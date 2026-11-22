<?php
/**
 * Customizer registration.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

require get_template_directory() . '/inc/customizer/colors.php';
require get_template_directory() . '/inc/customizer/typography.php';
require get_template_directory() . '/inc/customizer/buttons.php';
require get_template_directory() . '/inc/customizer/header.php';
require get_template_directory() . '/inc/customizer/footer.php';
require get_template_directory() . '/inc/customizer/layout.php';
require get_template_directory() . '/inc/customizer/spacing.php';
require get_template_directory() . '/inc/customizer/social.php';
require get_template_directory() . '/inc/customizer/homepage.php';
require get_template_directory() . '/inc/customizer/account.php';

add_action( 'customize_register', 'drbotax_customize_register' );

/**
 * Register every storefront setting.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function drbotax_customize_register( $wp_customize ) {
	drbotax_customize_colors( $wp_customize );
	drbotax_customize_typography( $wp_customize );
	drbotax_customize_buttons( $wp_customize );
	drbotax_customize_header( $wp_customize );
	drbotax_customize_footer( $wp_customize );
	drbotax_customize_layout( $wp_customize );
	drbotax_customize_spacing( $wp_customize );
	drbotax_customize_social( $wp_customize );
	drbotax_customize_homepage( $wp_customize );
	drbotax_customize_account( $wp_customize );
}

/**
 * Add one color setting and color control.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Theme-mod suffix.
 * @param string               $label        Control label.
 * @param string               $section      Section id.
 */
function drbotax_register_color( $wp_customize, $key, $label, $section ) {
	$defaults = drbotax_get_defaults();

	$wp_customize->add_setting(
		'drbotax_' . $key,
		array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'drbotax_sanitize_hex_color',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'drbotax_' . $key,
			array(
				'label'   => $label,
				'section' => $section,
			)
		)
	);
}

/**
 * Add a select whose values come from the choice map.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Theme-mod suffix.
 * @param string               $label        Control label.
 * @param string               $section      Section id.
 * @param array<string, string> $choices     Value to label map.
 */
function drbotax_register_select( $wp_customize, $key, $label, $section, $choices ) {
	$defaults = drbotax_get_defaults();

	$wp_customize->add_setting(
		'drbotax_' . $key,
		array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'drbotax_sanitize_select',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'drbotax_' . $key,
		array(
			'label'   => $label,
			'section' => $section,
			'type'    => 'select',
			'choices' => $choices,
		)
	);
}

/**
 * Add a text, textarea, or URL control stored as a content theme mod.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Theme-mod suffix.
 * @param string               $label        Control label.
 * @param string               $section      Section id.
 * @param string               $type         text, textarea, or url.
 * @param string               $description  Optional help text.
 */
function drbotax_register_text( $wp_customize, $key, $label, $section, $type = 'text', $description = '' ) {
	$content  = drbotax_get_content_defaults();
	$default  = isset( $content[ $key ] ) ? $content[ $key ] : '';
	$sanitize = 'sanitize_text_field';

	if ( 'textarea' === $type ) {
		$sanitize = 'sanitize_textarea_field';
	} elseif ( 'url' === $type ) {
		$sanitize = 'drbotax_sanitize_url';
	}

	$wp_customize->add_setting(
		'drbotax_' . $key,
		array(
			'default'           => $default,
			'sanitize_callback' => $sanitize,
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'drbotax_' . $key,
		array(
			'label'       => $label,
			'description' => $description,
			'section'     => $section,
			'type'        => $type,
		)
	);
}

/**
 * Add a font-family text control.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @param string               $key          Theme-mod suffix.
 * @param string               $label        Control label.
 * @param string               $section      Section id.
 */
function drbotax_register_font( $wp_customize, $key, $label, $section ) {
	$defaults = drbotax_get_defaults();

	$wp_customize->add_setting(
		'drbotax_' . $key,
		array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => 'drbotax_sanitize_font_family',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'drbotax_' . $key,
		array(
			'label'   => $label,
			'section' => $section,
			'type'    => 'text',
		)
	);
}
