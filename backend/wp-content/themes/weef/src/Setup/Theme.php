<?php

namespace Weef\Setup;

final class Theme {
	private function __construct() {}

	/**
	 * Removes unnecessary styles.
	 *
	 * @return void
	 */
	private static function remove_block_and_classic_theme_styles(): void {
		add_action(
			'wp_enqueue_scripts',
			function () {
				wp_dequeue_style( 'wp-block-library' );
				wp_dequeue_style( 'wp-block-library-theme' );
				wp_deregister_style( 'classic-theme-styles' );
				wp_dequeue_style( 'classic-theme-styles' );
			},
			100
		);
	}

	/**
	 * Removes unnecessary wp head tags.
	 *
	 * @return void
	 */
	private static function clean_wp_read(): void {
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'template_redirect', 'rest_output_link_header', 11 );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		add_filter( 'show_admin_bar', '__return_false' );
	}

	/**
	 * Initialize theme setup functions
	 *
	 * @return void
	 */
	public static function init(): void
	{
		self::remove_block_and_classic_theme_styles();
		self::clean_wp_read();
	}
}