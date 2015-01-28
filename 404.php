<?php get_header(); ?>

<div id="error-page">
	<img id="bg-404" src="<?php echo get_template_directory_uri(); ?>/images/404-bg.jpg" />
	
		<div id="error-block-wrapper">
			<div class="error-block">
				<div class="slider-service-shadow-bg"></div>
				<div class="error-title">
					It's raining 404's!
				</div>
				<div class="error-text">
					The requested content could <br>
					not be found.
				</div>
			</div>
		</div>
</div>
<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>