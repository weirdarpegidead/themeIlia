<?php get_header() ?>

<!-- contenido principal -->
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
<!-- fin contenido principal -->

<?php get_footer() ?>
