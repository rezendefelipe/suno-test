<?php

function load_styles() {

	//Bootstrap
	wp_register_style('geral_bootstrap_style', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css', array(), '4.1.1', 'all');
	wp_enqueue_style('geral_bootstrap_style');

	/* FontAwesome */
  	wp_register_style('geral_fa_style', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0', 'all');
  	wp_enqueue_style('geral_fa_style');

  	/* Style */
  	wp_register_style('style_geral', get_template_directory_uri().'/assets/css/style.css', array(), '1.0.0', 'all' );
  	wp_enqueue_style('style_geral');
}

function load_scripts() {

	
	$script  = '<script>';
	$script .= 'var ajaxurl = "' . admin_url('admin-ajax.php') . '";';
	$script .= '</script>';
	echo $script;
	
	//Jquery
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', false, '1.12.4', true);
	wp_enqueue_script('jquery');

	// Scripts 
	wp_register_script('geral_geral', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0.0', 'all');
	wp_enqueue_script('geral_geral');

	//Bootstrap
	wp_register_script('geral_bootstrap_script', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array(), '4.1.1', 'all');
	wp_enqueue_script('geral_bootstrap_script');


	
}


add_action('wp_enqueue_scripts','load_styles');
add_action('wp_enqueue_scripts','load_scripts');