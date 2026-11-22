<?php
/**
 * Header Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the announcement bar. The logo lives under Site Identity.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_header( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_header',
		array(
			'title'       => __( 'Header', 'drbotax' ),
			'description' => __( 'The logo is set under Site Identity.', 'drbotax' ),
			'priority'    => 60,
		)
	);

	drbotax_register_text(
		$wp_customize,
		'header_announcement',
		__( 'Announcement', 'drbotax' ),
		'drbotax_header',
		'text',
		__( 'Shown in a slim bar above the menu. Leave empty to hide it.', 'drbotax' )
	);
}
