<?php
/**
 * Planner Planifications Model
 *
 * PHP Version 5.6
 *
 * Planner_planifications_model file contains the Planner Planifications Model
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
 * Planner_planifications_model class - operates the planner_planifications table.
 *
 * @since 0.0.7.5
 * 
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Planner_planifications_model extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'planner_planifications';

    /**
     * Initialise the model
     */
    public function __construct() {
        
        // Call the Model constructor
        parent::__construct();
        
        $planner_planifications = $this->db->table_exists('planner_planifications');
        
        if ( !$planner_planifications ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_planifications` (
                              `planification_id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `user_id` bigint(20) NOT NULL,
                              `title` varchar(250) NOT NULL,
                              `group_id` bigint(20) NOT NULL,
                              `category_id` bigint(20) NOT NULL,
                              `created` varchar(30) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        $planifications = $this->db->list_fields('planner_planifications');
        
        if ( !in_array('category_id', $planifications) ) {
            
            $this->db->query('ALTER TABLE `planner_planifications` ADD category_id BIGINT(20) AFTER group_id');
            
        }
        
        $planner_planifications_posts = $this->db->table_exists('planner_planifications_posts');
        
        if ( !$planner_planifications_posts ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_planifications_posts` (
                              `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `planification_id` bigint(20) NOT NULL,
                              `post_id` bigint(20) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        $planner_planifications_networks = $this->db->table_exists('planner_planifications_networks');
        
        if ( !$planner_planifications_networks ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_planifications_networks` (
                              `id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `planification_id` bigint(20) NOT NULL,
                              `network_id` bigint(20) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        $planner_planifications_rules = $this->db->table_exists('planner_planifications_rules');
        
        if ( !$planner_planifications_rules ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_planifications_rules` (
                              `rule_id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `user_id` bigint(20) NOT NULL,
                              `planification_id` bigint(20) NOT NULL,
                              `date_from` varchar(10) NOT NULL,
                              `date_to` varchar(10) NOT NULL,
                              `time_from` varchar(30) NOT NULL,
                              `time_to` varchar(30) NOT NULL,
                              `mon` tinyint(1) NOT NULL,
                              `tue` tinyint(1) NOT NULL,
                              `wed` tinyint(1) NOT NULL,
                              `thu` tinyint(1) NOT NULL,
                              `fri` tinyint(1) NOT NULL,
                              `sat` tinyint(1) NOT NULL,
                              `sun` tinyint(1) NOT NULL,
                              `plan_order` tinyint(1) NOT NULL,
                              `plan_limit` tinyint(1) NOT NULL,
                              `plan_interval` tinyint(1) NOT NULL,
                              `created` varchar(30) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        $planner_planifications_rules_meta = $this->db->table_exists('planner_planifications_rules_meta');
        
        if ( !$planner_planifications_rules_meta ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_planifications_rules_meta` (
                              `meta_id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `planification_id` bigint(20) NOT NULL,
                              `rule_id` bigint(20) NOT NULL,
                              `post_id` bigint(20) NOT NULL,
                              `exact_date` datetime NOT NULL,
                              `scheduled` varchar(30) NOT NULL,
                              `status` tinyint(1) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        // Set the tables value
        $this->tables = $this->config->item('tables', $this->table);
        
    }
    
    /**
     * The public method save_planification saves a new planification
     * 
     * @param integer $user_id contains the user_id
     * @param string $title contains the notification's title
     * @param integer $group_id contains the group_id
     * @param integer $category_id contains the multimedia's category
     * 
     * @return integer with inserted id or false
     */
    public function save_planification( $user_id, $title, $group_id=NULL, $category_id=NULL ) {
        
        // Set data
        $data = array(
            'user_id' => $user_id,
            'title' => $title,
            'created' => time()
        );
        
        if ( is_numeric($group_id) ) {
            $data['group_id'] = $group_id;
        }
        
        if ( is_numeric($category_id) ) {
            $data['category_id'] = $category_id;
        }        
        
        // Insert planification
        $this->db->insert($this->table, $data);
        
        // Verify if planification was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_planification_networks saves planification's networks
     * 
     * @param integer $planification_id contains the notification's id
     * @param integer $network_id contains the network's id
     * 
     * @return integer with inserted id or false
     */
    public function save_planification_networks( $planification_id, $network_id ) {
        
        // Set data
        $data = array(
            'planification_id' => $planification_id,
            'network_id' => $network_id
        );
        
        // Insert network
        $this->db->insert('planner_planifications_networks', $data);
        
        // Verify if network was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_planification_posts saves planifications posts
     * 
     * @param integer $planification_id contains the notification's id
     * @param integer $post_id contains the post's id
     * 
     * @return integer with inserted id or false
     */
    public function save_planification_posts( $planification_id, $post_id ) {
        
        // Set data
        $data = array(
            'planification_id' => $planification_id,
            'post_id' => $post_id
        );
        
        // Insert network
        $this->db->insert('planner_planifications_posts', $data);
        
        // Verify if network was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_planification_rules saves planifications rules
     * 
     * @param array $data contains the data to save
     * 
     * @return integer with inserted id or false
     */
    public function save_planification_rules( $data ) {
        
        // Insert network
        $this->db->insert('planner_planifications_rules', $data);
        
        // Verify if rule was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_planification_rules_meta saves the rule's meta
     * 
     * @param array $data contains the data to save
     * 
     * @return integer with inserted id or false
     */
    public function save_planification_rules_meta( $data ) {
        
        // Insert network
        $this->db->insert('planner_planifications_rules_meta', $data);
        
        // Verify if rule was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method update_planification updates a planification
     * 
     * @param integer $planification_id contains the planification's id
     * @param integer $user_id contains the user_id
     * @param string $title contains the notification's title
     * @param integer $group_id contains the group_id
     * @param integer $category_id contains the multimedia's category
     * 
     * @return boolean true or false
     */
    public function update_planification( $planification_id, $user_id, $title, $group_id=NULL, $category_id=NULL ) {

        $params = array(
            'planification_id' => $planification_id,
            'user_id' => $user_id
        );
        
        $data = array(
            'title' => $title
        );
        
        if ( is_numeric($group_id) ) {
            $data['group_id'] = $group_id;
        }
        
        if ( is_numeric($category_id) ) {
            $data['category_id'] = $category_id;
        }        
        
        $this->db->where($params);
        $this->db->update($this->table, $data);
        
        // Verify if planification was saved
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_all_planifications gets planifications based on time
     *
     * @param integer $user_id contains the user_id
     * @param integer $start contains the start of displays planifications
     * @param integer $end displays the end time of displayed planifications
     * 
     * @return object with planifications or false
     */
    public function get_all_planifications( $user_id, $start, $end ) {
        
        $this->db->select('FROM_UNIXTIME(planner_planifications_rules_meta.scheduled) as datetime', false);
        $this->db->select('LEFT(planner_planifications_rules_meta.exact_date,10) as date', false);
        $this->db->select('planner_planifications_rules_meta.planification_id,planner_planifications_rules_meta.meta_id,planner_planifications_rules_meta.scheduled,planner_planifications.title');
        $this->db->from('planner_planifications_rules_meta');
        $this->db->join('planner_planifications', 'planner_planifications_rules_meta.planification_id=planner_planifications.planification_id', 'left');
        $this->db->where(array(
            'planner_planifications.user_id' => $user_id,
            'planner_planifications_rules_meta.scheduled >=' => ($start - 259200),
            'planner_planifications_rules_meta.scheduled <=' => $end
        ));
        $this->db->group_by(array('planner_planifications.planification_id', 'date'));
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_all_active_planifications gets all active planifications
     *
     * @param integer $user_id contains the user_id
     * @param boolean $all contains the option
     * 
     * @return object with planifications or false
     */
    public function get_all_active_planifications( $user_id=NULL, $all=TRUE ) {
        
        $params = array(
            'planner_planifications_rules_meta.status <' => 1
        );
        
        if ( $user_id ) {
            
            $params['planner_planifications.user_id'] = $user_id;
            
        }
        
        if ( !$all ) {
            
            $params['planner_planifications_rules_meta.scheduled <='] = time();
            
        }
        
        $this->db->select('FROM_UNIXTIME(planner_planifications_rules_meta.scheduled) as datetime', false);
        $this->db->select('planner_planifications_rules_meta.meta_id,planner_planifications_rules_meta.planification_id,planner_planifications_rules_meta.post_id,planner_planifications_rules_meta.scheduled,planner_planifications.user_id,planner_planifications.title,planner_planifications.group_id');
        $this->db->from('planner_planifications_rules_meta');
        $this->db->join('planner_planifications', 'planner_planifications_rules_meta.planification_id=planner_planifications.planification_id', 'left');
        $this->db->where($params);
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification gets planification's data
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * 
     * @return object with planifications or false
     */
    public function get_planification( $user_id, $planification_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('planner_planifications.planification_id,planner_planifications.title,planner_planifications.group_id,planner_planifications.category_id,lists.name');
        $this->db->from('planner_planifications');
        $this->db->where($params);
        $this->db->join('lists', 'planner_planifications.group_id=lists.list_id', 'left');
        $this->db->group_by(['planner_planifications.planification_id']);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification_networks gets the planification's networks
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * 
     * @return object with networks or false
     */
    public function get_planification_networks( $user_id, $planification_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('planner_planifications_networks.id,networks.network_id,networks.net_id,networks.network_name,networks.user_name');
        $this->db->from('planner_planifications_networks');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_networks.planification_id', 'left');
        $this->db->join('networks', 'planner_planifications_networks.network_id=networks.network_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification_posts gets the planification's posts
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * 
     * @return object with networks or false
     */
    public function get_planification_posts( $user_id, $planification_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('posts.post_id,posts.body,posts.title');
        $this->db->from('planner_planifications_posts');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_posts.planification_id', 'left');
        $this->db->join('posts', 'planner_planifications_posts.post_id=posts.post_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification_posts_by_page gets planification's posts
     *
     * @param integer $planification_id contains the planification's id
     * @param integer $user_id contains the user_id
     * @param integer $start contains the start of displays posts
     * @param integer $limit displays the limit of displayed posts
     * 
     * @return object with posts or false
     */
    public function get_planification_posts_by_page( $planification_id, $user_id, $start, $limit ) {
        
        $this->db->select('posts.post_id,posts.body,posts.title,posts.url,posts.img,posts.video,posts.sent_time,posts.status,posts_meta.network_name');
        $this->db->from('planner_planifications_posts');
        $this->db->join('posts', 'planner_planifications_posts.post_id=posts.post_id', 'left');
        $this->db->join('posts_meta', 'planner_planifications_posts.post_id=posts_meta.post_id', 'left');
        $this->db->where(array(
            'posts.user_id' => $user_id,
            'planner_planifications_posts.planification_id' => $planification_id
            )
        );
        
        $this->db->group_by(['planner_planifications_posts.post_id']);
        $this->db->order_by('posts.sent_time', 'desc');
        
        // Verify if $limit is not null
        if ( $limit ) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            
            // Verify if $limit is not null
            if ( $limit ) {
            
                // Get results
                $results = $query->result();

                // Create a new array
                $array = [];

                foreach ( $results as $result ) {

                    // Each result will be a new object
                    $array[] = (object) array(
                        'post_id' => $result->post_id,
                        'body' => $result->body,
                        'title' => $result->title,
                        'url' => $result->url,
                        'video' => $result->video,
                        'img' => $result->img,
                        'sent_time' => $result->sent_time,
                        'status' => $result->status,
                        'network_name' => $result->network_name,
                    );

                }

                return $array;
            
            } else {
                return $query->num_rows();
            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification_rules gets the planification's rules
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * 
     * @return object with networks or false
     */
    public function get_planification_rules( $user_id, $planification_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('planner_planifications_rules.rule_id,planner_planifications_rules.date_from,planner_planifications_rules.date_to,planner_planifications_rules.time_from,planner_planifications_rules.time_to,planner_planifications_rules.mon,planner_planifications_rules.tue,planner_planifications_rules.wed,planner_planifications_rules.thu,planner_planifications_rules.fri,,planner_planifications_rules.sat,,planner_planifications_rules.sun,,planner_planifications_rules.plan_order,,planner_planifications_rules.plan_limit,,planner_planifications_rules.plan_interval');
        $this->db->from('planner_planifications_rules');
        $this->db->join('planner_planifications', 'planner_planifications_rules.planification_id=planner_planifications.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $results;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planification_rules_meta gets the planification's rules meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * @param integer $meta_id contains the planification's rules meta id
     * 
     * @return object with networks or false
     */
    public function get_planification_rules_meta( $user_id, $planification_id, $meta_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id,
            'planner_planifications_rules_meta.meta_id' => $meta_id
        );
        
        $this->db->select('LEFT(planner_planifications_rules_meta.exact_date,10) as datetime', false);
        $this->db->from('planner_planifications_rules_meta');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_rules_meta.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            $params = array(
                'planner_planifications_rules_meta.planification_id' => $planification_id,
                'LEFT(planner_planifications_rules_meta.exact_date,10)' => $results[0]->datetime
            );
            
            $this->db->select('planner_planifications_rules_meta.meta_id,posts.post_id,posts.body,posts.title,RIGHT(LEFT(planner_planifications_rules_meta.exact_date,16), 5) as exact_date');
            $this->db->from('planner_planifications_rules_meta');
            $this->db->join('posts', 'planner_planifications_rules_meta.post_id=posts.post_id', 'left');
            $this->db->where($params);
            $query = $this->db->get();
            
            return $query->result();
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_all_planification_rules_meta gets all the planification's rules meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the planification's id
     * 
     * @return object with networks or false
     */
    public function get_all_planification_rules_meta( $user_id, $planification_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('*');
        $this->db->from('planner_planifications_rules_meta');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_rules_meta.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            return $query->result();
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method update_planification_meta_status updates a planification meta status
     * 
     * @param integer $planification_id contains the planification's id
     * @param integer $meta_id contains the meta's id
     * @param integer $status contains the meta's status
     * 
     * @return boolean true or false
     */
    public function update_planification_meta_status( $planification_id, $meta_id, $status ) {

        $params = array(
            'meta_id' => $meta_id,
            'planification_id' => $planification_id
        );
        
        $data = array(
            'status' => $status
        );
        
        $this->db->where($params);
        $this->db->update('planner_planifications_rules_meta', $data);
        
        // Verify if planification was saved
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_planification deletes a planification
     * 
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the notification's id
     * 
     * @return boolean true or false
     */
    public function delete_planification( $user_id, $planification_id ) {
        
        // Set data
        $data = array(
            'planification_id' => $planification_id,
            'user_id' => $user_id
        );
        
        // Delete planification
        $this->db->delete('planner_planifications', $data);
        
        // Verify if planification was deleted
        if ( $this->db->affected_rows() ) {
            
            // Delete networks
            $this->db->delete('planner_planifications_networks', array('planification_id' => $planification_id));
            
            // Delete posts
            $this->db->delete('planner_planifications_posts', array('planification_id' => $planification_id));
            
            // Delete rules
            $this->db->delete('planner_planifications_rules', array('planification_id' => $planification_id));   
            
            // Delete rules metas
            $this->db->delete('planner_planifications_rules_meta', array('planification_id' => $planification_id));   

            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_planification_rules_meta deletes planification rule meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $meta_id contains the planification's rules meta id
     * 
     * @return integer with planification's ID or false
     */
    public function delete_planification_rules_meta( $user_id, $meta_id ) {
        
        $params = array(
            'planner_planifications.user_id' => $user_id,
            'planner_planifications_rules_meta.meta_id' => $meta_id
        );
        
        $this->db->select('planner_planifications.planification_id');
        $this->db->from('planner_planifications_rules_meta');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_rules_meta.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            // Set data
            $data = array(
                'meta_id' => $meta_id
            );

            // Delete meta
            $this->db->delete('planner_planifications_rules_meta', $data);

            // Verify if rule's meta was deleted
            if ( $this->db->affected_rows() ) {           

                return $results[0]->planification_id;

            } else {

                return false;

            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_planification_rules_meta deletes planification rule meta
     *
     * @param integer $user_id contains the user_id
     * @param integer $rule_id contains the rule's to delete
     * 
     * @return boolean true or false
     */
    public function delete_planification_rules( $user_id, $rule_id ) {
            
        // Set data
        $data = array(
            'rule_id' => $rule_id,
            'user_id' => $user_id
        );

        // Delete rule
        $this->db->delete('planner_planifications_rules', $data);

        // Verify if rule's meta was deleted
        if ( $this->db->affected_rows() ) {           

            // Set data
            $data = array(
                'rule_id' => $rule_id
            );

            // Delete meta
            $this->db->delete('planner_planifications_rules_meta', $data);
            
            return true;

        } else {

            return false;

        }
        
    }
    
    /**
     * The public method delete_planification_network deletes planification's network
     *
     * @param integer $id contains planification network id
     * 
     * @return boolean true or false
     */
    public function delete_planification_network( $id ) {
            
        // Set data
        $data = array(
            'id' => $id
        );

        // Delete rule
        $this->db->delete('planner_planifications_networks', $data);

        // Verify if rule's meta was deleted
        if ( $this->db->affected_rows() ) {
            
            return true;

        } else {

            return false;

        }
        
    }
    
    /**
     * The public method delete_planification deletes a planification
     * 
     * @param integer $user_id contains the user_id
     * @param integer $planification_id contains the notification's id
     * @param integer $post_id contains the post's id
     * 
     * @return boolean true or false
     */
    public function delete_planification_posts( $user_id, $planification_id, $post_id ) {
        
        $params = array(
            'planner_planifications.planification_id' => $planification_id,
            'planner_planifications.user_id' => $user_id
        );
        
        $this->db->select('*');
        $this->db->from('planner_planifications_posts');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_posts.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Set data
            $data = array(
                'planification_id' => $planification_id,
                'post_id' => $post_id
            );

            // Delete planification's post
            $this->db->delete('planner_planifications_posts', $data);

            // Verify if post was deleted
            if ( $this->db->affected_rows() ) {
                
                // Delete post from meta
                $this->db->delete('planner_planifications_rules_meta', array('post_id' => $post_id));            

                return true;

            } else {

                return false;

            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_user_planner_data deletes the user data from planner
     * 
     * @param integer $user_id contains the user's id
     * 
     * @return boolean true or false
     */
    public function delete_user_planner_data( $user_id ) {
        
        // Deletes all user's posts from planner's posts table
        $this->db->delete('planner_posts', array('user_id' => $user_id));
        
        $params = array(
            'user_id' => $user_id
        );
        
        $this->db->select('planification_id');
        $this->db->from('planner_planifications');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            // Get results
            $results = $query->result();
            
            foreach ( $results as $result ) {
                
                // Delete planification
                $this->delete_planification( $user_id, $result->planification_id );
                
            }
            
        }
        
    }
    
    /**
     * The public method delete_post_records deletes all post's records
     * 
     * @param integer $post_id contains the post's id
     * 
     * @return boolean true or false
     */
    public function delete_post_records( $post_id ) {
        
        $params = array(
            'planner_planifications_posts.post_id' => $post_id
        );
        
        $this->db->select('planner_planifications.planification_id,planner_planifications.user_id');
        $this->db->from('planner_planifications_posts');
        $this->db->join('planner_planifications', 'planner_planifications.planification_id=planner_planifications_posts.planification_id', 'left');
        $this->db->where($params);
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $results = $query->result();
            
            $this->db->delete('posts', array('post_id' => $post_id));
            
            foreach ( $results as $result ) {
            
                $all_planification_posts = $this->get_planification_posts($result->user_id, $result->planification_id);

                if ( count($all_planification_posts) > 1 ) {

                    // Delete planification's post
                    $this->db->delete('planner_planifications_posts', array('post_id' => $post_id)); 
                    $this->db->delete('planner_planifications_rules_meta', array('post_id' => $post_id));                 

                } else {

                    // Delete planification
                    $this->delete_planification( $result->user_id, $result->planification_id );

                }
                
            }
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
}

/* End of file planner_planifications_model.php */