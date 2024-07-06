<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
        if (is_home() || is_front_page()) {
            // Homepage 
            echo bloginfo('description');
        } else { 
            // Not homepage
            echo bloginfo('name').' | '.get_the_title();
        } 
    ?>
  </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <?php wp_head()?>
</head>

<body>
  <!-- header -->
  <div class="grid-container full">
    <div class="grid-x header">
      <div class="large-12 cell text-center logo">
        <!-- menu social -->
        <ul class="menu align-right social">
          <li><a href="https://web.facebook.com/anopgenchi/?_rdc=1&_rdr" class="icon"><i class="fa-brands fa-facebook-f"></i></a></li>
          <li><a href="https://x.com/i/flow/login?redirect_after_login=%2FANOPGendarmeria" class="icon"><i class="fa-brands fa-twitter"></i></a></li>
          <li><a href="https://www.youtube.com/user/OficialPenitenciario" class="icon"><i class="fa-brands fa-youtube"></i></a></li>
        </ul>
        <img src="<?php echo esc_url( get_parent_theme_file_uri( 'img/logo-anop-2.png' ) ); ?>" alt="" />
        <!-- fin menu social -->
      </div>
      <!-- menu principal -->
        <?php wp_nav_menu( array( 
          'theme_location' => 'header-menu',
          'menu_class'		=> 'dropdown menu align-center nav',
          'container_class'	=> 'large-12 cell show-for-large',
          'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
          ) ); ?>
      <!-- fin menu principal-->
      <!-- mini menu -->
        <div class="small-12 cell hide-for-large">
          <ul class="vertical menu accordion-menu" data-accordion-menu>
            <li>
              <a href="#"><i class="fa-solid fa-bars"></i> Menu</a>
              <?php wp_nav_menu( array( 
                'theme_location' => 'extra-menu',
                'menu_class'		=> 'menu vertical nested',
                'container'     => false,
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                ) ); ?>
            </li>
          </ul>
        </div>
        <!-- fin mini menu -->
      </div>
    </div>
    <!-- fin header -->