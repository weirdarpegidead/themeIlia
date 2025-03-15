<?php
/**
 * Title: Acordeon
 * Slug: themeslug/acordeon
 * Categories: featured, themeslug/Ilia
 */

$items = array(
	__( 'Tab 1', 'themeslug' ),
	__( 'Tab 2', 'themeslug' ),
);

$items = array(
	__( 'Contenido 1', 'themeslug' ),
	__( 'Contenido 2', 'themeslug' ),
);
?>


<?php foreach ( $items as $item ) : ?>
<ul class="accordion" data-accordion>
  <li class="accordion-item is-active" data-accordion-item>
    <a href="#" class="accordion-title"><?php esc_html_e( 'Tab', 'themeslug' ); ?></a>
    <div class="accordion-content" data-tab-content>
      <p><?php esc_html_e( 'Contenido', 'themeslug' ); ?></p>
    </div>
  </li>
</ul>
<?php endforeach; ?>

