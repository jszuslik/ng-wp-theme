<?php

function nrw_create_signup_entry($request) {
	$post = array(
		'form_id' => 3,
		'frm_action' => 'create',
		'form_key' => 'uy2uo',
		'item_name' => 'New Sign Up',
		'parent_item_id' => 1,
		'item_meta' => array(
			15 => $request['name'],
			16 => $request['email'],
			17 => $request['phone']
		)
	);

	return FrmEntry::create($post);
}

function nrw_register_form_routes() {
	register_rest_route(NRW_REST_API_VERSION , 'form/signup', array(
		array(
			'methods' => WP_REST_Server::CREATABLE,
			'callback' => 'nrw_create_signup_entry'
		)
	));
}
add_action( 'rest_api_init', 'nrw_register_form_routes');