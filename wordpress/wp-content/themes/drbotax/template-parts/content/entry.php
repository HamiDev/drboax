<?php
/**
 * A post inside the fallback loop.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry__header">
		<?php if ( is_singular() ) : ?>
			<?php the_title( '<h1 class="entry__title">', '</h1>' ); ?>
		<?php else : ?>
			<?php
			the_title(
				sprintf(
					'<h2 class="entry__title"><a href="%s">',
					esc_url( get_permalink() )
				),
				'</a></h2>'
			);
			?>
		<?php endif; ?>
	</header>
	<div class="entry__content">
		<?php
		if ( is_singular() ) {
			the_content();
		} else {
			the_excerpt();
		}
		?>
	</div>
</article>
