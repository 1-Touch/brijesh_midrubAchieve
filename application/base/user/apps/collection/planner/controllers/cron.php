<?php
/**
 * Cron Controller
 *
 * This file loads the Planner's cron job commands
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner\Controllers;

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Cron class loads the app's cron job commands
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */
class Cron {
    
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
     * The public method schedule_posts schedules the planned posts
     * 
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function schedule_posts() {
        
        // Load the Planifications model
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_planifications_model', 'planner_planifications_model' );
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_posts_model', 'planner_posts_model' );
        $this->CI->load->ext_model( MIDRUB_BASE_USER_APPS_PLANNER . 'models/', 'Planner_lists_model', 'planner_lists_model' );
        
        // Get all active metas
        $active_metas = $this->CI->planner_planifications_model->get_all_active_planifications('', FALSE);

        if ( $active_metas ) {
            
            foreach ( $active_metas as $active_meta ) {
                
                $status = 1;
                $get_post = '';
                $img_ids = '';
                $video_ids = '';
                
                // Verify if user wants random multimedia files from a category
                if ( get_user_option('settings_planner_media_categories', $active_meta->user_id) ) {
                    
                    $plannification = $this->CI->planner_planifications_model->get_planification($active_meta->user_id, $active_meta->planification_id);
                    
                    if ( $plannification ) {
                    
                        $list_meta = $this->CI->planner_lists_model->get_random_meta($active_meta->user_id, $plannification[0]->category_id);
                        
                        if ( $list_meta ) {
                            
                            if ( $list_meta[0]->type === 'image' ) {
                                $img_ids = serialize(array($list_meta[0]->body));
                            }
                            
                            if ( $list_meta[0]->type === 'video' ) {
                                $video_ids = serialize(array($list_meta[0]->body));
                            }
                            
                        }
                        
                    }
                    
                }
                
                // Verify if user wants groups instead accounts
                if ( get_user_option('settings_display_groups', $active_meta->user_id) ) {
                    
                    if ( !$active_meta->group_id ) {
                        $status = 2;
                    } else {
                        $get_post = $this->CI->planner_posts_model->get_post($active_meta->user_id, $active_meta->post_id);
                    }
                    
                    if ( $get_post ) {
                        
                        if ( !$img_ids ) {
                            $img_ids = $get_post['imgIds'];
                        }
                        
                        if ( !$video_ids ) {
                            $video_ids = $get_post['videoIds'];
                        }                        
                        
                        $this->CI->planner_planifications_model->update_planification_meta_status( $active_meta->planification_id, $active_meta->meta_id, $status );
                        
                        $this->CI->planner_posts_model->save_post( $get_post['user_id'], $get_post['body'], $get_post['url'], $img_ids, $video_ids, $active_meta->scheduled, 2, $get_post['title'], $active_meta->group_id );
                        
                    } else {
                        
                        $this->CI->planner_planifications_model->update_planification_meta_status( $active_meta->planification_id, $active_meta->meta_id, $status );
                        
                    }

                } else {
                    
                    $planification_networks = $this->CI->planner_planifications_model->get_planification_networks( $active_meta->user_id, $active_meta->planification_id );
                    
                    if ( !$planification_networks ) {
                        $status = 2;
                    } else {
                        $get_post = $this->CI->planner_posts_model->get_post($active_meta->user_id, $active_meta->post_id);
                    }
                    
                    if ( $get_post ) {
                        
                        if ( !$img_ids ) {
                            $img_ids = $get_post['imgIds'];
                        }
                        
                        if ( !$video_ids ) {
                            $video_ids = $get_post['videoIds'];
                        }  
                        
                        $this->CI->planner_planifications_model->update_planification_meta_status( $active_meta->planification_id, $active_meta->meta_id, $status );

                        $post_id = $this->CI->planner_posts_model->save_post( $get_post['user_id'], $get_post['body'], $get_post['url'], $img_ids, $video_ids, $active_meta->scheduled, 2, $get_post['title'] );
                        
                        if ( $post_id ) {
                        
                            foreach ( $planification_networks as $planification_network ) {
                                
                                $this->CI->planner_posts_model->save_post_meta( $post_id, $planification_network->network_id, $planification_network->network_name, 2, $get_post['user_id'] );

                            }
                        
                        }
                        
                    } else {
                        
                        $this->CI->planner_planifications_model->update_planification_meta_status( $active_meta->planification_id, $active_meta->meta_id, $status );
                        
                    }
                    
                }                
                
            }
            
        }
        
    }
 
}
