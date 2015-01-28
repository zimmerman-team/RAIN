<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script>
var site = '<?php echo SITE_URL; ?>';
var search_url = '<?php echo SEARCH_URL; ?>';
var home_url = "<?php echo bloginfo("url"); ?>";
var template_directory = "<?php echo bloginfo("template_url"); ?>";
var site_title = "<?php echo wp_title(''); ?>";
var site_url = "<?php echo site_url(); ?>";
var standard_basemap = "zimmerman2014.hmpkg505";
var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
var ajax_path = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/CSSPlugin.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>
<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootpag.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/oipa.js"></script>


<script src="<?php echo get_template_directory_uri(); ?>/js/init.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.knob.js"></script>


<script>
<?php
global $_DEFAULT_ORGANISATION_ID;
?>
Oipa.default_organisation_id = "<?php echo $_DEFAULT_ORGANISATION_ID; ?>";
Oipa.default_organisation_name = "<?php echo 'RAIN Foundation'; ?>";
Oipa.framework = "wordpress";
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/rain.js"></script>
<?php 
wp_reset_postdata();

if (is_post_type_archive('news') or 'news' == get_post_type()){
?>
<script>

$("#menu-item-607").addClass("current-menu-item");

</script>

<?php } ?>


<script type="text/javascript">

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46692764-1', 'rainfoundation.org');
  ga('send', 'pageview');

</script>
