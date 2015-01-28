<div id="news-first-post">
		<div class="container">

			<?php // HIGHLIGHTED POST 

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array( 'post_type' => 'news', 'posts_per_page' => 1, 'orderby' => 'date', 'suppress_filters' => true, 'order' => 'DESC', 'paged' => $paged );
				if(isset($_GET["search"])){ $args["s"] = $_GET["search"]; }
				$loop = new WP_Query( $args );

				while ( $loop->have_posts() ) : $loop->the_post();

				if(	$post_id = icl_object_id(get_the_ID(),'news',false,ICL_LANGUAGE_CODE) ) {
			        $post = get_post($post_id);
			        setup_postdata($post);
			    }
				
			?>

			<div class="row">
				<div class="col-md-8">

					<div class="row">
						<div class="col-md-12">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						</div>
					</div>
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

					<div class="row">
						<div class="col-md-12">
							<h2><?php echo get_post_meta( get_the_ID(), 'subtitle', true ); ?></h2>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div id="news-archive-first-post-img">
								<?php the_post_thumbnail(array(750, 350)); ?>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div id="news-archive-first-post-text">
								<?php 
									$curexcerpt = apply_filters('the_excerpt', get_the_excerpt());
									$curexcerpt = substr($curexcerpt, 0, -5) . '<a class="moretag" href="' . get_permalink() . '"> Read more</a></p>';
									echo $curexcerpt;
								?>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>

			<?php		
				endwhile;
				wp_reset_postdata();
			?>
		</div>
	</div>