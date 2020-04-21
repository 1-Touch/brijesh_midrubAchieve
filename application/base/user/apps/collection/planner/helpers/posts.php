<?php
/**
 * Posts Helpers
 *
 * This file contains the class Posts
 * with methods to process the posts data
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner\Helpers;

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Posts class provides the methods to process the posts data
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
*/
class Posts {
    
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
        
    }
    
    /**
     * The public method planner_display_all_posts will display posts with pagination
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_display_all_posts() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('page', 'Page', 'trim|numeric|required');
            $this->CI->form_validation->set_rules('key', 'Key', 'trim');
            $this->CI->form_validation->set_rules('limit', 'Limit', 'trim|numeric|required');
            
            // Get data
            $page = $this->CI->input->post('page');
            $key = $this->CI->input->post('key');
            $limit = $this->CI->input->post('limit');
            
            if ( $this->CI->form_validation->run() == false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('no_posts_found')
                );

                echo json_encode($data);   
                
            } else {
                
                $page--;

                // Get total posts
                $total = $this->CI->planner_posts_model->get_posts($this->CI->user_id, '', '', $key);

                // Get posts by page
                $get_posts = $this->CI->planner_posts_model->get_posts($this->CI->user_id, ($page * $limit), $limit, $key);

                // Verify if posts exists
                if ( $get_posts ) {

                    $data = array(
                        'success' => TRUE,
                        'total' => $total,
                        'date' => time(),
                        'page' => ($page + 1),
                        'posts' => $get_posts,
                        'limit' => $limit
                    );

                    echo json_encode($data);

                } else {

                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('no_posts_found')
                    );

                    echo json_encode($data);            

                }
                
            }
            
        }
        
    }
    
    /**
     * The public method planner_save_post saves a post
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_post() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('post', 'Post', 'trim|required');
            $this->CI->form_validation->set_rules('networks', 'Networks', 'trim');
            $this->CI->form_validation->set_rules('group_id', 'Group ID', 'trim');
            $this->CI->form_validation->set_rules('url', 'Url', 'trim');
            $this->CI->form_validation->set_rules('medias', 'Medias', 'trim');
            $this->CI->form_validation->set_rules('post_title', 'Post Title', 'trim');
            $this->CI->form_validation->set_rules('publish', 'Publish', 'trim|integer');
            
            // Get data
            $post = str_replace('-', '/', $this->CI->input->post('post'));
            $post = $this->CI->security->xss_clean(base64_decode($post));
            $networks = $this->CI->input->post('networks');
            $group_id = $this->CI->input->post('group_id');
            $url = $this->CI->input->post('url');
            $medias = $this->CI->input->post('medias');
            $publish = $this->CI->input->post('publish');
            $post_title = $this->CI->input->post('post_title');
            $img = array();
            $video = array();

            // Verify if medias is not empty
            if ( $medias ) {
                
                foreach ( $medias as $media ) {
                    
                    if ( $media['type'] === 'image' ) {
                        
                        $img[] = $media['id'];
                        
                    } else {
                        
                        $video[] = $media['id'];                        
                        
                    }
                    
                }
                
            }
            
            // Serialize media
            $img = serialize($img);
            $video = serialize($video);
            
            if ( $this->CI->form_validation->run() === false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('your_post_too_short')
                );

                echo json_encode($data);
                exit();
                
            } else {
                
                // Save the post
                $lastId = $this->CI->planner_posts_model->save_post($this->CI->user_id, $post, $url, $img, $video, time(), 0, $post_title);

                // Verify if the post was saved
                if ( $lastId ) {

                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('post_saved_as_draft')
                    );

                    echo json_encode($data); 

                } else {

                        $data = array(
                            'success' => FALSE,
                            'message' => $this->CI->lang->line('error_occurred')
                        );

                        echo json_encode($data);

                }
                
            }
            
        }
        
    }
    
    /**
     * The public method planner_delete_post_by_id deletes a post by id
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_post_by_id() {
        
        // Get post_id's input
        $post_id = $this->CI->input->get('post_id');
        
        if ( $post_id ) {
        
            // Delete post data by user id and post id
            $get_respponse = $this->CI->planner_posts_model->delete_post($this->CI->user_id, $post_id);

            if ( $get_respponse ) {

                $data = array(
                    'success' => TRUE,
                    'message' => $this->CI->lang->line('post_was_deleted')
                );

                echo json_encode($data);

            } else {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('error_occurred')
                );

                echo json_encode($data);
                
            }
        
        } else {
            
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('no_post_found')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_save_posts saves posts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_posts() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('posts', 'Posts', 'trim');
            
            // Get data
            $posts = $this->CI->input->post('posts');
            
            if ( $this->CI->form_validation->run() == false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('error_occurred')
                );

                echo json_encode($data);   
                
            } else {
                
                // Delete all user's planner posts
                $this->CI->planner_posts_model->delete_planner_posts($this->CI->user_id);
                
                if ( $posts ) {
                    
                    $count = 0;
                    
                    foreach ( $posts as $post ) {
                        
                        if ( is_numeric($post[1]) ) {
                            
                            // Get post
                            $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post[1]);
                            
                            if ( $get_post ) {
                                
                                // Save post
                                if ( $this->CI->planner_posts_model->save_planner_post($this->CI->user_id, $post[1]) ) {
                                    
                                    $count++;
                                    
                                }
                                
                            }
                            
                        }
                        
                    }
                    
                    if ( $count ) {

                        // Get total planner posts
                        $total = $this->CI->planner_posts_model->get_planner_posts($this->CI->user_id, '', '');

                        // Get planner posts by page
                        $get_posts = $this->CI->planner_posts_model->get_planner_posts($this->CI->user_id, (0 * 10), 10);
                        
                        $data = array(
                            'success' => TRUE,
                            'message' => $this->CI->lang->line('posts_saved_successfully'),
                            'total' => $total,
                            'posts' => $get_posts,
                            'page' => 1
                        );

                        echo json_encode($data);
                        exit();
                        
                    }
                    
                }
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('error_occurred')
                );

                echo json_encode($data);
                
            }
            
        }
        
    }
    
    /**
     * The public method planner_add_planification_posts adds posts to a planification
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_add_planification_posts() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('posts', 'Posts', 'trim');
            $this->CI->form_validation->set_rules('planification_id', 'Planification ID', 'trim|required');
            
            // Get data
            $posts = $this->CI->input->post('posts');
            $planification_id = $this->CI->input->post('planification_id');
            
            if ( $this->CI->form_validation->run() == false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('error_occurred')
                );

                echo json_encode($data);   
                
            } else {
                
                // Verify if the user is the owner of the planification
                if ( $this->CI->planner_planifications_model->get_planification( $this->CI->user_id, $planification_id ) ) {
                
                    if ( $posts ) {

                        $count = 0;

                        foreach ( $posts as $post ) {

                            if ( is_numeric($post[1]) ) {

                                // Get post
                                $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post[1]);

                                if ( $get_post ) {

                                    // Save post
                                    if ( $this->CI->planner_planifications_model->save_planification_posts($planification_id, $post[1]) ) {
                                        $count++;
                                    }

                                }

                            }

                        }

                        if ( $count ) {

                            $data = array(
                                'success' => TRUE,
                                'message' => $this->CI->lang->line('posts_were_added_successfully')
                            );

                            echo json_encode($data);
                            exit();

                        }

                    }
                    
                }
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('please_select_planification')
                );

                echo json_encode($data);
                
            }
            
        }
        
    }
    
    /**
     * The public method planner_planify_display_all_posts displays planify's posts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_display_all_posts() {
        
        // Get page's input
        $page = $this->CI->input->get('page');
        
        // Get planification_id's input
        $planification_id = $this->CI->input->get('planification_id');
        
        if ( $page ) {
            $page--;
        } else {
            $page = 0;
        }
        
        if ( $planification_id ) {
            
            // Get total planner posts
            $total = $this->CI->planner_planifications_model->get_planification_posts_by_page($planification_id, $this->CI->user_id, '', '');

            // Get planner posts by page
            $get_posts = $this->CI->planner_planifications_model->get_planification_posts_by_page($planification_id, $this->CI->user_id, ($page * 10), 10);

            // Verify if posts exists
            if ( $get_posts ) {

                $data = array(
                    'success' => TRUE,
                    'total' => $total,
                    'posts' => $get_posts,
                    'page' => ($page + 1 )
                );

                echo json_encode($data);   

            } else {

                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('no_posts_found')
                );

                echo json_encode($data);

            }            
            
        } else {

            // Get total planner posts
            $total = $this->CI->planner_posts_model->get_planner_posts($this->CI->user_id, '', '');

            // Get planner posts by page
            $get_posts = $this->CI->planner_posts_model->get_planner_posts($this->CI->user_id, ($page * 10), 10);

            // Verify if posts exists
            if ( $get_posts ) {

                $data = array(
                    'success' => TRUE,
                    'total' => $total,
                    'posts' => $get_posts,
                    'page' => ($page + 1 )
                );

                echo json_encode($data);   

            } else {

                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('no_posts_found')
                );

                echo json_encode($data);

            }
            
        }
        
    }
    
    /**
     * The public method planner_planify_delete_post deletes a planify's post
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_delete_post() {
        
        // Get post_id's input
        $post_id = $this->CI->input->get('post_id');
        
        // Get type's input
        $type = $this->CI->input->get('type');        
        
        if ( is_numeric($post_id) && $type ) {
            
            if ( $type === 'planify-posts-modal' ) {
                
                // Delete a planner post
                $delete = $this->CI->planner_posts_model->delete_planner_posts($this->CI->user_id, $post_id);
                
                if ( $delete ) {
                    
                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('post_was_deleted')
                    );

                    echo json_encode($data); 
                    
                } else {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('error_occurred')
                    );

                    echo json_encode($data);
                    
                }
                
            } else {
                
                // Get the planification_id's input
                $planification_id = $this->CI->input->get('planification_id');
                
                // Delete a planner post
                $delete = $this->CI->planner_planifications_model->delete_planification_posts($this->CI->user_id, $planification_id, $post_id);
                
                if ( $delete ) {
                    
                    // Get planification posts
                    $planification_posts = $this->CI->planner_planifications_model->get_planification_posts( $this->CI->user_id, $planification_id );
                    
                    if ( !$planification_posts ) {
                        
                        // Delete rule meta
                        $delete = $this->CI->planner_planifications_model->delete_planification( $this->CI->user_id, $planification_id );

                        if ( $delete ) {

                            $data = array(
                                'success' => TRUE,
                                'message' => $this->CI->lang->line('planification_was_deleted')
                            );

                            echo json_encode($data);                

                        } else {

                            $data = array(
                                'success' => FALSE,
                                'message' => $this->CI->lang->line('error_occurred')
                            );

                            echo json_encode($data);                 

                        }
                        
                    } else {
                        
                        // Get planification rules metas
                        $planification_metas = $this->CI->planner_planifications_model->get_all_planification_rules_meta( $this->CI->user_id, $planification_id );

                        if ( !$planification_metas ) {

                            // Delete rule meta
                            $delete = $this->CI->planner_planifications_model->delete_planification( $this->CI->user_id, $planification_id );

                            if ( $delete ) {

                                $data = array(
                                    'success' => TRUE,
                                    'message' => $this->CI->lang->line('planification_was_deleted')
                                );

                                echo json_encode($data);                

                            } else {

                                $data = array(
                                    'success' => FALSE,
                                    'message' => $this->CI->lang->line('error_occurred')
                                );

                                echo json_encode($data);                 

                            }

                        } else {

                            $data = array(
                                'success' => TRUE,
                                'message' => $this->CI->lang->line('post_was_deleted'),
                                'post_id' => $post_id
                            );

                            echo json_encode($data); 

                        }

                    }
                    
                } else {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('error_occurred')
                    );

                    echo json_encode($data);
                    
                }
                
            }
            
        } else {
            
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('error_occurred')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_planify_edit_post edits a planify's post
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_edit_post() {
        
        // Get post_id's input
        $post_id = $this->CI->input->get('post_id');
        
        // Get type's input
        $type = $this->CI->input->get('type');      
            
        if ( is_numeric($post_id) && $type ) {
                
            // Get post
            $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post_id);

            if ( $get_post ) {

                $data = array(
                    'success' => TRUE,
                    'post' => $get_post
                );

                echo json_encode($data); 

            } else {

                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('no_post_found')
                );

                echo json_encode($data);

            }
            
        } else {
            
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('error_occurred')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_planify_delete_post_media deletes post's media
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_delete_post_media() {
        
        // Get post_id's input
        $post_id = $this->CI->input->get('post_id');
        
        // Get media_id's input
        $media_id = $this->CI->input->get('media_id');        
        
        // Get type's input
        $type = $this->CI->input->get('type');      
            
        if ( is_numeric($post_id) && is_numeric($media_id) && $type ) {
            
            // Get post
            $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post_id);
            
            $count = 0;
            
            // Verify if post exists
            if ( $get_post ) {
                
                if ( $type === 'image' ) {
                    
                    $imgs = unserialize($get_post['imgIds']);
                    
                    if ( in_array($media_id, $imgs) ) {
                        
                        unset($imgs[array_search($media_id,$imgs)]);
                        
                        $imgs = serialize($imgs);
                        
                        if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'img', $imgs) ) {
                            
                            $count++;
                            
                        }
                        
                    }
                    
                } else if ( $type === 'video' ) {
                    
                    $video = unserialize($get_post['videoIds']);
                    
                    if ( in_array($media_id, $video) ) {
                        
                        unset($video[array_search($media_id,$video)]);
                        
                        $video = serialize($video);
                        
                        if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'video', $video) ) {
                            
                            $count++;
                            
                        }
                        
                    }
                    
                }
                
                if ( $count ) {

                    // Get post
                    $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post_id);
                    
                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('file_was_deleted'),
                        'post' => $get_post
                    );

                    echo json_encode($data);                    
                    
                    
                } else {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('file_was_not_deleted')
                    );

                    echo json_encode($data);                    
                    
                }
                
                
                        
            }
            
        } else {
            
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('error_occurred')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_planify_add_post_media add post's media
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify_add_post_media() {
        
        // Get post_id's input
        $post_id = $this->CI->input->get('post_id');
        
        // Get media_id's input
        $media_id = $this->CI->input->get('media_id');    
            
        if ( is_numeric($post_id) && is_numeric($media_id) ) {
            
            // Get post
            $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post_id);
            
            // Get media's data
            $get_media = $this->CI->media->single_media($this->CI->user_id, $media_id);
            
            $count = 0;
            
            // Verify if post and media exists
            if ( $get_post && $get_media ) {
                
                if ( $get_media[0]->type === 'image' ) {
                    
                    $imgs = unserialize($get_post['imgIds']);
                    
                    if ( count($imgs) >= 10 ) {
                        
                        $data = array(
                            'success' => FALSE,
                            'message' => $this->CI->lang->line('10_images_post')
                        );

                        echo json_encode($data);
                        exit();
                        
                    }
                    
                    $imgs[] = $media_id;
                        
                    $imgs = serialize($imgs);

                    if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'img', $imgs) ) {

                        $count++;

                    }
                    
                } else if ( $get_media[0]->type === 'video' ) {
                    
                    $video = unserialize($get_post['videoIds']);
                    
                    if ( count($video) >= 1 ) {
                        
                        $data = array(
                            'success' => FALSE,
                            'message' => $this->CI->lang->line('10_videos_post')
                        );

                        echo json_encode($data);
                        exit();
                        
                    }                    
                    
                    $video[] = $media_id;
                        
                    $video = serialize($video);

                    if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'video', $video) ) {

                        $count++;

                    }
                    
                }
                
                if ( $count ) {

                    // Get post
                    $get_post = $this->CI->planner_posts_model->get_post($this->CI->user_id, $post_id);
                    
                    $data = array(
                        'success' => TRUE,
                        'post' => $get_post
                    );

                    echo json_encode($data);                    
                    
                    
                } else {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('error_occurred')
                    );

                    echo json_encode($data);                    
                    
                }
                        
            } else {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('error_occurred')
                );

                echo json_encode($data);                
                
            }
            
        } else {
            
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('error_occurred')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_update_a_post updates a post
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_update_a_post() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('post_id', 'Post ID', 'trim|integer|required');
            $this->CI->form_validation->set_rules('body', 'Body', 'trim|required');
            $this->CI->form_validation->set_rules('title', 'Title', 'trim');
            $this->CI->form_validation->set_rules('url', 'Url', 'trim');
            
            // Get data
            $post_id = $this->CI->input->post('post_id');
            $post = $this->CI->input->post('body');
            $title = $this->CI->input->post('title');
            $url = $this->CI->input->post('url');
            
            if ( $this->CI->form_validation->run() == false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('your_post_too_short')
                );

                echo json_encode($data);
                
            } else {
                
                $count = 0;
                
                if ( $post ) {
                    
                    if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'body', $post) ) {

                        $count++;

                    }
                    
                }
                
                if ( $title ) {
                    
                    if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'title', $title) ) {

                        $count++;

                    }
                    
                }
                
                if ( $url ) {
                    
                    if ( $this->CI->planner_posts_model->update_post($this->CI->user_id, $post_id, 'url', $url) ) {

                        $count++;

                    }
                    
                }
                
                if ( $count ) {
                    
                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('post_was_updated')
                    );

                    echo json_encode($data);                    
                    
                    
                } else {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('post_was_not_updated')
                    );

                    echo json_encode($data);                    
                    
                }
                
            }
            
        }
        
    }

}

