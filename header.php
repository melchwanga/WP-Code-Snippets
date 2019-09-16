<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Antarc_Kenya
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<!--[if lt IE 9]>
	  <script src="<?php echo get_template_directory_uri();?>/js/html5shiv.js"></script>
	  <![endif]-->

</head>

<body <?php body_class(); ?>>
    
    <!-- PRELOADER ELEMENTS -->
    <section id="preloader">

      <section class="progress">
        
        <img src="img/logo.png" alt="">
        <h4 class="percent">00%</h4>
      </section>

    </section>
    <!-- END PRELOADER ELEMENTS -->

    <!-- HEADER SECTION -->
    <header>
      
      <section class="headerWrapper">
        <!-- LOGO CONTAINER -->
        <section class="logoContainer">
          <a href="<?php echo home_url();?>">
          </a>
        </section>
        <!--END LOGO CONTAINER  -->
        
      </section>

    </header>
    <!--END HEADER SECTION -->