<?php
namespace LOOS_Inc\CBP;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * ブロックパターンの登録
 */
add_action( 'init', __NAMESPACE__ . '\register_block_patterns', 20 );
function register_block_patterns() {

	register_block_pattern_category( 'loos-cbp', [
		'label' => 'CUSTOM BLOCK PATTERNS',
	] );

	$the_query = new \WP_Query( [
		'post_type'              => 'loos-cbp',
		'posts_per_page'         => -1,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	] );

	foreach ( $the_query->posts as $parts ) :
		$pid     = $parts->ID;
		$options = [
			'title'      => $parts->post_title,
			'content'    => $parts->post_content,
			'categories' => [ 'loos-cbp' ],
		];

		$viewport    = apply_filters( 'loos_cbp_viewport_width', 0, $pid );
		$block_types = apply_filters( 'loos_cbp_block_types', [], $pid );

		if ( $viewport ) $options['viewportWidth']            = $viewport;
		if ( ! empty( $block_types ) ) $options['blockTypes'] = $block_types;

		register_block_pattern( 'loos-cbp/pattern-' . $pid, $options );
	endforeach;
	wp_reset_postdata();
}
