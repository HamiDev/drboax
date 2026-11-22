<?php
/**
 * Footer Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the copyright line.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_footer( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_footer',
		array(
			'title'    => __( 'Footer', 'drbotax' ),
			'priority' => 70,
		)
	);

	drbotax_register_text(
		$wp_customize,
		'footer_copyright',
		__( 'Copyright', 'drbotax' ),
		'drbotax_footer',
		'text',
		__( 'Leave empty to use the year and site name.', 'drbotax' )
	);
}
