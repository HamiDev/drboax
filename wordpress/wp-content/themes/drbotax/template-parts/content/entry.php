<?php
/**
 * A post inside the fallback loop.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;
?>
<?php
$drbotax_hide_title = function_exists( 'is_account_page' ) && is_account_page() && ! is_user_logged_in();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php if ( ! $drbotax_hide_title ) : ?>
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
	<?php endif; ?>
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
