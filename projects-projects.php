<?php 
include( get_template_directory() .'/projects-functions.php' );
	oipa_generate_results($objects, $meta, null, true); 
?>
<a class="anchorsubnav" id="projects"></a>
<div id="projects-wrapper">

		<?php
			$proj_id = get_the_ID();
			get_template_part( "projects", "filters" );
			get_template_part( "projects", "map" );
		?>

		<div id="page-wrapper">
			<div class="page-header">
				<div class="container">
					<div id="projects-search-navbar" class="row">
						<div class="col-sm-4">
							<div class="projects-pagination-info hneue-bold">
								<div id="pagination-totals">
									Results <span class="current-selection-amount"><?php echo $meta->total_count; ?></span> of <?php echo $meta->total_count; ?> activities
								</div>
							</div>
						</div>
						<div class="col-sm-8">
		                    <div class="sort-by-text">Sort by</div>
							<div class="btn btn-default project-sort" data-name="total_budget">Total budget
								<div id="total_budget-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="total_budget">Ascending</a><br>
									<a href="#" data-asc-desc="desc" data-filter="total_budget">Descending</a>
								</div>
							</div>

							<div class="btn btn-default project-sort" data-name="start_actual">Start date
								<div id="start_actual-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="start_actual">Ascending</a><br>
									<a href="#" data-asc-desc="desc" data-filter="start_actual">Descending</a>
								</div>
							</div>

							<div class="btn btn-default project-sort" data-name="end_planned">End date
								<div id="end_planned-asc-desc" class="asc-desc-slide-out">
									<a href="#" data-asc-desc="asc" data-filter="end_planned">Ascending</a><br>
									<a href="#" data-asc-desc="desc" data-filter="end_planned">Descending</a>
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

















</div>