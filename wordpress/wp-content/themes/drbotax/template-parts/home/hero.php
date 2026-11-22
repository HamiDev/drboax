<?php
/**
 * Landing hero.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_eyebrow = trim( (string) drbotax_mod( 'hero_eyebrow' ) );
$drbotax_title   = trim( (string) drbotax_mod( 'hero_title' ) );
$drbotax_text    = trim( (string) drbotax_mod( 'hero_text' ) );
$drbotax_label   = trim( (string) drbotax_mod( 'hero_button_label' ) );
$drbotax_image_id = absint( get_theme_mod( 'drbotax_hero_image', 0 ) );
$drbotax_image    = $drbotax_image_id && wp_attachment_is_image( $drbotax_image_id );
?>
<section class="hero" <?php echo '' !== $drbotax_title ? 'aria-labelledby="hero-title"' : 'aria-label="' . esc_attr__( 'Introduction', 'drbotax' ) . '"'; ?>>
	<div class="wrap hero__layout">
		<div class="hero__content">
			<?php if ( '' !== $drbotax_eyebrow ) : ?>
				<p class="hero__eyebrow"><?php echo esc_html( $drbotax_eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( '' !== $drbotax_title ) : ?>
				<h1 id="hero-title" class="hero__title"><?php echo esc_html( $drbotax_title ); ?></h1>
			<?php endif; ?>

			<?php if ( '' !== $drbotax_text ) : ?>
				<p class="hero__text"><?php echo nl2br( esc_html( $drbotax_text ), false ); ?></p>
			<?php endif; ?>

			<?php if ( '' !== $drbotax_label ) : ?>
				<a class="button" href="<?php echo esc_url( drbotax_hero_button_url() ); ?>"><?php echo esc_html( $drbotax_label ); ?></a>
			<?php endif; ?>
		</div>

		<div class="hero__media"<?php echo $drbotax_image ? '' : ' aria-hidden="true"'; ?>>
			<?php
			if ( $drbotax_image ) {
				$drbotax_alt = (string) get_post_meta( $drbotax_image_id, '_wp_attachment_image_alt', true );
				if ( '' === $drbotax_alt ) {
					$drbotax_alt = $drbotax_title;
				}

				echo wp_get_attachment_image(
					$drbotax_image_id,
					'large',
					false,
					array(
						'class'         => 'hero__image',
						'alt'           => $drbotax_alt,
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'decoding'      => 'async',
					)
				);
			}
			?>
		</div>
	</div>
</section>
