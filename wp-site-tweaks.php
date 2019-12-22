<?php
/**
 * Plugin Name:       WP Site Tweaks
 * Plugin URI:        https://github.com/afragen/wp-site-tweaks
 * Description:       Theme tweaks for your WP site that are not included in your theme.
 * Author:            Andy Fragen
 * Version:           0.4.0
 * Author URI:        http://thefragens.com
 * GitHub Plugin URI: https://github.com/afragen/wp-site-tweaks
 * License:           MIT
 */

// Add extra CSS without needing to create child theme.
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style( 'wp-site-tweaks', plugins_url( 'wp-site-tweaks.css', __FILE__ ) );
	},
	99
);

// Disables mobile WordPress app too.
add_filter( 'xmlrpc_enabled', '__return_false' );
