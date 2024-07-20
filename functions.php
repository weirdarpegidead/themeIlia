<?php
// Agrega los scripts css y javascripts correspondientes en el header y footer.
// Se hizo el siguiente cambio en app.js para que pudiese funcionar correctamente:
// (function ($) {
//    $(document).foundation() // linea original
// })(jQuery);

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
function add_theme_scripts() {
    wp_enqueue_style( 'foundation', get_parent_theme_file_uri('/css/foundation.css') );
    wp_enqueue_style( 'app', get_parent_theme_file_uri('/css/app.css') );
    wp_enqueue_script( 'jquery', get_parent_theme_file_uri('/js/vendor/jquery.js'), array(), 3.7, true );
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/js/vendor/what-input.js', array(), 5.2, true );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/vendor/foundation.js', array(), 1.0, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), 1.0, true );
}

// soporte para logo dinamico
function mytheme_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'mytheme_custom_logo_setup');

// controla los links sociales
function mytheme_customize_register( $wp_customize ) {
    // Sección para los enlaces sociales
    $wp_customize->add_section('social_links_section', array(
        'title'    => __('Enlaces Sociales', 'mytheme'),
        'priority' => 30,
    ));

    // Campos para los enlaces sociales
    $social_networks = array('facebook', 'twitter', 'youtube', 'linkedin', 'instagram', 'pinterest'); // Añade más redes si es necesario

    foreach ($social_networks as $network) {
        $wp_customize->add_setting("{$network}_link", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("{$network}_link", array(
            'label'   => ucfirst($network) . ' ' . __('Link', 'mytheme'),
            'section' => 'social_links_section',
            'type'    => 'url',
        ));
    }

    // Opción de posición del menú social
    $wp_customize->add_setting('social_menu_position', array(
        'default' => 'right',
        'sanitize_callback' => 'mytheme_sanitize_position',
    ));

    $wp_customize->add_control('social_menu_position', array(
        'label'   => __('Posición del menú social', 'mytheme'),
        'section' => 'social_links_section',
        'type'    => 'radio',
        'choices' => array(
            'left' => __('Izquierda', 'mytheme'),
            'right' => __('Derecha', 'mytheme'),
        ),
    ));

    // Sección para el footer
    $wp_customize->add_section('footer_section', array(
        'title'    => __('Footer', 'mytheme'),
        'priority' => 40,
    ));

    // Opción para el número de columnas del footer
    $wp_customize->add_setting('footer_columns', array(
        'default' => 4,
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('footer_columns', array(
        'label'   => __('Número de columnas del footer', 'mytheme'),
        'section' => 'footer_section',
        'type'    => 'select',
        'choices' => array(
            1 => __('1 columna', 'mytheme'),
            2 => __('2 columnas', 'mytheme'),
            3 => __('3 columnas', 'mytheme'),
            4 => __('4 columnas', 'mytheme'),
        ),
    ));
}
function mytheme_sanitize_position($input) {
    $valid = array('left', 'right');
    return in_array($input, $valid) ? $input : 'right';
}
add_action('customize_register', 'mytheme_customize_register');

// Registra y configura los sidebar para ser usados con widgets 
add_action( 'widgets_init', 'themeilia_widgets_init' );
function themeilia_widgets_init() {
    // sidebar en home
	register_sidebar( array(
		'name'          => __( 'HomeSidebar', 'Theme Ilia' ),
		'id'            => 'primary',
		'before_widget' => '<div class="sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
    // sidebar en single page
	register_sidebar( array(
		'name'          => __( 'SingleSidebar', 'Theme Ilia' ),
		'id'            => 'secondary',
		'before_widget' => '<div class="sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
    // texto pie de pagina
    register_sidebar( array(
		'name'          => __( 'Pie de Pagina', 'Theme Ilia' ),
		'id'            => 'piePagina',
		'before_widget' => '<div class="large-7 medium-7 cell">',
		'after_widget'  => '</div>',
		'before_title'  => false,
		'after_title'   => false,
	) );
    // carrito
    register_sidebar( array(
		'name'          => __( 'carrito', 'Theme Ilia' ),
		'id'            => 'carrito',
		'before_widget' => '<div class="carrito">',
		'after_widget'  => '</div>',
		'before_title'  => false,
		'after_title'   => false,
	) );

    // Registrar áreas de widgets del footer
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name'          => sprintf(__('Footer Column %d', 'Theme Ilia'), $i),
            'id'            => 'footer-column-' . $i,
            'before_widget' => false,
            'after_widget'  => false,
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}

// Agrega la clase post-link a los previous y next post
function wpdocs_add_post_link( $html ){
	$html = str_replace( '<a ', '<a class="post-link" ', $html );
	return $html;
}
add_filter( 'next_post_link', 'wpdocs_add_post_link' );
add_filter( 'previous_post_link', 'wpdocs_add_post_link' );
add_action( 'after_setup_theme', 'theme_slug_setup' );
function theme_slug_setup() {
	add_theme_support( 'wp-block-styles' );
}

// Agrega soporte para las miniaturas
add_theme_support( 'post-thumbnails' );
the_post_thumbnail( 'thumbnail' );     // Thumbnail (150 x 150 hard cropped)
the_post_thumbnail( 'medium' );        // Medium resolution (300 x 300 max height 300px)
the_post_thumbnail( 'medium_large' );  // Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
the_post_thumbnail( 'large' );         // Large resolution (1024 x 1024 max height 1024px)
the_post_thumbnail( 'full' );          // Full resolution (original size uploaded)
add_image_size( 'slide-size', 2500, 600, true ); // configura el tamaño que deben tener las imagenes para el slide

// Agrega soporte para los tipo de contenido que es soportado de manera nativa por wordpress
add_theme_support( 'post-formats',  array( 'aside', 'gallery', 'quote', 'image', 'video' ) );

// Registra los menus en el backend
function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu'   => __( 'menu primario' ),
        'extra-menu'    => __( 'menu secundario' ),
        'more-menu'     => __( 'menu terciario' )
       )
     );
   }
add_action( 'init', 'register_my_menus' );+

// Agrega la clase "is-active" a los elementos del menu que estan activos
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class($classes, $item){
     if( in_array('current-menu-item', $classes) ){
             $classes[] = 'is-active ';
     }
     return $classes;
}

// Corta el número de palabras que componen el excerpt de 55 a 20
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
//function wpdocs_custom_excerpt_length( $length ) {
//	return 20;
//}
//add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function my_pagination_rewrite() {
    add_rewrite_rule('category_name/page/?([0-9]{1,})/?$', 'index.php?category_name=blog&paged=$matches[1]', 'top');
}
add_action('init', 'my_pagination_rewrite');

