    <?php get_header() ?>
    <!-- contenido principal -->
    <div class="grid-container contenido">
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
                    <!--<div class="large-12 cell">
                        <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
                            <div class="orbit-wrapper">
                                <div class="orbit-controls">
                                    <button class="orbit-previous"><span class="show-for-sr">Previous
                                            Slide</span>&#9664;&#xFE0E;</button>
                                    <button class="orbit-next"><span class="show-for-sr">Next
                                            Slide</span>&#9654;&#xFE0E;</button>
                                </div>
                                <ul class="orbit-container">
                                    <li class="is-active orbit-slide">
                                        <figure class="orbit-figure">
                                            <img class="orbit-image"
                                                src="https://picsum.photos/seed/1716020245652/1920/600.jpg" alt="Space">
                                            <figcaption class="orbit-caption">Space, the final frontier.</figcaption>
                                        </figure>
                                    </li>
                                    <li class="orbit-slide">
                                        <figure class="orbit-figure">
                                            <img class="orbit-image"
                                                src="https://picsum.photos/seed/1716020249471/1920/600.jpg" alt="Space">
                                            <figcaption class="orbit-caption">Lets Rocket!</figcaption>
                                        </figure>
                                    </li>
                                    <li class="orbit-slide">
                                        <figure class="orbit-figure">
                                            <img class="orbit-image"
                                                src="https://picsum.photos/seed/1716020308964/1920/600.jpg" alt="Space">
                                            <figcaption class="orbit-caption">Encapsulating</figcaption>
                                        </figure>
                                    </li>
                                    <li class="orbit-slide">
                                        <figure class="orbit-figure">
                                            <img class="orbit-image"
                                                src="https://picsum.photos/seed/1716020324680/1920/600.jpg" alt="Space">
                                            <figcaption class="orbit-caption">Outta This World</figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                            <nav class="orbit-bullets">
                                <button class="is-active" data-slide="0">
                                    <span class="show-for-sr">First slide details.</span>
                                    <span class="show-for-sr" data-slide-active-label>Current Slide</span>
                                </button>
                                <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
                                <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
                                <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
                            </nav>
                        </div>
                    </div>-->
                    <div class="large-12 cell">
                        <?php the_post_thumbnail('full', ['class' => 'float-center', 'title' => 'Feature image']); ?>
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