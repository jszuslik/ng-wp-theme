<?php
class NrwPagesController {
	public function __construct() {
		add_action( 'rest_api_init', array($this, 'nrw_register_page_routes'));
	}
	public function nrw_get_page($request) {
		$page = self::nrw_get_post_by_name($request['slug']);
		$page->blog_title = get_bloginfo('name');
		$page->blog_description = get_bloginfo('description');
        $page->meta_data = get_post_meta($page->ID);
		$page->post_parent_title = get_the_title($page->post_parent);
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
		    $page->meta_data = get_post_meta($page->ID);
            $page->post_parent_title = get_the_title($page->post_parent);
			$page->page_template = self::nrw_get_page_template($page->ID);
			$page->post_thumbnail = self::nrw_get_child_funnel_thumb($page->ID);
			$page->children = [];
			$page->breadcrumbs = self::nrw_get_breadcrumbs($page->post_parent);
		}

		return array_reverse(get_page_children($page_id, $all_wp_pages));
	}
	public function nrw_get_child_funnel_thumb($page_id) {
	    $url = self::nrw_get_page_thumbnail($page_id);
	    return self::nrw_return_img_url($url, NRW_THUMB_FUNNELS);

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

    public function nrw_return_img_url( $url, $tag ) {
        $att_id = self::nrw_get_attachment_id_by_url($url);
        $image_arr = wp_get_attachment_image_src($att_id, $tag);
        return $image_arr[0];
    }

    public function nrw_get_attachment_id_by_url( $url ) {
        // Split the $url into two parts with the wp-content directory as the separator
        $parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
        // Get the host of the current site and the host of the $url, ignoring www
        $this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
        $file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
        // Return nothing if there aren't any $url parts or if the current host and $url host do not match
        if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
            return;
        }
        // Now we're going to quickly search the DB for any attachment GUID with a partial path match
        // Example: /uploads/2013/05/test-image.jpg
        global $wpdb;
        $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );
        // Returns null if no attachment is found
        return $attachment[0];
    }

}
$nrw_pages = new NrwPagesController();