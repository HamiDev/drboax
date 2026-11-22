<?php
/**
 * Empty cart page
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Drbotax
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

/*
 * Notices stay. The default “cart is empty” info notice is removed in setup.
 */
do_action( 'woocommerce_cart_is_empty' );

get_template_part( 'template-parts/cart/empty' );
