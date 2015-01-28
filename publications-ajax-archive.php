<div class="row">

<?php

	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	// if(isset($_GET["search"])){ 
	// 	$args = array( 'post_type' => 'publication', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC', 'paged' => $paged );
	// 	$args["s"] = $_GET["search"]; 
	// } else{


	$args = array( 'post_type' => 'publication', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC' );
	$args["offset"] = (($paged -1) * 6);
	// }

	if(isset($_REQUEST["publication-category"])){
		$args["publication-category"] = $_REQUEST["publication-category"];
	} 

	if(ICL_LANGUAGE_CODE=="fr"){
		$args['suppress_filters'] = true;
		$args['posts_per_page'] = 9999;
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
		$args['posts_per_page'] = 6;
		$loop = new WP_Query( $args );
	}

	$colcount = 0;
	?>

	
	<?php 

	if (isset($args["s"])){
		?>
		<div class="col-md-12 query-result-header">
		<?php
			echo '<span>Your query "<span>' . $args['s'] . '</span>" has:</span> ' . $loop->found_posts . ' results.'; 
		?> 
			<div class="col-md-12">
				<div class="dotted-line"></div>
			</div>
		</div>
		<?php
	} ?>
	

	



	<?php

	if($loop->found_posts == 0){
		?>
			<div class="col-sm-4">
				No publications found in this category.
			</div>

		<?php
	}

	while ( $loop->have_posts() ) : $loop->the_post();

	$colcount++;
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
	?>
</div>

<div class="row">
	<div class="col-sm-12">
		<div id="page-list">
		
				<?php
				global $wp_query;

				$big = 999999999; // need an unlikely integer
				$paginationtext = paginate_links( array(
				'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
				'format' => '?paged=%#%',
				'show_all' => False,
				'end_size' => 1,
				'mid_size' => 2,
				'prev_next' => True,
				'prev_text' => __('&laquo;'),
				'next_text' => __('&raquo;'),
				'current' => max( 1, get_query_var('paged') ),
				'total' => $loop->max_num_pages,
				'type' => 'list'
				) );
				$paginationtext = str_replace("<ul class='page-numbers'", "<ul class='page-numbers pagination'", $paginationtext);
				echo $paginationtext;
				?>
			
		</div>
	</div>
</div>


<?php
wp_reset_postdata();
?>
		