<a class="anchor" id="home-news-block"></a>
<div id="home-news-block-wrapper">
	<div class="container">
		<div class="row homepage-first-news-row">


			<?php
			$args = array( 'post_type' => 'news', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' );
			
			if(ICL_LANGUAGE_CODE=="fr"){
				$args['suppress_filters'] = true;
				$args['posts_per_page'] = 9999;
			}
			
			$loop = new WP_Query( $args );
			
			if(ICL_LANGUAGE_CODE=="fr"){
				$postids = array();
				foreach( $loop->posts as $item ) {


					if(	$post_id = icl_object_id($item->ID,'news',false,ICL_LANGUAGE_CODE)) {
				        $postids[]=$item->ID; //create a new query only of the post ids
				        $post_language_information = wpml_get_language_information($item->ID);
				        if($post_language_information['locale'] == 'fr_FR'){
				        	$postids[]=$item->ID;
				        }
				    } else {
				    	$postids[]=$item->ID;
				    }

					
				}
				$uniqueposts = array_unique($postids); //remove duplicate post ids
				$args['post__in'] = $uniqueposts;
				$args['posts_per_page'] = 3;
				$loop = new WP_Query( $args );
			}



			while ( $loop->have_posts() ) : $loop->the_post();

			?>

			<div class="col-sm-4">
		
				<div class="news-item">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news-thumb'); ?></a>
					<a href="<?php the_permalink(); ?>"><div class="news-item-title"><?php the_title(); ?></div></a>
					<div class="news-item-teaser">

						<?php 
							$curexcerpt = apply_filters('the_excerpt', get_the_excerpt());
							$curexcerpt = substr($curexcerpt, 0, -5) . '<a class="moretag" href="' . get_permalink() . '"> Read more</a></p>';
							echo $curexcerpt;
						?>
						
					</div>
				</div>

			</div>

			<?php
			endwhile;
			wp_reset_postdata();

			
			?>

			
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

			<?php
			$args = array( 'post_type' => 'news', 'posts_per_page' => 3, 'offset' => 3, 'orderby' => 'date', 'order' => 'DESC' );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			?>

			<div class="col-sm-4">
		
				<div class="news-item">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news-thumb'); ?></a>
					<a href="<?php the_permalink(); ?>"><div class="news-item-title"><?php the_title(); ?></div></a>
					<div class="news-item-teaser">

						<?php 
							$curexcerpt = apply_filters('the_excerpt', get_the_excerpt());
							$curexcerpt = substr($curexcerpt, 0, -5) . '<a class="moretag" href="' . get_permalink() . '"> Read more</a></p>';
							echo $curexcerpt;
						?>

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