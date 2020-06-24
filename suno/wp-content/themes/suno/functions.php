<?php

/**
 * Loja LifeCommerce
 *
 * @package lifecommerce
 */

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}

require get_template_directory() . '/inc/cleanup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/post-types.php';

add_theme_support('post-thumbnails');

show_admin_bar(false);

// Filter except length to 35 words.
// tn custom excerpt length
function tn_custom_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'tn_custom_excerpt_length', 999);

// Add default posts and comments RSS feed links to head.
add_theme_support('automatic-feed-links');

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');

add_theme_support('post-thumbnails');

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
));

// add necessary scripts
add_action('plugins_loaded', function () {
    if ($GLOBALS['pagenow'] == 'post.php') {
        add_action('admin_print_scripts', 'my_admin_scripts');
        add_action('admin_print_styles',  'my_admin_styles');
    }
});

function my_admin_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
}

function my_admin_styles()
{
    wp_enqueue_style('thickbox');
}

function disable_browser_upgrade_warning()
{
    remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'disable_browser_upgrade_warning');

// Post Type Parceiros
function create_posttype_parceiros()
{
    register_post_type(
        'parceiros',
        // Options Parceiros
        array(
            'labels' => array(
                'name' => __('Parceiros'),
                'singular_name' => __('Parceiro'),
                'search_items' => __('Buscar parceiros'),
                'all_items' => __('Todos parceiros'),
                'parent_item' => __('Parent Parceiro'),
                'parent_item_colon' => __('Parent Parceiro:'),
                'edit_item' => __('Editar Parceiro'),
                'update_item' => __('Atualizar Parceiro'),
                'add_new_item' => __('Adicionar novo Parceiro'),
                'new_item_name' => __('Novo Parceiro'),
                'menu_name' => __('Parceiro'),
            ),
            'public' => true,
            'supports' => ['thumbnail', 'title', 'excerpt'],
            'publicly_queryable' => true,  // you should be able to query it
            'show_ui' => true,  // you should be able to edit it in wp-admin
            'exclude_from_search' => true,  // you should exclude it from search results
            'show_in_nav_menus' => true,  // you shouldn't be able to add it to menus
            'has_archive' => true,  // it shouldn't have archive page
            'rewrite' => array('slug' => 'parceiros'),  // it shouldn't have rewrite rules
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype_parceiros');
// FIM Post Type Parceiros


function wpdocs_register_link()
{
    add_meta_box('logo', __('Logo da empresa', 'textdomain'), 'wpdocs_logo_callback', 'parceiros');
    add_meta_box('desconto', __('Porcentagem do desconto', 'textdomain'), 'wpdocs_desconto_callback', 'parceiros');
    add_meta_box('link', __('Url da empresa', 'textdomain'), 'wpdocs_link_callback', 'parceiros');
}
add_action('add_meta_boxes', 'wpdocs_register_link');


function wpdocs_logo_callback($post_id)
{
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="logo_noncename" id="logo_noncename" value="' .
        wp_create_nonce(plugin_basename(__FILE__)) .
        '" />';
    global $wpdb;
    $strFile = get_post_meta($post->ID, $key = 'logo_image', true);
    $media_file = get_post_meta($post->ID, $key = '_wp_attached_file', true);
    if (!empty($media_file)) {
        $strFile = $media_file;
    } ?>


    <script type="text/javascript">
        // Uploading files
        var file_frame;
        jQuery('#upload_image_button').live('click', function(logo) {

            logo.preventDefault();

            jQuery("#logo_img_pic").hide();

            // If the media frame already exists, reopen it.
            if (file_frame) {
                file_frame.open();
                return;
            }

            // Create the media frame.
            file_frame = wp.media.frames.file_frame = wp.media({
                title: jQuery(this).data('uploader_title'),
                button: {
                    text: jQuery(this).data('uploader_button_text'),
                },
                multiple: false // Set to true to allow multiple files to be selected
            });

            // When a file is selected, run a callback.
            file_frame.on('select', function() {
                // We set multiple to false so only get one image from the uploader
                attachment = file_frame.state().get('selection').first().toJSON();
                var url = attachment.url;

                var field = document.getElementById("logo_image");

                field.value = url; //set which variable you want the field to have
            });

            // Finally, open the modal
            file_frame.open();

        });
    </script>



    <div>

        <table>
            <tr valign="top">
                <td>
                    <input type="text" name="logo_image" id="logo_image" size="70" value="<?php echo $strFile; ?>" />
                    <input id="upload_image_button" type="button" value="Upload">
                    <br />
                    <br />
                    <img src="<?php echo $strFile; ?>" id="logo_img_pic" alt="" style="max-width:150px;height:auto;">
                </td>
            </tr>
        </table> <input type="hidden" name="img_txt_id" id="img_txt_id" value="" />
    </div>
<?php
    function admin_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }

    function admin_styles()
    {
        wp_enqueue_style('thickbox');
    }
    add_action('admin_print_scripts', 'admin_scripts');
    add_action('admin_print_styles', 'admin_styles');
}


function wpdocs_link_callback()
{
    global $post;
    wp_nonce_field(basename(__FILE__), 'link_fields');
    $link = get_post_meta($post->ID, 'link', true);
    // Output the field
    echo '<br />';
    echo '<input type="text" name="link" value="' . esc_textarea($link)  . '" class="widefat" placeholder="https://www.empresa.com.br">';
    echo '<br />';
}

function wpdocs_desconto_callback()
{
    global $post;
    wp_nonce_field(basename(__FILE__), 'link_fields');
    $desconto = get_post_meta($post->ID, 'desconto', true);
    // Output the field
    echo '<br />';
    echo '<input type="text" name="desconto" value="' . esc_textarea($desconto)  . '" class="widefat" placeholder="10%">';
    echo '<br />';
}


//parceiros taxonomies
function parceiros_categories()
{
    $labels = array(
        'name' => _x('Categoria parceiros', 'taxonomy general name'),
        'singular_name' => _x('Parceiros Categoria', 'taxonomy singular name'),
        'search_items' => __('Busca Categoria parceiros'),
        'all_items' => __('Todos Categoria parceiros'),
        'parent_item' => __('Parent Parceiros Categoria'),
        'parent_item_colon' => __('Parent Parceiros Categoria:'),
        'edit_item' => __('Editar Parceiros Categoria'),
        'update_item' => __('Atualizar Parceiros Categoria'),
        'add_new_item' => __('Adicionar novo Parceiros Categoria'),
        'new_item_name' => __('Novo Parceiros Categoria'),
        'menu_name' => __(' Categoria parceiros'),
    );

    //args array

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
    );

    register_taxonomy('hotel_category', 'parceiros', $args);
}

add_action('init', 'parceiros_categories', 0);

//FIM parceiros taxonomies

function parceiros_form()
{
    echo ' enctype="multipart/form-data"';
}
add_action('post_edit_form_tag', 'parceiros_form');

function wpdocs_link_save_meta_box($post_id)
{
    // Return if the user doesn't have edit permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if (isset($_POST['link'])) {
        $events_meta['link'] = esc_textarea($_POST['link']);
    }

    if (isset($_POST['desconto'])) {
        $events_meta['desconto'] = esc_textarea($_POST['desconto']);
    }

    $logo_meta['logo_image'] = $_POST['logo_image'];
    // Add values of $logo_meta as custom fields

    foreach ($logo_meta as $key => $value) {
        $value = implode(',', (array) $value);
        if (get_post_meta($post_id, $key, FALSE)) { // If the custom field already has a value it will update
            update_post_meta($post_id, $key, $value);
        } else { // If the custom field doesn't have a value it will add
            add_post_meta($post_id, $key, $value);
        }
        if (!$value) delete_post_meta($post_id, $key); // Delete if blank value
    }

    if (isset($events_meta)) {
        foreach ($events_meta as $key => $value) :
            // Don't store custom data twice
            if ('revision' === $post->post_type) {
                return;
            }
            if (get_post_meta($post_id, $key, false)) {
                // If the custom field already has a value, update it.
                update_post_meta($post_id, $key, $value);
            } else {
                // If the custom field doesn't have a value, add it.
                add_post_meta($post_id, $key, $value);
            }
            if (!$value) {
                // Delete the meta key if there's no value
                delete_post_meta($post_id, $key);
            }
        endforeach;
    }
}
add_action('save_post', 'wpdocs_link_save_meta_box');

/**
 * Remove a versão do WordPress dos parâmetros de URL
 *
 * @author Iniciativa #WordPressSeguro https://apiki.com/wordpress-seguro/
 * @param string $src A URL do arquivo JavaScript/CSS a ser carregado
 * @return string Retorna a URL do arquivo sem a versão do WordPress
 */
function _remove_wp_version_from_url_param($src)
{
    global $wp_version;

    $src = esc_url($src);

    if (!$src)
        return $src;

    $src_params = explode('?ver=', $src);

    if (!isset($src_params[1]))
        return $src;

    if ($src_params[1] !== $wp_version)
        return $src;

    return $src_params[0];
}

add_filter('script_loader_src', '_remove_wp_version_from_url_param');
add_filter('style_loader_src', '_remove_wp_version_from_url_param');

function parceiros($atts)
{
    ob_start();
    get_template_part('template-parts/parceiros');
    return ob_get_clean();
}
add_shortcode('parceiros', 'parceiros');

function parceiros_categorias($atts)
{
    ob_start();
    get_template_part('template-parts/parceiros_categorias');
    return ob_get_clean();
}
add_shortcode('parceiros_categorias', 'parceiros_categorias');

function load_more() {
 
    global $wp_query;
 
	wp_enqueue_script('jquery');
 
	wp_register_script( 'loadmore', get_stylesheet_directory_uri() . '/assets/js/myloadmore.js', array('jquery') );

	wp_localize_script( 'loadmore', 'loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
		'posts' => json_encode( $wp_query->query_vars ),
		'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
		'max_page' => $wp_query->max_num_pages
	) );
 
 	wp_enqueue_script( 'loadmore' );
}
 
add_action( 'wp_enqueue_scripts', 'load_more' );

function parceiros_taxonomy_add_custom_meta_field() {
        ?>
        <div class="form-field">
            <label for="term_meta[color_term_meta]"><?php _e( 'Adiconar cor', 'MJ' ); ?></label>
            <input type="text" name="term_meta[color_term_meta]" id="term_meta[color_term_meta]" value="">
            <p class="description"><?php _e( 'Cor hexadecimal, ex: #f2f2f2','MJ' ); ?></p>
        </div>
    <?php
    }
add_action( 'hotel_category_add_form_fields', 'parceiros_taxonomy_add_custom_meta_field', 10, 2 );

function parceiros_taxonomy_edit_custom_meta_field($term) {

        $t_id = $term->term_id;
        $term_meta = get_option( "taxonomy_$t_id" ); 
       ?>
        <tr class="form-field">
        <th scope="row" valign="top"><label for="term_meta[color_term_meta]"><?php _e( 'Adiconar cor', 'MJ' ); ?></label></th>
            <td>
                <input type="text" name="term_meta[color_term_meta]" id="term_meta[color_term_meta]" value="<?php echo esc_attr( $term_meta['color_term_meta'] ) ? esc_attr( $term_meta['color_term_meta'] ) : ''; ?>">
                <p class="description"><?php _e( 'Cor hexadecimal, ex: #f2f2f2','MJ' ); ?></p>
            </td>
        </tr>
    <?php
    }

add_action( 'hotel_category_edit_form_fields','parceiros_taxonomy_edit_custom_meta_field', 10, 2 );

function parceiros_save_taxonomy_custom_meta_field( $term_id ) {
        if ( isset( $_POST['term_meta'] ) ) {

            $t_id = $term_id;
            $term_meta = get_option( "taxonomy_$t_id" );
            $cat_keys = array_keys( $_POST['term_meta'] );
            foreach ( $cat_keys as $key ) {
                if ( isset ( $_POST['term_meta'][$key] ) ) {
                    $term_meta[$key] = $_POST['term_meta'][$key];
                }
            }
            // Save the option array.
            update_option( "taxonomy_$t_id", $term_meta );
        }

    }  
add_action( 'edited_hotel_category', 'parceiros_save_taxonomy_custom_meta_field', 10, 2 );  
add_action( 'create_hotel_category', 'parceiros_save_taxonomy_custom_meta_field', 10, 2 );