<?php
/**
 * Product category mega menu panel.
 *
 * Trigger: Primary menu item with CSS class `drbotax-mega`.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_tree = drbotax_get_product_category_tree();
?>
<div class="mega-menu" data-mega-menu>
	<?php if ( empty( $drbotax_tree ) ) : ?>
		<p class="mega-menu__empty"><?php esc_html_e( 'No product categories yet.', 'drbotax' ); ?></p>
	<?php else : ?>
		<div class="mega-menu__body">
			<ul class="mega-menu__parents" role="tablist" aria-label="<?php esc_attr_e( 'Product categories', 'drbotax' ); ?>">
				<?php foreach ( $drbotax_tree as $drbotax_index => $drbotax_node ) : ?>
					<?php
					$drbotax_term  = $drbotax_node['term'];
					$drbotax_id    = 'drbotax-mega-parent-' . (int) $drbotax_term->term_id;
					$drbotax_thumb = ! empty( $drbotax_node['thumbnail_id'] )
						? wp_get_attachment_image(
							(int) $drbotax_node['thumbnail_id'],
							'thumbnail',
							false,
							array(
								'class' => 'mega-menu__thumb',
								'alt'   => '',
							)
						)
						: '';
					?>
					<li
						class="mega-menu__parent<?php echo 0 === (int) $drbotax_index ? ' is-active' : ''; ?>"
						role="presentation"
						data-mega-parent="<?php echo esc_attr( (string) $drbotax_term->term_id ); ?>"
					>
						<button
							type="button"
							class="mega-menu__parent-btn"
							id="<?php echo esc_attr( $drbotax_id ); ?>"
							role="tab"
							aria-selected="<?php echo 0 === (int) $drbotax_index ? 'true' : 'false'; ?>"
							aria-controls="<?php echo esc_attr( $drbotax_id . '-panel' ); ?>"
							tabindex="<?php echo 0 === (int) $drbotax_index ? '0' : '-1'; ?>"
						>
							<span class="mega-menu__parent-icon" aria-hidden="true">
								<?php if ( is_string( $drbotax_thumb ) && '' !== $drbotax_thumb ) : ?>
									<?php echo $drbotax_thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_get_attachment_image(). ?>
								<?php else : ?>
									<span class="icon-SquaresFour"></span>
								<?php endif; ?>
							</span>
							<span class="mega-menu__parent-label"><?php echo esc_html( $drbotax_term->name ); ?></span>
						</button>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="mega-menu__panels">
				<?php foreach ( $drbotax_tree as $drbotax_index => $drbotax_node ) : ?>
					<?php
					$drbotax_term     = $drbotax_node['term'];
					$drbotax_id       = 'drbotax-mega-parent-' . (int) $drbotax_term->term_id;
					$drbotax_url      = get_term_link( $drbotax_term );
					$drbotax_children = $drbotax_node['children'];
					$drbotax_active   = 0 === (int) $drbotax_index;
					?>
					<div
						class="mega-menu__panel<?php echo $drbotax_active ? ' is-active' : ''; ?>"
						id="<?php echo esc_attr( $drbotax_id . '-panel' ); ?>"
						role="tabpanel"
						aria-labelledby="<?php echo esc_attr( $drbotax_id ); ?>"
						data-mega-panel="<?php echo esc_attr( (string) $drbotax_term->term_id ); ?>"
						<?php echo $drbotax_active ? '' : 'hidden'; ?>
					>
						<?php if ( ! is_wp_error( $drbotax_url ) ) : ?>
							<a class="mega-menu__see-all" href="<?php echo esc_url( $drbotax_url ); ?>">
								<?php
								printf(
									/* translators: %s: product category name. */
									esc_html__( 'See all %s products', 'drbotax' ),
									esc_html( $drbotax_term->name )
								);
								?>
								<span class="icon-ArrowLeft" aria-hidden="true"></span>
							</a>
						<?php endif; ?>

						<?php if ( empty( $drbotax_children ) ) : ?>
							<p class="mega-menu__empty"><?php esc_html_e( 'No subcategories in this category.', 'drbotax' ); ?></p>
						<?php else : ?>
							<div class="mega-menu__columns">
								<?php foreach ( $drbotax_children as $drbotax_child ) : ?>
									<?php
									$drbotax_child_term = $drbotax_child['term'];
									$drbotax_child_url  = get_term_link( $drbotax_child_term );
									$drbotax_grand      = $drbotax_child['children'];
									?>
									<div class="mega-menu__column">
										<?php if ( ! is_wp_error( $drbotax_child_url ) ) : ?>
											<a class="mega-menu__heading" href="<?php echo esc_url( $drbotax_child_url ); ?>">
												<?php echo esc_html( $drbotax_child_term->name ); ?>
											</a>
										<?php else : ?>
											<span class="mega-menu__heading"><?php echo esc_html( $drbotax_child_term->name ); ?></span>
										<?php endif; ?>

										<?php if ( ! empty( $drbotax_grand ) ) : ?>
											<ul class="mega-menu__links">
												<?php foreach ( $drbotax_grand as $drbotax_leaf ) : ?>
													<?php
													$drbotax_leaf_term = $drbotax_leaf['term'];
													$drbotax_leaf_url  = get_term_link( $drbotax_leaf_term );
													?>
													<?php if ( ! is_wp_error( $drbotax_leaf_url ) ) : ?>
														<li>
															<a href="<?php echo esc_url( $drbotax_leaf_url ); ?>">
																<?php echo esc_html( $drbotax_leaf_term->name ); ?>
															</a>
														</li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								<?php endforeach; ?>
							</div>

							<ul class="mega-menu__mobile-links">
								<?php foreach ( $drbotax_children as $drbotax_child ) : ?>
									<?php
									$drbotax_child_term = $drbotax_child['term'];
									$drbotax_child_url  = get_term_link( $drbotax_child_term );
									?>
									<?php if ( ! is_wp_error( $drbotax_child_url ) ) : ?>
										<li>
											<a href="<?php echo esc_url( $drbotax_child_url ); ?>">
												<span><?php echo esc_html( $drbotax_child_term->name ); ?></span>
												<span class="icon-ArrowLeft" aria-hidden="true"></span>
											</a>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
