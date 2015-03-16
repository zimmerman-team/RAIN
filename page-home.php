<?php
/*
Template Name: Home new
*/
?>
<?php get_header(); 
?>
<div class="container">
	<div id="page-home-main-wrapper" class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<div id="home-brand-building-block">
					 	<ul class="skippr">

							<?php
							$slidercount = 1;
							$args = array( 'post_type' => 'slider', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'ASC' );
							$loop = new WP_Query( $args );
							$firstid = 0;
							while ( $loop->have_posts() ) : $loop->the_post();
								
								if ($firstid == 0){$firstid = get_the_ID(); }
							?>

					 		<div data-slider-id="<?php echo $slidercount; ?>" class="home-slider-block home-slider-<?php echo $slidercount; ?>">
					 			<div class="home-slider-background-wrapper">
					 				<?php the_post_thumbnail('slider-full'); ?>
					 			</div>
					 			<div class="home-slider-title-id-<?php echo $slidercount; ?> home-slider-title">
					 				<?php the_content(); ?>
					 			</div>
					 			<div class="home-slider-subtitle-id-<?php echo $slidercount; ?> home-slider-subtitle">
					 				<?php echo get_post_meta( get_the_ID(), 'slider_block1_text', true ); ?>
					 			</div>
					 			<div class="home-slider-subtitle2-id-<?php echo $slidercount; ?> home-slider-subtitle-2">
					 				<?php echo get_post_meta( get_the_ID(), 'slider_block2_text', true ); ?>
					 			</div>
						 	</div>

							<?php
							$slidercount++;
							endwhile;
							?>

						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php dynamic_sidebar( "homepage-project-focus" ); ?>
				</div>
			</div>
			<div class="row">
				<?php dynamic_sidebar( "homepage-tools-countries" ); ?>
			</div>
		</div>
		<div class="col-md-4 homepage-sidebar">
			 <?php dynamic_sidebar( "homepage-side" ); ?>
		</div>
	</div>
</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.bxslider.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/helpers/jquery.fancybox-media.js"></script>

<script>


var filter = null;
var projectlist = null;
var otherlist = null;
var map = null;

Oipa.pageType = "activities";

var selection = new OipaSelection(1, 1);
Oipa.mainSelection = selection;
Oipa.mainSelection.group_by = "country";

map = new OipaMap();
map.set_map("explore-map");
map.selection = Oipa.mainSelection;
Oipa.maps.push(map);

filter = new OipaProjectFilters();
Oipa.mainFilter = filter;
filter.selection = Oipa.mainSelection;
filter.init();

map.refresh();


var slider = null;
var homeslider = null;

window.onload = function() {

	homeslider = new HomepageSlider();
	homeslider.set_slider(".skippr");
	homeslider.set_counter(13);
}

$(".fancyframe").fancybox({
    type        : 'iframe',
    maxWidth    : 800,
    maxHeight   : 600,
    fitToView   : false,
    width       : '70%',
    height      : '70%',
    autoSize    : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
});

</script>

<?php get_footer(); 