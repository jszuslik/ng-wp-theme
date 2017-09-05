<?php

// Setup
class NrwSetup {
	public function __construct() {
		add_theme_support( 'post-thumbnails' );
        add_image_size(NRW_TEXT_DOMAIN . '-fullwidth', 1170, 0, true);
        add_image_size( NRW_TEXT_DOMAIN . '-funnels', 970, 970, array('center','center'));
        add_image_size( NRW_TEXT_DOMAIN . '-serviceleft', 273, 375, array('center','center'));
        add_image_size( NRW_TEXT_DOMAIN . '-serviceright', 273, 182, array('center','center'));
        add_theme_support('post-formats', array('video', 'audio', 'gallery'));
	}
}
$nrw_setup = new NrwSetup();