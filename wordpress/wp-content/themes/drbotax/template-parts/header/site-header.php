<?php
/**
 * Site header: announcement, brand, search, account actions, and navigation.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_announcement = trim( (string) drbotax_mod( 'header_announcement' ) );
$drbotax_name         = drbotax_site_name();
$drbotax_account_url  = wp_login_url();

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
				<a class="site-header__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img
						class="site-header__logo"
						src="<?php echo esc_url( drbotax_default_logo_url() ); ?>"
						alt="<?php echo esc_attr( $drbotax_name ); ?>"
						width="80"
						height="80"
						decoding="async"
					>
				</a>
			<?php endif; ?>
		</div>

		<?php get_template_part( 'template-parts/header/search' ); ?>

		<div class="site-header__actions">
			<a
				class="site-header__account"
				href="<?php echo esc_url( $drbotax_account_url ); ?>"
				aria-label="<?php esc_attr_e( 'Account', 'drbotax' ); ?>"
			>
				<span class="icon-User" aria-hidden="true"></span>
			</a>
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a
					class="site-header__cart"
					href="<?php echo esc_url( wc_get_cart_url() ); ?>"
					aria-label="<?php echo esc_attr( drbotax_cart_label() ); ?>"
				>
					<span class="icon-ShoppingCart" aria-hidden="true"></span>
					<?php if ( $drbotax_cart_count > 0 ) : ?>
						<span class="site-header__count"><?php echo esc_html( (string) $drbotax_cart_count ); ?></span>
					<?php endif; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>

	<nav class="wrap site-header__nav primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'drbotax' ); ?>">
		<input type="checkbox" id="drbotax-primary-nav" class="primary-nav__checkbox" autocomplete="off">
		<label class="primary-nav__toggle" for="drbotax-primary-nav"><?php esc_html_e( 'Menu', 'drbotax' ); ?></label>
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
	</nav>
</header>
