<?php
/**
 * Featured products on the landing page.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_heading = trim( (string) drbotax_mod( 'featured_heading' ) );
?>
<section class="featured" aria-label="<?php esc_attr_e( 'Featured products', 'drbotax' ); ?>">
	<div class="wrap">
		<?php if ( '' !== $drbotax_heading ) : ?>
			<header class="featured__header">
				<h2 class="section__title"><?php echo esc_html( $drbotax_heading ); ?></h2>
			</header>
		<?php endif; ?>

		<?php if ( ! function_exists( 'wc_get_products' ) ) : ?>
			<p class="featured__empty"><?php esc_html_e( 'WooCommerce is not active.', 'drbotax' ); ?></p>
		<?php else : ?>
			<?php $drbotax_products = drbotax_get_featured_products(); ?>
			<?php if ( empty( $drbotax_products ) ) : ?>
				<p class="featured__empty"><?php esc_html_e( 'No products yet. Add a product in the shop to show it here.', 'drbotax' ); ?></p>
			<?php else : ?>
				<ul class="product-grid">
					<?php foreach ( $drbotax_products as $drbotax_product ) : ?>
						<li>
							<?php
							get_template_part(
								'template-parts/product/card',
								null,
								array(
									'product' => $drbotax_product,
								)
							);
							?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</section>
