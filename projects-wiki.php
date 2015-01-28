<a class="anchorsubnav" id="wiki"></a>
<div id="wiki-wrapper">
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
			<div class="col-md-8">
				<a href="<?php echo get_post_meta( get_the_ID(), 'projects_button_link', true ); ?>" target="_blank"><div class="default-more-button"><?php echo get_post_meta( get_the_ID(), 'projects_button_text', true ); ?></div></a>
			</div>
		</div>
		

	</div>
</div>