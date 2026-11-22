<?php
/**
 * WooCommerce product category tree for the mega menu.
 *
 * @package Drbotax
 */

defined( 'ABSPATH' ) || exit;

/**
 * Transient key for the cached category tree.
 */
define( 'DRBOTAX_PRODUCT_CAT_TREE_TRANSIENT', 'drbotax_product_cat_tree' );

add_action( 'created_product_cat', 'drbotax_flush_product_category_tree' );
add_action( 'edited_product_cat', 'drbotax_flush_product_category_tree' );
add_action( 'delete_product_cat', 'drbotax_flush_product_category_tree' );
add_filter( 'walker_nav_menu_start_el', 'drbotax_nav_mega_menu_item', 10, 4 );

/**
 * Drop the cached product category tree.
 */
function drbotax_flush_product_category_tree() {
	delete_transient( DRBOTAX_PRODUCT_CAT_TREE_TRANSIENT );
}

/**
 * Nested product_cat tree for mega menu rendering.
 *
 * @return array<int, array{term: WP_Term, thumbnail_id: int, children: array<int, array{term: WP_Term, thumbnail_id: int, children: array<int, array{term: WP_Term, thumbnail_id: int, children: array<int, mixed>}>}>}>
 */
function drbotax_get_product_category_tree() {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return array();
	}

	$cached = get_transient( DRBOTAX_PRODUCT_CAT_TREE_TRANSIENT );

	if ( is_array( $cached ) ) {
		return $cached;
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	);

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		set_transient( DRBOTAX_PRODUCT_CAT_TREE_TRANSIENT, array(), HOUR_IN_SECONDS );
		return array();
	}

	$by_parent = array();

	foreach ( $terms as $term ) {
		if ( ! $term instanceof WP_Term ) {
			continue;
		}

		if ( 'uncategorized' === $term->slug ) {
			continue;
		}

		$parent = (int) $term->parent;

		if ( ! isset( $by_parent[ $parent ] ) ) {
			$by_parent[ $parent ] = array();
		}

		$by_parent[ $parent ][] = $term;
	}

	$tree = drbotax_build_product_category_branch( $by_parent, 0 );
	set_transient( DRBOTAX_PRODUCT_CAT_TREE_TRANSIENT, $tree, HOUR_IN_SECONDS );

	return $tree;
}

/**
 * Recursively assemble category nodes for one parent.
 *
 * @param array<int, WP_Term[]> $by_parent Terms grouped by parent ID.
 * @param int                   $parent_id Parent term ID.
 * @return array<int, array{term: WP_Term, thumbnail_id: int, children: array<int, mixed>}>
 */
function drbotax_build_product_category_branch( array $by_parent, $parent_id ) {
	$parent_id = absint( $parent_id );
	$branch    = array();

	if ( empty( $by_parent[ $parent_id ] ) ) {
		return $branch;
	}

	foreach ( $by_parent[ $parent_id ] as $term ) {
		$branch[] = array(
			'term'         => $term,
			'thumbnail_id' => absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) ),
			'children'     => drbotax_build_product_category_branch( $by_parent, (int) $term->term_id ),
		);
	}

	return $branch;
}

/**
 * Append mega menu markup to Primary items marked with the drbotax-mega class.
 *
 * @param string   $item_output Item HTML.
 * @param WP_Post  $item        Menu item.
 * @param int      $depth       Depth.
 * @param stdClass $args        Menu args.
 * @return string
 */
function drbotax_nav_mega_menu_item( $item_output, $item, $depth, $args ) {
	if ( 0 !== (int) $depth ) {
		return $item_output;
	}

	$location = isset( $args->theme_location ) ? (string) $args->theme_location : '';

	if ( 'primary' !== $location || ! $item instanceof WP_Post ) {
		return $item_output;
	}

	$classes = is_array( $item->classes ) ? $item->classes : array();

	if ( ! in_array( 'drbotax-mega', $classes, true ) ) {
		return $item_output;
	}

	ob_start();
	get_template_part( 'template-parts/header/mega-menu' );
	$mega = ob_get_clean();

	if ( ! is_string( $mega ) || '' === $mega ) {
		return $item_output;
	}

	return $item_output . $mega;
}
