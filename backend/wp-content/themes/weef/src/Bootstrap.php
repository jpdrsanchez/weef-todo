<?php

namespace Weef;

use Weef\Custom\Todo;
use Weef\Http\Todos;
use Weef\Setup\Api;
use Weef\Setup\Theme;

final class Bootstrap {
	private function __construct() {}

	/**
	 * Initializes all application features.
	 *
	 * @return void
	 */
	public static function init(): void {
		Theme::init();
		Api::init();
		Todo::init();
		Todos::init();
	}
}