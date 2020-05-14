<?php
/**
 * Plugin Name:       WP Site Tweaks
 * Plugin URI:        https://github.com/afragen/wp-site-tweaks
 * Description:       Theme tweaks for your WP site that are not included in your theme.
 * Author:            Andy Fragen
 * Version:           0.9.1
 * Author URI:        http://thefragens.com
 * GitHub Plugin URI: https://github.com/afragen/wp-site-tweaks
 * License:           MIT
 */

// add extra css without needing to create child theme
add_action(
	'wp_enqueue_scripts',
	function() {
		wp_enqueue_style( 'wp-site-tweaks', plugins_url( 'wp-site-tweaks.css', __FILE__ ) );
	},
	99
);

add_action(
	'admin_menu',
	function() {
		remove_menu_page( 'link-manager.php' );
	}
);

// Doesn't seem to work with Gutenberg.
// http://www.paulund.co.uk/automatically-link-twitter
// add_filter( 'the_content', 'paulund_content_twitter_mention' );
// add_filter( 'comment_text', 'paulund_content_twitter_mention' );
function paulund_content_twitter_mention( $content ) {
	return preg_replace( '/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/', '$1<a href="http://twitter.com/$2" target="_blank" rel="nofollow">@$2</a>', $content );
}

add_action( 'genesis_entry_content', 'sk_show_featured_image_single_posts', 9 );
/**
 * Display Featured Image floated to the right in single Posts.
 *
 * @author Sridhar Katakam
 * @link   http://sridharkatakam.com/how-to-display-featured-image-in-single-posts-in-genesis/
 */
function sk_show_featured_image_single_posts() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	$image_args = [
		'size' => 'medium',
		'attr' => [
			'class' => 'alignleft',
		],
	];

	genesis_image( $image_args );
}

// remove query strings from static resources. This ensures that they are cached like other elements.
// add_filter( 'script_loader_src', 'ewp_remove_script_version', 15, 1 );
// add_filter( 'style_loader_src', 'ewp_remove_script_version', 15, 1 );
function ewp_remove_script_version( $src ) {
	return remove_query_arg( 'ver', $src );
}

add_filter(
	'git_remote_updater_remove_site_data',
	function() {
		return [ 'caldera-forms' ];
	}
);

remove_filter( 'contextual_help', 'pb_backupbuddy_contextual_help', 10 );

add_filter( 'xmlrpc_enabled', '__return_false' );
