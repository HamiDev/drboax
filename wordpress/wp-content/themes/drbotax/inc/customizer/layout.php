<?php
/**
 * Layout Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register content width and the product grid.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_layout( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_layout',
		array(
			'title'    => __( 'Layout', 'drbotax' ),
			'priority' => 80,
		)
	);

	drbotax_register_select(
		$wp_customize,
		'content_width',
		__( 'Content width', 'drbotax' ),
		'drbotax_layout',
		array(
			'960px'  => __( 'Narrow', 'drbotax' ),
			'1120px' => __( 'Standard', 'drbotax' ),
			'1280px' => __( 'Wide', 'drbotax' ),
		)
	);

	drbotax_register_select(
		$wp_customize,
		'product_columns',
		__( 'Products per row', 'drbotax' ),
		'drbotax_layout',
		array(
			'2' => __( 'Two', 'drbotax' ),
			'3' => __( 'Three', 'drbotax' ),
			'4' => __( 'Four', 'drbotax' ),
		)
	);
}
