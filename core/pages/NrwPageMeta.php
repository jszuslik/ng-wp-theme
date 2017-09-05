<?php

class NrwPageMeta {

    private $nrw_page_meta_fields = [];
    private $stored_meta_data = null;

    public function __construct() {
        if(isset($_GET['post'])) {
            $post_id = $_GET['post'];
            $this->stored_meta_data = get_post_meta( $post_id );
        }
        add_action('add_meta_boxes', array($this, 'nrw_add_page_meta_boxes'));
        add_action('save_post', array( $this, 'nrw_save_page_meta_data' ) );

        $this->nrw_page_meta_fields = array(
            array(
                'name' => '',
                'split_columns' => false,
                'fields' => array(
                    NrwMetaBuild::create_field_array(
                        array(
                            'name' => 'nrw_btn_text',
                            'id' => 'nrw_btn_text',
                            'meta_id' => $this->stored_meta_data,
                            'label' => __('Button Text', NRW_TEXT_DOMAIN)
                        )
                    )

                )
            )
        );

    }

    public function nrw_add_page_meta_boxes() {
        add_meta_box( 'nrw_page_meta_box', __('Funnels', NRW_TEXT_DOMAIN), array($this, 'nrw_funnel_build_meta_box'));
    }

    public function nrw_funnel_build_meta_box( $post ) {
        wp_nonce_field( basename( __FILE__ ), NRW_PAGE_NONCE );

        $this->stored_meta_data = get_post_meta( $post->ID );

        echo NrwMetaBuild::nrw_do_meta_fields($this->nrw_page_meta_fields, $this->stored_meta_data);
    }

    public function nrw_save_page_meta_data( $post_id ) {
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[NRW_PAGE_NONCE] ) && wp_verify_nonce( $_POST[NRW_PAGE_NONCE], basename(__FILE__) ) ) ? 'true' : 'false';

        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }
        foreach ($this->nrw_page_meta_fields as $field_group) {
            foreach($field_group['fields'] as $field) {
                if (isset($_POST[$field['id']])) {
                    if($field['type'] == 'checkbox') {
                        update_post_meta( $post_id, $field['id'], $_POST[$field['id']] );
                    } else {
                        update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
                    }

                }
            }
        }

    }
}
$nrw_page_meta = new NrwPageMeta();