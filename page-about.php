<?php
/*
Template Name: About page
*/
?>

<?php get_header(); 
get_template_part( "about", "subnav" );
?>

<div id="main-content-wrapper">

<?php

$args = array( 'post_type' => 'about-items', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'ASC' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();

	$template = get_post_meta( get_the_ID(), "custom_template", true );
	get_template_part( "about", $template ); 
	
endwhile;
wp_reset_postdata();
?>

</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>






<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/helpers/jquery.fancybox-media.js"></script>

<script>

alert("tet");
$(".fancyframe").fancybox({
    maxWidth    : 800,
    maxHeight   : 1500,
    fitToView   : false,
    width       : '70%',
    height      : '70%',
    autoSize    : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
});
</script>




<?php get_footer(); 