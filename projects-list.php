
<div class="page-content">

<?php


function get_ID_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}


// get correct projects id for language
if (ICL_LANGUAGE_CODE=="fr"){
	$the_id = get_ID_by_slug("projets");
} else {
	$the_id = get_ID_by_slug("projects");
}

function set_description($descriptions, $rsr_type){
	foreach ($descriptions as $description) {
	    if ($description->rsr_description_type_id == $rsr_type){
	    	return $description->description;
	    }
	}
	return "";
}
foreach($objects AS $idx=>$project) {
?>

	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="projects-image">
					<a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>" alt="See project details">
						<?php 	
						if(!empty($project->documents)) {

							$image_url = $project->documents[0]->url;

							?>
								<img src="<?php echo $image_url; ?>" alt="" />
							<?php

						} else {
							?>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image.png" alt="" />
							<?php
						}
						?>
					</a>
				</div>
				
			</div>

			<div class="col-sm-8">

				<div class="row">
					<div class="col-sm-12">

						<div class="projects-sector-wrapper">
							<b><?php echo get_post_meta( $the_id, 'projects-sector', true ); ?>: </b> <?php 
								if(!empty($project->sectors)) {
									$sep = '';
									foreach($project->sectors AS $sector) {
										if($sector->code > 1000){
											echo  $sep . "<a class='projects-description-link' href='?sectors={$sector->code}'>" . $sector->name . "</a>";
											$sep = ', ';
										}
									}		
								} else {
									echo "No information available";
								} ?>
						</div>
						<div class="projects-country-wrapper">
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

				<div class="row">
					<div class="col-sm-12">
						<div class="projects-title-wrapper">
							<a href="<?php echo SITE_URL . '/project/' . $project->id . '/'; ?>" alt="See project details">
							<?php if (!empty($project->titles)){ 
								echo $project->titles[0]->title; 
							} else {
								echo get_post_meta( $the_id, 'projects-no-title', true );
							}?>
							</a>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="projects-latest-update-wrapper">
						<?php echo get_post_meta( $the_id, 'projects-latest-update', true ); ?>

						<?php 
						if(!empty($project->last_updated_datetime)) { 
							echo date("d F Y", strtotime($project->last_updated_datetime));
						} else {
							echo get_post_meta( $the_id, 'projects-unknown', true );
						} 
						?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="projects-budget-wrapper">
						<?php echo get_post_meta( $the_id, 'projects-budget', true ); ?>:
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

				

				<div class="row projects-bottom-line-wrapper">
					<div class="col-sm-3">
						<?php if(!empty($project->activity_status->name)) { echo $project->activity_status->name; } ?>
					</div>
					<div class="col-sm-3">
						<?php 
						if(!empty($project->participating_organisations)) {

							$part_org_count = count($project->participating_organisations);
							echo (string)$part_org_count . " " . get_post_meta( $the_id, 'projects-partners', true );

						} else {
							echo "0 " . get_post_meta( $the_id, 'projects-partners', true );
						}
						?>
					</div>
					<div class="col-sm-3">
						<?php echo get_post_meta( $the_id, 'projects-start-date', true ); ?>: 
						
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
					 		$start_date = get_post_meta( $the_id, 'projects-unknown', true );
					 	}

					 	echo $start_date;
					 	?>
					</div>

					<div class="col-sm-3">
						<?php echo get_post_meta( $the_id, 'projects-end-date', true ); ?>: 
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
					 		$end_date = get_post_meta( $the_id, 'projects-unknown', true );
					 	}

					 	echo $end_date;
					 	?>
					</div>

				</div>


			
			</div>
		</div>
	</div>

	<div class="page-full-width-line-blue"></div>


<?php } ?>

<input type="hidden" class="list-amount-input" value="<?php echo $meta->total_count; ?>">

</div>
