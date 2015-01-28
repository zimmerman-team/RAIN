<div id="about-subnav">
	<div class="container">
		<div class="row">
			<div class="col-md-12 subnav-wrapper">
				
				<ul>
					<?php

					$args = array( 'post_type' => 'about-items', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'ASC' );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();	

						$template = get_post_meta( get_the_ID(), "custom_template", true );

						echo '<li class="about-subnav">';
						$urllang = "";
						if(ICL_LANGUAGE_CODE != "en"){ $urllang = '/' . ICL_LANGUAGE_CODE; }
						echo '<a id="subnav-' . $template . '" href="' . site_url() . $urllang . '/about/#' . $template . '">';
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