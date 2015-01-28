<div id="project-filter-wrapper">
	<div class="container">
		<div class="row project-filter">
			<div class="col-sm-12">

				<button type="button" class="btn btn-default btn-open-filter" data-name="countries"><?php echo get_post_meta( $projects_id, 'projects-country', true ); ?> <span class="caret"></span></button>
				<button type="button" class="btn btn-default btn-open-filter" data-name="services"><?php echo get_post_meta( $projects_id, 'projects-services', true ); ?> <span class="caret"></span></button>
				<button type="button" class="btn btn-default btn-open-filter" data-name="project-types"><?php echo get_post_meta( $projects_id, 'projects-project-type', true ); ?> <span class="caret"></span></button>
				<button type="button" class="btn btn-default btn-open-filter" data-name="themes"><?php echo get_post_meta( $projects_id, 'projects-themes', true ); ?> <span class="caret"></span></button>
				<button type="button" class="btn btn-default btn-open-filter" data-name="sustainability-types"><?php echo get_post_meta( $projects_id, 'projects-sustainability', true ); ?> <span class="caret"></span></button>

				<div class="float-right">
					<button type="button" class="btn btn-default btn-map-view active"><?php echo get_post_meta( $projects_id, 'projects-map-view', true ); ?></button>
					<button type="button" class="btn btn-default btn-list-view"><?php echo get_post_meta( $projects_id, 'projects-list-view', true ); ?></button>
				</div>
			</div>
		</div>
	</div>

	<div id="my-tab-content" class="slide-wrapper">

		<?php function print_filter_slide_block($filter_code_name, $filter_name, $save, $cancel){
			?>
			<div class="slide slide-<?php echo $filter_code_name; ?>">
			<div class="page-full-width-line"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-11 col-sm-offset-1">
						<div class="heading-holder"><span class="heading">Choose <?php echo $filter_name; ?></span></div>
					</div>
				</div>
			</div>
			<div class="page-full-width-line"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-11 col-sm-offset-1">
						<nav id="<?php echo $filter_code_name; ?>-pagination" class="pagination">
							
						</nav>
					</div>
				</div>
			</div>
			<!-- <div class="page-full-width-line"></div> -->
			<div class="container">
				<div class="row">
					<div class="col-sm-11 col-sm-offset-1">

						<div class="slide-content">
							<div id="<?php echo $filter_code_name; ?>-filters" class="holder">
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="page-full-width-line"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-11 col-sm-offset-1">

						<div class="btns-holder">
							<div class="holder">
								<ul class="btns-list">
									<li><a href="#" class="btn filter-save-button"><?php echo $save; ?></a></li>
									<li><a href="#" class="btn filter-cancel-button btn-close"><?php echo $cancel; ?></a></li>
									<li class="filter-error-msg"></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php 
		}
		$cancel = get_post_meta( $projects_id, 'projects-cancel', true );
		$save = get_post_meta( $projects_id, 'projects-save', true );

		print_filter_slide_block("countries", "country", $save, $cancel);
		print_filter_slide_block("services", "service", $save, $cancel);
		print_filter_slide_block("project-types", "project type", $save, $cancel);
		print_filter_slide_block("themes", "theme", $save, $cancel);
		print_filter_slide_block("sustainability-types", "sustainability type", $save, $cancel);
		?>

		 <?php if(is_page("projects") || is_page("projets")){ get_template_part( "projects", "selection" ); } ?>

	</div>

</div>

	