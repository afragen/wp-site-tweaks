<?php
/*
Plugin Name:       WP Site Tweaks
Plugin URI:        https://github.com/afragen/wp-site-tweaks
Description:       Theme tweaks for your WP site that are not included in your theme.
Author:            Andy Fragen
Version:           1.0.2
Author URI:        http://thefragens.com
GitHub Plugin URI: https://github.com/afragen/wp-site-tweaks
*/

// Add extra CSS without needing to create child theme.
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

// Seems to conflict with Gutenberg.
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

	$image_args = array(
		'size' => 'medium',
		'attr' => array(
			'class' => 'alignleft',
		),
	);

	genesis_image( $image_args );
}

// remove query strings from static resources. This ensures that they are cached like other elements.
add_filter( 'script_loader_src', 'ewp_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'ewp_remove_script_version', 15, 1 );
function ewp_remove_script_version( $src ) {
	return remove_query_arg( 'ver', $src );
}

// Resize post featured image in Beans.
add_filter(
	'beans_edit_post_image_args',
	function() {
		return array(
			'resize' => array( 300, false ),
		);
	}
);

// Add post meta item in Beans.
add_filter(
	'beans_post_meta_items',
	function () {
		return array(
			'date'     => 10,
			'author'   => 20,
			'comments' => 30,
			// 'categories' => 40,
			// 'tags'       => 50,
		);
	},
	15
);

add_filter(
	'syntaxhighlighter_htmlresult',
	function( $content ) {
		return str_replace( [ '&amp;gt;', '&amp;amp;' ], [ '&gt;', '&amp;' ], $content );
	},
	20,
	1
);

add_filter(
	'git_remote_updater_remove_site_data',
	function() {
		return [ 'caldera-forms' ];
	}
);
