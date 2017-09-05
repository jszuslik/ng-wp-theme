<?php
define('NRW_TEXT_DOMAIN', 'nrw-rest-api');
define('NRW_REST_API_VERSION', 'nrw/v1');
define('NRW_CORE_PATH', get_template_directory() . '/core/');
define('NRW_CONTROLLER_PATH', NRW_CORE_PATH . 'controllers/');
define('NRW_PAGE_NONCE', 'nrw_accounts_meta_box_nonce');
define('NRW_THUMB_FUNNELS', NRW_TEXT_DOMAIN . '-funnels');

function nrw_require_file( $path ) {
	if ( file_exists($path) ) {
		require $path;
	}
}

nrw_require_file( NRW_CORE_PATH . 'init.php' );

function p($var) {
    echo '<pre>';
	var_dump($var);
	echo '</pre>';
}
