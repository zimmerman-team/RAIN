<div id="team-wrapper">
	<a href="#" class="homepage-to-top"><img src="<?php echo get_template_directory_uri(); ?>/images/home-to-top.png" width="55" height="15" /></a>
		
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="about-team-subtitle">
					<?php the_content(); ?>
				</div>
			</div>
		</div>

		<div class="row">
			<?php

			$colcount = 0;
			$total_count = 0;
			$args = array( 'post_type' => 'team-members', 'posts_per_page' => 99, 'orderby' => 'menu_order title', 'order' => 'ASC' );

			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			$colcount++;
			$total_count++;

			if($colcount > 3){
				$colcount = 1; ?>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<div class="dotted-line"></div>
					</div>
					<div class="col-sm-4">
						<div class="dotted-line"></div>
					</div>
					<div class="col-sm-4">
						<div class="dotted-line"></div>
					</div>
				</div>
				<div class="row">
			<?php } ?>

			<div class="col-sm-4">
				<div class="team-member-item">
					<a class="fancyframe" href="#team-member-<?php echo get_the_ID(); ?>"><div class="team-member-image"><?php the_post_thumbnail('team-member-thumb'); ?></div></a>
					<a class="fancyframe" href="#team-member-<?php echo get_the_ID(); ?>"><div class="team-member-name"><h2><?php the_title(); ?></h2></div></a>
					<div class="team-member-title"><?php echo get_post_meta( get_the_ID(), 'team_job_title', true ); ?></div>

					<div id="team-member-<?php echo get_the_ID(); ?>" class="team-member-popup-wrapper" style="display: none;">
						<div class="row">
							<div class="col-md-12">
								<div class="team-member-name"><h2><?php the_title(); ?></h2></div>
								<div class="team-member-title"><?php echo get_post_meta( get_the_ID(), 'team_job_title', true ); ?></div>
								<div style="border-bottom: 1px dotted #ccc;"></div>
							</div>
						</div>
						<div class="row team-member-popup-content">
							<div class="col-md-3">
								<div class="team-member-image team-member-popup-image"><?php the_post_thumbnail('team-member-full'); ?></div>					
							</div>
							<div class="col-md-9">
								<div class="team-member-text"><?php the_content(); ?></div>
								<hr style="border-color: #ccc;">

								<?php 
								$linkedin_url = get_post_meta( get_the_ID(), 'team_linkedin', true ); 
								if (!empty($linkedin_url)){
									echo '<br><a href="'. $linkedin_url . '">LinkedIn</a><br>';
								}

								$telnr = get_post_meta( get_the_ID(), 'team_telephone_number', true ); 
								if (!empty($telnr)){
									echo 'Telephone: ' . $telnr . '<br>';
								}

								$email_address = get_post_meta( get_the_ID(), 'team_email_address', true ); 
								if (!empty($linkedin_url)){
									echo '<a href="mailto:'. $email_address . '">Email</a>';
								}
								?>
							</div>
						</div>
					</div>

				</div>
			</div>

			


			<?php
			endwhile;
			wp_reset_postdata();
			?>

			
		</div>		


	</div>
</div>