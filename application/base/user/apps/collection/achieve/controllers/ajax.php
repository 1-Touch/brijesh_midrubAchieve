<?php
/**
 * Ajax Controller
 *
 * This file processes the app's ajax calls
 *
 * @author Brijesh
 * @package Midrub
 * @since 0.0.7.6
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Achieve\Controllers;

defined('BASEPATH') OR exit('No direct script access allowed');

// Define the namespaces to use
use MidrubBase\User\Apps\Collection\Achieve\Helpers as MidrubBaseUserAppsCollectionAchieveHelpers;

/*
 * Ajax class processes the app's ajax calls
 * 
 * @author Brijesh
 * @package Midrub
 * @since 0.0.7.6
 */
class Ajax {
    
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
     * The public method achieve_create_new_employee creates a new employee
     * 
     * @since 0.0.7.6
     * 
     * @return void
    */
    public function achieve_create_new_employee() {

        (new MidrubBaseUserAppsCollectionAchieveHelpers\Employees)->achieve_create_new_employee();
        
    }
    
    /**
     * The public method get_employees gets all employees
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function get_employees() {

        (new MidrubBaseUserAppsCollectionAchieveHelpers\Employees)->get_employees();
        
    }



    /**
     * The public method get_employee get employee data
     * 
     * @since 0.0.7.6
     * 
     * @return void
     */
    public function get_employee() {

        (new MidrubBaseUserAppsCollectionAchieveHelpers\Employees)->get_employee();
        
    }

    
    public function delete_employees() {

        
        // Delete transactions
        (new MidrubBaseUserAppsCollectionAchieveHelpers\Employees)->delete_employees();
        
    } 
        
}
