<?php
/*
Template Name: Media
*/
?>
<?php get_header(); ?>

<div id="media-single">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="news-single-post">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-header">
								<?php echo get_post_meta( get_the_ID(), 'media-our-brand-identity', true ); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content media-single-content-bold">
								<?php echo wpautop(get_post_meta( get_the_ID(), 'media-our-brand-identity-content', true )); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="media-single-header2">
								<?php echo get_post_meta( get_the_ID(), 'media-dos-and-donts', true ); ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content">
								<?php echo wpautop(get_post_meta( get_the_ID(), 'media-dos-and-donts-content', true )); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content media-manual-wrapper">
								<img src="<?php echo get_template_directory_uri(); ?>/images/media-brand-manual-preview.png" alt="Brand manual" />
								<a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'media-dos-and-donts-download-url', true ); ?>"><img id="media-download-icon" src="<?php echo get_template_directory_uri(); ?>/images/media-download-icon.png" alt="Download brand-manual" /></a>
								<a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'media-dos-and-donts-download-url', true ); ?>" class=""><?php echo get_post_meta( get_the_ID(), 'media-dos-and-donts-download-text', true ); ?></a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-header2 media-rain-logos-title">
								<?php echo get_post_meta( get_the_ID(), 'media-rain-logos', true ); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-with-payoff-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-with-payoff-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-with-payoff-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-with-payoff-RGB.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-RGB.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper media-rain-image-wrapper-higher">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-without-cloud-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-without-cloud-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-without-cloud-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-without-cloud-RGB.png">.png (RGB)</a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="media-rain-image-wrapper media-rain-image-wrapper-highest">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-without-cloud-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-without-cloud-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-without-cloud-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-blue-white-without-cloud-RGB.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-with-pay-off-RGB.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-RGB.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-CMYK.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-PMS-coated.eps">.eps (PMS)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-yellow-blue-RGB.png">.png (RGB)</a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-without-payoff.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-without-payoff.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-without-payoff.png">.png (RGB)</a>
							</div>
						</div>
						<div class="col-md-4">
							<div class="media-rain-image-wrapper media-rain-image-wrapper-highest">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff1.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff1.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff1.png">.png (RGB)</a>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">
							<div class="media-rain-image-wrapper media-rain-image-wrapper-highest">
								<img src="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff2.png" />
							</div>
							<div class="rain-logo-link-block">
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff2.eps">.eps (CMYK)</a> | 
								<a href="http://www.rainfoundation.org/wp-content/uploads/RAIN-logo-greytones-with-payoff2.png">.png (RGB)</a>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>



					<div class="row">
						<div class="col-md-12">
							<div class="media-single-header">
								<?php echo get_post_meta( get_the_ID(), 'media-in-the-press', true ); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content">
								<?php echo get_post_meta( get_the_ID(), 'media-in-the-press-content', true ); ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>



					<div class="row">
						<div class="col-md-12">
							<div class="media-single-header">
								<?php echo get_post_meta( get_the_ID(), 'media-video-photography', true ); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content">
								<?php echo wpautop(get_post_meta( get_the_ID(), 'media-video-photography-content', true )); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="media-single-content">
								<?php echo get_post_meta( get_the_ID(), 'media-video-photography-video-links', true ); ?>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line-white"></div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-12">
							
						</div>
					</div>



				</div>
			</div>		
		<?php endwhile; ?>
</div>




<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>
