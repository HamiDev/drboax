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
	$path      = get_template_directory() . '/assets/css/main.css';
	$icons_path = get_template_directory() . '/assets/icons/style.css';
	$deps      = array();

	if ( wp_style_is( 'woocommerce-general', 'registered' ) ) {
		$deps[] = 'woocommerce-general';
	}

	wp_enqueue_style(
		'drbotax-icons',
		get_template_directory_uri() . '/assets/icons/style.css',
		array(),
		file_exists( $icons_path ) ? (string) filemtime( $icons_path ) : '0.1.0'
	);

	$deps[] = 'drbotax-icons';

	wp_enqueue_style(
		'drbotax-main',
		get_template_directory_uri() . '/assets/css/main.css',
		$deps,
		file_exists( $path ) ? (string) filemtime( $path ) : '0.1.0'
	);

	drbotax_enqueue_login_background();

	$header_script = get_template_directory() . '/assets/js/header.js';
	$mega_script   = get_template_directory() . '/assets/js/mega-menu.js';

	wp_enqueue_script(
		'drbotax-header',
		get_template_directory_uri() . '/assets/js/header.js',
		array(),
		file_exists( $header_script ) ? (string) filemtime( $header_script ) : '0.1.0',
		true
	);

	wp_enqueue_script(
		'drbotax-mega-menu',
		get_template_directory_uri() . '/assets/js/mega-menu.js',
		array(),
		file_exists( $mega_script ) ? (string) filemtime( $mega_script ) : '0.1.0',
		true
	);
}

/**
 * Full-page login background for the logged-out account view.
 */
function drbotax_enqueue_login_background() {
	if ( ! function_exists( 'is_account_page' ) || ! is_account_page() || is_user_logged_in() ) {
		return;
	}

	if ( ! wp_style_is( 'drbotax-main', 'enqueued' ) ) {
		return;
	}

	$url = esc_url_raw( drbotax_login_image_url() );
	if ( '' === $url ) {
		return;
	}

	wp_add_inline_style(
		'drbotax-main',
		'body.drbotax-account-login{--login-bg-image:url("' . esc_url( $url ) . '")}'
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
