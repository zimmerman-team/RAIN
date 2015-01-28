<a class="anchor" id="home-intelligence"></a>
<div id="home-intelligence-wrapper" class="home-service-block">
	<div class="container">

		<a href="#" class="homepage-to-top"><img src="<?php echo get_template_directory_uri(); ?>/images/home-to-top.png" width="55" height="15" /></a>
		<div id="homepage-intelligence-cloud-1" class="homepage-clouds"></div>
		<div id="homepage-intelligence-cloud-2" class="homepage-clouds"></div>


		<div class="row">
			<div class="col-sm-8 homepage-service-title-rain">
				<h1><?php echo get_post_meta(get_the_ID(), 'homepage_title',true); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<h2><?php echo get_post_meta(get_the_ID(), 'homepage_subtitle',true); ?></h2>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-4">
				<?php the_content(); ?>
			</div>
			<div class="col-sm-4">
				<?php echo wpautop(get_post_meta(get_the_ID(), 'homepage_column2',true)); ?>
				<div class="homepage-service-button-wrapper"><a class="default-more-button" href="<?php echo site_url(); ?>/services/#intelligence">More</a></div>
			</div>

		</div>
	</div>
</div>