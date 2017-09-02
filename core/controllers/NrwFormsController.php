<?php
class NrwFormsController {
	public function __construct() {
		add_action( 'rest_api_init', array($this, 'nrw_register_form_routes'));
	}
	public function nrw_create_signup_entry($request) {
		if(strlen($request['name']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Name Is A Required Field'
			);
		}
		if(strlen($request['email']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Email Is A Required Field'
			);
		}
		if(strlen($request['phone']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Phone Is A Required Field'
			);
		}
		$post = array(
			'form_id' => 3,
			'frm_action' => 'create',
			'form_key' => 'uy2uo',
			'item_name' => 'New Sign Up',
			'item_meta' => array(
				15 => $request['name'],
				16 => $request['email'],
				17 => $request['phone']
			)
		);

		$response_id = FrmEntry::create($post);
		if(!$response_id) {
			return array(
				'id' => $response_id,
				'message' => 'There was an error with your submission'
			);
		}
		$response = array(
			'id' => $response_id,
			'message' => $request['name']
		);

		return $response;
	}

	public function nrw_create_feedback_entry($request) {
		if(strlen($request['name']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Name Is A Required Field'
			);
		}
		if(strlen($request['email']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Email Is A Required Field'
			);
		}
		if(strlen($request['phone']) <= 0) {
			return array(
				'id' => false,
				'message' => 'Phone Is A Required Field'
			);
		}
		if(strlen($request['message']) <= 0) {
			return array(
				'id' => false,
				'message' => 'A Message Is Required'
			);
		}

		$post = array(
			'form_id' => 4,
			'frm_action' => 'create',
			'form_key' => 'fgzq',
			'item_name' => 'New Feedback',
			'item_meta' => array(
				18 => $request['name'],
				19 => $request['email'],
				20 => $request['phone'],
				21 => $request['message']
			)
		);
		$response_id = FrmEntry::create($post);
		if(!$response_id) {
			return array(
				'id' => $response_id,
				'message' => 'There was an error with your submission'
			);
		}
		$response = array(
			'id' => $response_id,
			'message' => $request['name']
		);

		return rest_ensure_response($response);
	}

	public function nrw_register_form_routes() {
		register_rest_route(NRW_REST_API_VERSION , 'form/signup', array(
			array(
				'methods' => WP_REST_Server::CREATABLE,
				'callback' => [$this, 'nrw_create_signup_entry']
			)
		));
		register_rest_route(NRW_REST_API_VERSION , 'form/feedback', array(
			array(
				'methods' => WP_REST_Server::CREATABLE,
				'callback' => [$this, 'nrw_create_feedback_entry']
			)
		));
	}
}
$nrw_forms_controller = new NrwFormsController();