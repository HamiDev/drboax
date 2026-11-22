<?php
/**
 * Empty cart composition: illustration, copy, and shop CTA.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_title = trim( (string) drbotax_mod( 'empty_cart_title' ) );
$drbotax_text  = trim( (string) drbotax_mod( 'empty_cart_text' ) );
$drbotax_label = trim( (string) drbotax_mod( 'empty_cart_button_label' ) );
$drbotax_url   = drbotax_empty_cart_shop_url();
$drbotax_image = drbotax_empty_cart_image_url();
?>
<section
	class="empty-cart"
	<?php echo '' !== $drbotax_title ? 'aria-labelledby="empty-cart-title"' : 'aria-label="' . esc_attr__( 'Cart', 'drbotax' ) . '"'; ?>
>
	<figure class="empty-cart__visual">
		<img
			class="empty-cart__image"
			src="<?php echo esc_url( $drbotax_image ); ?>"
			alt=""
			width="1024"
			height="682"
			loading="eager"
			decoding="async"
		>
	</figure>

	<div class="empty-cart__copy">
		<?php if ( '' !== $drbotax_title ) : ?>
			<h1 id="empty-cart-title" class="empty-cart__title"><?php echo esc_html( $drbotax_title ); ?></h1>
		<?php endif; ?>

		<?php if ( '' !== $drbotax_text ) : ?>
			<p class="empty-cart__text"><?php echo nl2br( esc_html( $drbotax_text ), false ); ?></p>
		<?php endif; ?>

		<?php if ( '' !== $drbotax_label && '' !== $drbotax_url ) : ?>
			<p class="empty-cart__actions">
				<a class="button empty-cart__button" href="<?php echo esc_url( $drbotax_url ); ?>">
					<?php echo esc_html( $drbotax_label ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</section>
