<?php

class NrwAdminOptions {

    public function __construct() {
        add_action('admin_menu', array($this, 'nrw_add_back_menu_page'));
        add_action('admin_menu', array($this, 'add_main_links_into_menu'));
    }

    public function nrw_add_back_menu_page() {
        global $nrw_crm_main_menu;
        $nrw_crm_main_menu = add_menu_page(
            'NRW Theme Options',
            'NRW Theme Options',
            'manage_options',
            'nrw-admin-options',
            array( $this, 'nrw_add_menu_options')
        );
    }

    public function add_main_links_into_menu() {
        global $submenu;
        $dashboard_link = 'admin.php?page=nrw_backend_main_menu&tab=dashboard';
        $contacts_link = 'admin.php?page=nrw_backend_main_menu&tab=contacts';
        $accounts_link = 'admin.php?page=nrw_backend_main_menu&tab=accounts';
        $submenu['nrw-admin-options'][] = array( 'Dashboard', 'manage_options', $dashboard_link );
        $submenu['nrw-admin-options'][] = array( 'Process', 'manage_options', $accounts_link );
        $submenu['nrw-admin-options'][] = array( 'Contacts', 'manage_options', $contacts_link );
    }

}
$nrw_admin_options = new NrwAdminOptions();