<?php
/**
 * Spacing Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the spacing unit that drives the scale.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_spacing( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_spacing',
		array(
			'title'    => __( 'Spacing', 'drbotax' ),
			'priority' => 90,
		)
	);

	drbotax_register_select(
		$wp_customize,
		'space_unit',
		__( 'Base unit', 'drbotax' ),
		'drbotax_spacing',
		array(
			'0.4rem' => __( 'Tight', 'drbotax' ),
			'0.5rem' => __( 'Even', 'drbotax' ),
			'0.6rem' => __( 'Open', 'drbotax' ),
		)
	);
}
