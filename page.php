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

					<div class="row">
						<div class="col-md-4">
							<h2><?php echo __('Related articles'); ?></h2>
							<?php related_posts(); ?>
						</div>
						<div class="col-md-4 news-single-related-articles">
							<h2><?php echo __('Recent articles'); ?></h2>

								<?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$colcount = 0;
								$args = array( 'post_type' => 'news', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC' );	
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();
								?>

						
								<div class="news-single-item-title">
									<a href="<?php the_permalink(); ?>">
										> <?php the_title(); ?>
									</a>
								</div>
										
								<?php
								endwhile;
								wp_reset_postdata();
								?>

						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="disqus-dotted-line dotted-line"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8">

							<div id="disqus_thread"></div>
						    <script>
						        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
						        var disqus_shortname = 'rainfoundation'; // required: replace example with your forum shortname
						 		var disqus_identifier = '<?php echo get_the_ID(); ?>';
    							var disqus_title = '<?php the_title(); ?>';
    							var disqus_url = '<?php echo get_permalink(); ?>';

						        /* * * DON'T EDIT BELOW THIS LINE * * */
						        (function() {
						            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
						            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
						        })();
						    </script>
						    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

						</div>
					</div>
				</div>
			</div>		
		<?php endwhile; ?>
</div>





<?php get_footer(); ?>