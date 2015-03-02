<?php
/* Meta box code based on http://codex.wordpress.org/Function_Reference/add_meta_box */

/* Define the custom box */
add_action( 'add_meta_boxes', 'rain_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'rain_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function rain_add_custom_box() {

  add_meta_box( 'projects_button_text', 'Button text', 'projects_button_text_meta_box', 'project-blocks', 'normal', 'high');
  add_meta_box( 'projects_button_link', 'Button link', 'projects_button_link_meta_box', 'project-blocks', 'normal', 'high');

  add_meta_box( 'homepage_column2_box', 'Column 2', 'homepage_column2_meta_box', 'homepage-blocks', 'normal', 'high');
  add_meta_box( 'homepage_title_box', 'Service title', 'homepage_title_meta_box', 'homepage-blocks', 'normal', 'high');
  add_meta_box( 'homepage_subtitle_box', 'Service subtitle', 'homepage_subtitle_meta_box', 'homepage-blocks', 'normal', 'high');
  add_meta_box( 'about_column2_box', 'Column 2', 'about_column2_meta_box', 'about-items', 'normal', 'high');
  
  add_meta_box( 'slider_block1_text_box', 'Slider block 1 text', 'slider_block1_text_meta_box', 'slider', 'normal', 'high');
  add_meta_box( 'slider_block2_text_box', 'Lower box', 'slider_block2_text_meta_box', 'slider', 'normal', 'high');

  add_meta_box( 'team_job_title_text_box', 'Job title', 'team_job_title_meta_box', 'team-members', 'normal', 'high');
  add_meta_box( 'team_telephone_number_text_box', 'Telephone number', 'team_telephone_number_meta_box', 'team-members', 'normal', 'high');
  add_meta_box( 'team_email_address_text_box', 'Email address', 'team_email_address_meta_box', 'team-members', 'normal', 'high');
  add_meta_box( 'team_linkedin_text_box', 'LinkedIn url', 'team_linkedin_meta_box', 'team-members', 'normal', 'high');

  add_meta_box( 'footer_about_title_box', 'About title', 'footer_about_title_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_about_text_box', 'About text', 'footer_about_text_meta_box', 'footer', 'normal', 'high');

  add_meta_box( 'footer_brand_title_box', 'Brand title', 'footer_brand_title_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_brand_text_box', 'Brand text', 'footer_brand_text_meta_box', 'footer', 'normal', 'high');

  add_meta_box( 'footer_address_title_box', 'Address title', 'footer_address_title_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_address_text_box', 'Address text', 'footer_address_text_meta_box', 'footer', 'normal', 'high');

  add_meta_box( 'footer_share_title_box', 'Share RAIN title', 'footer_share_title_meta_box', 'footer', 'normal', 'high');

  add_meta_box( 'footer_newsletter_title_box', 'Newsletter title', 'footer_newsletter_title_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_newsletter_email_box', 'Newsletter email', 'footer_newsletter_email_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_newsletter_first_name_box', 'Newsletter first name', 'footer_newsletter_first_name_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_newsletter_last_name_box', 'Newsletter last name', 'footer_newsletter_last_name_meta_box', 'footer', 'normal', 'high');
  add_meta_box( 'footer_newsletter_subscribe_button_box', 'Newsletter subscribe button', 'footer_newsletter_subscribe_button_meta_box', 'footer', 'normal', 'high');


  add_meta_box( 'country_page_lower_text_box', 'Text below map widget', 'country_page_lower_text_meta_box', 'countries', 'normal', 'high');
  add_meta_box( 'country-subtitle', 'Subtitle', 'country_subtitle_meta_box', 'countries', 'normal', 'high');

  add_meta_box( 'tool-button-text', 'Button text', 'tool_button_text_meta_box', 'tools', 'normal', 'high');
  add_meta_box( 'tool-button-link', 'Button link', 'tool_button_link_meta_box', 'tools', 'normal', 'high');

  add_meta_box( 'publication-url', 'Publication URL', 'publication_url_meta_box', 'publication', 'normal', 'high');

}


function publication_url_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'publication-url', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="publication-url" id="publication-url" />  
  <?php
}


function projects_button_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'projects_button_text', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="projects_button_text" id="projects_button_text" />  
  <?php
}

function projects_button_link_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'projects_button_link', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="projects_button_link" id="projects_button_link" />  
  <?php
}

function team_job_title_meta_box( $post) {
  $field_value = get_post_meta( $post->ID, 'team_job_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="team_job_title" id="team_job_title" />  
  <?php
}

function team_telephone_number_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'team_telephone_number', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="team_telephone_number" id="team_telephone_number" />  
  <?php
}

function team_email_address_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'team_email_address', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="team_email_address" id="team_email_address" />  
  <?php
}

function team_linkedin_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'team_linkedin', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="team_linkedin" id="team_linkedin" />  
  <?php
}

function homepage_column2_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'homepage_column2', false );
  wp_editor( $field_value[0], 'homepage_column2', array("wpautop" => true) );
}

function homepage_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'homepage_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="homepage_title" id="homepage_title" />  
  <?php
}

function homepage_subtitle_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'homepage_subtitle', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="homepage_subtitle" id="homepage_subtitle" />  
  <?php
}

function about_column2_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'about_column2', false );
  wp_editor( $field_value[0], 'about_column2' );
}

function slider_block1_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'slider_block1_text', false );
  wp_editor( $field_value[0], 'slider_block1_text', array('textarea_rows'=>5, 'wpautop' => false));
}


function slider_block2_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'slider_block2_text', false );
  wp_editor( $field_value[0], 'slider_block2_text', array('textarea_rows'=>5, 'wpautop' => false));
}


function footer_about_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_about_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_about_title" id="footer_about_title" />  
  <?php
}

function footer_brand_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_brand_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_brand_title" id="footer_brand_title" />  
  <?php
}

function footer_share_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_share_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_share_title" id="footer_share_title" />  
  <?php
}


function footer_newsletter_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_newsletter_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_newsletter_title" id="footer_newsletter_title" />  
  <?php
}

function footer_newsletter_email_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_newsletter_email', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_newsletter_email" id="footer_newsletter_email" />  
  <?php
}


function footer_newsletter_first_name_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_newsletter_first_name', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_newsletter_first_name" id="footer_newsletter_first_name" />  
  <?php
}


function footer_newsletter_last_name_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_newsletter_last_name', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_newsletter_last_name" id="footer_newsletter_last_name" />  
  <?php
}


function footer_newsletter_subscribe_button_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_newsletter_subscribe_button', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_newsletter_subscribe_button" id="footer_newsletter_subscribe_button" />  
  <?php
}


function footer_about_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_about_text', false );
  wp_editor( $field_value[0], 'footer_about_text', array('textarea_rows'=>5, 'wpautop' => false));
}

function footer_brand_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_brand_text', false );
  wp_editor( $field_value[0], 'footer_brand_text', array('textarea_rows'=>5, 'wpautop' => false));
}

function footer_address_title_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_address_title', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="footer_address_title" id="footer_address_title" />  
  <?php
}

function footer_address_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'footer_address_text', false );
  wp_editor( $field_value[0], 'footer_address_text', array('textarea_rows'=>5, 'wpautop' => false));
}


function country_page_lower_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'country_page_lower_text_box', false );
  wp_editor( $field_value[0], 'country_page_lower_text_box_editor', array('textarea_rows'=>5, 'wpautop' => false));
}




function country_subtitle_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'country-subtitle', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="country-subtitle" id="country-subtitle" />  
  <?php
}

function tool_button_text_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'tool-button-text', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="tool-button-text" id="tool-button-text" />  
  <?php
}

function tool_button_link_meta_box( $post ) {

  $field_value = get_post_meta( $post->ID, 'tool-button-link', false );
  ?>
  <input type="text" value="<?php echo $field_value[0]; ?>" name="tool-button-link" id="tool-button-link" />  
  <?php
}



/* When the post is saved, saves our custom data */
function rain_save_postdata( $post_id ) {

  // verify if this is an auto save routine. 
  // If it is our form has not been submitted, so we dont want to do anything
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( ( isset ( $_POST['rain_noncename'] ) ) && ( ! wp_verify_nonce( $_POST['rain_noncename'], plugin_basename( __FILE__ ) ) ) )
      return;

  // Check permissions
  if ( ( isset ( $_POST['post_type'] ) ) && ( 'page' == $_POST['post_type'] )  ) {
    if ( ! current_user_can( 'edit_page', $post_id ) ) {
      return;
    }    
  }
  else {
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
      return;
    }
  }

  if ( isset ( $_POST['projects_button_link'] ) ) {
    update_post_meta( $post_id, 'projects_button_link', $_POST['projects_button_link'] );
  }

  if ( isset ( $_POST['projects_button_text'] ) ) {
    update_post_meta( $post_id, 'projects_button_text', $_POST['projects_button_text'] );
  }

  if ( isset ( $_POST['publication-url'] ) ) {
    update_post_meta( $post_id, 'publication-url', $_POST['publication-url'] );
  }

  if ( isset ( $_POST['homepage_column2'] ) ) {
    update_post_meta( $post_id, 'homepage_column2', $_POST['homepage_column2'] );
  }

  if ( isset ( $_POST['homepage_title'] ) ) {
    update_post_meta( $post_id, 'homepage_title', $_POST['homepage_title'] );
  }

  if ( isset ( $_POST['homepage_subtitle'] ) ) {
    update_post_meta( $post_id, 'homepage_subtitle', $_POST['homepage_subtitle'] );
  }

  if ( isset ( $_POST['about_column2'] ) ) {
    update_post_meta( $post_id, 'about_column2', $_POST['about_column2'] );
  }

  if ( isset ( $_POST['slider_block1_text'] ) ) {
    update_post_meta( $post_id, 'slider_block1_text', $_POST['slider_block1_text'] );
  }

  if ( isset ( $_POST['slider_block2_text'] ) ) {
    update_post_meta( $post_id, 'slider_block2_text', $_POST['slider_block2_text'] );
  }

  if ( isset ( $_POST['team_email_address'] ) ) {
    update_post_meta( $post_id, 'team_email_address', $_POST['team_email_address'] );
  }

  if ( isset ( $_POST['team_telephone_number'] ) ) {
    update_post_meta( $post_id, 'team_telephone_number', $_POST['team_telephone_number'] );
  }

  if ( isset ( $_POST['team_job_title'] ) ) {
    update_post_meta( $post_id, 'team_job_title', $_POST['team_job_title'] );
  }

  if ( isset ( $_POST['team_linkedin'] ) ) {
    update_post_meta( $post_id, 'team_linkedin', $_POST['team_linkedin'] );
  }

  if ( isset ( $_POST['footer_about_title'] ) ) {
    update_post_meta( $post_id, 'footer_about_title', $_POST['footer_about_title'] );
  }

  if ( isset ( $_POST['footer_about_title'] ) ) {
    update_post_meta( $post_id, 'footer_about_text', $_POST['footer_about_text'] );
  }

  if ( isset ( $_POST['footer_brand_title'] ) ) {
    update_post_meta( $post_id, 'footer_brand_title', $_POST['footer_brand_title'] );
  }

  if ( isset ( $_POST['footer_brand_text'] ) ) {
    update_post_meta( $post_id, 'footer_brand_text', $_POST['footer_brand_text'] );
  }

  if ( isset ( $_POST['footer_address_title'] ) ) {
    update_post_meta( $post_id, 'footer_address_title', $_POST['footer_address_title'] );
  }

  if ( isset ( $_POST['footer_address_text'] ) ) {
    update_post_meta( $post_id, 'footer_address_text', $_POST['footer_address_text'] );
  }

  if ( isset ( $_POST['footer_share_title'] ) ) {
    update_post_meta( $post_id, 'footer_share_title', $_POST['footer_share_title'] );
  }

  if ( isset ( $_POST['footer_newsletter_title'] ) ) {
    update_post_meta( $post_id, 'footer_newsletter_title', $_POST['footer_newsletter_title'] );
  }

  if ( isset ( $_POST['footer_newsletter_email'] ) ) {
    update_post_meta( $post_id, 'footer_newsletter_email', $_POST['footer_newsletter_email'] );
  }

  if ( isset ( $_POST['footer_newsletter_first_name'] ) ) {
    update_post_meta( $post_id, 'footer_newsletter_first_name', $_POST['footer_newsletter_first_name'] );
  }

  if ( isset ( $_POST['footer_newsletter_last_name'] ) ) {
    update_post_meta( $post_id, 'footer_newsletter_last_name', $_POST['footer_newsletter_last_name'] );
  }
  
  if ( isset ( $_POST['footer_newsletter_subscribe_button'] ) ) {
    update_post_meta( $post_id, 'footer_newsletter_subscribe_button', $_POST['footer_newsletter_subscribe_button'] );
  }

  if ( isset ( $_POST['country_page_lower_text_box_editor'] ) ) {
    update_post_meta( $post_id, 'country_page_lower_text_box', $_POST['country_page_lower_text_box_editor'] );
  }

  if ( isset ( $_POST['country-subtitle'] ) ) {
    update_post_meta( $post_id, 'country-subtitle', $_POST['country-subtitle'] );
  }


  if ( isset ( $_POST['tool-button-text'] ) ) {
    update_post_meta( $post_id, 'tool-button-text', $_POST['tool-button-text'] );
  }

  if ( isset ( $_POST['tool-button-link'] ) ) {
    update_post_meta( $post_id, 'tool-button-link', $_POST['tool-button-link'] );
  }

}



add_filter('is_protected_meta', 'my_is_protected_meta_filter', 10, 2);

function my_is_protected_meta_filter($protected, $meta_key) {

    $protected_meta_fields = array(
      "footer_about_title_meta_box",
      "footer_address_title_meta_box",
      "footer_address_text_meta_box",
      "footer_about_text_meta_box",
      "footer_brand_title_meta_box",
      "footer_brand_text_meta_box",
      "footer_share_title_meta_box",
      "footer_newsletter_title_meta_box",
      "footer_newsletter_email_meta_box",
      "footer_newsletter_first_name_meta_box",
      "footer_newsletter_last_name_meta_box",
      "footer_newsletter_subscribe_button_meta_box",
      "slider_button1_text",
      "slider_button1_link",
      "slider_button2_text",
      "slider_button2_link",
      "slider_block1_title",
      "slider_block1_text",
      "slider_block1_link",
      "slider_block2_title",
      "slider_block2_text",
      "slider_block2_link",
      "slider_block3_title",
      "slider_block3_text",
      "slider_block3_link",
      "about_column2",
      "homepage_column2",
      "homepage_subtitle",
      "homepage_title",
      "custom_template",
      "_alp_processed",
      "_edit_last",
      "_edit_lock",
      "_wpml_media_duplicate",
      "_wpml_media_featured",
      "_yoast_wpseo_linkdex",
      "country_page_lower_text_box",
      );

 
  if (in_array($meta_key, $protected_meta_fields)){

    return true;
  } else {
    return false;
  }
}

