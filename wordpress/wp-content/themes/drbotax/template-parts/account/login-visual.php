<?php
/**
 * Full-bleed login background image.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_image_id  = absint( get_theme_mod( 'drbotax_login_image', 0 ) );
$drbotax_has_image = $drbotax_image_id && wp_attachment_is_image( $drbotax_image_id );
$drbotax_fallback  = get_template_directory_uri() . '/assets/images/login-visual.jpg';
?>
<div class="login-shell__visual" aria-hidden="true">
	<?php
	if ( $drbotax_has_image ) {
		echo wp_get_attachment_image(
			$drbotax_image_id,
			'full',
			false,
			array(
				'class'         => 'login-shell__image',
				'alt'           => '',
				'loading'       => 'eager',
				'fetchpriority' => 'high',
				'decoding'      => 'async',
			)
		);
	} else {
		printf(
			'<img class="login-shell__image" src="%1$s" alt="" width="1024" height="682" loading="eager" fetchpriority="high" decoding="async">',
			esc_url( $drbotax_fallback )
		);
	}
	?>
</div>
