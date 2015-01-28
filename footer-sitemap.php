<footer>
	<div class="container">
		<div id="footer-wrapper" class="row">

			<div class="col-md-8">
				

				<div id="footer-sitemap" class="row">

					<div class="col-sm-12">

						<?php /* 
						<div id="footer-menu-home" class="footer-menu">
							<div class="footer-menu-header">
								<?php icl_link_to_element(60); ?>
							</div>
						</div>

						<div id="footer-menu-services" class="footer-menu">
							<div class="footer-menu-header">
								<?php icl_link_to_element(147,'post',__('Services')); ?>
							</div>
							<ul>
								<?php

								if(ICL_LANGUAGE_CODE=="fr"){
									$id = icl_object_id(4,'page',false,"fr");
									$projectpost = get_post($id);
									$mainpage = $projectpost->post_name;
								} else {
									$mainpage = "services";
								}

								$args = array( 'post_type' => 'service-blocks', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();	

									$template = get_post_meta( get_the_ID(), "custom_template", true );
									if ($template != "overview"){
										echo '<li class="footer-menu-item">';
										echo '<a href="' . site_url() . '/' . ICL_LANGUAGE_CODE . '/' . $mainpage . '/#' . $template . '">';
										echo the_title();
										echo '</a>';
										echo '</li>';
									}
								endwhile;
								wp_reset_postdata();
								?>
							</ul>
						</div>

						<div id="footer-menu-projects" class="footer-menu">
							<div class="footer-menu-header">
								<?php icl_link_to_element(16); ?>
							</div>
							<ul>
								<?php

								if(ICL_LANGUAGE_CODE=="fr"){
									$id = icl_object_id(16,'page',false,"fr");
									$projectpost = get_post($id);
									$mainpage = $projectpost->post_name;
								} else {
									$mainpage = "projects";
								}

								$args = array( 'post_type' => 'about-items', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();	

									echo '<li class="footer-menu-item">';
									echo '<a href="' . get_the_permalink(get_the_ID()) . '">';
									echo the_title();
									echo '</a>';
									echo '</li>';
								endwhile;
								wp_reset_postdata();
								?>
							</ul>

						</div>

						<div id="footer-menu-partners" class="footer-menu">
							<div class="footer-menu-header">
								<?php icl_link_to_element(602,'post',__('Partners')); ?>
							</div>
						</div>

						<div id="footer-menu-news" class="footer-menu">
							<div class="footer-menu-header">
								<?php icl_link_to_element(973,'post',__('Media')); ?>
							</div>

						</div>


						<div id="footer-menu-about" class="footer-menu">
							<!-- TO DO: make headers multilangual -->
							<div class="footer-menu-header">
								<?php icl_link_to_element(7); ?>
							</div>
							<ul>
								<?php

								if(ICL_LANGUAGE_CODE=="fr"){
									$id = icl_object_id(7,'page',false,"fr");
									$projectpost = get_post($id);
									$mainpage = $projectpost->post_name;
								} else {
									$mainpage = "about";
								}

								$args = array( 'post_type' => 'about-items', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() ) : $loop->the_post();	

									echo '<li class="footer-menu-item">';
									echo '<a href="' . get_the_permalink(get_the_ID()) . '">';
									echo the_title();
									echo '</a>';
									echo '</li>';
								endwhile;
								wp_reset_postdata();
								?>
							</ul>

						</div>
						*/ ?>


						<?php 

						$navmenargs = array(
						  'menu' => 'top_menu',
						  'depth' => 2,
						  'container' => 'nav',
						  'container' => false,
						  'menu_id' => 'footer-menu',
						  'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
						  //Process nav menu using our custom nav walker
						  //'walker' => new wp_bootstrap_navwalker()
						);

						$menu = wp_nav_menu($navmenargs);
	        			echo $menu;
						?>
						
					</div>
				</div>




				<?php

				$args = array( 'post_type' => 'footer', 'posts_per_page' => 1, 'orderby' => 'menu_order title', 'order' => 'DESC' );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();

				?>

				<div class="row">
					<div class="col-md-6">
						<div id="footer-newsletter">
							<div id="footer-newsletter-text">
								
								<!-- Begin MailChimp Signup Form -->

								<div id="mc_embed_signup">
								<form action="http://rainfoundation.us6.list-manage.com/subscribe/post?u=76443dd8c4881218d77e1bda5&amp;id=515ae0cd82" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div class="footer-newsletter-title"><?php echo get_post_meta(get_the_ID(), 'footer_newsletter_title',true); ?></div>
								<div class="mc-field-group">
									<label for="mce-EMAIL"><?php echo get_post_meta(get_the_ID(), 'footer_newsletter_email',true); ?></label>
									<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
								</div>
								<div class="mc-field-group">
									<label for="mce-FNAME"><?php echo get_post_meta(get_the_ID(), 'footer_newsletter_first_name',true); ?></label>
									<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
								</div>
								<div class="mc-field-group">
									<label for="mce-LNAME"><?php echo get_post_meta(get_the_ID(), 'footer_newsletter_last_name',true); ?></label>
									<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
								</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
								    <div style="position: absolute; left: -5000px;"><input type="text" name="b_76443dd8c4881218d77e1bda5_515ae0cd82" value=""></div>
									<div class="clear"><input class="default-more-button" type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
								</form>
								</div>
								<!--End mc_embed_signup-->




							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div id="footer-about-rain">
							<div id="footer-about-rain-header">
								<?php echo get_post_meta(get_the_ID(), 'footer_about_title',true); ?>
							</div>
							<div id="footer-about-rain-text">
								<?php echo wpautop(get_post_meta(get_the_ID(), 'footer_about_text',true)); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div id="footer-brand-rain-header">
								<?php echo get_post_meta(get_the_ID(), 'footer_brand_title',true); ?>
							</div>
							<div id="footer-brand-rain-text">
								<?php echo wpautop(get_post_meta(get_the_ID(), 'footer_brand_text',true)); ?>
							</div>
					</div>
				</div>

			</div>
			<div class="col-md-4">

				<!-- TO DO: CREATE CUSTOM WIDGETS FOR THIS -->

				<div class="footer-contact-title"><?php echo get_post_meta(get_the_ID(), 'footer_address_title',true); ?></div>
				<div class="footer-contact-text">
					<?php echo wpautop(get_post_meta(get_the_ID(), 'footer_address_text',true)); ?>
				</div>

				<div class="footer-share-title"><?php echo get_post_meta(get_the_ID(), 'footer_share_title',true); ?></div>
				<div class="footer-share-buttons">
					<a id="footer-share-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=http%3A//www.rainfoundation.org&title=RAIN%foundation" target="_blank"></a>
					<a id="footer-share-twitter" href="http://twitter.com/home?status=http://www.rainfoundation.org" target="_blank"></a>
					<a id="footer-share-facebook" href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=http://www.rainfoundation.org&p[images][0]=&p[title]=RAIN%20foundation&p[summary]=" target="_blank"></a>
					<a id="footer-share-googleplus" href="https://plus.google.com/share?url=http://www.rainfoundation.org" target="_blank"></a>
					<a id="footer-share-youtube" href="http://www.youtube.com/rainfoundation/" target="_blank"></a>
				</div>
				
			</div>

			<?php 
			endwhile; 
			wp_reset_postdata();
			?>

		</div>
	</div>
</footer>