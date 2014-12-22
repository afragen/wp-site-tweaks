<?php
/*
Plugin Name:       WP Theme Tweaks
Plugin URI:        https://github.com/afragen/wp-theme-tweaks
Description:       Theme tweaks for your WP site that are not included in your theme.
Author:            Andy Fragen
Version:           0.3.0
Author URI:        http://thefragens.com
GitHub Plugin URI: https://github.com/afragen/wp-theme-tweaks
GitHub Branch:     thefragens
*/

//add extra css without needing to create child theme
add_action( 'wp_enqueue_scripts', 'wptt_add_xtras_css', 99 );
function wptt_add_xtras_css() {
	wp_enqueue_style( 'wp-theme-tweaks' , plugins_url( 'wp-theme-tweaks.css', __FILE__ ) );
}

add_action( 'admin_menu', 'ajf_remove_menu_pages' );
function ajf_remove_menu_pages() {
	remove_menu_page( 'link-manager.php' );
}

//http://www.paulund.co.uk/automatically-link-twitter
add_filter( 'the_content', 'paulund_content_twitter_mention' );   
add_filter( 'comment_text', 'paulund_content_twitter_mention' );
function paulund_content_twitter_mention( $content ) {
	return preg_replace( '/([^a-zA-Z0-9-_&])@([0-9a-zA-Z_]+)/', "$1<a href=\"http://twitter.com/$2\" target=\"_blank\" rel=\"nofollow\">@$2</a>", $content );
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