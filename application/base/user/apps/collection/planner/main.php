<?php
/**
 * Midrub Apps Planner
 *
 * This file loads the Planner app
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner;

// Define the constants
defined('BASEPATH') OR exit('No direct script access allowed');
defined('MIDRUB_BASE_USER_APPS_PLANNER') OR define('MIDRUB_BASE_USER_APPS_PLANNER', MIDRUB_BASE_USER . 'apps/collection/planner/');
defined('MIDRUB_BASE_USER_APPS_PLANNER_VERSION') OR define('MIDRUB_BASE_USER_APPS_PLANNER_VERSION', '0.0.8');

// Define the namespaces to use
use MidrubBase\User\Interfaces as MidrubBaseUserInterfaces;
use MidrubBase\User\Apps\Collection\Planner\Controllers as MidrubBaseUserAppsCollectionPlannerControllers;

/*
 * Main class loads the Inbox app loader
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */
class Main implements MidrubBaseUserInterfaces\Apps {
    
    /**
     * Class variables
     *
     * @since 0.0.7.5
     */
    protected
            $CI;

    /**
     * Initialise the Class
     *
     * @since 0.0.7.5
     */
    public function __construct() {
        
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        
        // Load language
        $this->CI->lang->load( 'planner_user', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_PLANNER);
        
    }

    /**
     * The public method check_availability checks if the app is available
     *
     * @return boolean true or false
     */
    public function check_availability() {

        if ( !get_option('app_planner_enable') || !plan_feature('app_planner') || !team_role_permission('planner') ) {
            return false;
        } else {
            return true;
        }
        
    }
    
    /**
     * The public method user loads the app's main page in the user panel
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function user() {
        
        // Verify if the app is enabled
        if ( !get_option('app_planner_enable') || !plan_feature('app_planner') ) {
            show_404();
        }
        
        // Instantiate the class
        (new MidrubBaseUserAppsCollectionPlannerControllers\User)->view();
        
    }
    
    /**
     * The public method ajax processes the ajax's requests
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function ajax() {

        // Verify if the app is enabled
        if ( !get_option('app_planner_enable') || !plan_feature('app_planner') ) {
            exit();
        }        
        
        // Get action's get input
        $action = $this->CI->input->get('action');

        if ( !$action ) {
            $action = $this->CI->input->post('action');
        }
        
        try {
            
            // Call method if exists
            (new MidrubBaseUserAppsCollectionPlannerControllers\Ajax)->$action();
            
        } catch (Exception $ex) {
            
            $data = array(
                'success' => FALSE,
                'message' => $ex->getMessage()
            );
            
            echo json_encode($data);
            
        }
        
    }

    /**
     * The public method rest processes the rest's requests
     * 
     * @param string $endpoint contains the requested endpoint
     * 
     * @since 0.0.7.9
     * 
     * @return void
     */
    public function rest($endpoint) {

    }
    
    /**
     * The public method cron_jobs loads the cron jobs commands
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function cron_jobs() {

        // Verify if the app is enabled
        if ( get_option('app_planner_enable') ) {

            // Schedule posts
            (new MidrubBaseUserAppsCollectionPlannerControllers\Cron)->schedule_posts();

        } 
        
    }
    
    /**
     * The public method delete_account is called when user's account is deleted
     * 
     * @param integer $user_id contains the user's ID
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function delete_account($user_id) {
        
        // Load the Plannification Model
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_planifications_model', 'planner_planifications_model' );
        
        // Delete user's planner data
        $this->CI->planner_planifications_model->delete_user_planner_data($user_id);
        
    }
    
    /**
     * The public method hooks contains the app's hooks
     *
     * @param string $category contains the hooks category
     *
     * @since 0.0.7.9
     *
     * @return void
     */
    public function load_hooks( $category ) {
        
        // Load and run hooks based on category
        switch ( $category ) {
                
            case 'admin_init':
                
                // Load the admin app's language files
                $this->CI->lang->load('planner_admin', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_PLANNER);
                
                // Verify which component is
                if ( ( md_the_component_variable('component') === 'user' ) && ( $this->CI->input->get('app', TRUE) === 'planner' ) ) {
                    
                    // Require the Admin Inc
                    get_the_file(MIDRUB_BASE_USER_APPS_PLANNER . 'inc/admin.php');
                    
                } else if ( ( md_the_component_variable('component') === 'user' ) && ( md_the_component_variable('component_display') === 'plans' ) ) {
                    
                    // Require the Plans Inc
                    get_the_file(MIDRUB_BASE_USER_APPS_PLANNER . 'inc/plans.php');
                    
                }
                
                break;

            case 'user_init':

                // Load the app's language files
                $this->CI->lang->load('planner_member', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_PLANNER);

                // Verify which component is
                if ( md_the_component_variable('component') === 'settings' ) {

                    // Require the User Inc
                    get_the_file(MIDRUB_BASE_USER_APPS_PLANNER . 'inc/user.php');

                } else if ( md_the_component_variable('component') === 'team' ) {

                    if ( get_option('app_planner_enable') && plan_feature('app_planner') ) {

                        // Require the Permissions Inc
                        get_the_file(MIDRUB_BASE_USER_APPS_PLANNER . 'inc/members.php');

                    }

                }

                // Load the Models used in the Planner
                $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_planifications_model', 'planner_planifications_model' );
                $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_lists_model', 'planner_lists_model' );
                $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_networks_model', 'planner_networks_model' );

                // Add hook in the queue
                add_hook(
                    'delete_social_post',
                    function ($args) {

                        // Delete the post's records
                        $this->CI->planner_planifications_model->delete_post_records( $args['post_id'] );

                    }
                );

                // Add hook in the queue
                add_hook(
                    'delete_network_group',
                    function ($args) {

                        // Delete the group's records
                        $this->CI->planner_lists_model->delete_group_records( $this->CI->user_id, $args['group_id'] );

                    }
                ); 
                
                // Add hook in the queue
                add_hook(
                    'delete_media_category',
                    function ($args) {

                        // Delete the category's records
                        $this->CI->planner_lists_model->delete_category_records( $this->CI->user_id, $args['list_id'] );

                    }
                );

                // Add hook in the queue
                add_hook(
                    'delete_network_account',
                    function ($args) {

                        // Delete the network's records
                        $this->CI->planner_networks_model->delete_account_records( $this->CI->user_id, $args['account_id'] );

                    }
                );                

                break;

                
        }
        
    }
    
    /**
     * The public method guest contains the app's access for guests
     *
     * @since 0.0.7.9
     *
     * @return void
     */
    public function guest() {
        
        // Display 404 page
        show_404();
        
    }
    
    /**
     * The public method app_info contains the app's info
     * 
     * @since 0.0.7.5
     * 
     * @return array with app's information
     */
    public function app_info() {
        
        // Load the app's language files
        $this->CI->lang->load( 'planner_user', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_PLANNER);
        
        // Return app information
        return array(
            'app_name' => $this->CI->lang->line('planner'),
            'app_slug' => 'planner',
            'app_icon' => '<i class="icon-calendar"></i>',
            'version' => MIDRUB_BASE_USER_APPS_PLANNER,
            'min_version' => '0.0.7.9',
            'max_version' => '0.0.7.9'
        );
        
    }

}

/* End of file main.php */
