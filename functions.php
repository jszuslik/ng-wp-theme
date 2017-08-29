<?php
define('NRW_REST_API_VERSION', 'nrw/v1');
define('NRW_CORE_PATH', get_template_directory() . '/core/');
define('NRW_ENDPOINTS_PATH', NRW_CORE_PATH . 'endpoints/');

function nrw_require_file( $path ) {
	if ( file_exists($path) ) {
		require $path;
	}
}

nrw_require_file( NRW_CORE_PATH . 'init.php' );


?>
