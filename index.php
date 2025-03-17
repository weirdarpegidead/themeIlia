  <?php get_header()?>

  <!-- contenido principal -->
  <?php $layout_class = get_theme_mod('mytheme_layout_setting', 'normal') === 'full' ? 'grid-container-full' : 'grid-container'; ?>  
  <div class="<?php echo esc_attr($layout_class); ?> contenido">
    <div class="grid-x grid-padding-x">

      <!-- borrar luego -->
      <div class="large-12 cell">
        <p style="margin: 1.5rem 0 1.5rem 0;">En ILIA Consultores, impulsamos el crecimiento organizacional desde dos pilares clave: el Desarrollo Humano y la Innovación Tecnologica. Fortalecemos equipos con consultorías, servicios y metodologías de aprendizaje y capacitación innovadoras, mientras que nuestras soluciones tecnológicas optimizan la seguridad, la eficiencia en los procesos empresariales y los procesos de capacitación con herramientas avanzadas como realidad virtual, simulaciones interactivas, plataformas digitales y aplicaciones, ayudamos a las organizaciones a evolucionar en un entorno cada vez más dinámico.</p>
      </div>
      <div class="large-6 cell show-for-large">
        <h2>Desarrollo Humano</h2>
      </div>
      <div class="large-6 cell show-for-large">
        <h2>Innovación Tecnológica</h2>
      </div>
      <!--borrar luego-->

      <div class="large-12 cell">
        <!-- noticias en dos columnas-->
        <div class="grid-x grid-padding-x" data-equalizer>
          <?php
            // WP_Query arguments
            $args = array(
                    'post_type'              => array( 'post' ),
                    'order'                  => 'ASC',
                    'orderby'                => 'date',
                    'category_name'          => 'noticias, convenios',
                    'paged'                  => $paged,
            );
            // The Query
            $the_query = new WP_Query( $args ); ?>
          <?php if ( $the_query->have_posts() ) : ?>
          <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php
            // Get the custom link
            $custom_link = get_post_meta( get_the_ID(), 'link', true );
            
            // If the custom link exists, use it; otherwise, use the default permalink
            if ( ! empty( $custom_link ) ) {
                $link = esc_url( $custom_link );
            } else {
                $link = get_the_permalink();
            }
            ?>

          <div class="large-6 cell">
            <div class="card noticia-grid redondo" data-equalizer-watch>
              <a href="<?php echo $link; ?>">
                <?php the_post_thumbnail('large', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']); ?>
              </a>
              <div class="card-section">
                <a href="<?php echo $link; ?>">
                  <?php the_title( '<h2>', '</h2>' );?>
                </a>
                <hr>
                <?php the_content(); ?>
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
    </div>
  </div>
  <!-- fin contenido principal -->

  <?php get_footer()?>
