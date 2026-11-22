<?php
/**
 * One product in a grid.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_args    = isset( $args ) && is_array( $args ) ? $args : array();
$drbotax_product = isset( $drbotax_args['product'] ) ? $drbotax_args['product'] : null;

if ( ! class_exists( 'WC_Product' ) || ! $drbotax_product instanceof WC_Product ) {
	return;
}

$drbotax_permalink = $drbotax_product->get_permalink();
$drbotax_name      = $drbotax_product->get_name();
$drbotax_simple    = $drbotax_product->is_type( 'simple' ) && $drbotax_product->is_purchasable() && $drbotax_product->is_in_stock();

if ( $drbotax_simple ) {
	$drbotax_action_url   = $drbotax_product->add_to_cart_url();
	$drbotax_action_label = $drbotax_product->add_to_cart_text();
} else {
	$drbotax_action_url   = $drbotax_permalink;
	$drbotax_action_label = __( 'View product', 'drbotax' );
}

$drbotax_availability = $drbotax_product->get_availability();
$drbotax_stock_label  = isset( $drbotax_availability['availability'] ) ? (string) $drbotax_availability['availability'] : '';
$drbotax_stock_state  = 'in-stock';

if ( ! $drbotax_product->is_in_stock() ) {
	$drbotax_stock_state = 'out-of-stock';
} elseif ( $drbotax_product->is_on_backorder() ) {
	$drbotax_stock_state = 'available-on-backorder';
}

if ( '' === $drbotax_stock_label ) {
	if ( 'out-of-stock' === $drbotax_stock_state ) {
		$drbotax_stock_label = __( 'Out of stock', 'drbotax' );
	} elseif ( 'available-on-backorder' === $drbotax_stock_state ) {
		$drbotax_stock_label = __( 'Available on backorder', 'drbotax' );
	} else {
		$drbotax_stock_label = __( 'In stock', 'drbotax' );
	}
}

$drbotax_price = $drbotax_product->get_price_html();
?>
<article <?php wc_product_class( 'product-card', $drbotax_product ); ?>>
	<a class="product-card__media" href="<?php echo esc_url( $drbotax_permalink ); ?>">
		<?php echo wp_kses_post( $drbotax_product->get_image( 'large' ) ); ?>
	</a>
	<div class="product-card__body">
		<h3 class="product-card__title">
			<a href="<?php echo esc_url( $drbotax_permalink ); ?>"><?php echo esc_html( $drbotax_name ); ?></a>
		</h3>
		<?php if ( $drbotax_price ) : ?>
			<p class="product-card__price"><?php echo wp_kses_post( $drbotax_price ); ?></p>
		<?php endif; ?>
		<p class="product-card__stock product-card__stock--<?php echo esc_attr( sanitize_html_class( $drbotax_stock_state ) ); ?>">
			<?php echo esc_html( $drbotax_stock_label ); ?>
		</p>
		<a class="button button--quiet" href="<?php echo esc_url( $drbotax_action_url ); ?>"><?php echo esc_html( $drbotax_action_label ); ?></a>
	</div>
</article>
