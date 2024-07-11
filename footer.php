<!-- footer -->
<div class="grid-container-full footer">
  <div class="grid-x grid-padding-x">
    <div class="large-12 cell">
      <div class="grid-container">
        <div class="grid-x grid-padding-x">

          <?php $footer_columns = get_theme_mod('footer_columns', 4);
            for ($i = 1; $i <= $footer_columns; $i++) {
              echo '<div class="large-' . esc_attr(12 / $footer_columns) . ' cell footer-widget">';
            if (is_active_sidebar('footer-column-' . $i)) {
                      dynamic_sidebar('footer-column-' . $i);
              } echo '</div>';} 
          ?>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="grid-container-full footer-pie">
  <div class="grid-x grid-padding-x">
    <div class="large-12 cell">
      <div class="grid-container">
        <div class="grid-x grid-padding-x">

          <?php dynamic_sidebar( 'Pie de Pagina' ); ?>

          <div class="large-5 medium-5 cell social">
            <ul class="menu align-right">

              <?php $social_networks = array(
                'facebook'  => 'fa-facebook-f',
                'twitter'   => 'fa-twitter',
                'youtube'   => 'fa-youtube',
                'linkedin'  => 'fa-linkedin',
                'instagram' => 'fa-instagram',
                'pinterest' => 'fa-pinterest'
                );
                foreach ($social_networks as $network => $icon) {
                $link = get_theme_mod("{$network}_link");
                if ($link) {
                  echo '<li><a href="' . esc_url($link) . '" class="icon"><i class="fa-brands ' . esc_attr($icon) . '"></i></a></li>';
                }}
              ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- fin footer -->
<?php wp_footer()?>
</body>

</html>
