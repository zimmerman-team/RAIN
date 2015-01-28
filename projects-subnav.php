<div id="projects-subnav">
	<div class="container">
		<div class="row">
			<div class="col-md-12 subnav-wrapper">
				
				<ul>
					<?php

					$args = array( 'post_type' => 'project-blocks', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();	

						$template = get_post_meta( get_the_ID(), "custom_template", true );

						echo '<li class="projects-subnav">';
						$urllang = "";
						if(ICL_LANGUAGE_CODE != "en"){ $urllang = '/' . ICL_LANGUAGE_CODE; }

						$projects_name = "projects";
						if(ICL_LANGUAGE_CODE == "fr"){ $projects_name = "projets"; }


						echo '<a id="subnav-' . $template . '" href="' . site_url() . $urllang . '/' . $projects_name . '/#' . $template . '">';
						echo the_title();
						echo '</a>';
						echo '</li>';
					endwhile;
					wp_reset_postdata();
					?>
				</ul>

			</div>
		</div>
	</div>
</div>
<div id="subnav-filler"></div>