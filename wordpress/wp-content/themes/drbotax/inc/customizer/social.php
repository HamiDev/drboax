<?php
/**
 * Social link Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register profile URLs. Empty values are not shown.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_social( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_social',
		array(
			'title'    => __( 'Social links', 'drbotax' ),
			'priority' => 100,
		)
	);

	drbotax_register_text( $wp_customize, 'social_instagram', __( 'Instagram', 'drbotax' ), 'drbotax_social', 'url' );
	drbotax_register_text( $wp_customize, 'social_telegram', __( 'Telegram', 'drbotax' ), 'drbotax_social', 'url' );
	drbotax_register_text( $wp_customize, 'social_whatsapp', __( 'WhatsApp', 'drbotax' ), 'drbotax_social', 'url' );
}
