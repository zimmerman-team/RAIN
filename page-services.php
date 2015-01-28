<?php
/*	
Template Name: Services page
*/
?>
<?php get_header();

get_template_part("services", "navbar");

$args = array( 'post_type' => 'service-blocks', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

	$template = get_post_meta( get_the_ID(), "custom_template", true );
	get_template_part( "services", $template ); 
	
endwhile;
wp_reset_postdata();

get_footer(); ?>