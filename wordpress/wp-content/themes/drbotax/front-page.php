<?php
/**
 * Landing page.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main site-main--front">
	<?php get_template_part( 'template-parts/store/notices' ); ?>
	<?php get_template_part( 'template-parts/home/hero' ); ?>
	<?php get_template_part( 'template-parts/home/featured-products' ); ?>
</main>
<?php
get_footer();
