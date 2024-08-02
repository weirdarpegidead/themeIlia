  <?php get_header()?>

  <!-- contenido principal -->
  <?php $layout_class = get_theme_mod('mytheme_layout_setting', 'normal') === 'full' ? 'grid-container-full' : 'grid-container'; ?>  
  <div class="<?php echo esc_attr($layout_class); ?> contenido">
    <div class="grid-x grid-padding-x">
      <div class="large-9 cell">
        <h1 class="text-center">Últimas Noticias</h1>

        <!-- noticias en dos columnas-->
        <div class="grid-x grid-padding-x">
          <?php
            // WP_Query arguments
            $args = array(
                    'post_type'              => array( 'post' ),
                    'order'                  => 'DESC',
                    'orderby'                => 'date',
                    'category_name'          => 'noticias, convenios',
                    'paged'                  => $paged,
            );
            // The Query
            $the_query = new WP_Query( $args ); ?>
          <?php if ( $the_query->have_posts() ) : ?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <div class="large-6 cell">
            <div class="card noticia-grid">
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']); ?>
              </a>
              <div class="card-section">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title( '<h2>', '</h2>' );?>
                </a>
                <span><?php the_author(); ?></span> | <span><?php the_date(); ?></span> | <span><?php the_category( ' ' ); ?></span>
                <hr>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <!-- fin noticias en 2 columnas -->

        <!-- paginacion -->
        <?php the_posts_pagination( array(
                  'class'       => 'pagination',
                  'aria_label'  => 'Pagination',
        ) ); ?>
        <!-- fin paginacion -->

        <?php wp_reset_postdata(); ?>
        <?php else : ?>
        <p><?php esc_html_e( 'Ups, no se encontraron entradas.' ); ?></p>
        <?php endif; ?>
      </div>
      <div class="large-3 cell">
        <?php get_sidebar( 'primary' )?>
      </div>
    </div>
  </div>
  <!-- fin contenido principal -->

  <?php get_footer()?>
