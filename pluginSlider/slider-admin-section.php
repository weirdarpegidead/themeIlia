<?php
/*
Plugin Name: Slider Custom Anibal
Description: Añade una sección especial en la administración para manejar los post que se mostraran en el slide.
Version: 1.0
Author: Anibal Garcias Urrea
*/

// Hook para agregar el menú en la administración
add_action('admin_menu', 'slider_admin_menu');

function slider_admin_menu() {
    add_menu_page(
        'Slider Posts',
        'Slider Posts',
        'manage_options',
        'slider-posts',
        'slider_posts_page',
        'dashicons-images-alt2',
        6
    );
}

function slider_posts_page() {
    // Consulta para obtener los posts de la categoría "slider"
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => 'slider',
        'order' => 'DESC',
        'orderby' => 'date'
    );
    $slider_posts = new WP_Query($args);

    echo '<div class="wrap">';
    echo '<h1>Slider Posts</h1>';
    echo '<a href="' . admin_url('post-new.php?slider_post=true') . '" class="page-title-action">Add New</a>';
    echo '<table class="widefat fixed" cellspacing="0">';
    echo '<thead><tr><th id="columnname" class="manage-column column-columnname" scope="col">Thumbnail</th><th id="columnname" class="manage-column column-columnname" scope="col">Title</th><th id="columnname" class="manage-column column-columnname" scope="col">Actions</th></tr></thead>';
    echo '<tbody>';

    if ($slider_posts->have_posts()) {
        while ($slider_posts->have_posts()) {
            $slider_posts->the_post();
            echo '<tr>';
            echo '<td>' . get_the_post_thumbnail(get_the_ID(), array(100, 100)) . '</td>';
            echo '<td><a href="' . get_edit_post_link() . '">' . get_the_title() . '</a></td>';
            echo '<td>
                    <form method="post" action="' . esc_url(admin_url('admin-post.php')) . '">
                        <input type="hidden" name="action" value="delete_slider_post">
                        <input type="hidden" name="post_id" value="' . get_the_ID() . '">
                        <input type="submit" value="Delete" class="button button-danger" onclick="return confirm(\'Are you sure you want to delete this post?\');">
                    </form>
                  </td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3">No posts found.</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  wp_reset_postdata();
}

// Hook para manejar la eliminación del post
add_action('admin_post_delete_slider_post', 'handle_delete_slider_post');
function handle_delete_slider_post() {
    if (isset($_POST['post_id']) && current_user_can('delete_post', $_POST['post_id'])) {
        wp_delete_post($_POST['post_id'], true);
        wp_redirect(admin_url('admin.php?page=slider-posts'));
        exit;
    }
}

// Asignar automáticamente la categoría slider a los nuevos posts creados desde la sección especial
add_action('save_post', 'assign_slider_category_on_save', 10, 2);
function assign_slider_category_on_save($post_id, $post) {
    // Verificar que no es una revisión y que la categoría ya no está asignada
    if (wp_is_post_revision($post_id) || has_category('slider', $post_id)) {
        return;
    }

    // Asignar la categoría "slider" si se está creando el post desde la sección especial
    if (isset($_GET['slider_post']) && $_GET['slider_post'] == 'true') {
        wp_set_post_categories($post_id, array(get_cat_ID('slider')), true);
    }
}

// Agrega soporte para miniaturas de posts si no está ya habilitado
add_action('after_setup_theme', 'add_thumbnail_support');
function add_thumbnail_support() {
    if (!current_theme_supports('post-thumbnails')) {
        add_theme_support('post-thumbnails');
    }
}

