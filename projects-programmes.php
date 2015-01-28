<a class="anchorsubnav" id="programmes"></a>
<div id="programmes-wrapper">
	<a href="#" class="homepage-to-top"><img src="<?php echo get_template_directory_uri(); ?>/images/home-to-top.png" width="55" height="15" /></a>
		
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>


		<div class="row">
			<div class="col-md-8">
				<?php the_content(); ?>
			</div>
		</div>


		<div class="row">

				<?php

				$colcount = 0;
				$args = array( 'post_type' => 'programmes', 'posts_per_page' => 20, 'orderby' => 'post_order title', 'order' => 'DESC' );
				
				if(isset($_GET["search"])){
					$args["s"] = $_GET["search"];
					$args["offset"] = 0;
				}

				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();
				
				$colcount++;
				if($colcount > 3){
					$colcount = 1; ?>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="dotted-line"></div>
						</div>
						<div class="col-md-4">
							<div class="dotted-line"></div>
						</div>
						<div class="col-md-4">
							<div class="dotted-line"></div>
						</div>
					</div>
					<div class="row">
				<?php } ?>

				<div class="col-md-4">		
					<div class="news-item">
						<?php the_post_thumbnail('news-thumb'); ?>
						<div class="news-item-title"><?php the_title(); ?></div>
						<div class="news-item-teaser">
							<?php the_content(); ?>
						</div>
					</div>
				</div>

				<?php
				endwhile;
				wp_reset_postdata();
				?>
			
		</div>

	</div>
</div>