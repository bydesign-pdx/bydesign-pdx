<?php
/* Template Name: Page: Right Sidebar Membership Directory */

global $data;

if (empty($_POST['search'])) {
		header("Location: http://sitemagpie.com/bcxa/corporate-directory/");
	} else {

get_header(); ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<div id="page-body-members" class="page-body">
	<div class="container">
		<?php get_template_part( 'framework/inc/titlebar' ); ?>
		<div class="row">
			<div class="span9"><?php
				if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
						the_content();
						wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					</article><?php
					if(!$data['check_disablecomments']) {
						comments_template();
					}
				endwhile; endif; ?>
<!-- start directory search code -->
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
			
			/* determine which search to use depending on the search criteria */
			/*if (!empty($_POST['lname'])) {
				searchByLastName($soap, $authHeaders);
			} else if (!empty($_POST['state'])) {
				searchByState($soap, $authHeaders);
			} else {*/
				searchByOther($soap, $authHeaders, $xwebNamespace);
			//}
		}  catch(SoapException $exception) {
			 throw $exception;
		}
	}
	/* Searches by the state if entered */
	function searchByState($soap, $authHeaders) {
		$responseHeaders = '';
		$arguments->bIncludeIndividuals = "1";
		$arguments->bIncludeOrganizations = "1";
		$arguments->szState = $_POST['state'];
		$arguments->szCity = "";
		$arguments->szRecordDate = "1/1/1990";
		
		$response = $soap->__SoapCall("GetCustomerByCityState", Array("parameters"=>$arguments), null, $authHeaders, $responseHeaders);
		$result = $response->GetCustomerByCityStateResult->any;
		$xml = simplexml_load_string($result);
		$search_results = array();
		$resultCount = 0;
		for ($i = 0; $i < count($xml); ++$i) {
			if (checkMembership(strval($xml->Result[$i]->Membership)) && checkCountry(strval($xml->Result[$i]->adr_country)) 
			 && checkCompany(strval($xml->Result[$i]->cst_org_name_dn)) && checkFirstName(strval($xml->Result[$i]->ind_first_name))) {
				$cust = new Customer($xml->Result[$i]);
				$search_results[$resultCount] = $cust;
				$resultCount++;
			}
		}
		displayResults($search_results);	
	}

	/* Searches by the last name if entered */
	function searchByLastName($soap, $authHeaders) {
		$name = $_POST['lname'];
		if (!empty($_POST['fname'])) {
			$name = $name." ".$_POST['fname'];
		}
		
		$responseHeaders = '';
		$arguments->szName = $name;
		$response = $soap->__SoapCall("GetCustomerByName", array("parameters"=>$arguments), null, $authHeaders, $responseHeaders);
		$result = $response->GetCustomerByNameResult->any;
		$xml = simplexml_load_string($result);
		$resultCount = 0;
		$search_results = array();
		for ($i = 0; $i < count($xml); ++$i) {
			if (checkMembership(strval($xml->Result[$i]->Membership)) && checkCountry(strval($xml->Result[$i]->adr_country)) 
			 && checkCompany(strval($xml->Result[$i]->cst_org_name_dn)) && checkState(strval($xml->Result[$i]->AddressState))){
				$cust = new Customer($xml->Result[$i]);				
				$search_results[$resultCount] = $cust;
				$resultCount++;
			}
		}
		displayResults($search_results);
	}
	
	/* Searches by first name, country, or company */
	function searchByOther($soap, $authHeaders, $xwebNamespace) {
		for ($j = 0; $j < 3; ++$j) {
			$responseHeaders = '';
			if ($j < 1) { $arguments->szRecordDate = "10/28/2010"; } else if ($j < 2) { $arguments->szRecordDate = "10/27/2010"; } else if ($j < 3) { $arguments->szRecordDate = "1"; }
			$arguments->bIncludeOrganizations = "1";
			$arguments->bIncludeIndividuals = "1";
			$arguments->bMembersOnly = "1";
			$response = $soap->__SoapCall("GetCustomerByRecordDate", array("parameters"=>$arguments), null, $authHeaders, $responseHeaders);
			$result = $response->GetCustomerByRecordDateResult->any;
			$xml[$j] = simplexml_load_string($result);
			$authToken = $responseHeaders['AuthorizationToken']->Token;
			$authHeaders = new SoapHeader($xwebNamespace, 'AuthorizationToken', Array('Token'=>$authToken), true);
		}
		$resultCount = 0;
		$search_results = array();
		$unique_keys = array();
		for ($j = 0; $j < count($xml); ++$j) {
			for ($i = 0; $i < count($xml[$j]); ++$i) {  
				if (checkMembership(strval($xml[$j]->Result[$i]->Membership)) && checkFirstName($xml[$j]->Result[$i]->ind_first_name) 
				 && checkCountry($xml[$j]->Result[$i]->adr_country) && checkCompany($xml[$j]->Result[$i]->cst_org_name_dn) 
				 && checkLastName($xml[$j]->Result[$i]->ind_last_name) && checkState($xml[$j]->Result[$i]->AddressState))  {
					if (!array_key_exists(strval($xml[$j]->Result[$i]->cst_key), $unique_keys)) {
						$cust = new Customer($xml[$j]->Result[$i]);  			
						$search_results[$resultCount] = $cust;
						$resultCount++;
						$unique_keys[strval($xml[$j]->Result[$i]->cst_key)] = true;
					}
				}
			}
		}
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
		 || !strcmp($membership, "NonProfit Membership") || !strcmp($membership, "CorpProviderIndividual") || !strcmp($membership, "AddlCorpProvider Membership")) {
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
?> 



<!-- end directory search code -->



			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>