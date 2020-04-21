<?php
/**
 * Employees Helpers
 *
 * This file contains the class employees
 * with methods to process the employees data
 *
 * @author Brijesh
 * @package Midrub
 * @since 0.0.7.6
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Achieve\Helpers;

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Employees class provides the methods to process the employees data
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.6
*/
class Employees {
    
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
        
        // Load the lists model
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_ACHIEVE . 'models/', 'Achieve_lists_model', 'achieve_lists_model' );
        
    }
    
    /**
     * The public method achieve_create_new_employee creates a new employee
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */ 
    public function achieve_create_new_employee() {

        // Check if data was submitted
        if ($this->CI->input->post()) {

            $this->CI->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->CI->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->CI->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->CI->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required');

            
            // Get data
            $employee_id = $this->CI->input->post('employee_id');
            $first_name = $this->CI->input->post('first_name');
            $last_name = $this->CI->input->post('last_name');
            $email = $this->CI->input->post('email');
            $phone_number = $this->CI->input->post('phone_number');


            // Create a new employee
            $save_employee = $this->CI->achieve_lists_model->save_employee($employee_id, $first_name, $last_name, $email, $phone_number);
            
            if ( $save_employee != FALSE ) {

                if($save_employee == "created"){
                    $createUpdate = "Employee record was created";
                    $status = 0;
                } else {
                    $createUpdate = "Employee record was updated";
                    $status = 1;
                }
                 $data = array(
                    'success' => TRUE,
                    'message' => $createUpdate,
                    'status' => $status
                );

                echo json_encode($data);
            
            } else {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('employee_was_not_saved')
                );
                echo json_encode($data); 
            }    
        }
        
    }
    
    /**
     * The public method get_employees gets employees
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */ 
    public function get_employees() {

        // Gets all employees
        $all_employees= $this->CI->achieve_lists_model->get_employees();

        if ( $all_employees ) {

            $data = array(
                'success' => TRUE,
                'employees' => $all_employees
            );

            echo json_encode($data); 

        } else {

            $data = array(
                'success' => FALSE
            );

            echo json_encode($data); 

        }
        
    }  
    
    /**
     * The public method delete_employees deletes delete_employees
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */ 
    public function delete_employees() {
        
        // Get employee_id input
        $employee_id = $this->CI->input->get('employee_id', TRUE);
        
        // Check if data was submitted
        if ($employee_id) {

            if ( $this->CI->achieve_lists_model->delete_employee($employee_id) ) {

                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('employee_was_deleted')
                    );

                    echo json_encode($data);

                } else {

                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('employee_was_not_deleted')
                    );

                    echo json_encode($data);    
            }

            exit();
            
        }
        
        $data = array(
            'success' => FALSE,
            'message' => $this->CI->lang->line('error_occurred')
        );

        echo json_encode($data);         
        
    } 

    /**
     * The public method get_employee deletes get_employee
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */ 
    public function get_employee() {
        
        // Get employee_id input
        $employee_id = $this->CI->input->get('employee_id', TRUE);
        
        // Check if data was submitted
        if ($employee_id) {

            if ( $this->CI->achieve_lists_model->get_employee($employee_id) ) {

                    $employee_data= $this->CI->achieve_lists_model->get_employee($employee_id);

                    $data = array(
                        'success' => TRUE,
                        'employee' => $employee_data
                    );

                    echo json_encode($data);

                } else {

                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('employee_was_not_deleted')
                    );

                    echo json_encode($data);    
            }

            exit();
            
        }
        
        $data = array(
            'success' => FALSE,
            'message' => $this->CI->lang->line('error_occurred')
        );

        echo json_encode($data);         
        
    }
    
    
}

