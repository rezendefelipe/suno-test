<?php
/**
 *
 * @package lifecommerce
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?> <?php wp_title(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" type="image/x-icon" href="https://www.sunoresearch.com.br/wp-content/uploads/2020/01/cropped-SUNO_Favicon_32px-1-32x32.jpg">
<!-- <script type="text/javascript" src="<?=get_template_directory_uri()?>/assets/js/jquery.min.js"></script> -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="red-line">
</div>
<div class="container-fluid wrap">
    <!-- BREADCRUMS -->
    <div class="container">
        <?php require('template-parts/breadcrumbs.php') ?>
    </div>
    <!-- END BREADCRUMS -->
</div>
