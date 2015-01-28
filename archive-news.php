<?php get_header(); ?>

<div id="news">
	
<?php

$args = array( 'post_type' => 'news-blocks', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
	
	$template = get_post_meta( get_the_ID(), "custom_template", true );
	get_template_part( "news", $template ); 
	
endwhile;
wp_reset_postdata();
?>

</div>


<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>



