<?php
/*
Plugin Name:       WP Theme Tweaks
Plugin URI:        https://github.com/afragen/wp-theme-tweaks
Description:       Theme tweaks for your WP site that are not included in your theme.
Author:            Andy Fragen
Version:           0.1.0
Author URI:        http://thefragens.com
GitHub Plugin URI: https://github.com/afragen/wp-theme-tweaks
GitHub Branch:     ebps
*/

//add extra css without needing to create child theme
add_action( 'wp_enqueue_scripts', 'wptt_add_xtras_css', 99 );
function wptt_add_xtras_css() {
	wp_enqueue_style( 'wp-theme-tweaks' , plugins_url( 'wp-theme-tweaks.css', __FILE__ ) );
}
