<?php
/**
 * Account dashboard quick-link cards.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_links = drbotax_account_dashboard_links();

if ( empty( $drbotax_links ) ) {
	return;
}
?>
<nav class="account-cards" aria-label="<?php esc_attr_e( 'Account shortcuts', 'drbotax' ); ?>">
	<?php foreach ( $drbotax_links as $drbotax_link ) : ?>
		<a class="account-card" href="<?php echo esc_url( $drbotax_link['url'] ); ?>">
			<span class="account-card__icon" aria-hidden="true">
				<span class="icon-<?php echo esc_attr( $drbotax_link['icon'] ); ?>"></span>
			</span>
			<span class="account-card__body">
				<span class="account-card__title"><?php echo esc_html( $drbotax_link['title'] ); ?></span>
				<span class="account-card__text"><?php echo esc_html( $drbotax_link['text'] ); ?></span>
			</span>
			<span class="account-card__arrow icon-ArrowLeft" aria-hidden="true"></span>
		</a>
	<?php endforeach; ?>
</nav>
