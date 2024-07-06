  <?php get_header() ?>
  <!-- slider -->
  <div class="grid-container full">
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
                  <?php the_post_thumbnail('post-thumbnail', ['class' => 'orbir-image', 'title' => 'Feature image']); ?>
                  <!--<figcaption class="orbit-caption"><?php the_excerpt(); ?></figcaption>-->
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
  <!-- contenido principal -->
  <div class="grid-container contenido">
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
                <?php the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']); ?>
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