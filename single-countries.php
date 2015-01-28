<?php 
include( get_template_directory() .'/projects-functions.php' );

while ( have_posts() ) : the_post();

$country_name = $post->post_title;
$country_id = $post->post_name;

$_REQUEST['countries__in'] = $country_id; 

get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<h1 style="border-bottom: 1px dotted #ccc;padding-bottom: 0.3em;margin-bottom: 0.3em;"><?php the_title(); ?></h1>
					
					<?php the_content(); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
						
					<div class="rain-widget">
						<div class="rain-widget-title">
							<?php echo get_post_meta( get_the_ID(), 'single_countries_projects_in', true ) . ' ' . $country_name; ?>
						</div>

						<div id="explore-map">
							
						</div>
					</div>

				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php echo wpautop(get_post_meta( get_the_ID(), 'country_page_lower_text_box', true )); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">

					  <div id="project-list" class="rain-widget">
					    <div class="rain-widget-title">
					      <?php echo get_post_meta( get_the_ID(), 'single_countries_project_list', true ); ?>
					    </div>
					    <div class="rain-widget-text">
					      
					    <?php 

					    $exact_locations = array();

				        oipa_generate_results($objects, $meta, null, true); 

				        foreach($objects AS $idx=>$project) {

					      	foreach($project->locations as $loc){
								if ((!empty($loc->longitude)) && (!empty($loc->latitude))){

									array_push($exact_locations, array(
										"id" => $project->id,
										"longitude" => $loc->longitude, 
										"latitude" => $loc->latitude,
										"name" => $loc->name )
									);
								}
							}
					    ?>

					      <div class="row project-list-widget-item">
					        <div class="col-xs-4">    
					          <div class="project-list-widget-image">
					            <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
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
					        <div class="col-xs-8">
					          <a class="project-list-widget-title" href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
					             <?php if (!empty($project->titles)){ 
					                echo $project->titles[0]->title; 
					              } else {
					                echo get_post_meta( $the_id, 'projects-no-title', true );
					              }?>
					          </a>
					          <div class="project-list-widget-description">
					            <?php
					              $desc_found = 0;
					               if (!empty($project->descriptions)){ 
					                foreach($project->descriptions as $desc){
					                  if (!empty($desc->type)){
					                    if ($desc->type->code == 99){
					                      $full_desc = $desc->description;
					                      $desc_found = 1; 
					                      echo substr($full_desc, 0, 200);
					                    }
					                  }
					                }
					                
					              }
					              if ($desc_found == 0) {
					                echo "No description given";
					              }?>
					          </div>
					          <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>" class="btn btn-default">More information</a>
					        </div>
					      </div>
					      <hr>

					      <?php } ?>


					    </div>
					  </div>
				</div>
			</div>
		</div>
		<div class="col-md-4 homepage-sidebar">
			 <?php dynamic_sidebar( "countries-side" ); ?>
		</div>
	</div>
</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<script>

$(document).ready(function () {

var filter = null;
var projectlist = null;
var otherlist = null;
var map = null;

Oipa.pageType = "activities";
Oipa.mainSelection = new OipaSelection(1, 1);
Oipa.mainSelection.countries.push({"id": "<?php echo $country_id; ?>", "name": "<?php echo $country_name; ?>"});
Oipa.mainSelection.group_by = "exact_location";

Oipa.mainSelection.exact_locations = [];

<?php     
	foreach($exact_locations as $loc){
		echo 'Oipa.mainSelection.exact_locations.push(' . json_encode($loc) . ');';
	}
?>

map = new OipaMap();
map.set_map("explore-map");
map.selection = Oipa.mainSelection;
Oipa.maps.push(map);

filter = new OipaProjectFilters();
Oipa.mainFilter = filter;
filter.selection = Oipa.mainSelection;

map.refresh();
});
</script>

<?php 
endwhile; 
get_footer(); ?>