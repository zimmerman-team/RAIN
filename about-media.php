<div id="media-wrapper">
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
				<a id="media-page-button" href="<?php echo get_post_meta( get_the_ID(), 'media_button_link', true ); ?>">
					<div class="default-more-button">
					<?php echo get_post_meta( get_the_ID(), 'media_button_text', true ); ?>
					</div>
				</a>
			</div>
		</div>

	</div>		
</div>