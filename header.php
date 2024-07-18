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
  <div class="grid-container-full">
    <div class="grid-x grid-padding-x">
      <div class="large-12 cell social">

        <!-- menu social -->
        <?php
          $menu_position = get_theme_mod('social_menu_position');
          if ($menu_position == 'left') {
            echo '<div class="large-12 cell">';
          } else {
            echo '<div class="large-12 cell">';
          }
        ?>
        <ul class="menu align-<?php echo esc_attr($menu_position); ?>">
        <?php
          $social_networks = array(
            'facebook'  => 'fa-facebook-f',
            'twitter'   => 'fa-twitter',
            'youtube'   => 'fa-youtube',
            'linkedin'  => 'fa-linkedin',
            'instagram' => 'fa-instagram',
            'pinterest' => 'fa-pinterest'
          );
          foreach ($social_networks as $network => $icon) {
            $link = get_theme_mod("{$network}_link");
            if ($link) {
              echo '<li><a href="' . esc_url($link) . '" class="icon"><i class="fa-brands ' . esc_attr($icon) . '"></i></a></li>';
            }}
        ?>
        </ul>
        <?php if ($menu_position == 'left') {
            echo '</div>';
          } else {
            echo '</div>';
          }
        ?>
        <!-- fin menu social -->

      </div>
    </div>
  </div>

  <div class="grid-container">
    <div class="grid-x grid-margin-x header">

      <!-- logo -->
      <div class="large-2 medium-3 cell logo">
        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
          the_custom_logo();
          } else { ?>
          <img src="<?php echo esc_url( get_parent_theme_file_uri( 'img/logo-anop-2.png' ) ); ?>" alt="" />
        <?php } ?>
      </div>
      <!-- fin logo -->

      <!-- menu principal -->
      <?php wp_nav_menu( array( 
        'theme_location' => 'header-menu',
        'menu_class'		=> 'dropdown menu align-left nav',
        'container_class'	=> 'auto cell show-for-medium',
        'items_wrap' => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
        ));
      ?>
      <!-- fin menu principal-->

      <!-- carrito -->
      <div class="shrink cell">
        <?php dynamic_sidebar( 'carrito' ); ?>
      </div>
      <!-- fin carrito -->


      <!-- mini menu -->
      <div class="small-12 cell hide-for-large hide-for-medium">
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
