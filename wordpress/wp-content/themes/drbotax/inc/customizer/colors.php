<?php
/**
 * Color Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the palette.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_colors( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_colors',
		array(
			'title'    => __( 'Colors', 'drbotax' ),
			'priority' => 30,
		)
	);

	drbotax_register_color( $wp_customize, 'color_ink', __( 'Ink', 'drbotax' ), 'drbotax_colors' );
	drbotax_register_color( $wp_customize, 'color_paper', __( 'Paper', 'drbotax' ), 'drbotax_colors' );
	drbotax_register_color( $wp_customize, 'color_accent', __( 'Accent', 'drbotax' ), 'drbotax_colors' );
	drbotax_register_color( $wp_customize, 'color_gold', __( 'Gold', 'drbotax' ), 'drbotax_colors' );
	drbotax_register_color( $wp_customize, 'color_line', __( 'Line', 'drbotax' ), 'drbotax_colors' );
	drbotax_register_color( $wp_customize, 'color_surface', __( 'Surface', 'drbotax' ), 'drbotax_colors' );
}
