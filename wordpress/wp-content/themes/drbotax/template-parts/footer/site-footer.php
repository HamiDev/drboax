<?php
/**
 * Site footer: name, menu, social links, and copyright.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_name = get_bloginfo( 'name' );

if ( '' === $drbotax_name ) {
	$drbotax_name = 'Drbotax';
}
?>
<footer class="site-footer">
	<div class="wrap site-footer__inner">
		<div class="site-footer__brand">
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $drbotax_name ); ?></a>
			<p class="site-footer__copyright"><?php echo esc_html( drbotax_copyright_text() ); ?></p>
		</div>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'drbotax' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu',
						'menu_id'        => 'footer-menu',
						'depth'          => 1,
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<?php
		$drbotax_social = drbotax_social_links();
		$drbotax_has_social = false;

		foreach ( $drbotax_social as $drbotax_link ) {
			if ( '' !== esc_url( $drbotax_link['url'] ) ) {
				$drbotax_has_social = true;
				break;
			}
		}
		?>
		<?php if ( $drbotax_has_social ) : ?>
			<nav class="social-links" aria-label="<?php esc_attr_e( 'Social links', 'drbotax' ); ?>">
				<ul class="social-links__list">
					<?php foreach ( $drbotax_social as $drbotax_link ) : ?>
						<?php $drbotax_url = esc_url( $drbotax_link['url'] ); ?>
						<?php if ( '' === $drbotax_url ) : ?>
							<?php continue; ?>
						<?php endif; ?>
						<li>
							<a href="<?php echo esc_url( $drbotax_url ); ?>" rel="noopener noreferrer" target="_blank"><?php echo esc_html( $drbotax_link['label'] ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</nav>
		<?php endif; ?>
	</div>
</footer>
