<?php
/**
 * Small readers for landing-page templates.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hero button destination. An empty Customizer URL points at the shop.
 *
 * @return string
 */
function drbotax_hero_button_url() {
	$url = (string) drbotax_mod( 'hero_button_url' );

	if ( '' !== $url ) {
		return $url;
	}

	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop = wc_get_page_permalink( 'shop' );
		if ( is_string( $shop ) && '' !== $shop ) {
			return $shop;
		}
	}

	return home_url( '/' );
}

/**
 * Footer copyright line.
 *
 * @return string
 */
function drbotax_copyright_text() {
	$custom = trim( (string) get_theme_mod( 'drbotax_footer_copyright', '' ) );

	if ( '' !== $custom ) {
		return $custom;
	}

	return sprintf(
		/* translators: 1: year, 2: site name. */
		__( '© %1$s %2$s', 'drbotax' ),
		wp_date( 'Y' ),
		get_bloginfo( 'name' )
	);
}

/**
 * Social profiles with empty URLs removed by the template.
 *
 * @return array<int, array{label: string, url: string}>
 */
function drbotax_social_links() {
	return array(
		array(
			'label' => __( 'Instagram', 'drbotax' ),
			'url'   => (string) get_theme_mod( 'drbotax_social_instagram', '' ),
		),
		array(
			'label' => __( 'Telegram', 'drbotax' ),
			'url'   => (string) get_theme_mod( 'drbotax_social_telegram', '' ),
		),
		array(
			'label' => __( 'WhatsApp', 'drbotax' ),
			'url'   => (string) get_theme_mod( 'drbotax_social_whatsapp', '' ),
		),
	);
}

/**
 * Featured products, then the latest published products.
 *
 * @return WC_Product[]
 */
function drbotax_get_featured_products() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return array();
	}

	$featured = wc_get_products(
		array(
			'status'   => 'publish',
			'limit'    => 4,
			'featured' => true,
			'orderby'  => 'menu_order',
			'order'    => 'ASC',
		)
	);

	if ( ! empty( $featured ) ) {
		return $featured;
	}

	return wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 4,
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);
}

/**
 * Number of items currently in the cart.
 *
 * @return int
 */
function drbotax_cart_count() {
	if ( ! function_exists( 'WC' ) ) {
		return 0;
	}

	$cart = WC()->cart;

	if ( ! $cart ) {
		return 0;
	}

	return absint( $cart->get_cart_contents_count() );
}

/**
 * Accessible name for the cart link.
 *
 * @return string
 */
function drbotax_cart_label() {
	$count = drbotax_cart_count();

	return sprintf(
		/* translators: %d: number of items in the cart. */
		_n( 'Cart, %d item', 'Cart, %d items', $count, 'drbotax' ),
		$count
	);
}

/**
 * Heading for the fallback archive, search, and posts views.
 */
function drbotax_archive_heading() {
	if ( is_search() ) {
		printf(
			/* translators: %s: search query. */
			esc_html__( 'Search: %s', 'drbotax' ),
			esc_html( get_search_query() )
		);
		return;
	}

	if ( is_archive() ) {
		echo wp_kses_post( get_the_archive_title() );
		return;
	}

	esc_html_e( 'Journal', 'drbotax' );
}
