<a class="anchor" id="news-search-anchor"></a>
<div id="news-search">
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<h2><?php echo __('News item search'); ?></h2>
			</div>
		</div>
		<div class="row news-search-form">
			<form id="archive-search-form" name="archive-search-form" action="<?php echo site_url(); ?>/news/" method="get">
				<div class="col-xs-8">
					<input name="search" style="width=100%" type="text">
				</div>
				<div class="col-xs-4">
					<input type="submit" value="Submit" class="news-search-button default-more-button">
				</div>
			</form>
		</div>
		
	</div>
</div>