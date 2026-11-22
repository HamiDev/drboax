<?php
/**
 * Empty cart Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register empty-cart copy and illustration.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_cart( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_cart',
		array(
			'title'    => __( 'Cart', 'drbotax' ),
			'priority' => 118,
		)
	);

	drbotax_register_text( $wp_customize, 'empty_cart_title', __( 'Empty cart title', 'drbotax' ), 'drbotax_cart' );
	drbotax_register_text( $wp_customize, 'empty_cart_text', __( 'Empty cart text', 'drbotax' ), 'drbotax_cart', 'textarea' );
	drbotax_register_text( $wp_customize, 'empty_cart_button_label', __( 'Empty cart button', 'drbotax' ), 'drbotax_cart' );

	$wp_customize->add_setting(
		'drbotax_empty_cart_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'drbotax_empty_cart_image',
			array(
				'label'     => __( 'Empty cart image', 'drbotax' ),
				'section'   => 'drbotax_cart',
				'mime_type' => 'image',
			)
		)
	);
}
