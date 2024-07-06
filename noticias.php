<?php 
/* Template Name: Noticias */ 
?>
<?php get_header()?>
<!-- contenido principal -->
<div class="grid-container contenido">
        <div class="grid-x grid-padding-x">
            <div class="large-12 cell">
                <h1 class="text-center">Noticias</h1>
            </div>
            <!-- Noticias -->
            <div class="large-12 cell convenios">
                <div class="grid-x grid-padding-x">
                    <?php
                    // WP_Query arguments
                    $args = array(
                        'post_type'              => array( 'post' ),
                        'order'                  => 'DESC',
                        'orderby'                => 'date',
                        'category_name'          => 'noticias',
                        'paged'                  => $paged,
                    );
                    // The Query
                    $the_query = new WP_Query( $args ); ?>
                    <?php if ( $the_query->have_posts() ) : ?>
                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="large-12 cell convenio-grid">
                        <div class="grid-x grid-padding-x">
                            <div class="large-1 medium-2 cell">
                                <div class="grid-x grid-padding-x meta">
                                    <div class="large-12 cell fecha">
                                        <div class="dia"><span><?php the_date('d'); ?></span></div>
                                        <div class="mes"><span><?php the_time('m Y'); ?></span></div>
                                    </div>
                                    <div class="large-12 cell icono">
                                        <div>
                                            <span><i class="fa-solid fa-pen-nib"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="large-4 medium-3 cell">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'float-center', 'title' => 'Feature image']); ?>
                                </a>
                            </div>
                            <div class="large-7 medium-7 cell">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title( '<h3>', '</h3>' );?>
                                </a>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <!-- paginacion -->
                <?php the_posts_pagination( array(
                  'class'       => 'pagination',
                  'aria_label'  => 'Pagination',
                ) ); ?>
                <!-- fin paginacion -->
            </div>
            <!-- fin Noticias -->
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <!-- fin contenido principal -->
    <?php get_footer()?>