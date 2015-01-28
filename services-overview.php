<?php $cur_post_id = get_the_ID(); ?>
<div id="overview">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<h1><?php echo get_post_meta( $cur_post_id, 'advice-title', true ); ?></h1>
				<div class="services-overview-subtitle"><?php echo get_post_meta( $cur_post_id, 'advice-subtitle', true ); ?></div>
				<div class="services-overview-text">

					<?php the_content(); ?>

				</div>
				<a href="<?php echo get_post_meta( $cur_post_id, 'service_column1_link_button_link', true ); ?>" id="services-overview-advice" class="services-overview-button"><?php echo get_post_meta( $cur_post_id, 'service_column1_link_button_text', true ); ?></a>
			</div>

			<div class="col-sm-4">
				<h1><?php echo get_post_meta( $cur_post_id, 'intelligence-title', true ); ?></h1>
				<div class="services-overview-subtitle"><?php echo get_post_meta( $cur_post_id, 'intelligence-subtitle', true ); ?></div>
				<div class="services-overview-text">

					<?php echo wpautop(get_post_meta( $cur_post_id, 'service_column2', true )); ?>

				</div>
				<a href="<?php echo get_post_meta( $cur_post_id, 'service_column2_link_button_link', true ); ?>" id="services-overview-intelligence" class="services-overview-button"><?php echo get_post_meta( $cur_post_id, 'service_column2_link_button_text', true ); ?></a>
			</div>

			<div class="col-sm-4">
				<h1><?php echo get_post_meta( $cur_post_id, 'implementation-title', true ); ?></h1>
				<div class="services-overview-subtitle"><?php echo get_post_meta( $cur_post_id, 'implementation-subtitle', true ); ?></div>
				<div class="services-overview-text">
					
					<?php echo wpautop(get_post_meta( $cur_post_id, 'service_column3', true )); ?>

				</div>
				<a href="<?php echo get_post_meta( $cur_post_id, 'service_column3_link_button_link', true ); ?>" id="services-overview-implementation" class="services-overview-button"><?php echo get_post_meta( $cur_post_id, 'service_column3_link_button_text', true ); ?></a>
			</div>
		</div>
	</div>
</div>	