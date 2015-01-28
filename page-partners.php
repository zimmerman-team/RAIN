<?php
/*
Template Name: Partners
*/
?>
<?php get_header(); ?>

<div id="news-single">
		<?php while ( have_posts() ) : the_post(); ?>
			<div id="news-single-post">
				<div class="container">
					<div class="row">
						<div class="col-md-8 partner-map-title">
							<h1><?php the_title(); ?></h1>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
								<div class="dotted-line"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 partner-map-content">
							<?php the_content(); ?>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<?php echo do_shortcode('[zz-partner-map]');  ?>
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



<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>