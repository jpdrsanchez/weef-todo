<?php

namespace Weef\Setup;

final class Api {
	private function __construct() {}

	/**
	 * Changes the default rest url prefix for the rest api.
	 *
	 * @return void
	 */
	private static function rest_url_prefix(): void {
		add_filter('rest_url_prefix', function () {
			return 'api';
		});
	}

	/**
	 * Initialize api setup functions
	 *
	 * @return void
	 */
	public static function init(): void
	{
		self::rest_url_prefix();
	}
}