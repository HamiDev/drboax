<?php
/**
 * Front-end styles.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'drbotax_enqueue_assets', 20 );
add_action( 'wp_head', 'drbotax_preload_fonts', 2 );

/**
 * Enqueue the compiled stylesheet after WooCommerce when it is present.
 */
function drbotax_enqueue_assets() {
	$path = get_template_directory() . '/assets/css/main.css';
	$deps = array();

	if ( wp_style_is( 'woocommerce-general', 'registered' ) ) {
		$deps[] = 'woocommerce-general';
	}

	wp_enqueue_style(
		'drbotax-main',
		get_template_directory_uri() . '/assets/css/main.css',
		$deps,
		file_exists( $path ) ? (string) filemtime( $path ) : '0.1.0'
	);
}

/**
 * Preload Vazirmatn Farsi Digits for body and bold text.
 */
function drbotax_preload_fonts() {
	$files = array(
		'/assets/fonts/vazirmatn/vazirmatn-fd-regular.woff2',
		'/assets/fonts/vazirmatn/vazirmatn-fd-bold.woff2',
	);

	foreach ( $files as $file ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_template_directory_uri() . $file )
		);
	}
}
