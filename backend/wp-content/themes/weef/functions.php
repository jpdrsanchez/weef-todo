<?php

defined( 'ABSPATH' ) || exit;

require_once get_theme_file_path('autoload.php');

use Weef\Bootstrap;

if ( class_exists( '\Weef\Bootstrap' ) ) {
	Bootstrap::init();
}