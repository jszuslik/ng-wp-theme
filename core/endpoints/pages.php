<?php

function nrw_get_page($request) {
	$page = get_page_by_path($request['slug']);
	return $page;
}


function nrw_register_page_routes() {
	register_rest_route(NRW_REST_API_VERSION , 'pages/(?P<slug>\S+)', array(
		array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => 'nrw_get_page'
		)
	));
}

add_action( 'rest_api_init', 'nrw_register_page_routes');