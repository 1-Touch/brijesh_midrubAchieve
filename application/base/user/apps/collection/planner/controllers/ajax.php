<?php
/**
 * Ajax Controller
 *
 * This file processes the app's ajax calls
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner\Controllers;

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the namespaces to use
use MidrubBase\User\Apps\Collection\Planner\Helpers as MidrubBaseUserAppsCollectionPlannerHelpers;

/*
 * Ajaz class processes the app's ajax calls
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */
class Ajax {
    
    /**
     * Class variables
     *
     * @since 0.0.7.5
     */
    protected $CI;

    /**
     * Initialise the Class
     *
     * @since 0.0.7.5
     */
    public function __construct() {
        
        // Get codeigniter object instance
        $this->CI =& get_instance();

        // Load the app's models
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_posts_model', 'planner_posts_model' );
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_networks_model', 'planner_networks_model' );
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_planifications_model', 'planner_planifications_model' );
        
    }
    
    /**
     * The public method account_manager_load_networks loads available social networks
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_load_networks() {
        
        // Get available social networks
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Account_manager)->load_networks();
        
    }
    
    /**
     * The public method planner_display_all_posts will display posts with pagination
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_display_all_posts() {
        
        // Display all posts with the Posts Helper
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_display_all_posts();
        
    }
    
    /**
     * The public method planner_save_post saves a post
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_post() {
        
        /*echo "<pre>"; print_r($_POST); 
        die;*/


        // Save a post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_save_post();
        
    }
    
    /**
     * The public method planner_delete_post_by_id deletes a post by id
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_post_by_id() {
        
        // Save a post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_delete_post_by_id();
        
    }  
    
    /**
     * The public method upload_csv uploads a csv
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function upload_csv() {
        
        // Verify if CSV import is enabled
        if ( get_option('app_planner_enable_csv_import') ) {
        
            // Save a post
            (new MidrubBaseUserAppsCollectionPlannerHelpers\Csv)->upload_csv();
        
        }
        
    }

    /**
     * The public method export_csv downloads a CSV's example
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function export_csv() {
        
        // Save a post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Csv)->export_csv();
        
    }
    
    /**
     * The public method planner_add_planification_posts adds posts to a planification
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_add_planification_posts() {
        
        // Save a post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_add_planification_posts();
        
    }
    
    /**
     * The public method planner_save_posts saves posts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_posts() {
        
        // Save a post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_save_posts();
        
    }
    
    /**
     * The public method planner_planify_display_all_posts will display planify's posts with pagination
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_display_all_posts() {
        
        // Display all posts with the Posts Helper
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_planify_display_all_posts();
        
    }
    
    /**
     * The public method planner_planify_delete_post deletes planify's posts
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_delete_post() {
        
        // Delete the selected post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_planify_delete_post();
        
    }
    
    /**
     * The public method planner_planner_planify_edit_post edits planify's posts
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_edit_post() {
        
        // Delete the selected post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_planify_edit_post();
        
    }
    
    /**
     * The public method planner_planify_delete_post_media delete post's media
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_delete_post_media() {
        
        // Delete the selected post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_planify_delete_post_media();
        
    }
    
    /**
     * The public method planner_planify_add_post_media add post's media
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_add_post_media() {
        
        // Delete the selected post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_planify_add_post_media();
        
    }
    
    /**
     * The public method planner_update_a_post updates a post
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_update_a_post() {
        
        // Delete the selected post
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Posts)->planner_update_a_post();
        
    }
    
    /**
     * The public method account_manager_get_accounts gets accounts by social network
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_get_accounts() {
        
        // Get accounts by social networks
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Account_manager)->get_accounts();
        
    }
    
    /**
     * The public method account_manager_search_for_accounts search accounts by key and network
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_search_for_accounts() {
        
        // Search accounts
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->search_accounts();
        
    } 
    
    /**
     * The public method account_manager_delete_accounts delete an account
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_delete_accounts() {
        
        // Delete accounts
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->delete_accounts();
        
    }
    
    /**
     * The public method account_manager_create_accounts_group creates a new group
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_create_accounts_group() {
        
        // Create a new group
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Groups)->save_group();
        
    }
    
    /**
     * The public method accounts_manager_groups_available_accounts gets all available group's accounts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function accounts_manager_groups_available_accounts() {
        
        // Gets available group accounts
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Groups)->available_group_accounts();
        
    }
    
    /**
     * The public method accounts_manager_groups_delete_group deletes a group
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function accounts_manager_groups_delete_group() {
        
        // Delete group 
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Groups)->delete_group();
        
    }
    
    /**
     * The public method account_manager_add_account_to_group adds account to group
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_add_account_to_group() {
        
        // Add account
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Groups)->add_account();
        
    }
    
    /**
     * The public method account_manager_remove_account_from_group removes accounts from a group
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function account_manager_remove_account_from_group() {
        
        // Remove account
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Groups)->remove_account();
        
    }
    
    /**
     * The public method planner_search_accounts gets accounts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_search_accounts() {
        
        // Gets accounts
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->planner_search_accounts();
        
    }
    
    /**
     * The public method planner_search_groups gets groups
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_search_groups() {
        
        // Gets accounts
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->planner_search_groups();
        
    }    
    
    /**
     * The public method planner_save_planification saves a planification
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_planification() {
        
        // Save planification
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_save_planification();
        
    } 
    
    /**
     * The public method planner_display_all_planifications gets the planifications
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_display_all_planifications() {
        
        // Display all planification
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_display_all_planifications();
        
    }
    
    /**
     * The public method planner_get_planification gets planifications
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_get_planification() {
        
        // Get planification's data
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_get_planification();
        
    }
    
    /**
     * The public method planner_delete_planification_rule_meta deletes planification rule's meta
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_planification_rule_meta() {
        
        // Delete planification rule meta
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_delete_planification_rule_meta();
        
    } 
    
    /**
     * The public method planner_delete_planification deletes a planification
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_planification() {
        
        // Delete planification rule meta
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_delete_planification();
        
    }
    
    /**
     * The public method planner_get_all_planifications gets all planifications
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_get_all_planifications() {
        
        // Gets all User's planifications
        (new MidrubBaseUserAppsCollectionPlannerHelpers\Planify)->planner_get_all_planifications();
        
    }
    
}
