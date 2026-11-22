<?php
/**
 * Fallback template for views that do not have their own file yet.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main">
	<div class="wrap">
		<?php if ( ! is_singular() ) : ?>
			<header class="archive-header">
				<h1 class="section__title"><?php drbotax_archive_heading(); ?></h1>
			</header>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/entry' );
			endwhile;

			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => __( 'Previous', 'drbotax' ),
					'next_text' => __( 'Next', 'drbotax' ),
				)
			);
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
