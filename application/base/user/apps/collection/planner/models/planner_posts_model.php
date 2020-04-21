<?php
/**
 * Planner_posts_model Model
 *
 * PHP Version 7.2
 *
 * Planner_posts_model file contains the Planner Posts Model
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
 * Planner_posts_model class - operates the posts table.
 *
 * @since 0.0.7.5
 * 
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Planner_posts_model extends CI_MODEL {
    
    /**
     * Class variables
     */
    private $table = 'posts';

    /**
     * Initialise the model
     */
    public function __construct() {
        
        // Call the Model constructor
        parent::__construct();
        
        // Load Campaigns SQL Queries
        $tables = $this->db->table_exists('planner_posts');
        
        if ( !$tables ) {
            
            $this->db->query('CREATE TABLE IF NOT EXISTS `planner_posts` (
                              `planner_id` bigint(20) AUTO_INCREMENT PRIMARY KEY,
                              `user_id` bigint(20) NOT NULL,
                              `post_id` bigint(20) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            
        }
        
        // Set the tables value
        $this->tables = $this->config->item('tables', $this->table);
        
    }
    
    /**
     * The public method save_post saves post before send on social networks
     * 
     * @param integer $user_id contains the user_id
     * @param string $post contains the post content
     * @param string $url contains the post's url
     * @param string $img contains the post's image url
     * @param integer $time contains the time when will be published the post
     * @param integer $publish contains a number. If 0 the post will be saved as draft
     * @param string $category contains the category
     * 
     * @return integer with inserted id or false
     */
    public function save_post( $user_id, $post, $url, $img, $video = NULL, $time, $publish, $post_title = NULL, $category = NULL ) {
        
        // Get current ip
        $ip = $this->input->ip_address();
        
        // Decode URL-encoded strings
        $post = rawurldecode($post);
        
        // Set data
        $data = array(
            'user_id' => $user_id,
            'body' => $post,
            'title' => $post_title,
            'url' => $url,
            'img' => $img,
            'sent_time' => $time,
            'ip_address' => $ip,
            'status' => $publish,
            'view' => '1'
        );
        
        if ( $category ) {
            
            $data['category'] = $category;
            
        }
        
        // Verify if video exists
        if ( $video ) {
            
            $data['video'] = $video;
            
        }
        
        // Insert post
        $this->db->insert($this->table, $data);
        
        // Verify if post was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Load Activities model
            $this->load->model( 'Activities', 'activities' );
            
            $member_id = 0;
            
            if ( $this->session->userdata( 'member' ) ) {
                
                // Load Team model
                $this->load->model( 'Team', 'team' );
                
                // Get member team info
                $member_info = $this->team->get_member( $user_id, 0, $this->session->userdata( 'member' ) );
                
                if ( $member_info ) {
                    
                    $member_id = $member_info[0]->member_id;
                    
                }
                
            }
            
            $this->activities->save_activity( 'posts', 'posts', $last_id, $user_id, $member_id );
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_post_meta saves post meta
     *
     * @since 0.0.7.5
     * 
     * @param integer $post_id contains the post_id
     * @param integer $account contains the account where will be published the post
     * @param string $name contains the network's name
     * @param integer $status may be a number 0, 1 or 2
     * @param integer $user_id contains the user_id
     * @param integer $published_id contains the published id
     * 
     * @return void
     */
    public function save_post_meta( $post_id, $account, $name, $status=0, $user_id=0, $published_id=0 ) {
        
        // Get current time
        $time = time();
        
        // Set data
        $data = array(
            'post_id' => $post_id,
            'network_id' => $account,
            'network_name' => $name,
            'sent_time' => $time,
            'status' => $status,
            'published_id' => $published_id
        );
        
        $this->db->insert('posts_meta', $data);
        
    }
    
    /**
     * The public method update_post updates a post
     * 
     * @param integer $user_id contains the user_id
     * @param integer $post_id contains the post's ID
     * @param string $column contains the table's column
     * @param string $value contains the table's column value
     * 
     * @return boolean true or false
     */
    public function update_post( $user_id, $post_id, $column, $value ) {
        
        $params = array(
            'post_id' => $post_id,
            'user_id' => $user_id
        );
        
        $data = array(
            $column => $value
        );
        
        $this->db->where($params);
        $this->db->update($this->table, $data);
        
        // Verify if post was saved
        if ( $this->db->affected_rows() ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_posts gets all posts from database
     *
     * @param integer $user_id contains the user_id
     * @param integer $start contains the start of displays posts
     * @param integer $limit displays the limit of displayed posts
     * @param string $key contains the search key
     * 
     * @return object with posts or false
     */
    public function get_posts( $user_id, $start, $limit, $key = NULL ) {
        
        $this->db->select('posts.post_id,posts.body,posts.title,posts.url,posts.img,posts.video,posts.sent_time,posts.status,posts_meta.network_name');
        $this->db->from($this->table);
        $this->db->join('posts_meta', 'posts.post_id=posts_meta.post_id', 'left');
        $this->db->where('posts.user_id', $user_id);
        $this->db->group_by(['posts.post_id']);
        
        // If $key exists means will displayed posts by search
        if ( $key ) {
            
            // This method allows to escape special characters for LIKE conditions
            $key = $this->db->escape_like_str($key);
            
            // Gets posts which contains the $key
            $this->db->like('posts.body', $key);
            
        }
        
        $this->db->order_by('posts.post_id', 'desc');
        
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
     * The public method get_post gets post content
     *
     * @param integer $user_id contains the user's id
     * @param integer $post_id contains the post's id
     * 
     * @return array with post's data or false if post doesn't exists
     */
    public function get_post( $user_id, $post_id ) {
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array(
            'user_id' => $user_id,
            'post_id' => $post_id
            )
        );
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
            $result = $query->result();

            $img = $result[0]->img;
            
            $video = $result[0]->video;
            
            // Verify if any image exists
            if ( !$img ) {
                $img = array();
            } else {
                $img = get_post_media_array($result[0]->user_id, unserialize($img) );
            }

            // Verify if any video exists
            if ( !$video ) {
                $video = array();
            } else {
                $video = get_post_media_array($result[0]->user_id, unserialize($video) );
            }
            
            return array(
                'post_id' => $result[0]->post_id,
                'user_id' => $result[0]->user_id,
                'body' => $result[0]->body,
                'title' => $result[0]->title,
                'category' => $result[0]->category,
                'url' => $result[0]->url,
                'img' => $img,
                'video' => $video,
                'status' => $result[0]->status,
                'time' => $result[0]->sent_time,
                'current' => time(),
                'parent' => $result[0]->parent,
                'imgIds' => $result[0]->img,
                'videoIds' => $result[0]->video
            );
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_post deletes a post
     *
     * @param integer $user_id contains the user's id
     * @param integer $post_id contains the post_id
     * 
     * @return boolean if the post was deleted successfully or false
     */
    public function delete_post($user_id, $post_id) {
        
        // First we check if the post exists
        $this->db->select('post_id');
        $this->db->from($this->table);
        $this->db->where(array(
            'user_id' => $user_id,
            'post_id' => $post_id
        ));
        
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {

            // Delete all post's records
            run_hook(
                'delete_social_post',
                array(
                    'post_id' => $post_id
                )
            );
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method save_post saves post before send on social networks
     * 
     * @param integer $user_id contains the user_id
     * @param string $post_id contains the post_id 
     * 
     * @return integer with inserted id or false
     */
    public function save_planner_post( $user_id, $post_id ) {
        
        // Set data
        $data = array(
            'user_id' => $user_id,
            'post_id' => $post_id
        );
        
        // Insert post
        $this->db->insert('planner_posts', $data);
        
        // Verify if post was saved
        if ( $this->db->affected_rows() ) {
            
            $last_id = $this->db->insert_id();
            
            // Return last inserted id
            return $last_id;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method get_planner_posts gets all planner's posts from database
     *
     * @param integer $user_id contains the user_id
     * @param integer $start contains the start of displays posts
     * @param integer $limit displays the limit of displayed posts
     * 
     * @return object with posts or false
     */
    public function get_planner_posts( $user_id, $start, $limit ) {
        
        $this->db->select('posts.post_id,posts.body,posts.title,posts.url,posts.img,posts.video,posts.sent_time,posts.status,posts_meta.network_name');
        $this->db->from('planner_posts');
        $this->db->join('posts', 'planner_posts.post_id=posts.post_id', 'left');
        $this->db->join('posts_meta', 'planner_posts.post_id=posts_meta.post_id', 'left');
        $this->db->where('planner_posts.user_id', $user_id);
        $this->db->group_by(['planner_posts.post_id']);
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
     * The public method get_all_planner_posts gets all planner's posts from database
     *
     * @param integer $user_id contains the user_id
     * 
     * @return object with posts or false
     */
    public function get_all_planner_posts( $user_id ) {
        
        $this->db->select('posts.post_id,posts.body,posts.title,posts.url,posts.img,posts.video,posts.sent_time,posts.status,posts_meta.network_name');
        $this->db->from('planner_posts');
        $this->db->join('posts', 'planner_posts.post_id=posts.post_id', 'left');
        $this->db->join('posts_meta', 'planner_posts.post_id=posts_meta.post_id', 'left');
        $this->db->where('planner_posts.user_id', $user_id);
        $this->db->group_by(['planner_posts.post_id']);
        $this->db->order_by('posts.sent_time', 'desc');
        $query = $this->db->get();
        
        if ( $query->num_rows() > 0 ) {
            
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
            
            return false;
            
        }
        
    }
    
    /**
     * The public method delete_planner_posts deletes all user's planner posts
     *
     * @param integer $user_id contains the user's id
     * @param integer $post_id contains the post's id
     * 
     * @return boolean if the post was deleted successfully or false
     */
    public function delete_planner_posts( $user_id, $post_id = NULL ) {
        
        if ( $post_id ) {
            
            // Deletes all user's posts from planner's posts table
            $this->db->delete('planner_posts', array(
                    'user_id' => $user_id,
                    'post_id' => $post_id
                )
            );
            
        } else {
            
            // Deletes all user's posts from planner's posts table
            $this->db->delete('planner_posts', array('user_id' => $user_id));
            
        }

        if ( $this->db->affected_rows() ) {

            return true;

        } else {

            return false;

        }
        
    }
    
}

/* End of file planner_posts_model.php */