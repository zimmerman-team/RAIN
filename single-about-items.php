<?php
get_header(); 
while ( have_posts() ) : the_post();
?>

<div id="main-content-wrapper">
	<?php

	$template = get_post_meta( get_the_ID(), "custom_template", true );
	get_template_part( "about", $template ); 
	?>
</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>



<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.fancybox.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/helpers/jquery.fancybox-media.js"></script>

<script>
$(".fancyframe").fancybox({
    maxWidth    : 800,
    maxHeight   : 1600,
    fitToView   : false,
    width       : '70%',
    height      : 'auto',
    autoSize    : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
});
</script>

<?php endwhile; ?>

<?php get_footer(); 