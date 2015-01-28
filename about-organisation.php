<div id="organisation-wrapper">
	<div class="container">

		<div class="row">
			<div class="col-md-4">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<h2><?php echo wpautop(get_post_meta( get_the_ID(), 'subtitle', true )); ?></h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div id="about-organisation-text"><?php the_content(); ?></div>
			</div>
		</div>

	</div>
</div>