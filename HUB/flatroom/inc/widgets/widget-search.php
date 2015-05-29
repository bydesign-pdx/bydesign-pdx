<?php
if (class_exists('dsSearchAgent_SearchWidget')) :
	
function flatroom_widgets_remover() {
    unregister_widget('dsSearchAgent_SearchWidget');
	register_widget('Flatroom_SearchAgent_SearchWidget');
}
add_action("widgets_init", "flatroom_widgets_remover");

class Flatroom_SearchAgent_SearchWidget extends dsSearchAgent_SearchWidget {
	function widget($args, $instance) {
		extract($args);
		extract($instance);
		$title = apply_filters("widget_title", $title);
		$options = get_option(DSIDXPRESS_OPTION_NAME);

		if (!$options["Activated"])
			return;
		
		$pluginUrl = plugins_url() . '/dsidxpress/';

		wp_enqueue_script('dsidxpress_widget_search_view', $pluginUrl . 'js/widget-client.js', array('jquery'), DSIDXPRESS_PLUGIN_VERSION, true);

		$formAction = get_home_url() . "/idx/";

		$defaultSearchPanels = dsSearchAgent_ApiRequest::FetchData("AccountSearchPanelsDefault", array(), false, 60 * 60 * 24);
		$defaultSearchPanels = $defaultSearchPanels["response"]["code"] == "200" ? json_decode($defaultSearchPanels["body"]) : null;
		$propertyTypes = dsSearchAgent_ApiRequest::FetchData("AccountSearchSetupFilteredPropertyTypes", array(), false, 60 * 60 * 24);
		$propertyTypes = $propertyTypes["response"]["code"] == "200" ? json_decode($propertyTypes["body"]) : null;

		$account_options = dsSearchAgent_ApiRequest::FetchData("AccountOptions", array(), false);
		$account_options = $account_options["response"]["code"] == "200" ? json_decode($account_options["body"]) : null;

		$num_location_dropdowns = 0;
		if($searchOptions["show_cities"] == "yes" || !isset($instance["searchOptions"]["show_cities"]))
			$num_location_dropdowns++;
		if($searchOptions["show_communities"] == "yes")
			$num_location_dropdowns++;
		if($searchOptions["show_tracts"] == "yes")
			$num_location_dropdowns++;
		if($searchOptions["show_zips"] == "yes")
			$num_location_dropdowns++;
		if($searchOptions["show_mlsnumber"] == "yes")
			$num_location_dropdowns++;

		echo $before_widget;
		if ($title)
			echo $before_title . $title . $after_title;

		echo <<<HTML
			<div class="dsidx-search-widget dsidx-widget">
			<form action="{$formAction}" method="get" onsubmit="return dsidx_w.searchWidget.validate();" >
				<div class="filter-form">
					<select name="idx-q-PropertyTypes" class="dsidx-search-widget-propertyTypes input-block-level styled">
						<option value="">All property types</option>
HTML;

		if (is_array($propertyTypes)) {
			foreach ($propertyTypes as $propertyType) {
				$name = htmlentities($propertyType->DisplayName);
				echo "<option value=\"{$propertyType->SearchSetupPropertyTypeID}\">{$name}</option>";
			}
		}

		echo <<<HTML
					</select>
					<label id="idx-search-invalid-msg" style="color:red"></label>
HTML;
		if($searchOptions["show_cities"] == "yes" || !isset($instance["searchOptions"]["show_cities"])) {
			echo <<<HTML
					<select id="idx-q-Cities" name="idx-q-Cities" class="idx-q-Location-Filter input-block-level">
HTML;
			if($num_location_dropdowns > 1)
				echo "<option value=\"\">City</option>";
			foreach ($searchOptions["cities"] as $city) {
				// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
				$city = htmlentities(trim($city));
				echo "<option value=\"{$city}\">{$city}</option>";
			}

			echo <<<HTML
					</select>
HTML;
		}
		if($searchOptions["show_communities"] == "yes") {
			echo <<<HTML
					<select id="idx-q-Communities" name="idx-q-Communities" class="idx-q-Location-Filter input-block-level">
HTML;
			if($num_location_dropdowns > 1)
				echo "<option value=\"\">Community</option>";
			foreach ($searchOptions["communities"] as $community) {
				// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
				$community = htmlentities(trim($community));
				echo "<option value=\"{$community}\">{$community}</option>";
			}

			echo <<<HTML
					</select>
HTML;
		}
		if($searchOptions["show_tracts"] == "yes") {
			echo <<<HTML
					<select id="idx-q-TractIdentifiers" name="idx-q-TractIdentifiers" class="idx-q-Location-Filter input-block-level">
HTML;
			if($num_location_dropdowns > 1)
				echo "<option value=\"\">Tract</option>";
			foreach ($searchOptions["tracts"] as $tract) {
				// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
				$tract = htmlentities(trim($tract));
				echo "<option value=\"{$tract}\">{$tract}</option>";
			}

			echo <<<HTML
					</select>
HTML;
		}
		if($searchOptions["show_zips"] == "yes") {
			echo <<<HTML
					<select id="idx-q-ZipCodes" name="idx-q-ZipCodes" class="idx-q-Location-Filter input-block-level">
HTML;
			if($num_location_dropdowns > 1)
				echo "<option value=\"\">Zip</option>";
			foreach ($searchOptions["zips"] as $zip) {
				// there's an extra trim here in case the data was corrupted before the trim was added in the update code below
				$zip = htmlentities(trim($zip));
				echo "<option value=\"{$zip}\">{$zip}</option>";
			}

			echo <<<HTML
					</select>
HTML;
		}
		if($searchOptions["show_mlsnumber"] == "yes") {
			echo <<<HTML
					<input id="idx-q-MlsNumbers" name="idx-q-MlsNumbers" type="text" class="input-block-level" placeholder="MLS #"/>
HTML;
		}
		echo <<<HTML
					<div class="row-fluid">
						<div class="span6"><input id="idx-q-PriceMin" name="idx-q-PriceMin" type="text" class="input-block-level" placeholder="Min price" /></div>
						<div class="span6"><input id="idx-q-PriceMax" name="idx-q-PriceMax" type="text" class="input-block-level" placeholder="Max price" /></div>
					</div>
HTML;
		if(isset($defaultSearchPanels)){
			foreach ($defaultSearchPanels as $key => $value) {
				if ($value->DomIdentifier == "search-input-home-size") {
					echo <<<HTML
					<input id="idx-q-ImprovedSqFtMin" name="idx-q-ImprovedSqFtMin" type="text" class="input-block-level" placeholder="Min sqft" />
HTML;
					break;
				}
			}
		}
		echo <<<HTML
					<input id="idx-q-BedsMin" name="idx-q-BedsMin" type="text" class="input-block-level" placeholder="Min bedrooms" />
					<input id="idx-q-BathsMin" name="idx-q-BathsMin" type="text" class="input-block-level" placeholder="Min bathrooms" />
				</div>
				<div class="dsidx-search-button search-form">
					<input type="submit" class="submit btn btn-block" value="Search for properties" />
HTML;
		if($options["HasSearchAgentPro"] == "yes" && $searchOptions["show_advanced"] == "yes"){
			echo <<<HTML
					try our&nbsp;<a href="{$formAction}advanced/"><i class="ib-icon-magnifier"></i> Advanced Search</a>
HTML;
		}
		if($account_options->EulaLink){
			$eula_url = $account_options->EulaLink;
			echo <<<HTML
					<p>By searching, you agree to the <a href="{$eula_url}" target="_blank">EULA</a></p>
HTML;
		}
		echo <<<HTML
				</div>
			</form>
			</div>
HTML;
		
		echo $after_widget;
		dsidx_footer::ensure_disclaimer_exists("search");
	}
}
endif;