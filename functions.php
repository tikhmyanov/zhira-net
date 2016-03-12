<?php

add_action( 'after_setup_theme', 'zn_setup' );

function zn_setup() {

  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'homepage-thumb', 270, 200, true );

  global $content_width;
  if ( ! isset( $content_width ) ) $content_width = 640;
  register_nav_menus(
    array( 'main-menu' => __( 'Main Menu', 'zn' ) )
  );
}


add_action( 'wp_enqueue_scripts', 'zn_load_scripts' );

function zn_load_scripts() {
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null );
  wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '0.9' );
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array(), null );

  wp_enqueue_script( 'jquery', array(), null, true );
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), "1", true );
  wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), null, true );
  wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', array(), null, true );
  wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.min.js', array(), null, true );
  wp_enqueue_script('waypoints', 'http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.4/waypoints.min.js', array(), null, true );
  wp_enqueue_script('jquery-ui', 'http://code.jquery.com/ui/1.11.4/jquery-ui.js', array(), null, true );
  wp_enqueue_script('bootstrap', 'http://maps.google.com/maps/api/js?sensor=false', array(), null, true );
  wp_enqueue_script('jquery.mapmarker', get_template_directory_uri() . '/js/jquery.mapmarker.js', array(), null, true );
  wp_enqueue_script('jquery.form', 'http://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.32/jquery.form.js', array(), null, true );
  wp_enqueue_script('jquery.validate', 'http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.11.1/jquery.validate.min.js', array(), null, true );
  wp_enqueue_script('SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', array(), null, true );
}

add_action("wp_ajax_zn_send_form", "zn_send_form");
add_action("wp_ajax_nopriv_zn_send_form", "zn_send_form");

function zn_send_form() {

    $to_email       = "shimokhinaanastasia@gmail.com";
    $subject_prefix = "[Анкета с сайта zhira-net.ru]";
    $from_email     = "zhira-net.ru <noreply@zhira-net.ru";
    $copy_to        = "v.tikhmyanov@gmail.com";

    $upload_dir     = "/uploads/member/";
    $salt           = time();

    // Sanitize input data using PHP filter_var().
    $user_name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone_number   = filter_var($_POST["phone"], FILTER_SANITIZE_NUMBER_INT);
    $message        = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    $time           = filter_var($_POST["time"], FILTER_SANITIZE_STRING);
   
    $subject        = "$subject_prefix $user_name";
    $headers        = "From:".$from_email.PHP_EOL;
    
    // Email body
    $body  = "";

    $body .= "ФИО: $user_name".PHP_EOL;
    $body .= "Дополнительная информация: $message".PHP_EOL;
    $body .= "Предпочитаемое время: $time".PHP_EOL;
    $body .= "Номер телефона: $phone_number".PHP_EOL;
    $body .= "E-mail: $user_email".PHP_EOL;

    // Attachment Preparation
    $attachments = array();

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] <> 4) {

        $file_tmp_name    = $_FILES['photo']['tmp_name'];
        $file_name        = $_FILES['photo']['name'];
        $file_size        = $_FILES['photo']['size'];
        $file_type        = $_FILES['photo']['type'];
        $file_error       = $_FILES['photo']['error'];

        //exit script and output error if we encounter any
        if ($file_error == 0) {

          $new_file_name = WP_CONTENT_DIR . $upload_dir . md5($file_name . $salt) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
          move_uploaded_file($file_tmp_name, $new_file_name);

          $attachments = array($new_file_name);
        }
    }

    wp_mail($to_email, $subject, $body, $headers, $attachments);
    // copy for debug
    $result = wp_mail($copy_to, $subject, $body, $headers, $attachments);

    die;   
}


add_filter( 'the_title', 'zn_title' );
function zn_title( $title ) {
  if ( $title == '' ) {
    return '&rarr;';
  } else {
    return $title;
  }
}

add_filter( 'wp_title', 'zn_filter_wp_title' );
function zn_filter_wp_title( $title ) {
  return $title . esc_attr( get_bloginfo( 'name' ) );
}


// shortcodes
add_shortcode( 'display_latest_posts', 'display_latest_posts_func' );
function display_latest_posts_func() {

  $args = "posts_per_page=3&category_name='blog'";
  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) {
    $out = ''; $i = 0; 
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      $out .= '<div class="col-md-4 col-xs-12 col-sm-6 text-center hvr-grow item wow zoomIn" data-wow-duration=".5s" data-wow-delay="'.$i.'s">';
      $out .= '<figure>';
      if ( has_post_thumbnail() ) {
        $out .= get_the_post_thumbnail( $post->ID, 'homepage-thumb' );
      } else {
        // dummy pic
      }
      $out .= '<span class="date">' . get_the_date( 'd M' ) . '</span>';
      $out .= '</figure>';
      $out .= '<h5>' . get_the_title() . '</h5>';
      $out .= '<p>' . mb_substr( get_the_excerpt(), 0, 80 ) . ( mb_strlen( get_the_excerpt() ) > 80 ? '...</p>' : '</p>' );
      $out .= '<a href="' . get_permalink() . '">Подробнее >></a>';
      $out .= '</div>';
      $i =+ 0.5;
    }
  }

  wp_reset_postdata();

  return $out;
}

add_shortcode( 'testimonials', 'testimonials_func' );
function testimonials_func() {

  $args = "posts_per_page=5&category_name='testimonials'";
  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) {
    $out = '<div class="reviewer-list" id="reviewer">';
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      $out .= '<div class="items zoom col-md-12">';
      if ( has_post_thumbnail() ) {
        $out .= '<div class="img-circle photo-frame">';
        $out .= get_the_post_thumbnail( $post->ID, array(100, 100), array('class' => 'img-circle', 'draggable' => 'false') );
        $out .= '</div>';
      } else {
        // dummy pic
      }
      $out .= '<blockquote><p><i class="fa fa-quote-left quote-mark"></i> &nbsp;' . get_the_excerpt() . '</p></blockquote>';
      $out .= '<footer><span class="pull-right"> - ' . get_the_title() . '</span></footer>';
      $out .= '</div>';
    }
    $out .= '</div>';
  }

  wp_reset_postdata();

  return $out;
}