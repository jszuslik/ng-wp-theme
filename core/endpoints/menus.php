<?php

add_action('after_setup_theme', 'nrw_setup_menus');
function nrw_setup_menus() {
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary Menu', NRW_TEXT_DOMAIN),
			'topbar'  => esc_html__('Topbar Menu', NRW_TEXT_DOMAIN)
		)
	);
}

function nrw_get_menu( $menu_name ) {
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

function nrw_get_main_menu( $request ) {
	$menu_items = nrw_get_menu( 'primary' );

	return rest_ensure_response($menu_items);
}

function nrw_register_menu_routes() {
	register_rest_route(NRW_REST_API_VERSION , 'mainmenu', array(
		array(
			'methods' => WP_REST_Server::READABLE,
			'callback' => 'nrw_get_main_menu'
		)
	));
}

add_action( 'rest_api_init', 'nrw_register_menu_routes');