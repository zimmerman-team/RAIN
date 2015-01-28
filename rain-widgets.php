<?php 

class ServicesWidget extends WP_Widget
{
  function ServicesWidget()
  {
    $widget_ops = array('classname' => 'ServicesWidget', 'description' => 'Services widget' );
    $this->WP_Widget('ServicesWidget', 'Services widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'subtitle' => '', 'text' => '') );

    $title = strip_tags($instance['title']);
    $subtitle = strip_tags($instance['subtitle']);
    $text = $instance['text'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
  <p>
  	<label for="<?php echo $this->get_field_id('subtitle'); ?>">Subtitle: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('subtitle'); ?>" name="<?php echo $this->get_field_name('subtitle'); ?>"><?php echo $subtitle; ?></textarea>
  </p>
  <p>
  	<label for="<?php echo $this->get_field_id('text'); ?>">Text below services buttons: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
  </p>
  
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

	<div class="services-widget rain-widget">
		<div class="services-widget-title">
			<?php echo $instance['title'];?>
		</div>
		<div class="services-widget-subtitle">
			<?php echo $instance['subtitle'];?>
		</div>
    <?php
    $post = get_queried_object();
    $post_name = $post->post_name;
    $imp_class = "service-widget-grey";
    $int_class = "service-widget-grey";
    $adv_class = "service-widget-grey";
    if ($post_name == 'intelligence'){
      $int_class = "";
    } else if ($post_name == 'implementation'){
      $imp_class = "";
    } else if ($post_name == 'advice'){
      $adv_class = "";  
    } else {
      $imp_class = ""; 
      $int_class = "";
      $adv_class = "";
    }
    ?>

		<a href="<?php echo home_url(); ?>/service/implementation/" class="services-widget-implementation <?php echo $imp_class; ?>">
			Implementation
		</a>
		<a href="<?php echo home_url(); ?>/service/intelligence/" class="services-widget-intelligence <?php echo $int_class; ?>">
			Intelligence
		</a>
		<a href="<?php echo home_url(); ?>/service/advice/" class="services-widget-advice <?php echo $adv_class; ?>">
			Advice
		</a>
		<div class="services-widget-text">
			<?php echo wpautop($instance['text']); ?>
		</div>
	</div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ServicesWidget");') );












class NewsWidget extends WP_Widget
{
  function NewsWidget()
  {
    $widget_ops = array('classname' => 'NewsWidget', 'description' => 'News widget' );
    $this->WP_Widget('NewsWidget', 'News widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

	<div class="rain-widget">
		<div class="rain-widget-title">
			<?php echo $instance['title'];?>
		</div>
		<div class="rain-widget-content">

			<?php

			$args = array( 'post_type' => 'news', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC' );
				

			if(ICL_LANGUAGE_CODE=="fr"){
				$args['suppress_filters'] = true;
				$args['posts_per_page'] = 9999;
			}
			
			$loop = new WP_Query( $args );
			
			if(ICL_LANGUAGE_CODE=="fr"){
				$postids = array();
				foreach( $loop->posts as $item ) {

					if(	$post_id = icl_object_id($item->ID,'news',false,ICL_LANGUAGE_CODE)) {
				        $postids[]=$item->ID; //create a new query only of the post ids
				        $post_language_information = wpml_get_language_information($item->ID);
				        if($post_language_information['locale'] == 'fr_FR'){
				        	$postids[]=$item->ID;
				        }
				    } else {
				    	$postids[]=$item->ID;
				    }
				}

				$uniqueposts = array_unique($postids); //remove duplicate post ids
				$args['post__in'] = $uniqueposts;
				$args['posts_per_page'] = 6;
				$loop = new WP_Query( $args );
			}

			while ( $loop->have_posts() ) : $loop->the_post();

			?>

			<div class="row news-widget-item">

				<div class="col-xs-4">		
					<div class="news-widget-image">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news-thumb-square'); ?></a>
					</div>
				</div>
				<div class="col-xs-8">
					<a href="<?php the_permalink(); ?>"><div class="news-widget-title"><?php the_title(); ?></div></a>
					<div class="news-widget-subtitle">
						By: <?php the_author(); ?> | <?php the_time('F jS, Y'); ?>
					</div>
					<div class="news-widget-teaser">
						<?php 
							$curexcerpt = get_the_excerpt();
							$curexcerpt = substr($curexcerpt, 0, 100) . "... ";
							// '<a class="moretag" href="' . get_permalink() . '"> Read more</a>'
							echo $curexcerpt;
						?>
					</div>
				</div>
			</div>

			<?php
			endwhile;
			wp_reset_postdata();
			?>
			

		</div>
		<div class="rain-widget-button">
			<a class="btn btn-default" href="<?php echo home_url(); ?>/news/">More news</a>
		</div>
	</div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("NewsWidget");') );












class NewsWidgetServices extends WP_Widget
{
  function NewsWidgetServices()
  {
    $widget_ops = array('classname' => 'NewsWidgetServices', 'description' => 'News widget on services page' );
    $this->WP_Widget('NewsWidgetServices', 'News widget on services page', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

  <div class="rain-widget">
    <div class="rain-widget-title">
      <?php echo $instance['title'];?>
    </div>
    <div class="rain-widget-content">

      <?php
      global $post;
      $category_slug = $post->post_name;
      $args = array( 'category_name' => $category_slug,'post_type' => 'news', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC' );
        

      if(ICL_LANGUAGE_CODE=="fr"){
        $args['suppress_filters'] = true;
        $args['posts_per_page'] = 9999;
      }
      
      $loop = new WP_Query( $args );
      
      if(ICL_LANGUAGE_CODE=="fr"){
        $postids = array();
        foreach( $loop->posts as $item ) {

          if( $post_id = icl_object_id($item->ID,'news',false,ICL_LANGUAGE_CODE)) {
                $postids[]=$item->ID; //create a new query only of the post ids
                $post_language_information = wpml_get_language_information($item->ID);
                if($post_language_information['locale'] == 'fr_FR'){
                  $postids[]=$item->ID;
                }
            } else {
              $postids[]=$item->ID;
            }
        }

        $uniqueposts = array_unique($postids); //remove duplicate post ids
        $args['post__in'] = $uniqueposts;
        $args['posts_per_page'] = 6;
        $loop = new WP_Query( $args );
      }

      while ( $loop->have_posts() ) : $loop->the_post();

      ?>

      <div class="row news-widget-item">

        <div class="col-xs-4">    
          <div class="news-widget-image">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('news-thumb-square'); ?></a>
          </div>
        </div>
        <div class="col-xs-8">
          <a href="<?php the_permalink(); ?>"><div class="news-widget-title"><?php the_title(); ?></div></a>
          <div class="news-widget-subtitle">
            By: <?php the_author(); ?> | <?php the_time('F jS, Y'); ?>
          </div>
          <div class="news-widget-teaser">
            <?php 
              $curexcerpt = get_the_excerpt();
              $curexcerpt = substr($curexcerpt, 0, 100) . "... ";
              // '<a class="moretag" href="' . get_permalink() . '"> Read more</a>'
              echo $curexcerpt;
            ?>
          </div>
        </div>
      </div>

      <?php
      endwhile;
      wp_reset_postdata();
      ?>
      

    </div>
    <div class="rain-widget-button">
      <a class="btn btn-default" href="<?php echo home_url(); ?>/news/">More news</a>
    </div>
  </div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("NewsWidgetServices");') );












class ProjectExploreWidget extends WP_Widget
{
  function ProjectExploreWidget()
  {
    $widget_ops = array('classname' => 'ProjectExploreWidget', 'description' => 'Project explore widget' );
    $this->WP_Widget('ProjectExploreWidget', 'Project explore widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
  <p>
  	<label for="<?php echo $this->get_field_id('text'); ?>">Text: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;

    $post = get_queried_object();
    $widget_title = str_replace("%s", $post->post_title, $instance['title']);
    ?>

	<div class="rain-widget">
		<div class="rain-widget-title">
			<?php echo $widget_title; ?>
		</div>

		<div id="explore-map">
			
		</div>
		<div class="rain-widget-text rain-widget-text-explore">
			<?php echo wpautop($instance['text']); ?>
		</div>
		<div class="rain-widget-button">
			<a class="btn btn-default" href="<?php echo home_url(); ?>/projects/">Explore activities</a>
		</div>
	</div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ProjectExploreWidget");') );











class ProjectListServicesWidget extends WP_Widget
{
  function ProjectListServicesWidget()
  {
    $widget_ops = array('classname' => 'ProjectListServicesWidget', 'description' => 'Project list on Services widget' );
    $this->WP_Widget('ProjectListServicesWidget', 'Project list on Services  widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

  <div class="rain-widget">
    <div class="rain-widget-title">
      <?php echo $instance['title']; ?>
    </div>
    <div class="rain-widget-text">
      
      <?php 
      
      $project_ids = get_post_meta( get_the_ID(), 'service-best-practices', true );
      
      $project_ids = explode(",", $project_ids);
      $objects = array();
    
      foreach ($project_ids as $pid){
        $activity = wp_get_activity($pid);        
        array_push($objects, $activity);
      }
      
      foreach($objects AS $idx=>$project) {
      ?>

      <div class="row project-list-widget-item">
        <div class="col-xs-4">    
          <div class="project-list-widget-image">
            <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
              <?php   
              if(!empty($project->documents)) {

                $image_url = $project->documents[0]->url;
                ?>
                  <img src="<?php echo $image_url; ?>" alt="" />
                <?php
              } else {
                ?>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image.png" alt="" />
                <?php
              }
              ?>
            </a>
          </div>
        </div>
        <div class="col-xs-8">
          <a class="project-list-widget-title" href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
             <?php if (!empty($project->titles)){ 
                echo $project->titles[0]->title; 
              } else {
                echo get_post_meta( $the_id, 'projects-no-title', true );
              }?>
          </a>
          <div class="project-list-widget-description">
            <?php
              $desc_found = 0;
               if (!empty($project->descriptions)){ 
                foreach($project->descriptions as $desc){
                  if (!empty($desc->type)){
                    if ($desc->type->code == 99){
                      $full_desc = $desc->description;
                      $desc_found = 1; 
                      echo substr($full_desc, 0, 200);
                    }
                  }
                }
                
              }
              if ($desc_found == 0) {
                echo "No description given";
              }?>
          </div>
          <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>" class="btn btn-default">More information</a>
        </div>
      </div>
      <hr>

      <?php } ?>


    </div>
  </div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ProjectListServicesWidget");') );







class ProjectListWidget extends WP_Widget
{
  function ProjectListWidget()
  {
    $widget_ops = array('classname' => 'ProjectListWidget', 'description' => 'Project list widget' );
    $this->WP_Widget('ProjectListWidget', 'Project list widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

  <div class="rain-widget">
    <div class="rain-widget-title">
      <?php echo $instance['title']; ?>
    </div>
    <div class="rain-widget-text">
      
      <?php 

      oipa_generate_results($objects, $meta, null, true); 

      foreach($objects AS $idx=>$project) {
      ?>

      <div class="row project-list-widget-item">
        <div class="col-xs-4">    
          <div class="project-list-widget-image">
            <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
              <?php   
              if(!empty($project->documents)) {

                $image_url = $project->documents[0]->url;
                ?>
                  <img src="<?php echo $image_url; ?>" alt="" />
                <?php
              } else {
                ?>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/no-project-image.png" alt="" />
                <?php
              }
              ?>
            </a>
          </div>
        </div>
        <div class="col-xs-8">
          <a class="project-list-widget-title" href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>">
             <?php if (!empty($project->titles)){ 
                echo $project->titles[0]->title; 
              } else {
                echo get_post_meta( $the_id, 'projects-no-title', true );
              }?>
          </a>
          <div class="project-list-widget-description">
            <?php
              $desc_found = 0;
               if (!empty($project->descriptions)){ 
                foreach($project->descriptions as $desc){
                  if (!empty($desc->type)){
                    if ($desc->type->code == 99){
                      $full_desc = $desc->description;
                      $desc_found = 1; 
                      echo substr($full_desc, 0, 200);
                    }
                  }
                }
                
              }
              if ($desc_found == 0) {
                echo "No description given";
              }?>
          </div>
          <a href="<?php echo SITE_URL . '/project/' . $project->iati_identifier . '/'; ?>" class="btn btn-default">More information</a>
        </div>
      </div>
      <hr>

      <?php } ?>


    </div>
  </div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ProjectListWidget");') );






class ProjectFocusWidget extends WP_Widget
{
  function ProjectFocusWidget()
  {
    $widget_ops = array('classname' => 'ProjectFocusWidget', 'description' => 'Project focus widget' );
    $this->WP_Widget('ProjectFocusWidget', 'Project focus widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $the_id = 338;
    ?>

	<div class="rain-widget">
		<div class="rain-widget-title rain-widget-focus-title">
			<?php echo $instance['title']; ?>

      <div class="pf-next-project">
        Next project update
        <div class="pf-next-project-counter">
          <input class="knob second" data-width="29" data-min="0" data-max="10" data-displayPrevious=true data-fgColor="#999" data-readOnly="true" value="10" data-bgcolor="#EEE">
        </div>
      </div>
		</div>

    <div id="project-focus-content-wrap">
      <script>

        jQuery.ajax({
        type: 'GET',
        url: '<?php echo admin_url('admin-ajax.php') . "?action=project_focus_widget"; ?>',
        dataType: 'html',
        success: function(data){
          jQuery("#project-focus-content-wrap").append(data);
          setTimeout(function(){ 

            jQuery(".project-focus-slider").css("margin-top", 200);
            jQuery(".project-focus-item").css("margin-left", 15);

            slider = new ProjectFocusSlider();
            slider.set_slider();
            slider.set_counter(10, slider);

          }, 2500);

        }
      });


      </script>
  </div>
		

	</div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("ProjectFocusWidget");') );






class RainToolsWidget extends WP_Widget
{
  function RainToolsWidget()
  {
    $widget_ops = array('classname' => 'RainToolsWidget', 'description' => 'Rain tools widget' );
    $this->WP_Widget('RainToolsWidget', 'Rain tools widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
   <p>
  	<label for="<?php echo $this->get_field_id('text'); ?>">Text: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>

	<div class="col-md-6">
		<div class="rain-widget">
			<div class="rain-widget-title">
				<?php echo $instance['title'];?>
			</div>

			<div class="rain-widget-content">
				<?php echo $instance['text'];?>
			</div>

			<div class="rain-widget-button">
				<a class="btn btn-default" href="<?php echo home_url(); ?>/tools/">Show tools</a>
			</div>
			
		</div>
	</div>

    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("RainToolsWidget");') );



class RainAroundTheWorldWidget extends WP_Widget
{
  function RainAroundTheWorldWidget()
  {
    $widget_ops = array('classname' => 'RainAroundTheWorldWidget', 'description' => 'RAIN around the world widget' );
    $this->WP_Widget('RainAroundTheWorldWidget', 'RAIN around the world widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
?>
  <p>
  	<label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
  	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
  <p>
  	<label for="<?php echo $this->get_field_id('text'); ?>">Text: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>
    <div class="col-md-6">
		<div class="rain-widget">
			<div class="rain-widget-title">
				<?php echo $instance['title'];?>
			</div>

			<div class="rain-widget-content rain-widget-content-around">
				<?php echo wpautop($instance['text']); ?>
			</div>

			<div class="rain-widget-button">
				<a class="btn btn-default" href="<?php echo home_url(); ?>/partners/">Show partners</a>
			</div>
		</div>
	</div>
    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("RainAroundTheWorldWidget");') );







class MoreInformationWidget extends WP_Widget
{
  function MoreInformationWidget()
  {
    $widget_ops = array('classname' => 'MoreInformationWidget', 'description' => 'RAIN more information widget' );
    $this->WP_Widget('MoreInformationWidget', 'RAIN more information widget', $widget_ops);
  }
 
  function form($instance)
  { 
    $instance = wp_parse_args( (array) $instance, array( 'title' => '') );

    $title = strip_tags($instance['title']);
    $text = $instance['text'];
    $contact_form_id = $instance['contact_form_id'];
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>">Title: </label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('text'); ?>">Text: </label>
    <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('contact_form_id'); ?>">Contact form id: </label>
    <input class="widefat" id="<?php echo $this->get_field_id('contact_form_id'); ?>" name="<?php echo $this->get_field_name('contact_form_id'); ?>" type="text" value="<?php echo esc_attr($contact_form_id); ?>" />
  </p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    return $new_instance;
  }
 
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    ?>
    <div class="rain-widget">

      <div class="rain-widget-title">
        <?php echo $instance['title'];?>
      </div>

      <div class="rain-widget-content">
        <div class="col-md-12">
          <br>
          <?php echo wpautop($instance['text']); ?>
          <?php echo do_shortcode( '[contact-form-7 id="' . $instance['contact_form_id'] . '" title="Sidebar contact"]' ) ?>
        </div>
      </div>
      
    </div>
    <?php
    echo $after_widget;
  }

}
add_action( 'widgets_init', create_function('', 'return register_widget("MoreInformationWidget");') );












