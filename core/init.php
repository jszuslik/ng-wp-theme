<?php

if ( function_exists('nrw_require_file') ) {

	// Load Classes
	nrw_require_file( NRW_CORE_PATH . 'NrwSetup.php');
    nrw_require_file( NRW_CORE_PATH . 'meta-build/NrwMetaBuild.php');
    nrw_require_file( NRW_CORE_PATH . 'pages/NrwPageMeta.php');
    nrw_require_file( NRW_CORE_PATH . 'options/NrwOptions.php');
	nrw_require_file( NRW_CONTROLLER_PATH . 'NrwCommonControllers.php' );
	nrw_require_file( NRW_CONTROLLER_PATH . 'NrwMenuControllers.php' );
	nrw_require_file( NRW_CONTROLLER_PATH . 'NrwPagesController.php' );
	nrw_require_file( NRW_CONTROLLER_PATH . 'NrwFormsController.php' );

}