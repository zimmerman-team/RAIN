<?php 

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function wp_get_activity($identifier) {
	if(empty($identifier)) return null;
	$search_url = SEARCH_URL . "activity-list/{$identifier}/?format=json";
	$content = file_get_contents($search_url);
	$activity = json_decode($content);
	return $activity;
}

function objectToArray($d) {
	if (is_object($d)) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars($d);
	}

	if (is_array($d)) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map(__FUNCTION__, $d);
	}
	else {
		// Return array
		return $d;
	}
}


function oipa_generate_results(&$objects, &$meta, $perspective = null, $use_filters = true){
	
	$search_url = OIPA_URL . "activity-list/?format=json";

	if($use_filters){
	    $search_url = oipa_filter_request($search_url);
	    if ($perspective){ 
	    	if ($perspective == "country"){
	    		$search_url .= "&countries__code__gte=0";
	    	} else if ($perspective == "region"){
	    		$search_url .= "&regions__code__gte=0";
	    	} else if ($perspective == "global"){
	    		$search_url .= "&countries=None&regions=None";
	    	}
	    }

	    $search_url = str_replace('start_planned__in', 'start_year_planned__in', $search_url);
    } else {
    	if (DEFAULT_ORGANISATION_ID){
    		$search_url .= "&limit=10";
			$search_url .= "&reporting_organisation__in=" . DEFAULT_ORGANISATION_ID;
		}
    }

    if(strpos($search_url,'order_by') === false) {
		$search_url .= "&order_by=-end_planned";
	}
	
	$content = file_get_contents($search_url);
	$result = json_decode($content);
	$meta = $result->meta;
	$objects = $result->objects;
}


function wp_generate_link_parameters($filter_to_unset=null){

	parse_str($_SERVER['QUERY_STRING'], $vars);
	if(isset($filter_to_unset)){
		if(isset($_GET[$filter_to_unset])){ unset($vars[$filter_to_unset]); }
	}
	if(isset($_GET['offset'])){ unset($vars['offset']); }
	if(isset($_GET['action'])){ unset($vars['action']); }
	$parameters = http_build_query($vars);
	$parameters = str_replace("%2C", ",", $parameters);
	if ($parameters){ $parameters = "&" . $parameters; }
	return $parameters;
}


function oipa_filter_request($search_url){


    if(isset($_REQUEST['countries__in'])) {
		$search_url .= "&countries__in=" . $_REQUEST['countries__in'];
	}

	if(isset($_REQUEST['countries'])) {
		$search_url .= "&countries=" . $_REQUEST['countries'];
	}

	if(isset($_REQUEST['country_id'])) {
		$search_url .= "&countries__in=" . $_REQUEST['country_id'];
	}

	if(isset($_REQUEST['regions__in'])) {
		$search_url .= "&regions__in=" . $_REQUEST['regions__in'];
	}

	if(isset($_REQUEST['regions'])) {
		$search_url .= "&regions=" . $_REQUEST['regions'];
	}

	if(isset($_REQUEST['region_id'])) {
		$search_url .= "&regions__in=" . $_REQUEST['region_id'];
	}

	if(isset($_REQUEST['sectors__in'])) {
		$search_url .= "&sectors__in=" . $_REQUEST['sectors__in'];
	}

	if(isset($_REQUEST['sector_id'])) {
		$search_url .= "&sectors__in=" . $_REQUEST['sector_id'];
	}

	if(isset($_REQUEST['donors__in'])) {
		$search_url .= "&participating_organisations__in=" . $_REQUEST['donors__in'];
	}

	if(isset($_REQUEST['donor_id'])) {
		$search_url .= "&participating_organisations__in=" . $_REQUEST['donor_id'];
	}

	if(isset($_REQUEST['participating_organisations__in'])) {
		$search_url .= "&participating_organisations__in=" . $_REQUEST['participating_organisations__in'];
	}

	if(isset($_REQUEST['activity_scope'])) {
		$search_url .= "&activity_scope=" . $_REQUEST['activity_scope'];
	}

	if(isset($_REQUEST['start_actual__in'])) {
		$search_url .= "&start_actual__in=" . $_REQUEST['start_actual__in'];
	}

	if(isset($_REQUEST['start_planned__in'])) {
		$search_url .= "&start_planned__in=" . $_REQUEST['start_planned__in'];
	}

	if(isset($_REQUEST['indicators__in'])) {
		$search_url .= "&indicators__in=" . $_REQUEST['indicators__in'];
	}

	if(isset($_REQUEST['cities__in'])) {
		$search_url .= "&cities__in=" . $_REQUEST['cities__in'];
	}

	if(isset($_REQUEST['reporting_organisations__in'])) {
		$search_url .= "&reporting_organisations__in=" . $_REQUEST['reporting_organisations__in'];
	} else {
		if (DEFAULT_ORGANISATION_ID){
			$search_url .= "&reporting_organisation__in=" . DEFAULT_ORGANISATION_ID;
		}
	}

	if(isset($_REQUEST['search'])) {
		$search_url .= "&search=" . $_REQUEST['search'];
	}

	if(isset($_REQUEST['query'])) {
		$search_url .= "&query=" . $_REQUEST['query'];
	}

	if(isset($_REQUEST['country'])) {
		$search_url .= "&country=" . $_REQUEST['country'];
	}

	if(isset($_REQUEST['region'])) {
		$search_url .= "&region=" . $_REQUEST['region'];
	}

	if(isset($_REQUEST['order_by'])) {
		$search_url .= "&order_by=" . $_REQUEST['order_by'];
	}

	if(isset($_REQUEST['order_by_asc_desc'])) {
		$search_url .= "&order_by_asc_desc=" . $_REQUEST['order_by_asc_desc'];
	}

	if(isset($_REQUEST['offset'])) {
		$search_url .= "&offset=" . $_REQUEST['offset'];
	}

	if(isset($_REQUEST['limit'])) {
		$search_url .= "&limit=" . $_REQUEST['limit'];
	} else {
		$search_url .= "&limit=10";
	}

	if(isset($_REQUEST['regions__code__gte'])) {
		$search_url .= "&regions__code__gte=" . $_REQUEST['regions__code__gte'];
	}

	if(isset($_REQUEST['countries__code__gte'])) {
		$search_url .= "&countries__code__gte=" . $_REQUEST['countries__code__gte'];
	}

	if(isset($_REQUEST['order_asc_desc'])){
		$search_url .= "&order_asc_desc=" . $_REQUEST['order_asc_desc'];
	}

	if(isset($_REQUEST['total_budget__gt'])){
		$search_url .= "&total_budget__gt=" . $_REQUEST['total_budget__gt'];
	}

	if(isset($_REQUEST['total_budget__lt'])){
		$search_url .= "&total_budget__lt=" . $_REQUEST['total_budget__lt'];
	}


	
	if(isset($_REQUEST['budgets__in'])) {
		$budget_gte = 99999999999;
		$budget_lte = 0;
		$budgets = explode(',', trim($_REQUEST['budgets__in']));
		foreach ($budgets as &$budget) {
		    $lower_higher = explode('-', $budget);
		    if($lower_higher[0] < $budget_gte){
		    	$budget_gte = $lower_higher[0];
		    }
		    if (sizeof($lower_higher) > 1) {
		    	
		    	if($lower_higher[1] > $budget_lte){
		    		$budget_lte = $lower_higher[1];
		    	}
		    }
		}

		if ($budget_gte != 99999999999){
			$search_url .= "&total_budget__gte={$budget_gte}";
		}
		if ($budget_lte != 0){
			$search_url .= "&total_budget__lte={$budget_lte}";
		}
	}
	$search_url = trim($search_url);
	$search_url = str_replace(" ", "%20", $search_url);

    return $search_url;
}



function format_custom_number($num) {
	
	$s = explode('.', $num);

	$parts = "";
	if(strlen($s[0])>3) {
		$parts = "." . substr($s[0], strlen($s[0])-3, 3);
		$s[0] = substr($s[0], 0, strlen($s[0])-3);
		
		if(strlen($s[0])>3) {
			$parts = "." . substr($s[0], strlen($s[0])-3, 3) . $parts;
			$s[0] = substr($s[0], 0, strlen($s[0])-3);
			if(strlen($s[0])>3) {
				$parts = "." . substr($s[0], strlen($s[0])-3, 3) . $parts;
				$s[0] = substr($s[0], 0, strlen($s[0])-3);
			} else {
				$parts = $s[0] . $parts;
			}
		} else {
			$parts = $s[0] . $parts;
		}
	} else {
		$parts = $s[0] . $parts;
	}
	
	
	$ret = $parts;
	
	if(isset($s[1])) {
		if($s[1]!="00") {
			$ret .= "," . $s[1];
		}
	}
	if (substr($ret, 0, 1) == "."){
		$ret = substr($ret, 1);
	}
	return $ret;
}





function currencyCodeToSign($currency){
	switch ($currency) {
	    case "CAD":
	        return "CAD $ ";
	        break;
	    case "DDK":
	        return "DDK kr. ";
	        break;
	    case "EUR":
	        return "EUR ";
	        break;
	    case "GBP":
	        return "GBP £ ";
	        break;
	    case "INR":
	        return "INR Rs ";
	        break;
	    case "NOK":
	        return "NOK kr. ";
	        break;
	    case "NPR":
	        return "NPR Rs ";
	        break;
	    case "NZD":
	        return "NZD $ ";
	        break;
	    case "PKR":
	        return "PKR Rs ";
	        break;
	    case "USD":
	        return "US $ ";
	        break;
	    case "ZAR":
	        return "Rand ";
	        break;

    }
}



?>