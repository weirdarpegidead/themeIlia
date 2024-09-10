<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>

    <?php if (is_home() || is_front_page()) {
            // Homepage 
            echo bloginfo('description'); 
          } else { 
            // Not homepage
          echo bloginfo('name').' | '.get_the_title(); } 
    ?>
      
  </title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <?php wp_head()?>
</head>

<body>

  <?php $layout_class = get_theme_mod('mytheme_layout_setting', 'normal') === 'full' ? 'grid-container-full' : 'grid-container'; ?>  
  <?php $menu_alignment_class = get_theme_mod('mytheme_menu_alignment_setting', 'align-left'); ?>

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
            'pinterest' => 'fa-pinterest',
            'whatsapp'  => 'fa-whatsapp'
          );
          foreach ($social_networks as $network => $icon) {
            $link = get_theme_mod("{$network}_link");
            if ($link) {
              echo '<li><a href="' . esc_url($link) . '" class="icon" target="_blank" ><i class="fa-brands ' . esc_attr($icon) . '"></i></a></li>';
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

  <div class="<?php echo esc_attr($layout_class); ?>">
    <div class="grid-x grid-margin-x header">

      <!-- logo -->
      <div class="large-2 medium-3 small-9 cell logo">
        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
          the_custom_logo();
          } else { ?>
          <img src="<?php echo esc_url( get_parent_theme_file_uri( 'img/ORlogo.png' ) ); ?>" alt="Default Logo" />
        <?php } ?>
      </div>
      <!-- fin logo -->

      <!-- menu principal -->
      <?php wp_nav_menu( array( 
        'theme_location' => 'header-menu',
        'menu_class'		=> 'dropdown menu nav '. esc_attr($menu_alignment_class),
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

  <?php if ( is_front_page() ) :?>

  <!-- slider -->
  <div class="grid-container full show-for-medium">
    <div class="grid-x">
      <div class="large-12 cell">
        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
          <div class="orbit-wrapper">
            <div class="orbit-controls">
              <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
              <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
            </div>

            <ul class="orbit-container">
              <?php
               // WP_Query arguments
                $args = array(
                  'post_type'              => array( 'post' ),
                  'nopaging'               => false,
                  'posts_per_page'         => '5',
                  'order'                  => 'DESC',
                  'orderby'                => 'date',
                  'category_name'          => 'slider',
                );
                // The Query
                $the_query = new WP_Query( $args ); ?>
              <?php if ( $the_query->have_posts() ) : ?>
              <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
              <li class="is-active orbit-slide">
                <figure class="orbit-figure">
                  <?php the_post_thumbnail( 'slide-size' ); ?>
                  <figcaption class="orbit-caption"><?php the_excerpt(); ?></figcaption>
                </figure>
              </li>
              <?php endwhile; ?>
            </ul>

            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- fin slider-->

  <?php else : endif; ?>
