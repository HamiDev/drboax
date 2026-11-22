<?php
/**
 * Button Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register button shape.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_buttons( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_buttons',
		array(
			'title'    => __( 'Buttons', 'drbotax' ),
			'priority' => 50,
		)
	);

	drbotax_register_select(
		$wp_customize,
		'button_radius',
		__( 'Corner radius', 'drbotax' ),
		'drbotax_buttons',
		array(
			'0px'   => __( 'Square', 'drbotax' ),
			'2px'   => __( 'Soft', 'drbotax' ),
			'4px'   => __( 'Rounded', 'drbotax' ),
			'999px' => __( 'Pill', 'drbotax' ),
		)
	);
}
