<?php
/**
 * Homepage Customizer settings.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register hero copy, the hero image, and the featured heading.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_homepage( $wp_customize ) {
	$wp_customize->add_section(
		'drbotax_homepage',
		array(
			'title'    => __( 'Homepage', 'drbotax' ),
			'priority' => 110,
		)
	);

	drbotax_register_text( $wp_customize, 'hero_eyebrow', __( 'Eyebrow', 'drbotax' ), 'drbotax_homepage' );
	drbotax_register_text( $wp_customize, 'hero_title', __( 'Title', 'drbotax' ), 'drbotax_homepage' );
	drbotax_register_text( $wp_customize, 'hero_text', __( 'Text', 'drbotax' ), 'drbotax_homepage', 'textarea' );
	drbotax_register_text( $wp_customize, 'hero_button_label', __( 'Button label', 'drbotax' ), 'drbotax_homepage' );
	drbotax_register_text(
		$wp_customize,
		'hero_button_url',
		__( 'Button link', 'drbotax' ),
		'drbotax_homepage',
		'url',
		__( 'Leave empty to link to the shop.', 'drbotax' )
	);

	$wp_customize->add_setting(
		'drbotax_hero_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'drbotax_hero_image',
			array(
				'label'     => __( 'Hero image', 'drbotax' ),
				'section'   => 'drbotax_homepage',
				'mime_type' => 'image',
			)
		)
	);

	drbotax_register_text( $wp_customize, 'featured_heading', __( 'Featured heading', 'drbotax' ), 'drbotax_homepage' );
}
