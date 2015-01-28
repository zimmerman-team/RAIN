<a class="anchor" id="intelligence"></a>
<div id="intelligence-wrapper" class="services-service-block">
	<a href="#" class="homepage-to-top"><img src="<?php echo get_template_directory_uri(); ?>/images/home-to-top.png" width="55" height="15" /></a>
		
	<div class="container">

		<div class="row">
			<div class="col-sm-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<div class="service-subtitle"><?php echo get_post_meta( get_the_ID(), 'service_subtitle', true ); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="service-block">
					<div class="service-text">

						<?php the_content(); ?>

					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<?php echo wpautop(get_post_meta( get_the_ID(), 'service_column2', true )); ?>
			</div>
			<div class="col-sm-4">
				<?php echo wpautop(get_post_meta( get_the_ID(), 'service_column3', true )); ?>
			</div>
		</div>

		<div class="row">
			
			<?php
			// TODO: get right cat parameter
			$args = array( 'post_type' => 'news', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC', 'category_name' => 'intelligence' );


			$loop = new WP_Query( $args );

			$colcount = 0;
			while ( $loop->have_posts() ) : $loop->the_post();
			?>

			<div class="col-sm-4">		
				<div class="news-item">
					<?php the_post_thumbnail('news-thumb'); ?>
					<div class="news-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<div class="news-item-teaser">
						<?php the_excerpt(); ?>
					</div>
				</div>
			</div>

			<?php
			endwhile;
			?>

		</div>
	</div>
</div>