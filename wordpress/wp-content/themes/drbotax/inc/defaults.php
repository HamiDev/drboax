<?php
/**
 * Shared defaults for theme mods and CSS tokens.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Visual defaults. Keys are theme-mod suffixes.
 *
 * @return array<string, string>
 */
function drbotax_get_defaults() {
	return array(
		'color_ink'       => '#241816',
		'color_paper'     => '#faf6f3',
		'color_accent'    => '#8c3d4e',
		'color_gold'      => '#a68456',
		'color_line'      => '#eadfd6',
		'color_surface'  => '#ffffff',
		'font_main'       => 'Vazirmatn',
		'font_size_base'  => '1.125rem',
		'button_radius'   => '2px',
		'content_width'   => '1120px',
		'product_columns' => '4',
		'space_unit'      => '0.5rem',
	);
}

/**
 * Allowed values for select controls, keyed by theme-mod suffix.
 *
 * @return array<string, string[]>
 */
function drbotax_choice_map() {
	return array(
		'font_size_base'  => array( '1rem', '1.0625rem', '1.125rem', '1.25rem' ),
		'button_radius'   => array( '0px', '2px', '4px', '999px' ),
		'content_width'   => array( '960px', '1120px', '1280px' ),
		'product_columns' => array( '2', '3', '4' ),
		'space_unit'      => array( '0.4rem', '0.5rem', '0.6rem' ),
	);
}

/**
 * Translated content defaults. Call this after the text domain can load.
 *
 * @return array<string, string>
 */
function drbotax_get_content_defaults() {
	return array(
		'hero_eyebrow'        => __( 'Beauty', 'drbotax' ),
		'hero_title'          => __( 'Care, in a quieter light', 'drbotax' ),
		'hero_text'           => __( 'A short edit of complexion, color, and care. Shade, size, and price stay easy to see.', 'drbotax' ),
		'hero_button_label'   => __( 'Shop the edit', 'drbotax' ),
		'hero_button_url'     => '',
		'featured_heading'    => __( 'Selected for you', 'drbotax' ),
		'login_title'         => '',
		'login_text'          => __( 'Sign in to continue to your account.', 'drbotax' ),
		'header_announcement' => '',
		'footer_copyright'    => '',
		'social_instagram'    => '',
		'social_telegram'     => '',
		'social_whatsapp'     => '',
	);
}

/**
 * Read a theme mod with the matching default.
 *
 * @param string $key Theme-mod suffix.
 * @return string
 */
function drbotax_mod( $key ) {
	$visual = drbotax_get_defaults();

	if ( isset( $visual[ $key ] ) ) {
		return (string) get_theme_mod( 'drbotax_' . $key, $visual[ $key ] );
	}

	$content = drbotax_get_content_defaults();
	$default = isset( $content[ $key ] ) ? $content[ $key ] : '';

	return (string) get_theme_mod( 'drbotax_' . $key, $default );
}
