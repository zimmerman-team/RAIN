<?php
/*
Template Name: Single project page
*/

get_header();

$project_id = null;
if (!empty($_REQUEST['iati_id'])){
	$project_id = $_REQUEST['iati_id'];
}

include( get_template_directory() .'/projects-functions.php' );

if ($project_id == null){
	$url_parts = explode("/", $_SERVER["REQUEST_URI"]);
	foreach($url_parts as $url_part){
		if (substr( $url_part, 0, 6 ) === "NL-KVK"){
			$project_id = $url_part;
		}
	}
}

$project = wp_get_activity($project_id);

$rsr_id = "";
if (!empty($project->other_identifier)){
	foreach($project->other_identifier as $otheridentifier){
		if ($otheridentifier->owner_name == "akvorsr"){
			$rsr_id = $otheridentifier->owner_ref;
		}
	}
}

if(!empty($rsr_id)){
	$rsr_url = "http://rsr.akvo.org/api/v1/project/". $rsr_id . "/?format=json";
	$rsr_project = file_get_contents($rsr_url);
} else {
	$rsr_project = null;
}

$result = json_decode($rsr_project);
?>

<div id="page-wrapper" class="project-page">

	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<a href="<?php echo bloginfo('url'); ?>/projects/" id="project-back-button">
					<?php echo get_post_meta( get_the_ID(), 'back_to_results', true ); ?>
				</a>
			</div>
		</div>
	</div>
	<div class="page-full-width-line"></div>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="project-title">
					<?php if (!empty($project->titles)){ 
						echo $project->titles[0]->title; 
					} else {
						echo get_post_meta( get_the_ID(), 'no_title_given', true );
					}?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="project-sector-wrapper">
					<b>Sector: </b> 
					<?php 
					if(!empty($project->sectors)) {
						$sep = '';
						foreach($project->sectors AS $sector) {
							if($sector->code > 1000){
								echo  $sep . "<a class='projects-description-link' href='" . home_url() . "/projects/?sectors={$sector->code}'>" . $sector->name . "</a>";
								$sep = ', ';
							}
						}		
					}
					?>
				</div>
				<div class="project-country-wrapper">
					<?php 
					if(!empty($project->countries)) {
						$sep = '';
						foreach($project->countries AS $country) {
							echo  $sep . "<a class='projects-description-link' href='" . home_url() . "/country/{$country->code}/'>" . $country->name . "</a>";
							$sep = ', ';
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="page-full-width-line"></div>



	<div class="container">
		<div class="row">
			<div class="col-sm-8 project-main-bar">
				<div class="row">
					<div class="col-sm-12 project-main-bar-header">

						<div id="project-description-header">
							<?php echo get_post_meta( get_the_ID(), 'project_summary', true ); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="project-description-text">
							<?php
							$desc_found = 0;
							// get descriptions from rsr
							 if (!empty($project->descriptions)){ 
							 	if (count($project->descriptions) > 2){
							 		$desc = $project->descriptions[2];
							 		echo $desc->description;
							 		$desc_found = 1; 
							 	}
							}
							if ($desc_found == 0) {
								echo get_post_meta( get_the_ID(), 'no_summary_found', true );
							}?>
						</div>
					</div>
				</div>


				<?php if(!empty($project->results)) { ?>

				<div class="row">
					<div class="col-sm-12 project-main-bar-header">
						<div id="project-description-header">
							<?php echo get_post_meta( get_the_ID(), 'project_output', true ); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div id="project-description-text">
							<?php 
								foreach($project->results AS $result) {
									echo "<li>" . $result->title . "</li>";
								}		
							?>
							<br>
						</div>
					</div>
				</div>

				<?php } ?>


				<div class="row">
					<div class="col-sm-12">
						<div id="project-map"></div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">

						<div class="project-dates">
							<span class="project-main-bar-header">
								<?php echo get_post_meta( get_the_ID(), 'project_start_date', true ); ?>
							</span><br>
							<span class="project-main-bar-text">
							<?php 
							$start_date = "";

							if(!empty($project->start_planned)) {
						 	if ($project->start_planned != "1970-01-01"){
								$start_date = date("d-m-Y", strtotime($project->start_planned));
						 	} } else if(!empty($project->start_actual)) { 
						 	if ($project->start_actual != "1970-01-01"){
								$start_date = date("d-m-Y", strtotime($project->start_actual));
						 	} }

						 	if (empty($start_date)){
						 		$start_date = get_post_meta( get_the_ID(), 'project_unknown', true );
						 	}

						 	echo $start_date;
						 	?>
						 	</span>
						</div>
						
					</div>
					<div class="col-sm-4">

						<div class="project-dates">
							<span class="project-main-bar-header">
								<?php echo get_post_meta( get_the_ID(), 'project_end_date', true ); ?>
							</span><br>
							<span class="project-main-bar-text">
							<?php 
							$end_date = "";
							
							if(!empty($project->end_planned)) {
						 	if ($project->end_planned != "1970-01-01"){
								$end_date = date("d-m-Y", strtotime($project->end_planned));
						 	} } else if(!empty($project->end_actual)) { 
						 	if ($project->end_actual != "1970-01-01"){
								$end_date = date("d-m-Y", strtotime($project->end_actual));
						 	} }

						 	if (empty($end_date)){
						 		$end_date = "unknown";
						 	}

						 	echo $end_date;
						 	?>
						 	</span>
						</div>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12">
						<div class="project-activity-status">
							<span class="project-main-bar-header">
								<?php echo get_post_meta( get_the_ID(), 'project_activity_status', true ); ?>
							</span><br>
							<span class="project-main-bar-text">
								<?php if(!empty($project->activity_status->name)) { echo $project->activity_status->name; } ?>
							</span>
						</div>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12">
						<div class="project-total-budget">
							<span class="project-main-bar-header">
								<?php echo get_post_meta( get_the_ID(), 'project_total_budget', true ); ?>
							</span> <br>
							<span class="project-main-bar-text">
								<?php if(!empty($project->total_budget)) {
									if(!empty($project->default_currency)) { 
										echo currencyCodeToSign($project->default_currency->code); }
										echo format_custom_number($project->total_budget);
								} else {
									echo "-";
								} ?>
							</span>
						</div>
					</div>
				</div>

				<div class="page-full-width-line"></div>


				<?php /*
				<div class="row">
					<div class="col-sm-12">
						<span class="project-main-bar-header project-spending-header">Budget spending</span>
						<div class="project-rsr-updates-text">
							<div id="visualisation-block-wrapper">

								<?php if(empty($project->total_budget)) {

									echo "<div id='no-budget-spending'>No budget spending available.</div>";
								}
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="page-full-width-line"></div>
				*/ ?>

				<div class="row">
					<div class="col-sm-12">
						<span class="project-main-bar-header project-rsr-updates-header">
							<?php echo get_post_meta( get_the_ID(), 'project_project_updates', true ); ?>
						</span>
						<?php if(!empty($rsr_id)){ ?>
							<a target="_blank" href="http://rain.akvoapp.org/en/project/<?php echo $rsr_id; ?>/update" style="float:right;padding-top: 14px;"> Add an update </a>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="project-rsr-updates-text">

							<?php 
							include( get_template_directory() .'/project-rsr-updates.php' );
							?>
							
						</div>					
					</div>
				</div>

				<div class="page-full-width-line statistics-wrapper"></div>
<?php /*
				<!-- <div class="row statistics-wrapper">
					<div class="col-sm-12">
						<span class="project-main-bar-header project-statistics-header">Statistics</span>
						<div class="project-rsr-updates-text">
							

							Visualisations on: <br>
							&nbsp; <br>
							-Types of rainwater harvesting used <br>
							-Amount of systems placed <br>
							-Amount of domestic m³ <br>
							-Amount of productive m³ <br>
							-Amount of men provided water to <br>
							-Amount of women provided water to <br>
							-Amount of girls provided water to <br>
							-Amount of boys provided water to <br>
							&nbsp; <br>
							note: only available on implementation projects
						
						</div>	
					</div>
				</div> -->
*/ ?>
			</div>
			<div class="col-sm-4 project-sidebar">

				<div class="row">
					<div class="col-sm-12 project-sidebar-header">
						
						<?php echo get_post_meta( get_the_ID(), 'project_share_this_project', true ); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="single-news-share-buttons">
							<?php echo do_shortcode('[feather_share skin="wheel" size="24"]'); ?>
						</div>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12 project-sidebar-header">
						<?php echo get_post_meta( get_the_ID(), 'project_information', true ); ?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_iati_identifier', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php if(!empty($project->iati_identifier)) { echo $project->iati_identifier; } ?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_sectors', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php 
							if(!empty($project->sectors)) {
								$sep = '';
								foreach($project->sectors AS $sector) {
									if ($sector->code > 300){
										echo  $sep . $sector->name;
										$sep = ', ';
									}
								}			
							} else {
								echo get_post_meta( get_the_ID(), 'no_information_available', true );
							} ?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_last_updated', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php if(!empty($project->last_updated_datetime)) { echo date("d F Y", strtotime($project->last_updated_datetime)); } ?>
					</div>
				</div>

	
				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_funding_organisation', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php 
							if(!empty($project->participating_organisations)) {
								$sep = ', ';
								$part_org_text = '';

								foreach($project->participating_organisations AS $participating_organisation) {
									if($participating_organisation->role_id == "Funding"){
										if(empty($participating_organisation->name)) {
											$part_org_text .= $participating_organisation->code;

										} else {
											$part_org_text .= $participating_organisation->name;
										}
										$part_org_text .= $sep;
									}
								}
								
								$part_org_text = substr($part_org_text, 0, -2);
								echo $part_org_text;
							} 

							if(empty($part_org_text)){
								echo get_post_meta( get_the_ID(), 'project_not_applicable_or_no_info', true );
							}

							?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_accountable_organisation', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php 
							if(!empty($project->participating_organisations)) {
								$sep = ', ';
								$part_org_text = '';

								foreach($project->participating_organisations AS $participating_organisation) {
									if($participating_organisation->role_id == "Accountable"){
										if(empty($participating_organisation->name)) {
											$part_org_text .= $participating_organisation->code;

										} else {
											$part_org_text .= $participating_organisation->name;
										}
										$part_org_text .= $sep;
									}
								}
								
								$part_org_text = substr($part_org_text, 0, -2);
								echo $part_org_text;
							} 

							if(empty($part_org_text)){
								echo get_post_meta( get_the_ID(), 'project_not_applicable_or_no_info', true );
							}
							?>

					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_implementing_organisation', true ); ?>						
					</div>
					<div class="col-sm-6">
						<?php 
							if(!empty($project->participating_organisations)) {
								$sep = ', ';
								$part_org_text = '';

								foreach($project->participating_organisations AS $participating_organisation) {
									if($participating_organisation->role_id == "Implementing"){
										if(empty($participating_organisation->name)) {
											$part_org_text .= $participating_organisation->code;

										} else {
											$part_org_text .= $participating_organisation->name;
										}
										$part_org_text .= $sep;
									}
								}
								
								$part_org_text = substr($part_org_text, 0, -2);
								echo $part_org_text;
							} 

							if(empty($part_org_text)){
								echo get_post_meta( get_the_ID(), 'project_not_applicable_or_no_info', true );
							}
							?>
					</div>
				</div>


				<div class="page-full-width-line"></div>

				<?php if(!empty($project->countries)) { ?>
				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_countries', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php
							$sep = '';
							foreach($project->countries AS $country) {
								echo  $sep . "<a href='" . home_url() . "/country/{$country->code}/'>" . $country->name . "</a>";
								$sep = ', ';
							}		
						?>
					</div>
				</div>


				<div class="page-full-width-line"></div>

				<?php } ?>

				<?php if(!empty($project->regions)) { ?>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_regions', true ); ?>
					</div>
					<div class="col-sm-6">
						<?php 
							$sep = '';
							foreach($project->regions AS $region) {
								echo  $sep . "<a href='".get_bloginfo('url')."/projects/?regions={$region->code}'>" . $region->name . "</a>";
								$sep = ', ';
							}		
						?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<?php } ?>


				<?php if (!empty($rsr_id)): ?>

				<div class="row information-table-row">
					<div class="col-sm-6">
						<?php echo get_post_meta( get_the_ID(), 'project_akvo_rsr_page', true ); ?>
					</div>
					<div class="col-sm-6">
						<a target="_blank" href="http://rain.akvoapp.org/en/project/<?php echo $rsr_id; ?>/">Go to RSR</a>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<?php endif; ?>



				<div class="row">
					<div class="col-sm-12 project-sidebar-header project-export-header">
						<?php echo get_post_meta( get_the_ID(), 'project_export_iati_data', true ); ?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12">
						<div id="project-export-block">
							<?php echo get_post_meta( get_the_ID(), 'project_download_data', true ); ?><br>
						
							<a class="export-download-button" data-format="json" data-id="<?php echo $project_id; ?>" href="#">JSON</a>
							<a class="export-download-button" data-format="csv" data-id="<?php echo $project_id; ?>" href="#">CSV</a>
							<a class="export-download-button" data-format="xml" data-id="<?php echo $project_id; ?>" href="#">XML</a>

						</div>
						
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 project-sidebar-header">
						<?php echo get_post_meta( get_the_ID(), 'project_embed_code', true ); ?>
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12">
						<div id="project-embed-block">
							<div id="project-embed-title">
								<?php echo get_post_meta( get_the_ID(), 'project_embed_code_text', true ); ?>
							</div>
							<textarea id="embed-code-input"><script type="text/javascript" src="<?php echo site_url(); ?>/wp-content/themes/rain/js/embed.js"></script>
<script>
 oipa_embed.options(
    url = "<?php echo site_url(); ?>/embed/<?php echo $project_id ?>/",
    width = 510,
    height = 1000
);
</script>

							</textarea>
							<div id="copy-embed-wrapper">
								<button id="copy-button" class="copy-embed-code" data-clipboard-target="embed-code-input" title="Click to copy me.">
									<?php echo get_post_meta( get_the_ID(), 'project_copy', true ); ?>
								</button>
							</div>
						</div>
					</div>
				</div>

				<?php /*

				<div class="row">
					<div class="col-sm-12 project-sidebar-header">
						MAIN CONTACT
					</div>
				</div>

				<div class="page-full-width-line"></div>

				<div class="row">
					<div class="col-sm-12">
						contact info NOTE: FEASIBILITY TO BE SEEN <br>
						&nbsp;<br>
						update: This data is not in the RAIN IATI file. 

					</div>
				</div>

				*/ ?>


				<div class="row">
					<div class="col-sm-12 project-sidebar-header project-sidebar-header-related-project">
						<?php echo get_post_meta( get_the_ID(), 'project_related_country', true ); ?>
					</div>
				</div>

				<?php 

				// currently only looking at projects in the same country. Later we could also look at same:
				// - programme
				// - theme
				// - service
				
				$countries_for_related = "";
				if(!empty($project->countries)) {
					$sep = '';
					foreach($project->countries AS $country) {
						$countries_for_related .= $sep . $country->code;
						$sep = ",";
					}
				}

				$search_url = OIPA_URL . "activity-list/?format=json&limit=25&reporting_organisation__in=" . DEFAULT_ORGANISATION_ID;
				if (!empty($countries_for_related)){
					$search_url .= "&countries__in=" . $countries_for_related;
				}
				$content = file_get_contents($search_url);
				$rel_result = json_decode($content);

				foreach($rel_result->objects as $rel_project){ 

					if($rel_project->id != $project_id){
				?>
				<div class="page-full-width-line"></div>

				<div class="row project-related-project-row">
					<div class="col-sm-12">
						<a href="<?php echo SITE_URL . '/project/' . $rel_project->id . '/'; ?>" alt="See project details">
							<?php if (!empty($rel_project->titles)){ 
								echo $rel_project->titles[0]->title; 
							} else {
								echo get_post_meta( get_the_ID(), 'no_title_given', true );
							}?>
							</a>
					</div>
				</div>
				<?php }
			} ?>
				
			</div>
		</div>
	</div>
</div>

<?php
function get_budget_value($budget, $budget_type){

	if(!empty($budget)) {

		foreach($budget AS $bud) {
			if(!empty($bud->type)) {
				if($bud->type->code == $budget_type){
					return $bud->value;
				}
			}
		}
	}

	return 0;
}

?>

<script>
var countries = null;

<?php 
if(!empty($project->countries)) {
	echo "countries = [];";
	$sep = '';
	foreach($project->countries AS $country) {
		echo "countries.push({'id': '" . $country->code . "', 'name': '" . $country->name . "'});";
	}
}



?>


<?php if(empty($project->total_budget)) {
	echo 'var loadBudgetData = false;';
} else {
	echo 'var loadBudgetData = true;';
} ?>



var budgetdata = [ 
	{
	  key: "Cumulative Return",
	  values: [
	    { 
	      "label" : "management" ,
	      "value" : <?php echo get_budget_value($project->budget, 100); ?>
	    } , 
	    { 
	      "label" : "employment" , 
	      "value" : <?php echo get_budget_value($project->budget, 101); ?>
	    } , 
	    { 
	      "label" : "hardware" , 
	      "value" : <?php echo get_budget_value($project->budget, 102); ?>
	    } , 
	    { 
	      "label" : "transport" , 
	      "value" : <?php echo get_budget_value($project->budget, 103); ?>
	    } , 
	    { 
	      "label" : "training" ,
	      "value" : <?php echo get_budget_value($project->budget, 104); ?>
	    } , 
	    { 
	      "label" : "communication" , 
	      "value" : <?php echo get_budget_value($project->budget, 105); ?>
	    } , 
	    { 
	      "label" : "contingency" , 
	      "value" : <?php echo get_budget_value($project->budget, 106); ?>
	    }, 
	    { 
	      "label" : "other" , 
	      "value" : <?php echo get_budget_value($project->budget, 107); ?>
	    },
	  ]
	}
];

</script>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/d3.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/nv.d3.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/oipa-vis.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/dist/ZeroClipboard.min.js"></script>

<script>
var exact_locations = [];
	<?php     
		foreach($project->locations as $loc){
			if ((!empty($loc->longitude)) && (!empty($loc->latitude))){
				echo 'exact_locations.push({"longitude": "' . $loc->longitude . '", "latitude": "' . $loc->latitude . '", "name": "' . $loc->name . '" });';
			}
		}
	?>

var map = null;

  jQuery( document ).ready(function() {

    Oipa.pageType = "activities";

    var selection = new OipaSelection(1, 1);
    Oipa.mainSelection = selection;
    if(exact_locations.length == 0){
    	Oipa.mainSelection.group_by = "country";
    } else {
    	Oipa.mainSelection.group_by = "exact_location";
    	Oipa.mainSelection.exact_locations = exact_locations;
    }

    map = new OipaMap();
    map.detail = true;
    map.set_map("project-map");
    map.selection = Oipa.mainSelection;
    Oipa.maps.push(map);

    if (countries != null && exact_locations.length == 0){
        selection.countries = countries;
        
    }

    map.refresh();

  });

if (loadBudgetData){
// create line chart
var columnchart = new OipaColumnChart();

columnchart.indicator = "spending-chart";
<?php 
echo 'columnchart.name = "' . get_post_meta( get_the_ID(), 'project_spending_over_years', true ) . '";';
?>

columnchart.init();
columnchart.visualize();
}

// main.js
var client = new ZeroClipboard( document.getElementById("copy-button") );

client.on( "ready", function( readyEvent ) {

  client.on( "aftercopy", function( event ) {
    $("#copy-button").text("Copied");
  } );
} );
</script>

<?php get_footer();