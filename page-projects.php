<?php
/*
Template Name: Projects page
*/
?>

<?php 
get_header();

while ( have_posts() ) : the_post();

$projects_id = get_the_ID();

 endwhile; ?>

<div id="main-content-wrapper">

    <?php while ( have_posts() ) : the_post(); ?>

	<?php

	include( get_template_directory() .'/projects-functions.php' );
		oipa_generate_results($objects, $meta, null, true); 
	?>
	<a class="anchorsubnav" id="projects"></a>
	<div id="projects-wrapper">

		<?php
		include( get_template_directory() .'/projects-filters.php' );
		include( get_template_directory() .'/projects-map.php' );
		?>

		<div id="page-wrapper">
			<div class="page-header">
				<div class="container">
					<div id="projects-search-navbar" class="row">
						<div class="col-sm-4">
							<div class="projects-pagination-info hneue-bold">
								<div id="pagination-totals">
									<?php echo get_post_meta( $projects_id, 'projects-results', true ); ?> <span class="current-selection-amount"><?php echo $meta->total_count; ?></span> <?php echo get_post_meta( $projects_id, 'projects-results-of', true ); ?> <?php echo $meta->total_count; ?> <?php echo get_post_meta( $projects_id, 'projects-results-of-activities', true ); ?>
								</div>
							</div>
						</div>
						<div class="col-sm-8">
		                    <div class="sort-by-text"><?php echo get_post_meta( $projects_id, 'projects-sort-by', true ); ?></div>
							<div class="btn btn-default project-sort" data-name="total_budget"><?php echo get_post_meta( $projects_id, 'projects-budget', true ); ?>
								<div id="total_budget-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="total_budget"><?php echo get_post_meta( $projects_id, 'projects-ascending', true ); ?></a><br>
									<a href="#" data-asc-desc="desc" data-filter="total_budget"><?php echo get_post_meta( $projects_id, 'projects-descending', true ); ?></a>
								</div>
							</div>

							<div class="btn btn-default project-sort" data-name="start_actual"><?php echo get_post_meta( $projects_id, 'projects-start-date', true ); ?>
								<div id="start_actual-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="start_actual"><?php echo get_post_meta( $projects_id, 'projects-ascending', true ); ?></a><br>
									<a href="#" data-asc-desc="desc" data-filter="start_actual"><?php echo get_post_meta( $projects_id, 'projects-descending', true ); ?></a>
								</div>
							</div>

							<div class="btn btn-default project-sort" data-name="end_planned"><?php echo get_post_meta( $projects_id, 'projects-end-date', true ); ?>
								<div id="end_planned-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="end_planned"><?php echo get_post_meta( $projects_id, 'projects-ascending', true ); ?></a><br>
									<a href="#" data-asc-desc="desc" data-filter="end_planned"><?php echo get_post_meta( $projects_id, 'projects-descending', true ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="project-list-block">
				<div id="project-list-wrapper">
					<?php include( get_template_directory() .'/projects-list.php' ); ?>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<div id="project-list-pagination-wrapper">
								<div id="project-list-pagination"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	endwhile; 
	?>

	
</div>


<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>


<script>

    var filter = null;
    var projectlist = null;
    var otherlist = null;
    var map = null;

    <?php   
    if(isset($_REQUEST['countries'])) {
        echo 'var preloadcountries = "' . $_REQUEST['countries'] . '";';
    } else {
        echo 'var preloadcountries = null;';
    }
    ?>
    
  jQuery( document ).ready(function() {

    Oipa.pageType = "activities";

    var selection = new OipaSelection(1, 1);
    Oipa.mainSelection = selection;
    Oipa.mainSelection.group_by = "country";

    map = new OipaMap();
    map.set_map("map");
    map.selection = Oipa.mainSelection;
    Oipa.maps.push(map);

    filter = new OipaProjectFilters();
    Oipa.mainFilter = filter;
    filter.selection = Oipa.mainSelection;
    filter.init();

    projectlist = new OipaProjectList();
    projectlist.limit = 10;
    projectlist.list_div = "#project-list-wrapper";
    projectlist.pagination_div = "#project-list-pagination";

    projectlist.order_by = "end_planned";
    projectlist.order_by_asc_desc = "desc";

    projectlist.selection = Oipa.mainSelection;
    projectlist.init();
    
    Oipa.lists.push(projectlist);

    <?php 
    if(isset($_REQUEST['view'])) {
        if ($_REQUEST['view'] == 'list'){
            echo '$(".btn-list-view").click();';
        }
    }
    ?>

    filter.save();
  });


</script>


<?php get_footer();