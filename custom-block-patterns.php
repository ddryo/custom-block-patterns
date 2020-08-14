<?php
/**
 * Plugin Name: Custom Block Patterns
 * Plugin URI: https://github.com/ddryo/Custom-Block-Patterns
 * Description: You can easily create your own block patterns and register them.
 * Version: 1.0.0
 * Author: LOOS, Inc.
 * Author URI: https://loos-web-studio.com/
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: loos-cbp
 */

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! function_exists( 'register_block_pattern' ) ) return;

/**
 * プラグインディレクトリまでのパス
 */
define( 'LOOS_CBP_PATH', plugin_dir_path( __FILE__ ) );
// define( 'LOOS_CBP_URL', plugins_url( '/', __FILE__ ) );


/**
 * plugin処理
 */
add_action( 'plugins_loaded', function() {
	// 翻訳ファイルの読み込み
	$locale = apply_filters( 'plugin_locale', determine_locale(), 'loos-cbp' );
	load_textdomain( 'loos-cbp', LOOS_CBP_PATH . 'languages/loos-cbp-' . $locale . '.mo' );

	// add_action( 'enqueue_block_editor_assets', function() {} );
	require LOOS_CBP_PATH . 'inc/gutenberg.php';
	require LOOS_CBP_PATH . 'inc/post_type.php';

} );