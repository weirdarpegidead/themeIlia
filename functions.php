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
// Registra y configura los sidebar para ser usados con widgets 
add_action( 'widgets_init', 'themename_widgets_init' );
function themename_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'HomeSidebar', 'ThemeAnop' ),
		'id'            => 'primary',
		'before_widget' => '<div class="sidebar text-center">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'SingleSidebar', 'ThemeAnop' ),
		'id'            => 'secondary',
		'before_widget' => '<div class="sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
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
// Agrega soporte para los tipo de contenido que es soportado de manera nativa por wordpress
add_theme_support( 'post-formats',  array( 'aside', 'gallery', 'quote', 'image', 'video' ) );
// Registra los menus en el backend
function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'menu primario' ),
        'extra-menu' => __( 'menu secundario' )
       )
     );
   }
add_action( 'init', 'register_my_menus' );
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

// FORMULARIO
// Incluir la biblioteca FPDF
require_once get_template_directory() . '/fpdf/fpdf.php';

// javascript que controla el formulario
function enqueue_custom_scripts() {
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

// graba los datos en la BD y envía el PDF
function registrar_evaluacion() {
    global $wpdb;

    // Obtener datos de la solicitud
    $data = json_decode(file_get_contents('php://input'), true);

    if (!isset($data['nombre'], $data['email'], $data['resultado'], $data['total'])) {
        wp_send_json_error(['message' => 'Datos incompletos']);
    }

    $nombre = sanitize_text_field($data['nombre']);
    $email = sanitize_email($data['email']);
    $resultado = sanitize_text_field($data['resultado']);
    $total = intval($data['total']);

    $table_name = $wpdb->prefix . 'test_results';  // Nombre de la tabla

    // Insertar datos en la base de datos
    $result = $wpdb->insert($table_name, [
        'name' => $nombre,
        'email' => $email,
        'recommendations' => $resultado,
        'score' => $total,
        'created_at' => current_time('mysql')
    ]);

    if ($result !== false) {
        // Generar el PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Resultados de la Evaluacion Ley Karin');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Nombre: ' . $nombre);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Email: ' . $email);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Resultado: ' . $resultado);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, 'Puntaje Total: ' . $total);

				if ($resultado === 'Alto') {
					$pdf->MultiCell(0, 10, 'Felicidades, su empresa tiene un alto cumplimiento de la Ley Karin.');
			} elseif ($resultado === 'Medio') {
					$pdf->MultiCell(0, 10, 'Su empresa tiene un cumplimiento medio de la Ley Karin, se recomienda mejorar en algunas áreas.');
			} else {
					$pdf->MultiCell(0, 10, 'Su empresa tiene un bajo cumplimiento de la Ley Karin, se recomienda implementar medidas urgentes.');
			}

        // Guardar el PDF en el servidor
        $upload_dir = wp_upload_dir();
        $pdf_path = $upload_dir['path'] . '/resultado_evaluacion_' . time() . '.pdf';
        $pdf->Output('F', $pdf_path);

        // Enviar el PDF por correo
        $to = $email;
        $subject = 'Resultados de la Evaluación Ley Karin';
        $body = 'Adjunto encontrará un PDF con los resultados de su evaluación.';
        $headers = ['Content-Type: text/html; charset=UTF-8'];
        $attachments = [$pdf_path];

        wp_mail($to, $subject, $body, $headers, $attachments);

        wp_send_json_success();
    } else {
        wp_send_json_error(['message' => 'Error al registrar los datos en la base de datos']);
    }
}

add_action('wp_ajax_registrar_evaluacion', 'registrar_evaluacion');
add_action('wp_ajax_nopriv_registrar_evaluacion', 'registrar_evaluacion');

// Añadir el menú en el administrador
function agregar_menu_test_results() {
    add_menu_page(
        'Resultados del Test',
        'Resultados del Test',
        'manage_options',
        'test-results',
        'mostrar_test_results',
        'dashicons-chart-bar',
        6
    );
}
add_action('admin_menu', 'agregar_menu_test_results');

// Función para mostrar los resultados del test
function mostrar_test_results() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_results';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

    echo '<div class="wrap">';
    echo '<h1>Resultados del Test</h1>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nombre</th>';
    echo '<th>Email</th>';
    echo '<th>Puntaje</th>';
    echo '<th>Recomendaciones</th>';
    echo '<th>Fecha</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    if (!empty($results)) {
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . esc_html($result->id) . '</td>';
            echo '<td>' . esc_html($result->name) . '</td>';
            echo '<td>' . esc_html($result->email) . '</td>';
            echo '<td>' . esc_html($result->score) . '</td>';
            echo '<td>' . esc_html($result->recommendations) . '</td>';
            echo '<td>' . esc_html($result->created_at) . '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">No hay resultados</td></tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
