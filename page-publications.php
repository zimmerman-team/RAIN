<?php get_header(); 

$publication_categories = get_terms( 'publication-category', array( 'taxonomy' => 'publication-category', 'hide_empty' => false, 'parent' => 0  ) );

$even = "even";
foreach($publication_categories as $pub_cat){
if ($even == "even"){ $even = "uneven"; } else { $even = "even"; }
?>
<div class="publications-wrapper <?php echo $even; ?>">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1><?php echo $pub_cat->name; ?></h1>
				<div class="publications-line"></div>
			</div>
		</div>

	</div>
</div>
<div id="news-archive" class="publications-archive <?php echo $even; ?>">
	<div class="publications-archive-wrapper container">

		<div class="row">

			<?php

			$args = array( 
				'post_type' => 'publication', 
				'posts_per_page' => 100, 
				'orderby' => 'menu_order date', 
				'order' => 'DESC',
				'publication-category' => $pub_cat->slug );

			if(ICL_LANGUAGE_CODE=="fr"){
				$args['suppress_filters'] = true;
				$args['posts_per_page'] = 200;
			}
			
			$loop = new WP_Query( $args );
			
			if(ICL_LANGUAGE_CODE=="fr"){
				$postids = array();
				foreach( $loop->posts as $item ) {

					if(	$post_id = icl_object_id($item->ID,'publication',false,ICL_LANGUAGE_CODE)) {
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
				$loop = new WP_Query( $args );
			}

			if($loop->found_posts == 0){
				?>
				<div class="col-sm-12" style="margin-top: 20px; margin-bottom: 20px;">
					No publications found in this category.
				</div>
				<?php
			}

			?>
			<div class="col-sm-8">		
				<div class="publication-items">
					<?php
					while ( $loop->have_posts() ) : $loop->the_post();
					?>
						<a target="_blank" href="<?php echo get_post_meta( get_the_ID(), 'publication-url', true ); ?>">
							<div class="publication-item-title"><?php the_title(); ?></div>
						</a><br>
					<?php
					endwhile;
					?>
				</div>
		    </div>
	    </div>
	</div>   
</div>

<?php
wp_reset_postdata();

}

get_template_part( 'footer', 'sitemap' );
get_template_part( 'footer', 'scripts' );
get_footer();
