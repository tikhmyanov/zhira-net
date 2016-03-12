<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
 <meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- Responsive Meta Tag -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Фитнес-проект по жиросжиганию</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- preloader -->
<div class="preloader"></div>
<div id="wrapper"> 
  <!--Header Section Start Here -->
  <header class="hero-section" >
    <div class="navbar navbar-static-top" id="nav">
      <div class="container">
        <div class="navbar-header" >
          <button aria-expanded="false" aria-controls="bs-navbar" data-target="#bs-navbar" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">Переключить навигацию</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <a class="navbar-brand animated bounce col-xs-9" href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="Жира.НЕТ"></a>
        </div>
        <?php
          wp_nav_menu(
            array(
              'theme_location'  => 'main-menu',
              'container'       => 'nav',
              'container_class' => 'collapse navbar-collapse pull-right',
              'container_id'    => 'bs-navbar',
              'menu_class'      => 'nav navbar-nav',
              'menu_id'         => '',
            )
          );
        ?>        
      </div>
    </div>
    <?php if ( is_front_page() ) : ?>
    <!-- banner section Start Here -->
    <section id="about" class="banner-section">
      <div class="container">
        <div class="col-md-5 col-sm-12 dest-detail wow bounceInLeft" data-wow-duration=".5s" data-wow-delay="0s">
          <span class="revolutionary blue">фитнес-клуб first</span>
          <div class="titles">
            <h1>ПРОДОЛЖАЕТСЯ НАБОР</h1>
            <span class="grow">В дневную группу ПН, СР, ПТ 13:00</span>
          </div>
          <p>Революционный фитнес-проект по трансформации тела от Анастасии Шимохиной, абсолютной чемпионки Иркутской области по фитнесу 2012, 2013 гг</p>
          <a href="#contact" target="_blank" class="scroll btn btn-outline hvr-sweep-to-right">заполнить анкету</a>
        </div>
        <div class="col-md-7 col-sm-12 hidden-xs wow bounceInRight" data-wow-duration="1s" data-wow-delay="0.5s" >
          <img src="<?php echo get_template_directory_uri(); ?>/img/banner-girl.png" alt="">
        </div>
      </div>
    </section>
    <!-- banner section End Here -->
    <?php endif; ?>
  </header>
  <!-- Header Section End Here -->
  
  <!-- Main Section Start Here -->
  <div id="main">
