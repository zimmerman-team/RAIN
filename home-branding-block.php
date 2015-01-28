<div id="home-brand-building-block">
 	<ul class="bxslider">

<?php
$slidercount = 0;
$args = array( 'post_type' => 'slider', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
$loop = new WP_Query( $args );
$firstid = 0;

while ( $loop->have_posts() ) : $loop->the_post();
	$slidercount = $slidercount + 1;
	if ($firstid == 0){$firstid = get_the_ID(); }
?>

 		<li class="home-slider-block home-slider-<?php echo $slidercount; ?>">
 			<div class="home-slider-background-wrapper">
 				<?php the_post_thumbnail('full'); ?>
 			</div>
			<div id="slider-1-content">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="slider-header-title-block-wrapper">
								<div class="slider-header-title-block">
									<div class="slider-service-shadow-bg"></div>
									<div class="slider-header-title"><?php the_title(); ?></div>
								</div>
							</div>	
						</div>
					</div>
					<div class="row slider-header-text-row">
						<div class="col-md-5">
							<div class="slider-header-text-block-wrapper">
								<div class="slider-header-text-block">
									<div class="slider-service-shadow-bg"></div>
									<div class="slider-header-text">
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>


					<?php if(get_post_meta(get_the_ID(), 'slider_button1_text',true)) { ?>
					<div class="row">
						<div class="col-md-4">
							<div class="slider-subtitle-1-block-wrapper">
								<div class="slider-subtitle-1-block">
									<div class="slider-service-shadow-bg"></div>
									<?php $link1 = get_post_meta(get_the_ID(), 'slider_button1_link',true); ?> 
									
									<a <?php if (strpos($link1,'rainfoundation.org') === false) { echo 'target="_blank" '; } ?> href="<?php echo $link1; ?>">
										<div class="slider-subtitle-1">
											<?php echo get_post_meta(get_the_ID(), 'slider_button1_text',true); ?>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
					<?php if(get_post_meta(get_the_ID(), 'slider_button2_text',true)) { ?>
					<div class="row">
						<div class="col-md-4">
							<div class="slider-subtitle-2-block-wrapper">
								<div class="slider-subtitle-2-block">
									<div class="slider-service-shadow-bg"></div>
									<?php $link2 = get_post_meta(get_the_ID(), 'slider_button2_link',true); ?> 
									
									<a <?php if (strpos($link2,'rainfoundation.org') === false) { echo 'target="_blank" '; } ?> href="<?php echo $link2; ?>">
										<div class="slider-subtitle-2">
											<?php echo get_post_meta(get_the_ID(), 'slider_button2_text',true); ?>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if(get_post_meta(get_the_ID(), 'slider_block1_title',true) && get_post_meta(get_the_ID(), 'slider_block2_title',true) && get_post_meta(get_the_ID(), 'slider_block3_title',true)) { ?>
					<div class="row slider-services-block slider-<?php echo $slidercount; ?>">
						
						<div class="col-xs-4">
							<a class="slider-service-link" href="<?php echo get_post_meta(get_the_ID(), 'slider_block1_link',true); ?>">
								<div class="slider-service-block">
									<div class="slider-service-shadow-bg"></div>
									<div class="slider-service-title">
										<?php echo get_post_meta(get_the_ID(), 'slider_block1_title',true); ?>
									</div>
									<div class="slider-service-description">
										<?php echo get_post_meta(get_the_ID(), 'slider_block1_text',true); ?>
									</div>	
								</div>
							</a>
						</div>

						<div class="col-xs-4">
							<a class="slider-service-link" href="<?php echo get_post_meta(get_the_ID(), 'slider_block2_link',true); ?>">
								<div class="slider-service-block">
									<div class="slider-service-shadow-bg"></div>
									<div class="slider-service-title">
										<?php echo get_post_meta(get_the_ID(), 'slider_block2_title',true); ?>
									</div>
									<div class="slider-service-description">
										<?php echo get_post_meta(get_the_ID(), 'slider_block2_text',true); ?>
									</div>
								</div>
							</a>
						</div>

						<div class="col-xs-4">
							<a class="slider-service-link" href="<?php echo get_post_meta(get_the_ID(), 'slider_block3_link',true); ?>">
								<div class="slider-service-block">
									<div class="slider-service-shadow-bg"></div>
									<div class="slider-service-title">
										<?php echo get_post_meta(get_the_ID(), 'slider_block3_title',true); ?>
									</div>
									<div class="slider-service-description">
										<?php echo get_post_meta(get_the_ID(), 'slider_block3_text',true); ?>
									</div>
								</div>
							</a>
						</div>
					</div>

					<?php } ?>

				</div>
			</div>
	 	</li>

<?php
		
endwhile;
?>
	</ul>



	<div id="home-phone-services" class="row">
		<div class="col-sm-4">
			<a class="slider-service-link" href="<?php echo get_post_meta($firstid, 'slider_block1_link',true); ?>">
				<div class="slider-service-block">
					<div class="slider-service-shadow-bg"></div>
					<div class="slider-service-title">
						<?php echo get_post_meta($firstid, 'slider_block1_title',true); ?>
					</div>
					<div class="slider-service-description">
						<?php echo get_post_meta($firstid, 'slider_block1_text',true); ?>
					</div>	
				</div>
			</a>
		</div>

		<div class="col-sm-4">
			<a class="slider-service-link" href="<?php echo get_post_meta($firstid, 'slider_block2_link',true); ?>">
				<div class="slider-service-block">
					<div class="slider-service-shadow-bg"></div>
					<div class="slider-service-title">
						<?php echo get_post_meta($firstid, 'slider_block2_title',true); ?>
					</div>
					<div class="slider-service-description">
						<?php echo get_post_meta($firstid, 'slider_block2_text',true); ?>
					</div>
				</div>
			</a>
		</div>

		<div class="col-sm-4">
			<a class="slider-service-link" href="<?php echo get_post_meta($firstid, 'slider_block3_link',true); ?>">
				<div class="slider-service-block">
					<div class="slider-service-shadow-bg"></div>
					<div class="slider-service-title">
						<?php echo get_post_meta($firstid, 'slider_block3_title',true); ?>
					</div>
					<div class="slider-service-description">
						<?php echo get_post_meta($firstid, 'slider_block3_text',true); ?>
					</div>
				</div>
			</a>
		</div>

	</div>

</div>