<?php
/**
 * Storage Lists Model
 *
 * PHP Version 5.6
 *
 * Storage Lists Model contains the Storage Lists Model
 *
 * @category Social
 * @package  Midrub
 * @author   Brijesh
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined('BASEPATH') ) {
    exit('No direct script access allowed');
}

/**
 * Achieve_lists_model class - operates the lists table.
 *
 * @since 0.0.7.6
 * 
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Achieve_lists_model extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'employees';

    /**
     * Initialise the model
     */
    public function __construct() {
        
        // Call the Model constructor
        parent::__construct();
        
        // Set the tables value
        $this->tables = $this->config->item('tables', $this->table);
        
    }
    
    /**
     * The public method save_employee creates an employee
     *
     * @param integer $user_id contains the user_id
     * @param string $type contains the list's type
     * @param string $name contains the list's name
     * @param string $description contains the list's description
     * 
     * @return integer with last inserted id or false
     */
    public function save_employee($employee_id, $first_name, $last_name, $email, $phone_number) {
        // Set data
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number
        );


        if($employee_id > 0){
            $params = array(
                'employee_id' => $employee_id
            );
            $this->db->where($params);
            $this->db->update($this->table, $data);
        } else {
            // Insert data
            $this->db->insert($this->table, $data);
        }

        if ( $this->db->affected_rows() ) {

             if($employee_id > 0){
                return "updated";
             } else {
                // Return last inserted ID
                return "created";
             }
            
            
            
        } else {
   
            return false;
            
        }
        
    }

    /**
     * The public method get_employees gets all employees
     *
     * @param integer $user_id contains the user id
     * @param string $type contains the list's type
     * 
     * @return object with groups or false
     */    
    public function get_employees() {

        $this->db->select('*');
        $this->db->from($this->table);
        
        $query = $this->db->get();
        //echo "<pre>"; print_r($query); 
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            //echo "<pre>"; print_r($result); die;
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_employee gets employee data
     *
     * @param integer $user_id contains the user id
     * @param string $type contains the list's type
     * 
     * @return object with groups or false
     */    
    public function get_employee($employee_id) {

        $this->db->select('*');
        $this->db->from($this->table);
        
        $this->db->where(array(
            'employee_id' => $employee_id,
        ));
        
        $query = $this->db->get();
        //echo "<pre>"; print_r($query); 
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            //echo "<pre>"; print_r($result); die;
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_employee deletes an employee
     *
     * @param integer $user_id contains the user_id
     * @param integer $list_id contains the list's ID
     * @param string $type contains the list's type
     * 
     * @return boolean true or false
     */
    public function delete_employee($employee_id) {
        
        $this->db->delete($this->table, array(
                'employee_id' => $employee_id,
            )
        );
        
        if ($this->db->affected_rows()) {
            return true;
            
        } else {
            return false;
        }
        
    }

}

/* End of file Achieve_lists_model.php */