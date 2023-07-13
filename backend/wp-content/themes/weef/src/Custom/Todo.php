<?php

namespace Weef\Custom;

final class Todo {
	private function __construct() {}

	/**
	 * The post type unique name
	 *
	 * @var string
	 */
	private const POST_TYPE = 'todo';

	/**
	 * Registers the Todo post type
	 *
	 * @return void
	 */
	private static function register_post_type(): void {
		add_action('init', function () {
			register_post_type(
				self::POST_TYPE,
				[
					'labels'             => [
						'name'          => 'Todos',
						'singular_name' => 'Todo',
					],
					'description'        => 'Our Todo List Items',
					'public'             => true,
					'publicly_queryable' => false,
					'show_in_rest'       => true,
					'supports'           => [
						'title',
						'author'
					],
					'query_var'          => false,
					'menu_icon'          => 'dashicons-media-interactive'
				]
			);
		});
	}

	/**
	 * Initialize custom todo post functions
	 *
	 * @return void
	 */
	public static function init(): void {
		self::register_post_type();
	}
}