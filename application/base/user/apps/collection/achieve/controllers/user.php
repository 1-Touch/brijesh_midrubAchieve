<?php
/**
 * User Controller
 *
 * This file loads the Achieve app in the user panel
 *
 * @author Brijesh
 * @package Midrub
 * @since 0.0.7.6
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Achieve\Controllers;

// Define the constants
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * User class loads the Achieve app loader
 * 
 * @author Brijesh
 * @package Midrub
 * @since 0.0.7.6
 */
class User {
    
    /**
     * Class variables
     *
     * @since 0.0.7.6
     */
    protected $CI;

    /**
     * Initialise the Class
     *
     * @since 0.0.7.6
     */
    public function __construct() {
        
        // Get codeigniter object instance
        $this->CI =& get_instance();
        
        // Load language
        $this->CI->lang->load( 'achieve_user', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_ACHIEVE );
        
    }
    
    /**
     * The public method view loads the app's template
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function view() {

        // Set the page's title
        set_the_title($this->CI->lang->line('achieve'));

        // Set Achieve's styles
        set_css_urls(array('stylesheet', base_url('assets/base/user/apps/collection/achieve/styles/css/styles.css?ver=' . MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION), 'text/css', 'all'));
        set_css_urls(array('stylesheet', base_url('assets/base/user/apps/collection/achieve/styles/css/datatables.min.css?ver=' . MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION), 'text/css', 'all'));

        // Set Achieve's Js
        set_js_urls(array(base_url('assets/base/user/apps/collection/achieve/js/datatables.min.js?ver=' . MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION)));
        set_js_urls(array(base_url('assets/base/user/apps/collection/achieve/js/main.js?ver=' . MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION)));
        
       
        // Set Media's Js
        set_js_urls(array(base_url('assets/user/js/media.js?ver=' . MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION)));
        
        // Set views params
        set_user_view(
            $this->CI->load->ext_view(
                MIDRUB_BASE_USER_APPS_ACHIEVE . 'views',
                'main',
                array(
                ),
                true
            )
        );
        
    }

}
