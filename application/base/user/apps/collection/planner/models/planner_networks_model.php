<?php
/**
 * Planner Networks Model
 *
 * PHP Version 5.6
 *
 * Planner Networks Model contains the Networks Model
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
 * Planner_networks_model class - operates the networks table.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Planner_networks_model extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'networks';

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
     * The public method get_accounts gets social networks accounts from database
     *
     * @param integer $user_id contains the user id
     * @param integer $start contains the page number
     * @param integer $limit displays the limit of displayed accounts
     * @param string $key contains the search key
     * @param integer $option contains the display option
     * 
     * @since 0.0.7.0
     * 
     * @return object with accounts or false
     */    
    public function get_accounts( $user_id, $start=0, $limit=0, $key = NULL, $option = 0 ) {
        
        $classes = array();

        // List all available networks
        foreach ( glob( MIDRUB_BASE_USER . 'networks/*.php' ) as $filename ) {

            // Get the class's name
            $className = str_replace(array(MIDRUB_BASE_USER . 'networks/', '.php'), '', $filename);

            // Check if the administrator has disabled the $className social network
            if ( !get_option($className) || !plan_feature($className) ) {
                continue;
            }

            // Create an array
            $array = array(
                'MidrubBase',
                'User',
                'Networks',
                ucfirst($className)
            );

            // Implode the array above
            $cl = implode('\\', $array);

            // Get method
            $get = (new $cl());

            // Verify if the social networks is available
            if ( $get->check_availability() ) {

                // Get network's info
                $info = $get->get_info();

                if ( $option === 1 ) {
                    
                    if ( in_array('insights', $info['types']) ) {
                        $classes[] = $className;
                    }
                    
                } else if ( $option === 2 ) {

                    if ( in_array('insights', $info['types']) ) {
                        $classes[] = $className;
                    }                    
                    
                } else {
                    
                    if ( in_array('post', $info['types']) ) {
                        $classes[] = $className;
                    }                    
                    
                }

            }
            
        }
        
        if ( !$classes ) {
            return false;
        }
        
        if ( $key ) {
            $this->db->select('*');
        } else {
            $this->db->select('networks.network_id,networks.network_name,networks.user_name,networks.net_id,networks.user_avatar,networks.expires,networks.token,networks.secret,networks.api_key,networks.api_secret,COUNT(case posts_meta.meta_id when null then 1 else posts_meta.meta_id end) AS num');
        }
        
        $this->db->from($this->table);
        
        if ( !$key ) {
            $this->db->join('posts_meta', 'networks.network_id=posts_meta.network_id', 'left');
        }
        
        $this->db->where("(UNIX_TIMESTAMP(networks.expires) > '" . time() . "' OR LENGTH(networks.expires) < '5') AND networks.user_id='" . $user_id . "'", NULL, FALSE); 

        if ( $classes ) {

            $this->db->where_in( 'networks.network_name', $classes );
        
        } else {
            
            return false;
            
        }
        
        if ( $key ) {
            
            // This method allows to escape special characters for LIKE conditions
            $key = $this->db->escape_like_str($key);
            
            // Gets posts which contains the $key
            $this->db->like('user_name', $key);

        } else {
            $this->db->group_by('networks.network_id');
            $this->db->order_by('num', 'desc');
        }
        
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
     * The public method get_accounts_by_network gets network's accounts
     *
     * @param integer $user_id contains the user id
     * @param integer $network_name contains the network's name
     * @param integer $active contains the active status
     * @param string $key contains the search key
     * 
     * @since 0.0.7.0
     * 
     * @return object with accounts or false
     */    
    public function get_accounts_by_network( $user_id, $network_name, $active, $key = NULL ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        
        if ( $key ) {
            
            // This method allows to escape special characters for LIKE conditions
            $key = $this->db->escape_like_str($key);

            $this->db->where("(user_id = '" . $user_id . "') AND (user_name LIKE '%" . $key . "%') AND (UNIX_TIMESTAMP(expires) > '" . time() . "' OR LENGTH(expires) < '5') AND network_name='" . $network_name . "'", NULL, FALSE);

        } else {
            
            if ( $active ) {

                $this->db->where("(user_id = '" . $user_id . "') AND (UNIX_TIMESTAMP(expires) > '" . time() . "' OR LENGTH(expires) < '5') AND network_name='" . $network_name . "'", NULL, FALSE); 

            } else {
                
                $this->db->where("(user_id = '" . $user_id . "') AND (UNIX_TIMESTAMP(expires) < '" . time() . "' AND LENGTH(expires) > '5') AND network_name='" . $network_name . "'", NULL, FALSE);
                
            }
            
        }
        
        $this->db->order_by('network_id', 'desc');
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
                
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_account gets accounts by network_id
     *
     * @param integer $network_id contains the network_id
     * 
     * @since 0.0.7.0
     * 
     * @return object with account data or false
     */    
    public function get_account( $network_id ) {
        
	$this->db->select('*');
	$this->db->from($this->table);
	$this->db->where('network_id', $network_id);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method get_network_data checks if user are connected to $network
     *
     * @param string $networks contains the network's name
     * @param integer $network_id contains the network id from the DB
     * @param integer $user_id contains the user id
     * 
     * @return object with network data or false
     */
    public function get_network_data( $network, $user_id, $network_id=null ) {
        
        $this->db->select('network_id,net_id,network_name,user_name,expires,user_avatar,token,secret,api_key,api_secret,COUNT(network_name) AS num');
        $this->db->from($this->table);
        
        if ( $network_id != null ) {
            
            $this->db->where(array(
                'network_name'=>strtolower($network),
                'user_id'=>$user_id,
                'network_id'=>$network_id
            ));
            
        } else {
            
            $this->db->where(array(
                'network_name'=>strtolower($network),
                'user_id'=>$user_id
            ));
            
        }
        
        $this->db->group_by(['network_name']);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();
            return $result;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_network will delete a network account from the database
     *
     * @param integer $account_id contains the id account
     * @param integer $user_id contains the user id
     * 
     * @since 0.0.7.0
     * 
     * @return boolean true or false
     */
    public function delete_network( $account_id, $user_id ) {
        
        if ( $account_id == 'all' ) {
            
            // Delete all social networks connections
            $this->db->delete($this->table, array('user_id' => $user_id));
            
        } else {
            
            // Delete the $name social network's connection
            $this->db->delete($this->table, array('network_id' => $account_id, 'user_id' => $user_id));
            
        }
        
        if ( $this->db->affected_rows() ) {
            
            // Delete all post's records
            run_hook(
                'delete_network_account',
                array(
                    'account_id' => $account_id
                )
            );
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    
    /**
     * The public method if_posts_has_the_meta checks if the post has the meta
     *
     * @param integer $post contains the current post_id
     * @param integer $network_id contains the network_id
     * 
     * @since 0.0.7.0
     * 
     * @return boolean true or false
     */    
    public function if_posts_has_the_meta($post,$net) {
	
        $this->db->select('*');
        $this->db->from('posts_meta');
        $this->db->where(array(
            'post_id' => $post,
            'network_id' => $net
        ));
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {

            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_account_records deletes the account records
     * 
     * @param integer $user_id contains user_id
     * @param integer $account_id contains the account's id
     * 
     * @return void
     */
    public function delete_account_records( $user_id, $account_id ) {
        
        // Set data
        $data = array(
            'network_id' => $account_id
        );

        // Delete rule
        $this->db->delete('planner_planifications_networks', $data);
        
    }
 
}

/* End of file planner_networks_model.php */