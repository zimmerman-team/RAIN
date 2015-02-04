<?php 

include( get_template_directory() .'/projects-functions.php' );


$service_color = get_post_meta( get_the_ID(), 'service-color', true );

get_header();

if($post->post_name == "implementation"){
	$_REQUEST['sector_id'] = "202";
} else if($post->post_name == "intelligence"){
	$_REQUEST['sector_id'] = "201";;
} else if($post->post_name == "advice"){
	$_REQUEST['sector_id'] = "200";
}

$_REQUEST['limit'] = 100;


while ( have_posts() ) : the_post(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div class="single-service-main-block single-service-<?php echo $service_color; ?>">
						<div class="col-md-12">

							<div class="single-service-title"><?php the_title(); ?></div><br>
							<?php 
							$subtitle = get_post_meta( get_the_ID(), 'service-subtitle', true ); 
							if (!empty($subtitle)){
								echo '<div class="single-service-subtitle">';
								echo $subtitle;
								echo '</div>';
							}
							?>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<span> Description </span>
									<?php echo wpautop(get_post_meta( get_the_ID(), 'service-description', true )); ?>
								</div>
								<div class="col-md-6">
									<span> Features </span>
									<?php echo wpautop(get_post_meta( get_the_ID(), 'service-features', true )); ?>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<span> Who is using <?php echo get_post_meta( get_the_ID(), 'service-name', true ); ?>? </span>
									<?php echo wpautop(get_post_meta( get_the_ID(), 'service-who-is-using', true )); ?>
								</div>
								<div class="col-md-6">
									<span> Downloads </span>
									<?php echo wpautop(get_post_meta( get_the_ID(), 'service-download-factsheets', true )); ?>
								</div>
							</div>

							<div class="row single-service-testimonial">
								<?php the_post_thumbnail(); ?>

								<?php 
								$testimonial_title = get_post_meta( get_the_ID(), 'testimonial-title', true ); 
								if(!empty($testimonial_title)){
									echo '<div class="single-service-testimonial-title">';	
									echo $testimonial_title;
									echo '</div>';
								}

								$testimonial_text = get_post_meta( get_the_ID(), 'testimonial-text', true ); 
								if(!empty($testimonial_text)){
									echo '<div class="single-service-testimonial-text">';	
									echo $testimonial_text;
									echo '</div>';
								} ?>
							</div>
						</div>
					</div>

				</div>
			</div>


			<div class="row">
				<div class="col-md-12">

				  <div class="rain-widget">
				    <div class="rain-widget-title">
				      Best practices
				    </div>
				    <div class="rain-widget-text">
				      
				      <?php 
				      
				      for ($i = 1; $i < 4;$i++) {

				      	$best_practice_text = get_post_meta( get_the_ID(), 'best_practice_' . $i . '_text', true );

				      	$best_practice_image = get_post_meta( get_the_ID(), 'best_practice_' . $i . '_image', true );
				      	
				      	if (!empty($best_practice_text)){

				      	
				      ?>

				      <div class="row project-list-widget-item">
				        <div class="col-xs-4">    
				          <div class="project-list-widget-image">
				          	<?php
				             	if(!empty($best_practice_image)){
				             		echo wp_get_attachment_image( $best_practice_image, 'project-list-thumb');
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
				        	<div class="project-list-service-text">
				        		<?php echo wpautop($best_practice_text); ?>
				        	</div>
				        </div>
				      </div>
				      <hr>

				      <?php }
				  	} ?>

				    </div>
				  </div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<?php dynamic_sidebar( "services-main" ); ?>
				</div>
			</div>
		</div>
		<div class="col-md-4 homepage-sidebar">
			 <?php dynamic_sidebar( "services-side" ); ?>
		</div>
	</div>
</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<script>

var filter = null;
var projectlist = null;
var otherlist = null;
var map = null;

Oipa.pageType = "activities";

var selection = new OipaSelection(1, 1);
console.log(selection);
<?php 
if($post->post_name == "implementation"){
	echo 'selection.services.push({"id": "202", "name": "Implementation"});';
} else if($post->post_name == "intelligence"){
	echo 'selection.services.push({"id": "201", "name": "Intelligence"});';
} else if($post->post_name == "advice"){
	echo 'selection.services.push({"id": "200", "name": "Advice"});';
}
?>
Oipa.mainSelection = selection;
Oipa.mainSelection.group_by = "country";

map = new OipaMap();
map.set_map("explore-map");
map.selection = Oipa.mainSelection;
Oipa.maps.push(map);

filter = new OipaProjectFilters();
Oipa.mainFilter = filter;
filter.selection = Oipa.mainSelection;
map.refresh();

</script>

<?php endwhile; ?>
<?php get_footer(); ?>