<?php
/**
 * Typography Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register font families and the base size.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_typography( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_typography',
		array(
			'title'       => __( 'Typography', 'drbotax' ),
			'description' => __( 'Use the family name of an installed font. The theme includes Vazirmatn.', 'drbotax' ),
			'priority'    => 40,
		)
	);

	drbotax_register_font( $wp_customize, 'font_main', __( 'Font', 'drbotax' ), 'drbotax_typography' );
	drbotax_register_select(
		$wp_customize,
		'font_size_base',
		__( 'Base size', 'drbotax' ),
		'drbotax_typography',
		array(
			'1rem'      => '16px',
			'1.0625rem' => '17px',
			'1.125rem'  => '18px',
			'1.25rem'   => '20px',
		)
	);
}
