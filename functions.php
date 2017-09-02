<?php
define('NRW_TEXT_DOMAIN', 'nrw-rest-api');
define('NRW_REST_API_VERSION', 'nrw/v1');
define('NRW_CORE_PATH', get_template_directory() . '/core/');
define('NRW_CONTROLLER_PATH', NRW_CORE_PATH . 'controllers/');

function nrw_require_file( $path ) {
	if ( file_exists($path) ) {
		require $path;
	}
}

nrw_require_file( NRW_CORE_PATH . 'init.php' );

function p($var) {
	var_dump($var);
}
