<?php
namespace LOOS_Inc\CBP;

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', '\LOOS_Inc\CBP\register_block_patterns', 20 );


/**
 * ブロックパターンの登録
 */
function register_block_patterns() {

	if ( ! is_admin() ) return;

	// カテゴリーの登録
	register_block_pattern_category(
		'loos-cbp',
		[
			'label' => 'CUSTOM BLOCK PATTERNS',
		]
	);

	// New sub query
	$the_query = new \WP_Query( [
		'post_type'      => 'loos-cbp',
		'no_found_rows'  => true,
		'posts_per_page' => -1,
	] );

	// Sub loop
	while ( $the_query->have_posts() ) :
		$the_query->the_post();
		$parts = get_post();

		register_block_pattern(
			'loos-cbp/pattern-' . esc_attr( get_the_ID() ),
			[
				'title'       => esc_html( get_the_title() ),
				'content'     => $parts->post_content,
				'categories'  => ['loos-cbp' ],
			]
		);
	endwhile;
	wp_reset_postdata();
}
