<?php
class NrwPagesController {
	public function __construct() {
		add_action( 'rest_api_init', array($this, 'nrw_register_page_routes'));
	}
	public function nrw_get_page($request) {
		$page = self::nrw_get_post_by_name($request['slug']);
		$page->page_template = self::nrw_get_page_template($page->ID);
		$page->post_thumbnail = self::nrw_get_page_thumbnail($page->ID);
		$page->children = self::nrw_get_child_pages($page->ID);
		$page->breadcrumbs = self::nrw_get_breadcrumbs($page->post_parent);
		return $page;
	}

	public function nrw_get_breadcrumbs($page_parent){
		$breadcrumbs = array();
		while($page_parent > 0) {
			$page = get_post($page_parent);
			$breadcrumbs[] = array(
				'id' => $page_parent,
				'slug' => trim($page->post_name),
				'title' => trim($page->post_title)
			);
			$page_parent = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		return $breadcrumbs;
	}

	public function nrw_register_page_routes() {
		register_rest_route(NRW_REST_API_VERSION , 'pages/(?P<slug>\S+)', array(
			array(
				'methods' => WP_REST_Server::READABLE,
				'callback' => [$this, 'nrw_get_page']
			)
		));
	}

	public function nrw_get_page_template($page_id) {
		$slug = get_page_template_slug($page_id);
		if (strlen($slug) === 0) {
			return 'page-default.php';
		}
		return $slug;
	}

	public function nrw_get_child_pages($page_id) {
		$new_wp_query = new WP_Query();
		$all_wp_pages = $new_wp_query->query(array('post_type' => 'page', 'posts_per_page' => -1));
		foreach($all_wp_pages as $page) {
			$page->page_template = self::nrw_get_page_template($page->ID);
			$page->post_thumbnail = self::nrw_get_page_thumbnail($page->ID);
			$page->children = [];
			$page->breadcrumbs = self::nrw_get_breadcrumbs($page->post_parent);
		}

		return array_reverse(get_page_children($page_id, $all_wp_pages));
	}

	public function nrw_get_page_thumbnail($page_id) {
		return get_the_post_thumbnail_url($page_id);
	}

	public function nrw_get_post_by_name($post_name, $output = OBJECT) {
		global $wpdb;
		$post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND 
		post_type='page'", $post_name ));
		if ( $post )
			return get_post($post, $output);

		return null;
	}
}
$nrw_pages = new NrwPagesController();