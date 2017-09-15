<?php

class NrwAdminOptions {

    private $options;

    public function __construct() {
        add_action('admin_init', array($this, 'nrw_register_theme_options'));
        add_action('admin_menu', array($this, 'nrw_add_back_menu_page'));
        add_action('admin_menu', array($this, 'nrw_add_main_links_into_menu'));
    }

    public function nrw_print_options_page() {

        global $nrw_dashboard_tabs;
        $this->options = get_option('nrw_theme_options');

        $nrw_dashboard_tabs['1'] = array('company_info' => 'Company Info');
//        $nrw_dashboard_tabs['2'] = array('accounts' => 'Accounts');
//        $nrw_dashboard_tabs['3'] = array('contacts' => 'Contacts');


        ?>
        <div class="wrap">
			<h2>Welcome to No Rules Web</h2>
			<?php settings_errors(); ?>

			<?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'dashboard'; ?>

			<h2 class="nav-tab-wrapper">
			 <?php
                ksort($nrw_dashboard_tabs);
                foreach($nrw_dashboard_tabs as $dashboard_tab) :
	                foreach($dashboard_tab as $key => $value) :?>
				    <a href="?page=nrw_backend_main_menu&tab=<?php echo $key; ?>" class="nav-tab <?php echo $active_tab == $key ? 'nav-tab-active' : ''; ?>"><?php echo $value; ?></a>
				<?php endforeach; endforeach; ?>
			</h2>
            <form action='options.php' method='post'>

                <?php
                settings_fields( 'nrw_' . $active_tab . '_group' );
                do_settings_sections( 'nrw_' . $active_tab . '_group' );
                submit_button();
                ?>

            </form>
        </div>
        <?php
    }

    public function nrw_add_back_menu_page() {
        global $nrw_crm_main_menu;
        $nrw_crm_main_menu = add_menu_page(
            'NRW Theme Options',
            'NRW Theme Options',
            'manage_options',
            'nrw-admin-options',
            array( $this, 'nrw_print_options_page')
        );
    }

    public function nrw_add_main_links_into_menu() {
        global $submenu;
        $company_info_link = 'admin.php?page=nrw-admin-options&tab=company_info';
        $contacts_link = 'admin.php?page=nrw_backend_main_menu&tab=contacts';
        $accounts_link = 'admin.php?page=nrw_backend_main_menu&tab=accounts';
        $submenu['nrw-admin-options'][] = array( 'Comapany Info', 'manage_options', $company_info_link );
        // $submenu['nrw-admin-options'][] = array( 'Process', 'manage_options', $accounts_link );
        // $submenu['nrw-admin-options'][] = array( 'Contacts', 'manage_options', $contacts_link );
    }

    public function nrw_register_theme_options() {
        foreach (NrwAdminOptionFields::$nrw_company_info as $setting) {
            register_setting(
                $setting['option_group'],
                $setting['option_name'],
                array($this, 'sanitize')
            );
            foreach ($setting['settings_sections'] as $section) {
                add_settings_section(
                    $section['id'],
                    __($section['title'], NRW_TEXT_DOMAIN),
                    array($this, $section['callback']),
                    $setting['option_group']
                );
                foreach ($section['fields'] as $field) {
                    add_settings_field(
                        $field['id'],
                        __($field['title'], NRW_TEXT_DOMAIN),
                        array($this, 'nrw_callback_field'),
                        $setting['option_group'],
                        $section['id'],
                        array(
                            'field_id' => $field['id'],
                            'options_group' => $setting['option_name'],
                            'type' => $field['type']
                        )
                    );
                }
            }
        }
    }

    public function nrw_callback_field($args) {

        if(!isset($this->options[$args['field_id']])) {
            $this->options[$args['field_id']] = '';
            update_option($args['options_group'], $this->options);
        }
        $value = $this->options[$args['field_id']];

        printf(
            '<input type="%s" id="%s[%s]" name="%s[%s]" value="%s" />',
            $args['type'],
            $args['options_group'],
            $args['field_id'],
            $args['options_group'],
            $args['field_id'],
            isset($value) ? esc_attr($value) : ''
        );
    }

    public function nrw_company_info_section() {
        echo __( 'Put contact info here', 'wpissues' );
    }

    public function sanitize($input) {
        return $input;
    }

}
$nrw_admin_options = new NrwAdminOptions();