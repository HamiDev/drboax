<?php
/**
 * Account / login Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register login copy and the side image.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_account( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_account',
		array(
			'title'    => __( 'Account', 'drbotax' ),
			'priority' => 115,
		)
	);

	drbotax_register_text(
		$wp_customize,
		'login_title',
		__( 'Login title', 'drbotax' ),
		'drbotax_account',
		'text',
		__( 'Leave empty to welcome the shopper by site name.', 'drbotax' )
	);
	drbotax_register_text( $wp_customize, 'login_text', __( 'Login text', 'drbotax' ), 'drbotax_account', 'textarea' );

	$wp_customize->add_setting(
		'drbotax_login_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'drbotax_login_image',
			array(
				'label'     => __( 'Login image', 'drbotax' ),
				'section'   => 'drbotax_account',
				'mime_type' => 'image',
			)
		)
	);
}
