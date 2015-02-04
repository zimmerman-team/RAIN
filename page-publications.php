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



<?php get_template_part( 'footer', 'sitemap' ); ?>
<?php get_template_part( 'footer', 'scripts' ); ?>

<?php get_footer(); ?>
