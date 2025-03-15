<?php
// Agrega los scripts css y javascripts correspondientes en el header y footer.
// Se hizo el siguiente cambio en app.js para que pudiese funcionar correctamente:
//
// (function ($) {
//    $(document).foundation() // linea original
// })(jQuery);
//
// estilos y js
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
function add_theme_scripts() {
    wp_enqueue_style( 'foundation', get_parent_theme_file_uri('/css/foundation.css') );
    wp_enqueue_style( 'app', get_parent_theme_file_uri('/css/app.css') );
    wp_enqueue_script( 'jquery', get_parent_theme_file_uri('/js/vendor/jquery.js'), array(), 3.7, true );
    wp_enqueue_script( 'what-input', get_template_directory_uri() . '/js/vendor/what-input.js', array(), 5.2, true );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/vendor/foundation.js', array(), 1.0, true );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), 1.0, true );
    wp_enqueue_script( 'themeslug-lista-icono', get_template_directory_uri() . '/js/lista-icono.js', array(), '1.0.0', true );
}

// font-awesome
function themeslug_enqueue_font_awesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0' );
}
add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_font_awesome' );

// Enqueue Google Fonts
function theme_enqueue_google_fonts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&family=Anaheim:wght@400;800&family=Antic&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_google_fonts');

// meter los fonts en el panel de apariencia
function theme_customize_register($wp_customize) {
    // Add a section for Font Settings
    $wp_customize->add_section('font_settings', array(
        'title'    => __('Font Settings', 'themeIlia'),
        'priority' => 30,
    ));

    // Add settings and controls for each font
    $elements = array(
        'global' => 'Global Font',
        'h1'     => 'Heading 1 (H1)',
        'h2'     => 'Heading 2 (H2)',
        'h3'     => 'Heading 3 (H3)',
        'h4'     => 'Heading 4 (H4)',
        'h5'     => 'Heading 5 (H5)',
        'h6'     => 'Heading 6 (H6)',
    );

    foreach ($elements as $element => $label) {
        // Add setting
        $wp_customize->add_setting($element . '_font', array(
            'default'   => 'Roboto',
            'transport' => 'refresh',
        ));

        // Add control
        $wp_customize->add_control($element . '_font', array(
            'label'    => __($label, 'themeIlia'),
            'section'  => 'font_settings',
            'type'     => 'select',
            'choices'  => array(
                'Roboto'    => 'Roboto',
                'Open Sans' => 'Open Sans',
                'Anaheim'   => 'Anaheim',
                'Antic'     => 'Antic',
                // Add more fonts here
            ),
        ));
    }
}
add_action('customize_register', 'theme_customize_register');

// setar los fonts
function theme_apply_custom_fonts() {
    // Get the selected fonts from the Customizer
    $global_font = get_theme_mod('global_font', 'Roboto');
    $h1_font     = get_theme_mod('h1_font', 'Roboto');
    $h2_font     = get_theme_mod('h2_font', 'Roboto');
    $h3_font     = get_theme_mod('h3_font', 'Roboto');
    $h4_font     = get_theme_mod('h4_font', 'Roboto');
    $h5_font     = get_theme_mod('h5_font', 'Roboto');
    $h6_font     = get_theme_mod('h6_font', 'Roboto');

    // Generate CSS
    $css = "
        body, p, ul, ol, li, a, span, div {
            font-family: '{$global_font}', sans-serif;
        }
        h1 {
            font-family: '{$h1_font}', sans-serif;
        }
        h2 {
            font-family: '{$h2_font}', sans-serif;
        }
        h3 {
            font-family: '{$h3_font}', sans-serif;
        }
        h4 {
            font-family: '{$h4_font}', sans-serif;
        }
        h5 {
            font-family: '{$h5_font}', sans-serif;
        }
        h6 {
            font-family: '{$h6_font}', sans-serif;
        }
    ";

    // Add inline styles
    wp_add_inline_style('google-fonts', $css);
}
add_action('wp_enqueue_scripts', 'theme_apply_custom_fonts');

// soporte para block styles
add_action( 'init', 'themeslug_enqueue_block_styles' );

function themeslug_enqueue_block_styles() {
	wp_enqueue_block_style( 'core/image', array(
		'handle' => 'themeslug-block-image',
		'src'    => get_theme_file_uri( "assets/blocks/core-image.css" ),
		'path'   => get_theme_file_path( "assets/blocks/core-image.css" )
	) );
  wp_enqueue_block_style( 'core/columns', array(
		'handle' => 'themeslug-block-columns',
		'src'    => get_theme_file_uri( "assets/blocks/core-columns.css" ),
		'path'   => get_theme_file_path( "assets/blocks/core-columns.css" )
	) );
	/* wp_enqueue_block_style( 'core/columns', array(*/
	/*	'handle' => 'themeslug-block-columns',*/
	/*	'src'    => get_theme_file_uri( "css/foundation.css" ),*/
	/*	'path'   => get_theme_file_path( "css/foundation.css" )*/
	/*) );*/
  wp_enqueue_block_style( 'core/column', array(
		'handle' => 'themeslug-block-column',
		'src'    => get_theme_file_uri( "assets/blocks/core-column.css" ),
		'path'   => get_theme_file_path( "assets/blocks/core-column.css" )
	) );
  wp_enqueue_block_style( 'core/list', array(
		'handle' => 'themeslug-block-list',
		'src'    => get_theme_file_uri( "assets/blocks/core-list.css" ),
		'path'   => get_theme_file_path( "assets/blocks/core-list.css" )
	) );
}
// registro de block styles
add_action( 'init', 'themeslug_register_block_styles' );
function themeslug_register_block_styles() {
	register_block_style( 'core/image', array(
    'name'         => 'hand-drawn',
    'label'        => __( 'Hand Drawn', 'themeslug' ),
    'style_handle' => '.wp-block-image.is-style-hand-drawn img'
  ) );
  register_block_style( 'core/image', array(
    'name'         => 'round5',
    'label'        => __( 'Round 5px', 'themeslug' ),
    'style_handle' => '.wp-block-image.is-style-round5 img'
  ) );
  register_block_style( 'core/image', array(
    'name'         => 'round10',
    'label'        => __( 'Round 10px', 'themeslug' ),
    'style_handle' => '.wp-block-image.is-style-round10 img'
  ) );
  register_block_style( 'core/image', array(
    'name'         => 'opacity',
    'label'        => __( 'Opacidad .9', 'themeslug' ),
    'style_handle' => '.wp-block-image.is-style-opacity img'
  ) );
  register_block_style( 'core/columns', array(
    'name'         => 'grid-container',
    'label'        => __( 'Box Container', 'themeslug' ),
    'style_handle' => 'is-style-grid-container'
  ) );
  register_block_style( 'core/column', array(
    'name'         => 'opacity',
    'label'        => __( 'Opacity .9', 'themeslug' ),
    'style_handle' => '.is-style-opacity'
  ) );
  register_block_style( 'core/column', array(
    'name'         => 'paddingtext',
    'label'        => __( 'Padding Texto', 'themeslug' ),
    'style_handle' => '.wp-block-column.is-style-paddingtext'
  ) );
  register_block_style( 'core/list', array(
    'name'         => 'lista-icono',
    'label'        => __( 'Lista con Ícono', 'themeslug' ),
    'inline_style' => ' .is-style-lista-icono',
  ) );
}

// soporte oara custom background
$args = array(
	'default-color' => 'ffffff',
);
add_theme_support( 'custom-background', $args );

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

// Controla las adiciones al menu de personalizacion
function mytheme_customize_register( $wp_customize ) {
    // Sección para los enlaces sociales
    $wp_customize->add_section('social_links_section', array(
        'title'    => __('Enlaces Sociales', 'mytheme'),
        'priority' => 30,
    ));

    // Campos para los enlaces sociales
  $social_networks = array(
    'facebook',
    'twitter',
    'youtube',
    'linkedin',
    'instagram',
    'pinterest',
    'whatsapp'
  );

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

    // Añadir una sección para el layout
    $wp_customize->add_section('mytheme_layout_section', array(
        'title'       => __('Configuracion de Layout', 'mytheme'),
        'priority'    => 30,
        'capability'  => 'edit_theme_options',
        'description' => __('Cambia el layout de la pagina.', 'mytheme'),
    ));

    // Añadir la opción de layout
    $wp_customize->add_setting('mytheme_layout_setting', array(
        'default'           => 'normal',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'mytheme_sanitize_layout',
    ));

    $wp_customize->add_control('mytheme_layout_control', array(
        'label'    => __('Selecciona el Layout', 'mytheme'),
        'section'  => 'mytheme_layout_section',
        'settings' => 'mytheme_layout_setting',
        'type'     => 'radio',
        'choices'  => array(
            'normal' => __('Normal', 'mytheme'),
            'full'   => __('Full Width', 'mytheme'),
        ),
    ));

    // Añadir una sección para la alineación del menú
    $wp_customize->add_section('mytheme_menu_layout_section', array(
        'title'       => __('Alineacion de Menu', 'mytheme'),
        'priority'    => 31,  // Asegúrate de que sea un valor único
        'capability'  => 'edit_theme_options',
        'description' => __('Cambia la alineacion del Menu Principal.', 'mytheme'),
    ));

    // Añadir la opción de alineación del menú
    $wp_customize->add_setting('mytheme_menu_alignment_setting', array(
        'default'           => 'align-left',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'mytheme_sanitize_alignment',
    ));

    $wp_customize->add_control('mytheme_menu_alignment_control', array(
        'label'    => __('Selecciona la Alineacion del Menu', 'mytheme'),
        'section'  => 'mytheme_menu_layout_section',
        'settings' => 'mytheme_menu_alignment_setting',
        'type'     => 'radio',
        'choices'  => array(
            'align-left'  => __('Izquierda', 'mytheme'),
            'align-right' => __('Derecha', 'mytheme'),
        ),
    ));
}

add_action('customize_register', 'mytheme_customize_register');

// Sanitizar la opción de layout
function mytheme_sanitize_layout($input) {
    $valid = array('normal', 'full');

    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'normal';
}

// Sanitizar la opción de alineación del menú
function mytheme_sanitize_alignment($input) {
    $valid = array('align-left', 'align-right');

    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'align-left';
}

// Sanitizar la posición del menú social
function mytheme_sanitize_position($input) {
    $valid = array('left', 'right');

    if (in_array($input, $valid, true)) {
        return $input;
    }
    return 'right';
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
		'before_widget' => false,
		'after_widget'  => false,
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

