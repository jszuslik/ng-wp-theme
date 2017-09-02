<?php
class NrwMenuControllers {

	public function __construct() {
		add_action('after_setup_theme', array($this, 'nrw_setup_menus'));
		add_action( 'rest_api_init', array($this, 'nrw_register_menu_routes'));
	}
	public function nrw_setup_menus() {
		register_nav_menus(
			array(
				'primary' => esc_html__('Primary Menu', NRW_TEXT_DOMAIN),
				'footer' => esc_html__('Footer Menu', NRW_TEXT_DOMAIN),
				'social' => esc_html__('Social Media Menu', NRW_TEXT_DOMAIN),
				'service' => esc_html__('Customer Service Menu', NRW_TEXT_DOMAIN)
			)
		);
	}
	public function nrw_register_menu_routes() {
		register_rest_route(NRW_REST_API_VERSION , 'menus/(?P<slug>\S+)', array(
			[
				'methods' => WP_REST_Server::READABLE,
				'callback' => [ $this, 'nrw_get_menus' ]
			]
		));
	}
	public function nrw_get_internal_menu( $menu_name ) {
		$theme_locations = get_nav_menu_locations();

		$menu_obj = get_term( $theme_locations[$menu_name], 'nav_menu' );

		$menu_name = $menu_obj->name;

		$menu_items = wp_get_nav_menu_items($menu_name);

		$menu_routes = array();

		foreach($menu_items as $menu_item) {
			$title = strtolower($menu_item->title);
			$slug = str_replace(" ", "-", $title);
			// $page = get_page_by_path($slug);
			$item = array(
				'id' => (int) $menu_item->object_id,
				'page_slug' => $slug,
				'page_title' => $menu_item->title
			);
			$menu_routes[] = $item;
		}
		// return $menu_items;
		return $menu_routes;
	}

	public function nrw_get_external_menu($menu_name) {
		$theme_locations = get_nav_menu_locations();

		$menu_obj = get_term( $theme_locations[$menu_name], 'nav_menu' );

		$menu_name = $menu_obj->name;

		$menu_items = wp_get_nav_menu_items($menu_name);

		$menu_routes = array();
		foreach($menu_items as $menu_item) {
			$menu_routes[] = array(
				'id' => (int) $menu_item->object_id,
				'page_slug' => $menu_item->url,
				'page_title' => $menu_item->title
			);
		}

		return $menu_routes;
	}

	public function nrw_get_menus( $request ) {
		$menu_items = null;
		if($request['slug'] === 'primary' || $request['slug'] === 'service' || $request['slug'] === 'footer') {
			$menu_items = self::nrw_get_internal_menu( $request['slug'] );
		} else {
			$menu_items = self::nrw_get_external_menu($request['slug']);
		}

		return rest_ensure_response($menu_items);
	}

}
$nrw_menu_controller = new NrwMenuControllers();