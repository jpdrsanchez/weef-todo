<?php

namespace Weef\Http;

use WP_REST_Server;
use WP_REST_Request;
use WP_REST_Response;
use WP_Post;

final class Todos {
	/**
	 * The api namespace.
	 *
	 * @var string
	 */
	private const NAMESPACE = 'weef/v1';

	/**
	 * The resource's name.
	 *
	 * @var string
	 */
	private const RESOURCE_NAME = '/todos';

	public static function init(): self
	{
		return new self();
	}

	private function __construct()
	{
		$this->register_rest_routes();
	}

	/**
	 * Registers the api todo endpoints.
	 *
	 * @return void
	 */
	private function register_rest_routes(): void
	{
		add_action('rest_api_init', function () {
			register_rest_route(
				self::NAMESPACE,
				self::RESOURCE_NAME,
				[
					[
						'methods' => WP_REST_Server::READABLE,
						'callback' => [$this, 'get_todos'],
						'permission_callback' => '__return_true',
					],
					[
						'methods' => WP_REST_Server::CREATABLE,
						'callback' => [$this, 'create_todo'],
						'permission_callback' => '__return_true',
						'args' => [
							'name' => [
								'required' => true,
								'validate_callback' => fn (mixed $value) => ! empty( $value ),
								'sanitize_callback' => fn (mixed $value) => sanitize_text_field($value)
							]
						]
					],
					[
						'methods' => WP_REST_Server::EDITABLE,
						'callback' => [$this, 'update_todo'],
						'permission_callback' => '__return_true',
						'args' => [
							'id' => [
								'required' => true,
								'validate_callback' => fn (mixed $value) => is_numeric($value),
								'sanitize_callback' => fn( mixed $param) => absint( $param ),
							],
							'name' => [
								'required' => false,
								'validate_callback' => fn (mixed $value) => ! empty( $value ),
								'sanitize_callback' => fn (mixed $value) => sanitize_text_field($value)
							],
							'status' => [
								'required' => false,
								'validate_callback' => fn( mixed $param) => 'done' === $param || 'undone' === $param,
								'sanitize_callback' => fn (mixed $value) => sanitize_text_field($value)
							]
						]
					],
					[
						'methods' => WP_REST_Server::DELETABLE,
						'callback' => [$this, 'delete_todo'],
						'permission_callback' => '__return_true',
						'args' => [
							'id' => [
								'required' => true,
								'validate_callback' => fn (mixed $value) => is_numeric($value),
								'sanitize_callback' => fn( mixed $param) => absint( $param ),
							]
						]
					],
				]
			);
		});
	}

	/**
	 * Get the list of the required resource.
	 *
	 * @return WP_REST_Response
	 */
	public function get_todos(): WP_REST_Response
	{
		$todos = get_posts([
			'numberposts' => -1,
			'post_type' => 'todo'
		]);

		return new WP_REST_Response([
			'todos' => $this->map_todo($todos)
		], 200);
	}

	/**
	 * Maps the API response.
	 *
	 * @param WP_Post[] $todos
	 *
	 * @return array|array[]
	 */
	private function map_todo(array $todos): array
	{
		return array_map(function (WP_Post $todo) {
			return [
				'id' => $todo->ID,
				'name' => $todo->post_name,
				'title' => $todo->post_title,
				'status' => get_post_meta($todo->ID, '_status', true)
			];
		}, $todos);
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function create_todo(WP_REST_Request $request): WP_REST_Response
	{
		$_name = $request->get_param('name');

		$todo = wp_insert_post([
			'post_title' => $_name,
			'post_author' => 1,
			'meta_input' => [
				'_status' => 'undone'
			],
			'post_type' => 'todo',
			'post_status'   => 'publish'
		]);

		$todo = get_post($todo);

		if (!$todo) {
			return new WP_REST_Response(['message' => 'Erro ao criar novo post'], 400);
		}

		return new WP_REST_Response([
			'id' => $todo->ID,
			'name' => $todo->post_name,
			'title' => $todo->post_title,
			'status' => get_post_meta($todo->ID, '_status', true)
		], 201);
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function update_todo(WP_REST_Request $request): WP_REST_Response
	{
		$update_array = [];

		$_id = $request->get_param('id');
		$_name = $request->get_param('name');
		$_status = $request->get_param('status');

		$update_array['ID'] = $_id;

		if (!empty($_name)) $update_array['post_title'] = $_name;
		if (!empty($_status)) $update_array['meta_input'] = [
			'_status' => $_status
		];

		$todo = wp_update_post($update_array);

		$todo = get_post($todo);

		if (!$todo) {
			return new WP_REST_Response(['message' => 'Erro ao editar post'], 400);
		}

		return new WP_REST_Response([
			'id' => $todo->ID,
			'name' => $todo->post_name,
			'title' => $todo->post_title,
			'status' => get_post_meta($todo->ID, '_status', true)
		], 200);
	}

	/**
	 * @param WP_REST_Request $request
	 *
	 * @return WP_REST_Response
	 */
	public function delete_todo(WP_REST_Request $request): WP_REST_Response
	{
		$_id = $request->get_param('id');

		$todo = wp_delete_post($_id, true);

		if (!$todo) {
			return new WP_REST_Response(['message' => 'Erro ao excluir post'], 400);
		}

		return new WP_REST_Response(null, 204);
	}
}