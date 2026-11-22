<?php
/**
 * My Account Dashboard
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Drbotax
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/account/dashboard', 'banner' );
get_template_part( 'template-parts/account/dashboard', 'intro' );
get_template_part( 'template-parts/account/dashboard', 'cards' );

/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );
