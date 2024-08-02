    <?php get_header() ?>

    <!-- contenido principal -->
    <?php $layout_class = get_theme_mod('mytheme_layout_setting', 'normal') === 'full' ? 'grid-container-full' : 'grid-container'; ?>  
    <div class="<?php echo esc_attr($layout_class); ?> contenido">
      <div class="grid-x grid-padding-x">
        <div class="large-9 medium-9 cell">

          <!-- contenido post -->
          <div class="grid-x grid-padding-x">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
              <div class="large-6 medium-6 small-6 cell text-left post-nav">
                <?php previous_post_link( '%link', '<i class="fa-solid fa-chevron-left"></i> Post anterior' ); ?>
              </div>
              <div class="large-6 medium-6 small-6 cell text-right post-nav">
                <?php next_post_link( '%link','Post siguiente <i class="fa-solid fa-chevron-right"></i>' ); ?>
              </div>
              <div class="large-12 cell">

                <?php the_post_thumbnail('large', ['class' => 'float-center', 'title' => 'Feature image']); ?>
                <?php   the_title('<h1>','</h1>');
                  the_content();
                ?>
                <hr><?php the_date(); ?><hr>
                <?php    endwhile;
                  else :
                    _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
                  endif;
                ?>

              </div>
          </div>
          <!-- fin contenido post -->

        </div>
        
        <!-- sidebar -->
        <div class="large-3 medium-3 cell">
          <?php get_sidebar('single') ?>
        </div>
        <!-- fin sidebar -->

      </div>
    </div>
    <!-- fin contenido principal -->

    <?php get_footer() ?>
