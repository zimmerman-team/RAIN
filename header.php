<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage RAIN
 * @since RAIN website 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.fancybox.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.skippr.css" />

	<!--[if lte IE 8]>
	    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/leaflet.ie.css" />
	<![endif]-->
	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" media="screen">
	<link href="<?php echo get_template_directory_uri(); ?>/css/projects.css" rel="stylesheet"> 

	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	

 	<?php wp_head(); ?>

 	
	
	<style>
		html {
			margin-top: 0px !important;
		}
	</style>

	<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.skippr.min.js"></script>
	
</head>
<body <?php body_class(); ?>>

	
	<nav id="rain-header" class="navbar navbar-default navbar-fixed-top noise" role="navigation">

		<div class="container">
		  <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		      <span class="sr-only">Toggle navigation</span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		      <span class="icon-bar"></span>
		    </button>
		    <a href="<?php echo icl_get_home_url(); ?>"><img class="navbar-brand" width="107" height="50" src="<?php echo get_template_directory_uri(); ?>/images/rain-logo.png" /></a>
		  </div>

		  <!-- Collect the nav links, forms, and other content for toggling -->
		  <div class="collapse navbar-collapse navbar-ex1-collapse">


		    <?php 

	        $navmenargs = array(
	            'menu' => 'header-menu',
	            'container' => '',
	            'container_class' => '',
	            'after' => '',
	            'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
	            'echo' => false
	            );

	        $navmenargs = array(
			  'menu' => 'top_menu',
			  'depth' => 2,
			  'container' => false,
			  'menu_class' => 'nav',
			  'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
			  //Process nav menu using our custom nav walker
			  'walker' => new wp_bootstrap_navwalker()
			);
	        $menu = wp_nav_menu($navmenargs);
	        echo $menu;

	        ?>
		        	

	        <div id="navbar-languages">
		  		<?php $languages =  icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str'); 
		  				$navtext = "";
						foreach ($languages as &$language) {
							if (array_key_exists('missing', $language) && $language['missing'] == 0){
								$cur_lang_url = $language['url'];
							} else {
								if ($language['language_code'] == "en"){
									$cur_lang_url = site_url() . '/';
								} else {
									$cur_lang_url = site_url() . '/' . $language['language_code'] . '/';
								}
								
							}
							$navtext .= '<a href="' . $cur_lang_url . '"';
							if ($language['active']){ 
								$navtext .= ' class="navbar-language-' . $language['language_code'] . ' navbar-languages-active"'; 
							} else {
								$navtext .= ' class="navbar-language-' . $language['language_code'] . '"'; 
							}
							$navtext .= '></a> | '; 
					    }

					    echo trim($navtext, '| ');
		    	?>
		    </div>
		  </div><!-- /.navbar-collapse -->
		</div>
	</nav>
