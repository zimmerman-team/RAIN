<?php
/*
Template Name: News page
*/
?>

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

<div id="news-newsletter">
	<div class="container">

		<div class="row">
			<div class="col-md-8">
				<h1><?php echo __('Newsletter') ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<h2>Sign-up for the RAIN newsletter</h2>
			</div>
			<div class="col-md-4">
				<h2>Recent newsletters</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<a id="news-mailchimp-form-link" href="#footer-newsletter"><div id="news-mailchimp-form" class="default-more-button">Go to the sign-up form</div></a>
			</div>
			<div class="col-md-4">
				<script language="javascript" src="http://us6.campaign-archive2.com/generate-js/?u=76443dd8c4881218d77e1bda5&fid=5361&show=10" type="text/javascript"></script>
			</div>
		</div>
		
	</div>
</div>



<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer();