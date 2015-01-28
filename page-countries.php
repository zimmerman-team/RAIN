<?php 

include( get_template_directory() .'/projects-functions.php' );

get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<?php while ( have_posts() ) : the_post(); ?>

					<h1 style="border-bottom: 1px dotted #ccc;padding-bottom: 0.3em;margin-bottom: 0.3em;">
						<?php the_title(); ?>
					</h1>
					
					<?php // echo get_post_meta( get_the_ID(), 'country-subtitle', true ); ?>
					
					<?php endwhile; ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="rain-widget" style="margin-top: 10px; margin-bottom: 1em;">
						<div class="rain-widget-title">
							Explore RAIN projects per country
						</div>

						<div id="explore-map">
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?php the_content(); ?>
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

</script>

<?php get_footer();