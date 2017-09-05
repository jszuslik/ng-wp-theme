<?php

class NrwOption {

	public $ID = null;

	public $post_title = null;

	public function __construct($option, $value) {
		$this->ID = $option;
		$this->post_title = $value;
	}


}