<?php
/**
 * Site header: announcement, brand, navigation, and account actions.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_announcement = trim( (string) drbotax_mod( 'header_announcement' ) );
$drbotax_name         = get_bloginfo( 'name' );

if ( '' === $drbotax_name ) {
	$drbotax_name = 'Drbotax';
}

$drbotax_account_url = wp_login_url();

if ( function_exists( 'wc_get_page_permalink' ) ) {
	$drbotax_account = wc_get_page_permalink( 'myaccount' );
	if ( is_string( $drbotax_account ) && '' !== $drbotax_account ) {
		$drbotax_account_url = $drbotax_account;
	}
}

$drbotax_cart_count = drbotax_cart_count();
?>
<header class="site-header">
	<?php if ( '' !== $drbotax_announcement ) : ?>
		<p class="site-header__announcement"><?php echo esc_html( $drbotax_announcement ); ?></p>
	<?php endif; ?>

	<div class="wrap site-header__bar">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $drbotax_name ); ?></a>
			<?php endif; ?>
		</div>

		<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'drbotax' ); ?>">
			<details>
				<summary class="primary-nav__toggle"><?php esc_html_e( 'Menu', 'drbotax' ); ?></summary>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-menu',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => 'drbotax_primary_menu_fallback',
						'depth'          => 2,
					)
				);
				?>
			</details>
		</nav>

		<div class="site-header__actions">
			<a class="site-header__account" href="<?php echo esc_url( $drbotax_account_url ); ?>"><?php esc_html_e( 'Account', 'drbotax' ); ?></a>
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a class="site-header__cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php echo esc_attr( drbotax_cart_label() ); ?>">
					<?php esc_html_e( 'Cart', 'drbotax' ); ?>
					<span class="site-header__count"><?php echo esc_html( (string) $drbotax_cart_count ); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</header>
