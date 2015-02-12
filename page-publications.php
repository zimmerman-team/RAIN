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
	<div class="publications-archive-ajax-wrapper container">

		<?php 
		$colcount = 0;
		$args = array( 'post_type' => 'page', 'posts_per_page' => 1, 'pagename' => 'publications');
		$_REQUEST["publication-category"] = $pub_cat->slug;
		include( get_template_directory() . '/publications-ajax-archive.php' ); 
		?>
	</div>
	<div id="news-archive-loading" class="row">
		<div class="col-sm-12">
			Loading publications
		</div>
	</div>
	<br>&nbsp;<br>
</div>
<?php } ?>



<div id="news-newsletter">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1 style="padding-bottom: 5px;"><?php echo __('Newsletter') ?></h1>
				<div style="margin-bottom: 20px" class="publications-line"></div>
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

<?php get_footer(); ?>
