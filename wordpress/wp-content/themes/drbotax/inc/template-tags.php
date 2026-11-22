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
 * Whether the current view is the logged-out account login screen.
 *
 * @return bool
 */
function drbotax_is_account_login() {
	return function_exists( 'is_account_page' ) && is_account_page() && ! is_user_logged_in();
}

/**
 * Whether the current view is the logged-in My Account area.
 *
 * @return bool
 */
function drbotax_is_account() {
	return function_exists( 'is_account_page' ) && is_account_page() && is_user_logged_in();
}

/**
 * Whether a My Account nav item is the current page.
 *
 * WooCommerce misses the dashboard item when the account page is reached
 * via a plain `pagename` query (no pretty permalinks).
 *
 * @param string $endpoint Account endpoint key.
 * @return bool
 */
function drbotax_is_current_account_menu_item( $endpoint ) {
	$endpoint = sanitize_key( (string) $endpoint );

	if ( function_exists( 'wc_is_current_account_menu_item' ) && wc_is_current_account_menu_item( $endpoint ) ) {
		return true;
	}

	if ( 'dashboard' !== $endpoint || ! function_exists( 'is_account_page' ) || ! is_account_page() ) {
		return false;
	}

	global $wp;

	$menu_items = function_exists( 'wc_get_account_menu_items' ) ? wc_get_account_menu_items() : array();
	unset( $menu_items['dashboard'] );

	foreach ( array_keys( $menu_items ) as $item ) {
		if ( isset( $wp->query_vars[ $item ] ) ) {
			return false;
		}
	}

	return true;
}

/**
 * Icon class stem for a My Account menu endpoint.
 *
 * @param string $endpoint Account endpoint key.
 * @return string Phosphor icon name without the icon- prefix.
 */
function drbotax_account_menu_icon( $endpoint ) {
	$icons = array(
		'dashboard'         => 'SquaresFour',
		'orders'            => 'Package',
		'downloads'         => 'Download',
		'edit-address'      => 'MapPin',
		'payment-methods'   => 'CreditCard',
		'edit-account'      => 'User',
		'customer-logout'   => 'SignOut',
	);

	$endpoint = sanitize_key( (string) $endpoint );

	return isset( $icons[ $endpoint ] ) ? $icons[ $endpoint ] : 'SquaresFour';
}

/**
 * Quick links shown on the account dashboard.
 *
 * @return array<int, array{endpoint: string, icon: string, title: string, text: string, url: string}>
 */
function drbotax_account_dashboard_links() {
	if ( ! function_exists( 'wc_get_account_menu_items' ) ) {
		return array();
	}

	$menu     = wc_get_account_menu_items();
	$shipping = function_exists( 'wc_shipping_enabled' ) && wc_shipping_enabled();

	$cards = array(
		array(
			'endpoint' => 'orders',
			'icon'     => 'Package',
			'title'    => isset( $menu['orders'] ) ? $menu['orders'] : __( 'Orders', 'drbotax' ),
			'text'     => __( 'View and track recent orders', 'drbotax' ),
			'url'      => wc_get_account_endpoint_url( 'orders' ),
		),
		array(
			'endpoint' => 'edit-address',
			'icon'     => 'MapPin',
			'title'    => isset( $menu['edit-address'] ) ? $menu['edit-address'] : __( 'Addresses', 'drbotax' ),
			'text'     => $shipping
				? __( 'Manage shipping and billing addresses', 'drbotax' )
				: __( 'Manage your billing address', 'drbotax' ),
			'url'      => wc_get_account_endpoint_url( 'edit-address' ),
		),
		array(
			'endpoint' => 'edit-account',
			'icon'     => 'User',
			'title'    => isset( $menu['edit-account'] ) ? $menu['edit-account'] : __( 'Account details', 'drbotax' ),
			'text'     => __( 'Update profile and password', 'drbotax' ),
			'url'      => wc_get_account_endpoint_url( 'edit-account' ),
		),
	);

	return $cards;
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
 * Whether the cart page is showing with no items.
 *
 * @return bool
 */
function drbotax_is_cart_empty() {
	if ( ! function_exists( 'is_cart' ) || ! is_cart() ) {
		return false;
	}

	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return true;
	}

	return WC()->cart->is_empty();
}

/**
 * Empty cart illustration URL.
 *
 * @return string
 */
function drbotax_empty_cart_image_url() {
	$image_id = absint( get_theme_mod( 'drbotax_empty_cart_image', 0 ) );

	if ( $image_id && wp_attachment_is_image( $image_id ) ) {
		$url = wp_get_attachment_image_url( $image_id, 'full' );
		if ( is_string( $url ) && '' !== $url ) {
			return $url;
		}
	}

	return get_template_directory_uri() . '/assets/images/empty-cart.png';
}

/**
 * Shop destination for the empty cart CTA.
 *
 * @return string
 */
function drbotax_empty_cart_shop_url() {
	$url = '';

	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop = wc_get_page_permalink( 'shop' );
		if ( is_string( $shop ) && '' !== $shop ) {
			$url = $shop;
		}
	}

	/**
	 * Filter "Return To Shop" redirect URL.
	 *
	 * @since 4.6.0
	 * @param string $default_url Default URL.
	 */
	return (string) apply_filters( 'woocommerce_return_to_shop_redirect', $url ? $url : home_url( '/' ) );
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
