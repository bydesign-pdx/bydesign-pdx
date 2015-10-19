<?php 
/*
Template Name: corporate-search-results
Created By: Charles Effinger - charlie.effinger@gmail.com
Executes a search on the Corporate Database
*/
	/* redirect if page gets accessed not from the corporate directory */
	if (empty($_POST['search'])) {
		header("Location: http://www.bcxa.org/corporate-directory/");
	} else {
		get_header(); ?>
		<div class="page-wrap">
			<?php get_template_part( 'framework/inc/slider' ); ?>
				<div id="page-body-training" class="page-body">
					<div class="container">
					<?php get_template_part( 'framework/inc/titlebar' ); ?>
						<div class="row">
			<?php get_sidebar(); ?>
			<div class="span9">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
<?php 
		/* initialize the soap call data */
		$soap = new SoapClient("http://netforum.avectra.com/xweb/netForumXMLOnDemand.asmx?WSDL",
			Array('trace'=>true, //turning on trace=true will let us grab the headers and responses
				'exceptions'=>true ));
		$auth = array('userName' => 'bcaxwebuser', 'password' => 'Bc4xW3bU5eR');
		$responseHeaders = '';
		try {
			/* get authorization token  */
			$response = $soap->__SoapCall("Authenticate",array('parameters'=>$auth), null, null, $responseHeaders);
			$authToken = $responseHeaders['AuthorizationToken']->Token;
			$xwebNamespace = $response->AuthenticateResult;
			$authHeaders = new SoapHeader($xwebNamespace, 'AuthorizationToken', Array('Token'=>$authToken), true);
			
			/* search the directory */
			search($soap, $authHeaders, $xwebNamespace);
		}  catch(SoapException $exception) {
			 throw $exception;
		}
	}

	/* Searches the corporate directory */
	function search($soap, $authHeaders, $xwebNamespace) {
		$resultCount = 0;
		$search_results = array(); 
		$unique_keys = array();
		
		$arguments->szRecordDate = "1/1/2010";
		$arguments->bIncludeOrganizations = "0";
		$arguments->bIncludeIndividuals = "1";
		$arguments->bMembersOnly = "1";
		do {
			$responseHeaders = '';
			$response = $soap->__SoapCall("GetCustomerByRecordDate", array("parameters"=>$arguments), null, $authHeaders, $responseHeaders);
			$result = $response->GetCustomerByRecordDateResult->any;
			$xml = simplexml_load_string($result);
			$authToken = $responseHeaders['AuthorizationToken']->Token;
			$authHeaders = new SoapHeader($xwebNamespace, 'AuthorizationToken', Array('Token'=>$authToken), true);
			for ($i = 0; $i < count($xml); ++$i) {  
				if (checkMembership(strval($xml->Result[$i]->Membership)) && checkFirstName($xml->Result[$i]->ind_first_name) 
				 && checkCountry($xml->Result[$i]->adr_country) && checkCompany($xml->Result[$i]->cst_org_name_dn) 
				 && checkLastName($xml->Result[$i]->ind_last_name) && checkState($xml->Result[$i]->AddressState))  {
					if (!array_key_exists(strval($xml->Result[$i]->cst_key), $unique_keys)) {
						$cust = new Customer($xml->Result[$i]);  			
						$search_results[$resultCount] = $cust;
						$unique_keys[strval($xml->Result[$i]->cst_key)] = true;
						$resultCount++;
					}
				}
			}
			$arguments->szRecordDate = strval($xml->Result[count($xml)-1]->RecordDate);
		} while (count($xml) >= 300);
	
		displayResults($search_results);
	}
	
	/* displays search info */
	function displayResults($results) {
		$message =  "<br>There ";
		if (count($results) == 1) {
			$message = $message."was ";
		} else {
			$message = $message."were ";
		}
		$message = $message.count($results)." result";
		if (count($results) != 1) {
			$message = $message."s";
		}
		$message = $message.".<br>";
		echo $message;
		echo "<br><a href=\"http://www.bcxa.org/corporate-directory/\">Search Again</a><br>"; 
		for ($i = 0; $i < count($results); ++$i) {
			$results[$i]->displayCust();
		}
		echo "<br><br>";

	
	}
	/* Checks the result against the proper memberships */
	function checkMembership($membership) {
		if (!strcmp($membership, "CorpNonProvider" ) || !strcmp($membership, "CorpNonProviderIndividual") || !strcmp($membership, "Corporate Membership") 
		 || !strcmp($membership, "NonProfit Membership") || !strcmp($membership, "CorpProviderIndividual") || !strcmp($membership, "AddlCorpProvider Membership") 
		 || !strcmp($membership, "CorpProviderSecond") || !strcmp($membership, "CorpNonProviderSecondd")
		) {
			return true;
		} else {
			return false;
		}
	}
	
	/* Checks the result against the specified first name */
	function checkFirstName($name) {
		if (empty($_POST['fname'])) {
			return true;
		} else {
			return !strcmp(strtolower($name), strtolower($_POST['fname']));
		}
	}
	
	/* Checks the result against the specified state */
	function checkState($state) {
		if (empty($_POST['state'])) {
			return true;
		} else {
			return !strcmp($state, $_POST['state']);
		}
	}
	
	/* Checks the result against the specified country */
	function checkCountry($country) {
		if (empty($_POST['country'])) {
			return true;
		} else {
			return !strcmp($country, $_POST['country']);
		}
	}
	/* Checks the result against the specified company */
	function checkCompany($company) {
		if (empty($_POST['company'])) {
			return true;
		} else {
			$pattern = '/^'.preg_quote(strtolower($_POST['company'])).'[a-zA-Z0-9\-_\. ]*/';
			return preg_match($pattern, strtolower($company));
		}
	}
	
	/* Checks the result against the specified last name */
	function checkLastName($name) {
		if (empty($_POST['lname'])) {
			return true;
		} else {
			return !strcmp(strtolower($name), strtolower($_POST['lname']));
		}
	}

	/* Customer class that holds all data */
	class Customer {
		private $fname;
		private $lname;
		private $address;
		private $state;
		private $city;
		private $zip;
		private $country;
		private $company;
		private $email;
		private $phone;
		private $fax;
		private $memberType;
   
		/* TODO: Fix constructor to stop repeated code */
		function __construct($cust) {
			$this->fname = strval($cust->ind_first_name);
			$this->lname = strval($cust->ind_last_name);
			$this->address = strval($cust->AddressLine1);
			if (!empty($cust->AddressLine2)) {
				$this->address = $this->address."<br>".strval($cust->AddressLine2);
				if (!empty($cust->AddressLine3)) {
					$this->address = $this->address."<br>".strval($cust->AddressLine3);
				}
			}
			$this->city = strval($cust->AddressCity);
			$this->company = strval($cust->cst_org_name_dn);
			$this->state = strval($cust->AddressState);
			$this->zip = strval($cust->AddressZip);
			$this->country = strval($cust->adr_country);
			$this->email = strval($cust->EmailAddress); 
			$this->phone = strval($cust->PhoneNumber); 
			$this->fax = strval($cust->FaxNumber);
			$this->memberType = strval($cust->Membership);  			
		}
		
		public function displayCust() {
			if (!empty($this->fname)) {
				echo "<br><b>Name:</b> ";
				echo $this->fname;
				echo " ";
				echo $this->lname;
			}
			if (!empty($this->company)) {
				echo "<br><b>Company:</b> ";
				echo $this->company;
			}
			if (!empty($this->address)) {
				echo "<br><b>Address:<br></b> ";
				echo $this->address;
			}
			if (!empty($this->city)) {
				echo "<br>";
				echo $this->city;
				echo ", ";
				echo $this->state;
				echo " ";
				echo $this->zip;
				echo "<br>";
			}
			echo $this->country;
			if (!empty($this->email)) {
				echo "<br><b>Email:</b> ";
				echo $this->email;
			}
			if (!empty($this->phone)) {
				echo "<br><b>Phone:</b> ";
				echo $this->phone;
			}
			if (!empty($this->fax)) {
				echo "<br><b>Fax:</b> ";
				echo $this->fax;
			}
			echo "<br><b>Membership Type:</b> ";
			echo $this->memberType;
			echo "<br>";
		}
	}	
?> 				</div>
			</div>
		</div><!-- #container -->
	</div><!-- #content -->

<?php get_footer(); ?>