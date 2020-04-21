<?php
/**
 * User Controller
 *
 * This file loads the Planner app in the user panel
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.4
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner\Controllers;

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the namespaces to use
use MidrubBase\User\Apps\Collection\Planner\Helpers as MidrubBaseUserAppsCollectionPlannerHelpers;

/*
 * User class loads the Planner app loader
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.4
 */
class User {
    
    /**
     * Class variables
     *
     * @since 0.0.7.4
     */
    protected $CI;

    /**
     * Initialise the Class
     *
     * @since 0.0.7.4
     */
    public function __construct() {
        
        // Get codeigniter object instance
        $this->CI =& get_instance();
        
        // Load language
        $this->CI->lang->load( 'planner_user', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_PLANNER );
        
    }
    
    /**
     * The public method view loads the app's template
     * 
     * @since 0.0.7.4
     * 
     * @return void
     */
    public function view() {

        // Set the page's title
        set_the_title($this->CI->lang->line('planner'));

        // Set FullCalendar's styles
        set_css_urls(array('stylesheet', '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css?ver=' . MD_VER, 'text/css', 'all'));

        // Set Emojion Area Styles
        set_css_urls(array('stylesheet', base_url('assets/base/user/apps/collection/posts/js/emojionearea-master/dist/emojionearea.min.css'), 'text/css', 'all'));

        // Set Planner's Styles
        set_css_urls(array('stylesheet', base_url('assets/base/user/apps/collection/planner/styles/css/styles.css?ver=' . MIDRUB_BASE_USER_APPS_PLANNER_VERSION), 'text/css', 'all'));

        // Set FullCalendar's Js
        set_js_urls(array('//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js')); 

        // Set Emojion Area Js
        set_js_urls(array(base_url('assets/base/user/apps/collection/posts/js/emojionearea-master/dist/emojionearea.min.js?ver=' . MIDRUB_BASE_USER_APPS_PLANNER_VERSION)));

        // Set Planner's Js
        set_js_urls(array(base_url('assets/base/user/apps/collection/planner/js/main.js?ver=' . MIDRUB_BASE_USER_APPS_PLANNER_VERSION))); 

        if ( $this->CI->lang->line('calendar_language') ) {

            // Set translated FullCalendar's Js
            set_js_urls(array($this->CI->lang->line('calendar_language'))); 

        }
        
        // Define the accounts list valiable
        $accounts_list = '';

        // Define the groups list variable
        $groups_list = '';
        
        // Define the multimedia's categories
        $multimedia_categories = '';

        // Verify if user wants groups instead accounts
        if ( get_user_option('settings_display_groups') ) {

            // Load Lists Model
            $this->CI->load->model('lists');

            // Get the user lists
            $groups_list = $this->CI->lists->get_lists( $this->CI->user_id, 0, 'social', 10 );

        } else {

            // Get accounts list
            $accounts_list = (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->list_accounts_for_planner($this->CI->planner_networks_model->get_accounts( $this->CI->user_id, 0, 10 ));             

        }
        
        // Load the lists model
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_lists_model', 'planner_lists_model' );
        
        // Gets all categories
        $multimedia_categories = $this->CI->planner_lists_model->get_categories( $this->CI->user_id, 'storage' );
        
        // Set views params
        set_user_view(

            $this->CI->load->ext_view(
                MIDRUB_BASE_USER_APPS_PLANNER . 'views',
                'main',
                array(
                    'accounts_list' => $accounts_list,
                    'groups_list' => $groups_list,
                    'multimedia_categories' => $multimedia_categories
                ),
                true
            )

        );
        
    }

}
