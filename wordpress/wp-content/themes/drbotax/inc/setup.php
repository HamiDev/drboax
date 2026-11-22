<?php
/**
 * Theme supports and menu locations.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'drbotax_setup' );
add_filter( 'body_class', 'drbotax_body_class' );

/**
 * Register supports, menus, and the text domain.
 */
function drbotax_setup() {
	load_theme_textdomain( 'drbotax', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary', 'drbotax' ),
			'footer'  => __( 'Footer', 'drbotax' ),
		)
	);

	$GLOBALS['content_width'] = 1120;
}

/**
 * Mark the storefront so theme styles can win over plugin styles.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function drbotax_body_class( $classes ) {
	$classes[] = 'drbotax';

	if ( function_exists( 'is_account_page' ) && is_account_page() && ! is_user_logged_in() ) {
		$classes[] = 'drbotax-account-login';
	}

	return $classes;
}

/**
 * Shop link shown until a primary menu is assigned.
 */
function drbotax_primary_menu_fallback() {
	$shop_url = home_url( '/' );

	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop = wc_get_page_permalink( 'shop' );
		if ( is_string( $shop ) && '' !== $shop ) {
			$shop_url = $shop;
		}
	}

	echo '<ul id="primary-menu" class="primary-menu">';
	printf(
		'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
		esc_url( $shop_url ),
		esc_html__( 'Shop', 'drbotax' )
	);
	echo '</ul>';
}
