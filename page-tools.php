<?php get_header(); ?>

<div id="news">
	
<?php

$args = array( 'post_type' => 'tools', 'posts_per_page' => 20, 'orderby' => 'menu_order title', 'order' => 'DESC' );
$loop = new WP_Query( $args );
$even = "even";
while ( $loop->have_posts() ) : $loop->the_post();
	
?>
<!-- 
<a class="anchorsubnav" id="wiki"></a> -->

<div class="tool-wrapper tool-item-<?php echo $even; ?>">
	<a href="#" class="homepage-to-top"><img src="<?php echo get_template_directory_uri(); ?>/images/home-to-top.png" width="55" height="15" /></a>
	
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<a href="<?php echo get_post_meta( get_the_ID(), 'tool-button-link', true ); ?>" target="_blank"><div class="default-more-button"><?php echo get_post_meta( get_the_ID(), 'tool-button-text', true ); ?></div></a>
			</div>
		</div>
	</div>
</div>

<?php 

if ($even == "even"){
	$even = "uneven";
} else {
	$even = "even";
}

endwhile;
wp_reset_postdata();
?>

</div>

<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>



