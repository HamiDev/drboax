<?php
/**
 * Logo mark used on the account login card.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_name = drbotax_site_name();
?>
<div class="login-panel__brand">
	<?php if ( has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php else : ?>
		<img
			class="login-panel__logo"
			src="<?php echo esc_url( drbotax_default_logo_url() ); ?>"
			alt="<?php echo esc_attr( $drbotax_name ); ?>"
			width="200"
			height="67"
			decoding="async"
		>
	<?php endif; ?>
</div>
