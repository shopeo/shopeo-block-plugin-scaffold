<?php
/**
 * Plugin Name: SHOPEO Block Plugin Scaffold
 * Plugin URI: https://wordpress.org/plugins/shopeo-block-plugin-scaffold
 * Description:
 * Author: SHOPEO
 * Version: 0.0.1
 * Author URI: https://shopeo.cn
 * License: GPL3+
 * Text Domain: shopeo-block-plugin-scaffold
 * Domain Path: /languages
 * Requires at least: 5.9
 * Requires PHP: 5.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once 'vendor/autoload.php';
}

if ( ! defined( 'SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE' ) ) {
	define( 'SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE', __FILE__ );
}

if ( ! function_exists( 'shopeo_block_plugin_scaffold_activation' ) ) {
	function shopeo_block_plugin_scaffold_activation() {

	}
}

register_activation_hook( SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE, 'shopeo_block_plugin_scaffold_activation' );

if ( ! function_exists( 'shopeo_block_plugin_scaffold_deactivation' ) ) {
	function shopeo_block_plugin_scaffold_deactivation() {

	}
}

register_deactivation_hook( SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE, 'shopeo_block_plugin_scaffold_deactivation' );

if ( ! function_exists( 'shopeo_block_plugin_scaffold_init' ) ) {
	function shopeo_block_plugin_scaffold_init() {

		//load text domain
		load_plugin_textdomain( 'shopeo-block-plugin-scaffold', false, dirname( plugin_basename( SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE ) ) . '/languages' );
	}
}

add_action( 'init', 'shopeo_block_plugin_scaffold_init' );

add_action( 'admin_enqueue_scripts', function () {
	$plugin_version = get_plugin_data( SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE )['Version'];
	//style

	//script
	wp_enqueue_script( 'shopeo-block-plugin-scaffold-admin-script', plugins_url( '/assets/js/admin.js', SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE ), array( 'jquery' ), $plugin_version );
	wp_localize_script( 'shopeo-block-plugin-scaffold-admin-script', 'shopeo_block_plugin_scaffold', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	$plugin_version = get_plugin_data( SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE )['Version'];
	//style
	wp_enqueue_style( 'shopeo-block-plugin-scaffold-style', plugins_url( '/assets/css/style.css', SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE ), array(), $plugin_version );
	wp_style_add_data( 'shopeo-block-plugin-scaffold-style', 'rtl', 'replace' );

	//script
	wp_enqueue_script( 'shopeo-block-plugin-scaffold-script', plugins_url( '/assets/js/app.js', SHOPEO_PLUGIN_SCAFFOLD_PLUGIN_FILE ), array( 'jquery' ), $plugin_version );
	wp_localize_script( 'shopeo-block-plugin-scaffold-script', 'shopeo_block_plugin_scaffold', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
} );

if ( ! function_exists( 'shopeo_block_plugin_scaffold_register_blocks' ) ) {
	function shopeo_block_plugin_scaffold_register_blocks() {
		$blocks = array(
			'dynamic' => 'shopeo_block_plugin_scaffold_dynamic_block_test',
			'static'  => ''
		);
		foreach ( $blocks as $dir => $render_callback ) {
			$args = array();
			if ( ! empty( $render_callback ) ) {
				$args['render_callback'] = $render_callback;
			}
			register_block_type( __DIR__ . '/blocks/dist/' . $dir, $args );
		}
	}
}

add_action( 'init', 'shopeo_block_plugin_scaffold_register_blocks' );

if ( ! function_exists( 'shopeo_block_plugin_scaffold_dynamic_block_test' ) ) {
	function shopeo_block_plugin_dynamic_block_test( $attributes ) {

	}
}
