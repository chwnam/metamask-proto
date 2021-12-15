<?php
/**
 * Plugin Name:       Metamask Prototype
 * Plugin URI:        https://github.com/chwnam/metamask
 * Description:       Metamask login prototype
 * Version:           0.1.0
 * Requires PHP:      7.4
 * Author:            changwoo
 * Author URI:        https://blog.changwoo.pe.kr/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

/* ABSPATH check */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'metamask_init' );

function metamask_init() {
	$path = plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

	if ( file_exists( $path ) ) {
		$asset = include $path;

		wp_register_script(
			'metamask',
			plugin_dir_url( __FILE__ ) . 'build/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);
	}
}

add_action( 'login_form', 'metamask_login_form' );

function metamask_login_form() {
	echo '<section id="metamask" style="margin-top: 0.25em; margin-bottom: 0.75em;"></section>';

	wp_enqueue_script( 'metamask' );
	wp_localize_script(
		'metamask',
		'metamaskObject',
		[
			'icon'             => plugins_url( 'metamask-logo.png', __FILE__ ),
			'textLogin'        => 'Login via Metamask',
			'textNotInstalled' => 'Metamask is not installed.',
		]
	);
}