<?php

if ( function_exists('nrw_require_file') ) {

	// Load Classes
	// nrw_require_file( NRW_CORE_PATH . 'setup.php');
	nrw_require_file( NRW_ENDPOINTS_PATH . 'common.php' );
	nrw_require_file( NRW_ENDPOINTS_PATH . 'menus.php' );
	nrw_require_file( NRW_ENDPOINTS_PATH . 'pages.php' );
	nrw_require_file( NRW_ENDPOINTS_PATH . 'forms.php' );

}