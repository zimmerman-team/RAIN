<?php
/*
Template Name: Embed project page
*/
?>


<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
<!--[if lte IE 8]>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/leaflet.ie.css" />
<![endif]-->
<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" media="screen">
<link href="<?php echo get_template_directory_uri(); ?>/css/projects.css" rel="stylesheet">

<style>
body{
	padding-top: 0;
}

</style>

<?php //get_header();



include( get_template_directory() .'/projects-functions.php' );
$project_id = $_REQUEST['iati_id'];

if ($project_id == null){
	$url_parts = split("/", $_SERVER["REQUEST_URI"]);
	foreach($url_parts as $url_part){
		if (substr( $url_part, 0, 6 ) === "NL-KVK"){
			$project_id = $url_part;
		}
	}
}

$project = wp_get_activity($project_id);

?>

<div id="page-wrapper" class="project-page" style="padding-left: 10px">

	<div class="row">
		<div class="col-sm-12">
			<div id="project-title">
				<?php if (!empty($project->titles)){ 
					echo $project->titles[0]->title; 
				} else {
					echo "No title given";
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
						echo  $sep . "<a class='projects-description-link' href='?sectors={$sector->code}'>" . $sector->name . "</a>";
						$sep = ', ';
					}		
				}
				?>
			</div>
			<div class="project-country-wrapper">
				<?php 
				if(!empty($project->countries)) {
					$sep = '';
					foreach($project->countries AS $country) {
						echo  $sep . "<a class='projects-description-link' href='?countries={$country->code}'>" . $country->name . "</a>";
						$sep = ', ';
					}
				}
				?>
			</div>
		</div>
	</div>
<div class="page-full-width-line"></div>


	<div class="row">
		<div class="col-sm-8 project-main-bar">
			<div class="row">
				<div class="col-sm-12 project-main-bar-header">

					<div id="project-description-header" >Description</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="project-description-text">
						<?php if (!empty($project->descriptions)){ 
							echo $project->descriptions[0]->description; 
						} else {
							echo "No description given";
						}?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div id="project-map"></div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-3">

					<div class="project-dates">
						<span class="project-main-bar-header">start date</span><br>
						<?php 
						$start_date = "";

						if(!empty($project->start_planned)) {
					 	if ($project->start_planned != "1970-01-01"){
							$start_date = date("d-m-y", strtotime($project->start_planned));
					 	} } else if(!empty($project->start_actual)) { 
					 	if ($project->start_actual != "1970-01-01"){
							$start_date = date("d-m-y", strtotime($project->start_actual));
					 	} }

					 	if (empty($start_date)){
					 		$start_date = "unknown";
					 	}

					 	echo $start_date;
					 	?>
					</div>
					
				</div>
				<div class="col-sm-3	">

					<div class="project-dates">
						<span class="project-main-bar-header">end date</span><br>
						<?php 
						$end_date = "";
						
						if(!empty($project->end_planned)) {
					 	if ($project->end_planned != "1970-01-01"){
							$end_date = date("d-m-y", strtotime($project->end_planned));
					 	} } else if(!empty($project->end_actual)) { 
					 	if ($project->end_actual != "1970-01-01"){
							$end_date = date("d-m-y", strtotime($project->end_actual));
					 	} }

					 	if (empty($end_date)){
					 		$end_date = "unknown";
					 	}

					 	echo $end_date;
					 	?>
					</div>
				</div>
			</div>

			<div class="page-full-width-line"></div>

			<div class="row">
				<div class="col-sm-12">
					<div class="project-activity-status">
						<span class="project-main-bar-header">Activity status</span><br>
						<?php if(!empty($project->activity_status->name)) { echo $project->activity_status->name; } ?>
					</div>
				</div>
			</div>

			<div class="page-full-width-line"></div>

			<div class="row">
				<div class="col-sm-12">
					<div class="project-total-budget">
						<span class="project-main-bar-header">Total budget</span> <br>
						<?php if(!empty($project->total_budget)) {
							if(!empty($project->default_currency)) { 
								echo currencyCodeToSign($project->default_currency->code); }
								echo format_custom_number($project->total_budget);
						} else {
							echo "-";
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script>
var site = '<?php echo SITE_URL; ?>';
var search_url = '<?php echo SEARCH_URL; ?>';
var home_url = "<?php echo bloginfo("url"); ?>";
var template_directory = "<?php echo bloginfo("template_url"); ?>";
var site_title = "<?php echo wp_title(''); ?>";
var site_url = "<?php echo site_url(); ?>";
var standard_basemap = "zimmerman2014.hmpkg505";
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var ajax_path = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/oipa.js"></script>



<?php
global $_DEFAULT_ORGANISATION_ID;
?>
<script>
Oipa.default_organisation_id = "<?php echo $_DEFAULT_ORGANISATION_ID; ?>";
Oipa.default_organisation_name = "<?php echo 'RAIN Foundation'; ?>";
Oipa.framework = "wordpress";
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/rain.js"></script>

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

  jQuery( document ).ready(function() {

    Oipa.pageType = "activities";

    var selection = new OipaSelection(1, 1);
    Oipa.mainSelection = selection;
    Oipa.mainSelection.group_by = "country";

    var map = new OipaMap();
    map.set_map("project-map");
    map.selection = Oipa.mainSelection;
    Oipa.maps.push(map);

    if (countries != null){
        selection.countries = countries;
        map.refresh();
    }


  });

</script>

