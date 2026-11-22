<?php
/**
 * Runtime design tokens from the Customizer.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'drbotax_enqueue_inline_css', 30 );

/**
 * Attach custom properties to the compiled stylesheet.
 */
function drbotax_enqueue_inline_css() {
	if ( ! wp_style_is( 'drbotax-main', 'enqueued' ) ) {
		return;
	}

	wp_add_inline_style( 'drbotax-main', drbotax_css_variables() );
}

/**
 * Build the :root block that overrides the SCSS defaults.
 *
 * @return string
 */
function drbotax_css_variables() {
	$variables = array(
		'--color-ink'       => drbotax_color_value( 'color_ink' ),
		'--color-paper'     => drbotax_color_value( 'color_paper' ),
		'--color-accent'    => drbotax_color_value( 'color_accent' ),
		'--color-gold'      => drbotax_color_value( 'color_gold' ),
		'--color-line'      => drbotax_color_value( 'color_line' ),
		'--color-surface'  => drbotax_color_value( 'color_surface' ),
		'--font-main'       => drbotax_css_font_stack( drbotax_font_value( 'font_main' ) ),
		'--font-size-base'  => drbotax_choice_value( 'font_size_base' ),
		'--button-radius'   => drbotax_choice_value( 'button_radius' ),
		'--content-width'   => drbotax_choice_value( 'content_width' ),
		'--product-columns' => drbotax_choice_value( 'product_columns' ),
		'--space-unit'      => drbotax_choice_value( 'space_unit' ),
	);

	$rules = array();

	foreach ( $variables as $name => $value ) {
		$rules[] = $name . ':' . $value;
	}

	return ':root{' . implode( ';', $rules ) . ';}';
}
