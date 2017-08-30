<?php

function nrw_get_bloginfo($request) {
	$response = array(
		'description' => get_bloginfo('description')
	);
	return $response;
}
function nrw_register_common_routes() {
	register_rest_route(NRW_REST_API_VERSION , 'bloginfo', array(
		array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => 'nrw_get_bloginfo'
		)
	));
}
add_action( 'rest_api_init', 'nrw_register_common_routes');