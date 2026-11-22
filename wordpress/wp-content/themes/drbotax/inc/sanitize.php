<?php
/**
 * Sanitizers for Customizer values.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Keep a hex color, or the setting default.
 *
 * @param mixed                     $value   Raw value.
 * @param WP_Customize_Setting|null $setting Customizer setting.
 * @return string
 */
function drbotax_sanitize_hex_color( $value, $setting = null ) {
	$color = sanitize_hex_color( (string) $value );

	if ( is_string( $color ) ) {
		return $color;
	}

	if ( $setting instanceof WP_Customize_Setting ) {
		return (string) $setting->default;
	}

	return '#241816';
}

/**
 * Keep a font family name made of letters, numbers, spaces, and hyphens.
 *
 * @param mixed                     $value   Raw value.
 * @param WP_Customize_Setting|null $setting Customizer setting.
 * @return string
 */
function drbotax_sanitize_font_family( $value, $setting = null ) {
	$clean = sanitize_text_field( (string) $value );
	$clean = preg_replace( '/[^A-Za-z0-9 \-]/', '', $clean );
	$clean = trim( (string) $clean );

	if ( '' !== $clean ) {
		return $clean;
	}

	if ( $setting instanceof WP_Customize_Setting ) {
		return (string) $setting->default;
	}

	return '';
}

/**
 * Keep a value that belongs to the choice map for this setting.
 *
 * @param mixed                $value   Raw value.
 * @param WP_Customize_Setting $setting Customizer setting.
 * @return string
 */
function drbotax_sanitize_select( $value, $setting ) {
	$key     = str_replace( 'drbotax_', '', $setting->id );
	$map     = drbotax_choice_map();
	$choices = isset( $map[ $key ] ) ? $map[ $key ] : array();
	$value   = (string) $value;

	if ( in_array( $value, $choices, true ) ) {
		return $value;
	}

	return (string) $setting->default;
}

/**
 * Keep a safe URL. An empty value stays empty.
 *
 * @param mixed $value Raw value.
 * @return string
 */
function drbotax_sanitize_url( $value ) {
	return esc_url_raw( (string) $value );
}

/**
 * Sanitized color for inline CSS.
 *
 * @param string $key Theme-mod suffix.
 * @return string
 */
function drbotax_color_value( $key ) {
	$defaults = drbotax_get_defaults();
	$fallback = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '#241816';
	$color    = sanitize_hex_color( (string) get_theme_mod( 'drbotax_' . $key, $fallback ) );

	return is_string( $color ) ? $color : $fallback;
}

/**
 * Sanitized select value for inline CSS.
 *
 * @param string $key Theme-mod suffix.
 * @return string
 */
function drbotax_choice_value( $key ) {
	$defaults = drbotax_get_defaults();
	$map      = drbotax_choice_map();
	$fallback = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	$value    = (string) get_theme_mod( 'drbotax_' . $key, $fallback );
	$choices  = isset( $map[ $key ] ) ? $map[ $key ] : array();

	if ( in_array( $value, $choices, true ) ) {
		return $value;
	}

	return $fallback;
}

/**
 * Sanitized font name for inline CSS.
 *
 * @param string $key Theme-mod suffix.
 * @return string
 */
function drbotax_font_value( $key ) {
	$defaults = drbotax_get_defaults();
	$fallback = isset( $defaults[ $key ] ) ? $defaults[ $key ] : 'Vazirmatn';
	$value    = drbotax_sanitize_font_family( get_theme_mod( 'drbotax_' . $key, $fallback ) );

	return '' !== $value ? $value : $fallback;
}

/**
 * Quote a font name and append a generic fallback stack.
 *
 * @param string $name Family name.
 * @return string
 */
function drbotax_css_font_stack( $name ) {
	$name = str_replace( array( '\\', '"' ), '', $name );

	return '"' . $name . '", "Tahoma", sans-serif';
}
