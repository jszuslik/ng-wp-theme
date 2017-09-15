<?php

class NrwAdminOptionFields
{

    public static $nrw_company_info = array(
        array(
            'option_group' => 'nrw_company_info_group',
            'option_name' => 'nrw_theme_options',
            'settings_sections' => array(
                array(
                    'id' => 'nrw_company_info',
                    'title' => 'Company Info',
                    'callback' => 'nrw_company_info_section',
                    'fields' => array(
                        array(
                            'type' => 'text',
                            'id' => 'nrw_phone_field',
                            'title' => 'Phone Number'
                        ),
                        array(
                            'type' => 'text',
                            'id' => 'nrw_email_field',
                            'title' => 'Email Address'
                        )
                    )
                )
            )
        )
    );

}