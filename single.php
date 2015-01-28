<?php get_header(); ?>

<div id="news-single">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="news-single-post">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 news-item-date">
								
								<span class="news-date-span"><?php the_time('F jS, Y'); ?></span><span class="news-author-span">By: <?php the_author(); ?></span>
								<div class="dotted-line"></div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-8">
							<?php echo get_post_meta( get_the_ID(), 'subtitle', true ); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<?php the_content(); ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="dotted-line"></div>
								<div class="single-news-share-buttons">
									<?php 
										echo do_shortcode('[feather_share skin="wheel"]'); 
									?>
								</div>
							<div class="news-item-bottom-line dotted-line"></div>
						</div>
					</div>

				</div>
			</div>		
		<?php endwhile; ?>
</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>