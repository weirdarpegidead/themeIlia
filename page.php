<?php get_header()?>
<!-- contenido principal -->
<div class="grid-container contenido">
  <div class="grid-x grid-padding-x">
    <div class="large-12 cell">
      <?php
        if ( have_posts() ) :
        while ( have_posts() ) : the_post();
        the_title( '<h1 class="text-center">', '</h1>' );
        the_content();
        endwhile;
        else:
          _e( 'No se pudo encontrar la paginia solicitada.', 'textdomain' );
        endif;
      ?>
    </div>
  </div>
</div>
<!-- fin contenido principal -->
<?php get_footer()?>
