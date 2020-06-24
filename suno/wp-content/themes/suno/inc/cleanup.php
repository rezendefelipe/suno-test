<?php

/*

@package xtudo

    ===================================
      REMOVE GENERATOR VERSION NUMBER
    ===================================

*/

/*Remove version string from css and js*/
function geral_remove_wp_version_strings( $src ){

  global $wp_version;

  parse_str( parse_url($src, PHP_URL_QUERY), $query  );
  if (!empty($query['ver']) && $query=['ver'] === $wp_version ) {
    $src = remove_query_arg( 'ver', $src );
  }

  return $src;

}
add_filter( 'script_loader_src', 'geral_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'geral_remove_wp_version_strings' );

/*Remove metatag generatr from header*/
function geral_remove_meta_version(){
  return '';
}
add_filter('the_generator', 'geral_remove_meta_version');


/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
  if ( 'dns-prefetch' == $relation_type ) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

    $urls = array_diff( $urls, array( $emoji_svg_url ) );
  }

  return $urls;
}
