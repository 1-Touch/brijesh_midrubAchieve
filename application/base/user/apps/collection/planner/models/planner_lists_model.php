<?php
/**
 * Planner Lists Model
 *
 * PHP Version 5.6
 *
 * Planner Lists Model contains the Planner Lists Model
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Planner_lists_model class - operates the lists table.
 *
 * @since 0.0.7.5
 * 
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Planner_lists_model extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'lists';

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
     * The public method save_group creates a list
     *
     * @param integer $user_id contains the user_id
     * @param string $type contains the list's type
     * @param string $name contains the list's name
     * @param string $description contains the list's description
     * 
     * @return integer with last inserted id or false
     */
    public function save_group( $user_id, $type, $name, $description ) {
        
        // Get current time
        $created = time();
        
        // Set data
        $data = array(
            'user_id' => $user_id,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'created' => $created
        );
        
        // Insert data
        $this->db->insert($this->table, $data);
        
        if ( $this->db->affected_rows() ) {
            
            // Return last inserted ID
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_group_account saves an account in the group
     *
     * @param integer $group_id contains the group's id 
     * @param integer $user_id contains the user's id
     * @param integer $account_id contains the account's id
     * 
     * @return integer with last inserted id or false
     */
    public function save_group_account( $group_id, $user_id, $account_id ) {
        
        // Set data
        $data = array(
            'list_id' => $group_id,
            'user_id' => $user_id,
            'body' => $account_id
        );
        
        // Insert data
        $this->db->insert('lists_meta', $data);
        
        if ( $this->db->affected_rows() ) {
            
            // Return last inserted ID
            return $this->db->insert_id();
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method remove_group_account removes account from a group
     *
     * @param integer $group_id contains the group's id 
     * @param integer $user_id contains the user's id
     * @param integer $account_id contains the account's id
     * 
     * @return boolean true or false
     */
    public function remove_group_account( $group_id, $user_id, $account_id ) {
        
        // Set data
        $data = array(
            'list_id' => $group_id,
            'user_id' => $user_id,
            'body' => $account_id
        );
        
        $this->db->delete('lists_meta', $data);
        
        if ( $this->db->affected_rows() ) {
            
            // Return true
            return true;
            
        } else {
            
            return false;
            
        }
        
    }    
    
    /**
     * The public method get_groups gets social groups from database
     *
     * @param integer $user_id contains the user id
     * @param integer $start contains the page number
     * @param integer $limit displays the limit of displayed accounts
     * @param string $key contains the search key
     * 
     * @return object with groups or false
     */    
    public function get_groups( $user_id, $start=0, $limit=0, $key = NULL) {

        $this->db->select('*');
        $this->db->from($this->table);
        
        $this->db->where(array(
            'user_id' => $user_id,
            'type' => 'social'
        ));
            
        // This method allows to escape special characters for LIKE conditions
        $key = $this->db->escape_like_str($key);

        // Gets posts which contains the $key
        $this->db->like('name', $key);
        
        if ( $limit ) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            if ( $limit > 0 ) {
                $result = $query->result();
                return $result;
            } else {
                return $query->num_rows();
            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_lists_meta gets all list's meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $list contains the list's ID
     * 
     * @return object with results or false
     */
    public function get_lists_meta( $user_id, $list ) {
            
        $this->db->select('lists_meta.meta_id,networks.network_id,networks.expires,networks.network_name,networks.user_id,networks.user_name');
        $this->db->from('lists_meta');
        $this->db->join('networks', 'lists_meta.body=networks.network_id', 'left');
        $this->db->where(array('lists_meta.user_id' => $user_id, 'lists_meta.list_id' => $list));
        $this->db->order_by('lists_meta.meta_id', 'desc');        
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ) {

            $result = $query->result();
            return $result;

        } else {

            return false;

        }
        
    }
    
    /**
     * The public method get_random_meta gets one random meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $list contains the list's ID
     * 
     * @return object with results or false
     */
    public function get_random_meta( $user_id, $list ) {
            
        $this->db->select('lists_meta.body, media.type');
        $this->db->from('lists_meta');
        $this->db->join('media', 'lists_meta.body=media.media_id', 'left');
        $this->db->where(
            array(
                'lists_meta.user_id' => $user_id,
                'lists_meta.list_id' => $list
            )
        );
        
        $this->db->order_by('lists_meta.body', 'RANDOM');
        $this->db->limit(1);   
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ) {

            $result = $query->result();
            return $result;

        } else {

            return false;

        }
        
    }    
    
    /**
     * The public method get_categories gets all media's categories
     *
     * @param integer $user_id contains the user id
     * @param string $type contains the list's type
     * 
     * @return object with groups or false
     */    
    public function get_categories( $user_id, $type ) {

        $this->db->select('*');
        $this->db->from($this->table);
        
        $this->db->where(array(
            'user_id' => $user_id,
            'type' => $type
        ));
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_list deletes a list by $list_id
     *
     * @param integer $user_id contains the user_id
     * @param integer $list_id contains the list's ID
     * @param string $type contains the list's type
     * 
     * @return boolean true or false
     */
    public function delete_list( $user_id, $list_id, $type ) {
        
        $this->db->delete($this->table, array('list_id' => $list_id, 'user_id' => $user_id, 'type' => $type));
        
        if ( $this->db->affected_rows() ) {
            
            // Delete all group's records
            run_hook(
                'delete_network_group',
                array(
                    'group_id' => $list_id
                )
            );
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method if_item_is_in_list check if the item already exists
     *
     * @param integer $user_id contains the user_id
     * @param integer $list contains the list's ID
     * @param string $item contains the account id
     * 
     * @return boolean true or false
     */
    public function if_item_is_in_list( $user_id, $list, $item ) {
        
        // Verify if list's meta exists
        $this->db->select('*');
        $this->db->from('lists_meta');
        $this->db->where(array('user_id' => $user_id, 'list_id' => $list, 'body' => $item));
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method if_item_is_in_list check if the item already exists
     *
     * @param integer $user_id contains the user_id
     * @param integer $list contains the list's ID
     * @param string $type contains the list's type
     * 
     * @return boolean true or false
     */
    public function if_user_has_list( $user_id, $list, $type ) {
        
        $this->db->select('*');
        $this->db->from('lists');
        $this->db->where(array('user_id' => $user_id, 'list_id' => $list, 'type' => $type));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_group_records deletes all group's records
     * 
     * @param integer $user_id contains user_id
     * @param integer $group_id contains the group's id
     * 
     * @return void
     */
    public function delete_group_records( $user_id, $group_id ) {
        
        $this->db->select('planification_id');
        $this->db->from('planner_planifications');
        $this->db->where(array('user_id' => $user_id, 'group_id' => $group_id));
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $results = $query->result();
            
            foreach ( $results as $result ) {
                
                $this->db->where(array(
                        'planification_id' => $result->planification_id
                    )
                );
                
                $this->db->update('planner_planifications', array('group_id' => '0'));
                
            }
            
        }
        
    }
    
    /**
     * The public method delete_category_records deletes all category's records
     * 
     * @param integer $user_id contains user_id
     * @param integer $category_id contains the category's id
     * 
     * @return void
     */
    public function delete_category_records( $user_id, $category_id ) {
        
        $this->db->select('planification_id');
        $this->db->from('planner_planifications');
        $this->db->where(array('user_id' => $user_id, 'category_id' => $category_id));
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $results = $query->result();
            
            foreach ( $results as $result ) {
                
                $this->db->where(array(
                        'planification_id' => $result->planification_id
                    )
                );
                
                $this->db->update('planner_planifications', array('category_id' => '0'));
                
            }
            
        }
        
    }
 
}

/* End of file planner_lists_model.php */