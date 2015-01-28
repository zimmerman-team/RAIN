<div id="approach-wrapper">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="about-approach-item">
					<?php the_content(); ?>

					<?php echo wpautop(get_post_meta( get_the_ID(), "about_column2", true )); ?>
				</div>
			</div>
		</div>

	</div>
</div>