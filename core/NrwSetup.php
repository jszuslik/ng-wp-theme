<?php

// Setup
class NrwSetup {
	public function __construct() {
		add_theme_support( 'post-thumbnails' );
	}
}
$nrw_setup = new NrwSetup();