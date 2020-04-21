<?php
/**
 * Midrub Apps Demo
 *
 * This file loads the Demo app
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.6
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Demo;

// Define the constants
/*defined('BASEPATH') OR exit('No direct script access allowed');
defined('MIDRUB_BASE_USER_APPS_ACHIEVE') OR define('MIDRUB_BASE_USER_APPS_ACHIEVE', MIDRUB_BASE_USER . 'apps/collection/achieve/');
defined('MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION') OR define('MIDRUB_BASE_USER_APPS_ACHIEVE_VERSION', '0.0.592');
*/
// Define the namespaces to use
use MidrubBase\User\Interfaces as MidrubBaseUserInterfaces;
use MidrubBase\User\Apps\Collection\Demo\Controllers as MidrubBaseUserAppsCollectionDemoControllers;

/*
 * Main class loads the Achieve app loader
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.6
 */
class Main implements MidrubBaseUserInterfaces\Apps {
    
    /**
     * Class variables
     *
     * @since 0.0.7.6
     */
    protected
            $CI;

    /**
     * Initialise the Class
     *
     * @since 0.0.7.6
     */
    public function __construct() {
        
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
        
    }

    /**
     * The public method check_availability checks if the app is available
     *
     * @return boolean true or false
     */
    public function check_availability() {

        if ( !get_option('app_demo_enable') || !plan_feature('app_demo') || !team_role_permission('demo') ) {
            return false;
        } else {
            return true;
        }
        
    }
    
    /**
     * The public method user loads the app's main page in the user panel
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function user() {
        
        // Verify if the app is enabled
        /*if ( !get_option('app_achieve_enable') || !plan_feature('app_achieve') ) {
            show_404();
        }
        
        // Instantiate the class
        (new MidrubBaseUserAppsCollectionAchieveControllers\User)->view();*/
        
    }    

    /**
     * The public method ajax processes the ajax's requests
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function ajax() {

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
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function cron_jobs() {
        
    }
    
    /**
     * The public method delete_account is called when user's account is deleted
     * 
     * @param integer $user_id contains the user's ID
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function delete_account($user_id) {
        
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
                //$this->CI->lang->load('achieve_admin', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_ACHIEVE);

                // Verify which component is
                if ( ( md_the_component_variable('component') === 'user' ) && ( $this->CI->input->get('app', TRUE) === 'demo' ) ) {

                    // Require the Admin Inc
                    //md_include_component_file(MIDRUB_BASE_USER_APPS_ACHIEVE . 'inc/admin.php');
                    set_admin_app_options(

                        array (

                            array (
                                'type' => 'checkbox_input',
                                'slug' => 'app_demo_enable',
                                'label' => 'Enable App',
                                'label_description' =>'If is enabled demo'
                            )/*, array (
                                'type' => 'checkbox_input',
                                'slug' => 'app_demo_enable_url_download',
                                'label' => 'Enable App',
                                'label_description' => 'If is enabled demo'
                            )*/
                            
                        )

                    );

                } else if ( ( md_the_component_variable('component') === 'user' ) && ( md_the_component_variable('component_display') === 'plans' ) ) {

                    // Require the Plans Inc
                    //md_include_component_file(MIDRUB_BASE_USER_APPS_ACHIEVE . 'inc/plans.php');
                    set_plans_options(

                        array(
                            'name' => 'Demo',
                            'icon' => '<i class="fab fa-apple"></i>',
                            'slug' => 'demo',
                            'fields' => array(

                                array (
                                    'type' => 'checkbox_input',
                                    'slug' => 'app_demo',
                                    'label' => 'Enable App',
                                    'label_description' => 'If is enabled demo'
                                )

                            )

                        )

                    );

                }

                break;

            case 'user_init':

                // Verify which component is
                /*if ( md_the_component_variable('component') === 'team' ) {

                    if ( get_option('app_achieve_enable') && plan_feature('app_achieve') ) {

                        // Load the app's language files
                        $this->CI->lang->load('achieve_member', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_ACHIEVE);

                        // Require the Permissions Inc
                        md_include_component_file(MIDRUB_BASE_USER_APPS_ACHIEVE . 'inc/members.php');

                    }

                }*/

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
     * @since 0.0.7.6
     * 
     * @return array with app's information
     */
    public function app_info() {
        
        // Load the app's language files
        //$this->CI->lang->load( 'achieve_user', $this->CI->config->item('language'), FALSE, TRUE, MIDRUB_BASE_USER_APPS_ACHIEVE);
        
        // Return app information
        return array(
            'app_name' => 'Demo',
            'app_slug' => 'demo',
            'app_icon' => '<i class="fab fa-apple"></i>',
            'version' => '1.0',
            'min_version' => '0.0.7.9',
            'max_version' => '0.0.7.9',
        );
        
    }

}
