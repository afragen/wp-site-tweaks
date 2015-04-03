<?php

use Fragen\Category_Colors;

/*
Plugin Name:       WP Theme Tweaks
Plugin URI:        https://github.com/afragen/wp-theme-tweaks
Description:       Theme tweaks for your WP site that are not included in your theme.
Author:            Andy Fragen
Version:           0.1.0
Author URI:        http://thefragens.com
GitHub Plugin URI: https://github.com/afragen/wp-theme-tweaks
GitHub Branch:     danishmaritimedays
Requires PHP:      5.3
*/

//add extra css without needing to create child theme
add_action( 'wp_enqueue_scripts', 'wptt_add_xtras_css', 99 );
function wptt_add_xtras_css() {
	wp_enqueue_style( 'wp-theme-tweaks' , plugins_url( 'wp-theme-tweaks.css', __FILE__ ) );
}


add_action( 'plugins_loaded', 'teccc_load_options_class', 20 );
function teccc_load_options_class() {
	if ( class_exists( '\\Fragen\\Category_Colors\\Main' ) ) {
		new Category_Colors_Options();
	}
}

if ( ! class_exists( 'Category_Colors_Options' ) ) {
	class Category_Colors_Options {

		public function __construct() {
			add_filter( 'teccc_legend_html', array( $this, 'add_to_legend_html' ) );
			$this->hide_extra_categories();
		}


		public function add_legend_explanation( $html ) {
			echo '<div class="legend-explanation"> To focus on events from only one of these categories, just click on the relevant label. </div>' . $html;
		}

		public function hide_extra_categories() {
			teccc_ignore_slug( 'fully-booked', 'leveraging-new-technologies-and-innovation', 'maritime-growth-areas-of-the-future', 'maritime-security', 'meeting-the-transportation-infrastructure-needs-of-the-future', 'social', 'sustainable-growth', 'unlocking-growth-in-the-emerging-economies', 'workforce-of-the-future' );
		}

		public function add_to_legend_html( $html ) {
			echo $html . dmd_show_extra_legend_items();
		}

		public function dmd_show_extra_legend_items() {
			?>
			<ul>
				<li>
					<a href="http://www.danishmaritimedays.com/events/category/fully-booked/">Fully&nbsp;booked</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/leveraging-new-technologies-and-innovation/">Leveraging&nbsp;New&nbsp;Technologies&nbsp;and&nbsp;Innovation</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/maritime-growth-areas-of-the-future/">Maritime&nbsp;Growth&nbsp;Areas&nbsp;of&nbsp;the&nbsp;Future</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/maritime-security/">Maritime&nbsp;Security</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/meeting-the-transportation-infrastructure-needs-of-the-future/">Meeting&nbsp;the&nbsp;Transportation&nbsp;Infrastructure&nbsp;Needs&nbsp;of&nbsp;the&nbsp;Future</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/social/">Social</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/sustainable-growth/">Sustainable&nbsp;Growth</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/unlocking-growth-in-the-emerging-economies/">Unlocking&nbsp;Growth&nbsp;in&nbsp;the&nbsp;Emerging&nbsp;Economies</a>
				</li>

				<li>
					<a href="http://www.danishmaritimedays.com/events/category/workforce-of-the-future/">Workforce&nbsp;of&nbsp;the&nbsp;Future</a>
				</li>
			</ul>
		<?php
		}
}

}