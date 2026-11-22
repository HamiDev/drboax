<?php
/**
 * My Account navigation
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Drbotax
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation account-nav" aria-label="<?php esc_attr_e( 'Account pages', 'drbotax' ); ?>">
	<ul class="account-nav__list">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			$drbotax_icon    = drbotax_account_menu_icon( $endpoint );
			$drbotax_current = drbotax_is_current_account_menu_item( $endpoint );
			?>
			<li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a
					class="account-nav__link"
					href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
					<?php echo $drbotax_current ? 'aria-current="page"' : ''; ?>
				>
					<span class="account-nav__icon icon-<?php echo esc_attr( $drbotax_icon ); ?>" aria-hidden="true"></span>
					<span class="account-nav__label"><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
