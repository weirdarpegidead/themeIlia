<?php get_header() ?>

<!-- contenido principal -->
<?php $layout_class = get_theme_mod('mytheme_layout_setting', 'normal') === 'full' ? 'grid-container-full' : 'grid-container'; ?>  
<?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        //the_title( '<h1 class="text-center">', '</h1>' );
        the_content();
        endwhile;
        else:
          _e( 'No se pudo encontrar la paginia solicitada.', 'textdomain' );
        endif;
      ?>
<div class="<?php //echo esc_attr($layout_class); ?> grid-container-full contenido">
  <div class="grid-x grid-padding-x">
    <div class="large-12 cell">

      
    </div>
  </div>
</div>
<!-- fin contenido principal -->

<?php get_footer() ?>
