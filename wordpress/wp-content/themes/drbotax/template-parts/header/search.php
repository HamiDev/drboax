<?php
/**
 * Header product search form.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

$drbotax_search_query = get_search_query();
?>
<form class="site-header__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="drbotax-header-search"><?php esc_html_e( 'Search products', 'drbotax' ); ?></label>
	<input
		id="drbotax-header-search"
		type="search"
		name="s"
		value="<?php echo esc_attr( $drbotax_search_query ); ?>"
		placeholder="<?php esc_attr_e( 'Search products…', 'drbotax' ); ?>"
	>
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<input type="hidden" name="post_type" value="product">
	<?php endif; ?>
	<button type="submit" class="site-header__search-submit" aria-label="<?php esc_attr_e( 'Search', 'drbotax' ); ?>">
		<span class="icon-MagnifyingGlass" aria-hidden="true"></span>
	</button>
</form>
