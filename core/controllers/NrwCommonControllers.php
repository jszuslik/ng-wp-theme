<?php
class NrwCommonControllers {
	public function __construct() {
		add_action( 'rest_api_init', array($this,'nrw_register_common_routes'));
	}
	public function nrw_get_bloginfo($request) {
		$response = array(
			'title' => get_bloginfo('name'),
			'description' => get_bloginfo('description')
		);
        $options = get_option('nrw_theme_options');
        $response = array_merge($response, $options);
		return $response;
	}

	public function nrw_register_common_routes() {
		register_rest_route(NRW_REST_API_VERSION , 'bloginfo', array(
			array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => [$this, 'nrw_get_bloginfo']
			)
		));
	}
}
$nrw_controllers = new NrwCommonControllers();

