<?php
/**
 * Small readers for landing-page templates.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default full logo URL when no Customizer logo is set.
 *
 * @return string
 */
function drbotax_default_logo_url() {
	return get_template_directory_uri() . '/assets/images/DrBotax-logo-full.png';
}

/**
 * Login page background image URL.
 *
 * @return string
 */
function drbotax_login_image_url() {
	$image_id = absint( get_theme_mod( 'drbotax_login_image', 0 ) );

	if ( $image_id && wp_attachment_is_image( $image_id ) ) {
		$url = wp_get_attachment_image_url( $image_id, 'full' );
		if ( is_string( $url ) && '' !== $url ) {
			return $url;
		}
	}

	return get_template_directory_uri() . '/assets/images/login-visual.jpg';
}

/**
 * Site name with a stable fallback for empty blog names.
 *
 * @return string
 */
function drbotax_site_name() {
	$name = get_bloginfo( 'name' );

	return '' !== $name ? $name : 'Drbotax';
}

/**
 * Login panel heading. Empty Customizer title welcomes by site name.
 *
 * @return string
 */
function drbotax_login_title() {
	$title = trim( (string) drbotax_mod( 'login_title' ) );

	if ( '' !== $title ) {
		return $title;
	}

	return sprintf(
		/* translators: %s: site name. */
		__( 'Welcome to %s', 'drbotax' ),
		drbotax_site_name()
	);
}

/**
 * Social sign-in providers for the login panel.
 *
 * Each item: label (string), icon (icon class without prefix), url (string).
 * Google and Telegram match the login layout; set a URL via the filter to enable them.
 *
 * @return array<int, array{label: string, icon: string, url: string}>
 */
function drbotax_login_social_providers() {
	$providers = apply_filters(
		'drbotax_login_social_providers',
		array(
			array(
				'label' => __( 'Google', 'drbotax' ),
				'icon'  => 'GoogleLogo',
				'url'   => '',
			),
			array(
				'label' => __( 'Telegram', 'drbotax' ),
				'icon'  => 'TelegramLogo',
				'url'   => '',
			),
		)
	);

	if ( ! is_array( $providers ) ) {
		return array();
	}

	$clean = array();

	foreach ( $providers as $provider ) {
		if ( ! is_array( $provider ) ) {
			continue;
		}

		$label = isset( $provider['label'] ) ? sanitize_text_field( (string) $provider['label'] ) : '';
		if ( '' === $label ) {
			continue;
		}

		$clean[] = array(
			'label' => $label,
			'icon'  => isset( $provider['icon'] ) ? sanitize_html_class( (string) $provider['icon'] ) : '',
			'url'   => isset( $provider['url'] ) ? esc_url_raw( (string) $provider['url'] ) : '',
		);
	}

	return $clean;
}

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
