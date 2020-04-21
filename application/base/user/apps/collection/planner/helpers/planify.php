<?php
/**
 * Planify Helpers
 *
 * This file contains the class Planify
 * with has the planify's modal methods
 *
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
 */

// Define the page namespace
namespace MidrubBase\User\Apps\Collection\Planner\Helpers;

// Constants
defined('BASEPATH') OR exit('No direct script access allowed');

// Define the namespaces to use
use MidrubBase\User\Apps\Collection\Planner\Helpers as MidrubBaseUserAppsCollectionPlannerHelpers;

/*
 * Planify class provides the planify's modal methods
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
*/
class Planify {
    
    /**
     * Class variables
     *
     * @since 0.0.7.5
     */
    protected $CI, $planner_posts, $time, $order = 0, $count = 0, $active_planifications = 0;

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
     * The public method planner_save_planification saves a planification
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_save_planification() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->CI->form_validation->set_rules('planification_rules', 'Planifications Rules', 'trim');
            $this->CI->form_validation->set_rules('networks', 'Networks', 'trim');
            $this->CI->form_validation->set_rules('planification_id', 'Planification ID', 'trim');
            $this->CI->form_validation->set_rules('group_id', 'Group ID', 'trim');
            $this->CI->form_validation->set_rules('category_id', 'Category ID', 'trim');
            $this->CI->form_validation->set_rules('current_date', 'Current Date', 'trim');
            
            // Get data
            $title = $this->CI->input->post('title');
            $planification_rules = $this->CI->input->post('planification_rules');
            $networks = $this->CI->input->post('networks');
            $planification_id = $this->CI->input->post('planification_id');
            $group_id = $this->CI->input->post('group_id');
            $category_id = $this->CI->input->post('category_id');
            $current_date = $this->CI->input->post('current_date');
            $this->time = time() - strtotime($current_date);

            if ( $this->CI->form_validation->run() == false ) {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('please_enter_title')
                );

                echo json_encode($data);   
                
            } else {
                
                $plan_id = get_user_option('plan', $this->CI->user_id);
                
                $allowed_plannifications = plan_feature('planner_allowed_plannifications', $plan_id);
                
                if ( !$allowed_plannifications ) {
                    $allowed_plannifications = 1000;
                }
                
                if ( !$networks && !get_user_option('settings_display_groups') ) {

                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('please_select_at_least_one_account')
                    );

                    echo json_encode($data);

                    exit();

                }
                
                if ( $planification_id ) {
                    
                    $total_count = 0;
                    
                    if ( $this->CI->planner_planifications_model->update_planification($planification_id, $this->CI->user_id, $title, $group_id, $category_id) ) {
                        $total_count++;
                    }
                        
                    $rules = array();
                    
                    $ids = array();
                    
                    if ( $planification_rules ) {
                        
                        // Verify if user wants groups instead accounts
                        if ( !get_user_option('settings_display_groups') ) {
                        
                            $nets = array();

                            foreach ($networks as $key => $value) {

                                $value = json_decode($value, true);

                                if ( $value ) {

                                    foreach ( $value as $val ) {

                                        if ( !in_array($val, $nets) ) {

                                            $nets[] = $val;

                                        }

                                    }

                                }

                            }

                            // Get planification networks
                            $planification_networks = $this->CI->planner_planifications_model->get_planification_networks( $this->CI->user_id, $planification_id );

                            if ( $planification_networks ) {

                                foreach ( $planification_networks as $planification_network ) {

                                    if ( !in_array($planification_network->network_id, $nets) ) {

                                        if ( $this->CI->planner_planifications_model->delete_planification_network($planification_network->id) ) {
                                            $total_count++;
                                        }

                                    } else {
                                        
                                        unset($nets[array_search($planification_network->network_id,$nets)]);
                                        
                                    }

                                }

                            }


                            if ( $nets ) {

                                foreach ( $nets as $net ) {

                                    if ($this->CI->planner_planifications_model->save_planification_networks($planification_id, $net)) {
                                        $total_count++;
                                    }

                                }

                            }
                            
                        }

                        foreach ( $planification_rules as $planification_rule ) {

                            if ( isset($planification_rule['rule_id']) ) {

                                $ids[] = $planification_rule['rule_id'];

                            } else {

                                $rules[] = $planification_rule;

                            }

                        }
                        
                        // Get planification rules
                        $planification_active_rules = $this->CI->planner_planifications_model->get_planification_rules( $this->CI->user_id, $planification_id );
                        
                        if ( $planification_active_rules ) {
                            
                            foreach ( $planification_active_rules as $planification_active_rule ) {
                                
                                if ( !in_array($planification_active_rule->rule_id, $ids) ) {
                                    
                                    if ( $this->CI->planner_planifications_model->delete_planification_rules($this->CI->user_id, $planification_active_rule->rule_id) ) {
                                        $total_count++;
                                    }
                                    
                                }
                                
                            }
                            
                        }
                        
                        if ( $rules ) {
                            
                            $rules_count = 0;
                            
                            $planner_posts = $this->CI->planner_planifications_model->get_planification_posts($this->CI->user_id, $planification_id);
                            
                            if ( !$planner_posts ) {

                                $data = array(
                                    'success' => FALSE,
                                    'message' => $this->CI->lang->line('no_post_to_planify')
                                );

                                echo json_encode($data);

                                exit();

                            } else {

                                $this->planner_posts = $planner_posts;

                            }

                            foreach ( $rules as $rule ) {

                                $date_from = explode('-', $rule['date_from']);

                                $date_to = explode('-', $rule['date_to']);

                                if ( strtotime($date_to[1] . '-' . $date_to[0] . '-' . $date_to[2]) - strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]) >= 0 ) {

                                    $hour_from = $rule['hour_from'];
                                    $time_from = $rule['time_from'];
                                    $hour_to = $rule['hour_to'];
                                    $time_to = $rule['time_to'];

                                    if ( $rule['selected_days'] && is_numeric($hour_from) && is_numeric($time_from) && is_numeric($hour_to) && is_numeric($time_to) ) {

                                        $mon = 0;

                                        if ( in_array(1, $rule['selected_days']) ) {
                                            $mon = 1;
                                        }

                                        $tue = 0;

                                        if ( in_array(2, $rule['selected_days']) ) {
                                            $tue = 1;
                                        }

                                        $wed = 0;

                                        if ( in_array(3, $rule['selected_days']) ) {
                                            $wed = 1;
                                        }

                                        $thu = 0;

                                        if ( in_array(4, $rule['selected_days']) ) {
                                            $thu = 1;
                                        }

                                        $fri = 0;

                                        if ( in_array(5, $rule['selected_days']) ) {
                                            $fri = 1;
                                        }

                                        $sat = 0;

                                        if ( in_array(6, $rule['selected_days']) ) {
                                            $sat = 1;
                                        }

                                        $sun = 0;

                                        if ( in_array(7, $rule['selected_days']) ) {
                                            $sun = 1;
                                        }

                                        $plan_order = 1;

                                        if ( (int)$rule['order'] === 2 ) {
                                            $plan_order = 2;
                                        }

                                        $plan_limit = 1;

                                        if ( is_numeric($rule['limit']) && $rule['limit'] > 1 && $rule['limit'] < 11 ) {
                                            $plan_limit = $rule['limit'];
                                        } 

                                        $plan_interval = 1;

                                        if ( (int)$rule['interval'] === 2 ) {
                                            $plan_interval = 2;
                                        }

                                        $data = array(
                                            'user_id' => $this->CI->user_id,
                                            'planification_id' => $planification_id,
                                            'date_from' => $rule['date_from'],
                                            'date_to' => $rule['date_to'],
                                            'time_from' => $hour_from . ':' . $time_from . ':' . '00',
                                            'time_to' => $hour_to . ':' . $time_to . ':' . '00',
                                            'mon' => $mon,
                                            'tue' => $tue,
                                            'wed' => $wed,
                                            'thu' => $thu,
                                            'fri' => $fri,
                                            'sat' => $sat,
                                            'sun' => $sun,
                                            'plan_order' => $plan_order,
                                            'plan_limit' => $plan_limit,
                                            'plan_interval' => $plan_interval,
                                            'created' => time()
                                        );

                                        $rules_id = $this->CI->planner_planifications_model->save_planification_rules($data);

                                        if ( $rules_id ) {

                                            $data['rule_id'] = $rules_id;

                                            $rules_count++;

                                            $counts = ((strtotime($date_to[1] . '-' . $date_to[0] . '-' . $date_to[2]) - strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]))/86400) + 1;

                                            for ( $c = 0; $c < $counts; $c++ ) {

                                                $time = strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]) + ( $c * 86400 );                                             

                                                if ( ((int)date( 'N', $time ) === 1) && ($mon === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 2) && ($tue === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 3) && ($wed === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 4) && ($thu === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 5) && ($fri === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 6) && ($sat === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                } else if ( ((int)date( 'N', $time ) === 7) && ($sun === 1) ) {

                                                    $this->planner_planify($time, $data);

                                                }

                                                if ($this->active_planifications >= $allowed_plannifications ) {

                                                    $datas = array(
                                                        'success' => FALSE,
                                                        'message' => $this->CI->lang->line('reached_maximum_number_planifications')
                                                    );

                                                    echo json_encode($datas);

                                                    exit();

                                                }

                                            }

                                        } 

                                    }

                                }

                            }
                            
                            if ( $rules_count > 0 ) {
                                
                                $data = array(
                                    'success' => TRUE,
                                    'message' => $this->CI->lang->line('planification_was_updated_successfully')
                                );

                                echo json_encode($data);
                                exit();                                
                                
                            } else {
                                
                                $data = array(
                                    'success' => FALSE,
                                    'message' => $this->CI->lang->line('error_occurred')
                                );

                                echo json_encode($data);
                                exit();
                                
                            }
                            
                        } else {
                            
                            if ( $total_count > 0 ) {
                            
                                $data = array(
                                    'success' => TRUE,
                                    'message' => $this->CI->lang->line('planification_was_updated_successfully')
                                );

                                echo json_encode($data);
                                exit();
                            
                            } else {
                                
                                $data = array(
                                    'success' => FALSE,
                                    'message' => $this->CI->lang->line('planification_was_not_updated_successfully')
                                );

                                echo json_encode($data);
                                exit();                                
                                
                            }
                            
                        }
                    
                    } else {
                        
                        $data = array(
                            'success' => FALSE,
                            'message' => $this->CI->lang->line('at_least_planification_rule')
                        );

                        echo json_encode($data);
                        exit();
                        
                    }
                    
                } else {
                    
                    $active_planifications = $this->CI->planner_planifications_model->get_all_active_planifications($this->CI->user_id);
                
                    if ( $active_planifications ) {

                        $this->active_planifications = count($active_planifications);

                        if ( $this->active_planifications >= $allowed_plannifications ) {

                            $data = array(
                                'success' => FALSE,
                                'message' => $this->CI->lang->line('reached_maximum_number_planifications')
                            );

                            echo json_encode($data);

                            exit();

                        }

                    }

                    $planner_posts = $this->CI->planner_posts_model->get_all_planner_posts($this->CI->user_id);

                    if ( !$planner_posts ) {

                        $data = array(
                            'success' => FALSE,
                            'message' => $this->CI->lang->line('no_post_to_planify')
                        );

                        echo json_encode($data);

                        exit();

                    } else {

                        $this->planner_posts = $planner_posts;

                    }

                    $planification_id = $this->CI->planner_planifications_model->save_planification($this->CI->user_id, $title, $group_id, $category_id);

                    if ( $planification_id ) {

                        $networks_count = 0;
                        
                        // Verify if user wants groups instead accounts
                        if ( !get_user_option('settings_display_groups') ) {

                            foreach ($networks as $key => $value) {

                                $value = json_decode($value, true);

                                if ( $value ) {

                                    foreach ( $value as $val ) {

                                        if ( $this->CI->planner_planifications_model->save_planification_networks($planification_id, $val) ) {
                                            $networks_count++;
                                        }

                                    }

                                }

                            }
                            
                        } else {
                            $networks_count++;
                        }

                        if ( !$networks_count ) {

                            $this->CI->planner_planifications_model->delete_planification($this->CI->user_id, $planification_id);

                        } else {

                            $posts_count = 0;

                            foreach ( $planner_posts as $post ) {

                                if ( $this->CI->planner_planifications_model->save_planification_posts($planification_id, $post->post_id) ) {
                                    $posts_count++;
                                }                            

                            }

                            if ( !$posts_count ) {

                                $this->CI->planner_planifications_model->delete_planification($this->CI->user_id, $planification_id);

                            } else {

                                if ( $planification_rules ) {

                                    $rules_count = 0;

                                    foreach ( $planification_rules as $rule ) {

                                        $date_from = explode('-', $rule['date_from']);

                                        $date_to = explode('-', $rule['date_to']);

                                        if ( strtotime($date_to[1] . '-' . $date_to[0] . '-' . $date_to[2]) - strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]) >= 0 ) {

                                            $hour_from = $rule['hour_from'];
                                            $time_from = $rule['time_from'];
                                            $hour_to = $rule['hour_to'];
                                            $time_to = $rule['time_to'];

                                            if ( $rule['selected_days'] && is_numeric($hour_from) && is_numeric($time_from) && is_numeric($hour_to) && is_numeric($time_to) ) {

                                                $mon = 0;

                                                if ( in_array(1, $rule['selected_days']) ) {
                                                    $mon = 1;
                                                }

                                                $tue = 0;

                                                if ( in_array(2, $rule['selected_days']) ) {
                                                    $tue = 1;
                                                }

                                                $wed = 0;

                                                if ( in_array(3, $rule['selected_days']) ) {
                                                    $wed = 1;
                                                }

                                                $thu = 0;

                                                if ( in_array(4, $rule['selected_days']) ) {
                                                    $thu = 1;
                                                }

                                                $fri = 0;

                                                if ( in_array(5, $rule['selected_days']) ) {
                                                    $fri = 1;
                                                }

                                                $sat = 0;

                                                if ( in_array(6, $rule['selected_days']) ) {
                                                    $sat = 1;
                                                }

                                                $sun = 0;

                                                if ( in_array(7, $rule['selected_days']) ) {
                                                    $sun = 1;
                                                }

                                                $plan_order = 1;

                                                if ( (int)$rule['order'] === 2 ) {
                                                    $plan_order = 2;
                                                }

                                                $plan_limit = 1;

                                                if ( is_numeric($rule['limit']) && $rule['limit'] > 1 && $rule['limit'] < 11 ) {
                                                    $plan_limit = $rule['limit'];
                                                } 

                                                $plan_interval = 1;

                                                if ( (int)$rule['interval'] === 2 ) {
                                                    $plan_interval = 2;
                                                }

                                                $data = array(
                                                    'user_id' => $this->CI->user_id,
                                                    'planification_id' => $planification_id,
                                                    'date_from' => $rule['date_from'],
                                                    'date_to' => $rule['date_to'],
                                                    'time_from' => $hour_from . ':' . $time_from . ':' . '00',
                                                    'time_to' => $hour_to . ':' . $time_to . ':' . '00',
                                                    'mon' => $mon,
                                                    'tue' => $tue,
                                                    'wed' => $wed,
                                                    'thu' => $thu,
                                                    'fri' => $fri,
                                                    'sat' => $sat,
                                                    'sun' => $sun,
                                                    'plan_order' => $plan_order,
                                                    'plan_limit' => $plan_limit,
                                                    'plan_interval' => $plan_interval,
                                                    'created' => time()
                                                );

                                                $rules_id = $this->CI->planner_planifications_model->save_planification_rules($data);

                                                if ( $rules_id ) {

                                                    $data['rule_id'] = $rules_id;

                                                    $rules_count++;

                                                    $counts = ((strtotime($date_to[1] . '-' . $date_to[0] . '-' . $date_to[2]) - strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]))/86400) + 1;

                                                    for ( $c = 0; $c < $counts; $c++ ) {

                                                        $time = strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2]) + ( $c * 86400 );                                             

                                                        if ( ((int)date( 'N', $time ) === 1) && ($mon === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 2) && ($tue === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 3) && ($wed === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 4) && ($thu === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 5) && ($fri === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 6) && ($sat === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        } else if ( ((int)date( 'N', $time ) === 7) && ($sun === 1) ) {

                                                            $this->planner_planify($time, $data);

                                                        }

                                                        if ($this->active_planifications >= $allowed_plannifications ) {

                                                            $datas = array(
                                                                'success' => FALSE,
                                                                'message' => $this->CI->lang->line('reached_maximum_number_planifications')
                                                            );

                                                            echo json_encode($datas);

                                                            exit();

                                                        }

                                                    }

                                                } 

                                            }

                                        } 

                                        if ( !$rules_count ) {

                                            $this->CI->planner_planifications_model->delete_planification($this->CI->user_id, $planification_id);

                                        }

                                    }

                                } else {

                                    $this->CI->planner_planifications_model->delete_planification($this->CI->user_id, $planification_id);

                                    $data = array(
                                        'success' => FALSE,
                                        'message' => $this->CI->lang->line('at_least_planification_rule')
                                    );

                                    echo json_encode($data);
                                    exit();

                                }

                            }

                        }

                        if ( $this->count ) {

                            $data = array(
                                'success' => TRUE,
                                'message' => $this->CI->lang->line('planification_was_saved')
                            );

                            echo json_encode($data);
                            exit();

                        } else {

                            $this->CI->planner_planifications_model->delete_planification($this->CI->user_id, $planification_id);

                            $data = array(
                                'success' => FALSE,
                                'message' => $this->CI->lang->line('planification_was_not_saved')
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
        
    }
    
    /**
     * The public method planner_planify planifies a planification
     * 
     * @param integer $time contains the scheduling time
     * @param array $data contains the planification's data
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_planify($time, $data) {
        
        $time_from = $data['time_from'];
        
        $time_to = $data['time_to'];
        
        $start = strtotime(date('Y-m-d', $time) . ' ' . $time_from );
        
        $end = strtotime(date('Y-m-d', $time) . ' ' . $time_to );
        
        $date_from = explode('-', $data['date_from']);

        $date_to = explode('-', $data['date_to']);
        
        $time_from2 = $data['time_from'];
        
        $time_to2 = $data['time_to'];
        
        $start2 = strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2] . ' ' . $time_from2 );
        
        $end2 = strtotime($date_from[1] . '-' . $date_from[0] . '-' . $date_from[2] . ' ' . $time_to2 );
        
        if ( $end2 < $start2 ) {
            $end2 = $start2;
            $int = 10;
        } else {
            $int = $end2 - $start2;
        }

        if ( $int === $end2 ) {

            $val = 10;

        } else {

            $val = $int/$data['plan_limit'];

        }
        
        for ( $w = 0; $w < $data['plan_limit']; $w++ ) {
            
            if ( (int)$data['plan_interval'] === 1 ) {
                $time = ceil($w * $val);
            } else {
                $time = rand(0, $val);
            }
            
            $datas = array(
                'planification_id' => $data['planification_id'],
                'rule_id' => $data['rule_id'],
                'exact_date' => date('Y-m-d H:i:s', ($start + $time)),
                'scheduled' => ( $this->time + ($start + $time))
            );
            
            if ( (int)$data['plan_order'] === 1 ) {
                if ( isset($this->planner_posts[$this->order] ) ) {
                    $datas['post_id'] = $this->planner_posts[$this->order]->post_id;
                    $this->order++;
                } else {
                    $this->order = 0;
                    $datas['post_id'] = $this->planner_posts[$this->order]->post_id;
                    $this->order++;
                }
                
            } else {
                $count_all = count($this->planner_posts) - 1;
                $datas['post_id'] = $this->planner_posts[rand(0, $count_all)]->post_id;
            }            

            if ( $this->CI->planner_planifications_model->save_planification_rules_meta($datas) ) {
                $this->count++;
                $this->active_planifications++;
            }
            
        }
        
    }
    
    /**
     * The public method planner_display_all_planifications displays all planifications
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_display_all_planifications() {
        
        // Get start's input
        $start = $this->CI->input->get('start');
        
        // Get end's input
        $end = $this->CI->input->get('end');
        
        // Get planifications
        $all_planifications = $this->CI->planner_planifications_model->get_all_planifications( $this->CI->user_id, $start, $end );
        
        if ( $all_planifications ) {
            
            $data = array(
                'success' => TRUE,
                'all_planifications' => $all_planifications
            );

            echo json_encode($data);
            
        } else {
            
            $data = array(
                'success' => FALSE
            );

            

            echo json_encode($data);
            
        }
        //echo "<pre>"; print_r($data); die;
    }
    
    /**
     * The public method planner_get_planification displays planification
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_get_planification() {
        
        // Get planification_id's input
        $planification_id = $this->CI->input->get('planification_id');
        
        // Get meta_id's input
        $meta_id = $this->CI->input->get('meta_id');
        
        if ( is_numeric($planification_id) && is_numeric($meta_id) ) {
        
            // Get planification
            $planification_data = $this->CI->planner_planifications_model->get_planification( $this->CI->user_id, $planification_id );
            
            if ( $planification_data ) {

                // Get planification networks
                $planification_networks = $this->CI->planner_planifications_model->get_planification_networks( $this->CI->user_id, $planification_id );
                
                // Get planification rules
                $planification_rules = $this->CI->planner_planifications_model->get_planification_rules( $this->CI->user_id, $planification_id );
                
                // Get planification meta
                $planification_rules_metas = $this->CI->planner_planifications_model->get_planification_rules_meta( $this->CI->user_id, $planification_id, $meta_id);

                // Get total planification's posts
                $total = $this->CI->planner_planifications_model->get_planification_posts_by_page($planification_id, $this->CI->user_id, '', '');

                // Get planification posts by page
                $get_posts = $this->CI->planner_planifications_model->get_planification_posts_by_page($planification_id, $this->CI->user_id, 0, 10);
                
                $networks = array();
                
                if ( $planification_networks ) {
                    
                    foreach ( $planification_networks as $planification_network ) {
                        
                        $networks[] = array(
                            'network_id' => $planification_network->network_id,
                            'net_id' => $planification_network->net_id,
                            'network_name' => $planification_network->network_name,
                            'network_icon' => (new MidrubBaseUserAppsCollectionPlannerHelpers\Accounts)->get_network_icon(ucfirst($planification_network->network_name)),
                            'user_name' => $planification_network->user_name
                        );
                        
                    }
                    
                }

                $data = array(
                    'success' => TRUE,
                    'planification_data' => $planification_data,
                    'planification_networks' => $networks,
                    'planification_posts' => $get_posts,
                    'planification_rules' => $planification_rules,
                    'planification_rules_metas' => $planification_rules_metas,
                    'planification_posts_total' => $total,
                    'page' => 1
                );

                echo json_encode($data);    
                exit();
            
            }
        
        }
        
        $data = array(
            'success' => FALSE,
            'message' => $this->CI->lang->line('no_planification_found')
        );

        echo json_encode($data);
        
    }
    
    /**
     * The public method planner_delete_planification_rule_meta deletes planification rule meta
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_planification_rule_meta() {
        
        // Get meta_id's input
        $meta_id = $this->CI->input->get('meta_id');
        
        if ( is_numeric($meta_id) ) {
        
            // Delete planification
            $planification_id = $this->CI->planner_planifications_model->delete_planification_rules_meta( $this->CI->user_id, $meta_id );
            
            if ( $planification_id ) {
                
                // Get planification rules metas
                $planification_metas = $this->CI->planner_planifications_model->get_all_planification_rules_meta( $this->CI->user_id, $planification_id );
                
                if ( !$planification_metas ) {
                    
                    // Delete planification
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
                            'message' => $this->CI->lang->line('no_planification_found')
                        );

                        echo json_encode($data);

                    }
                    
                    
                } else {

                    $data = array(
                        'success' => TRUE,
                        'message' => $this->CI->lang->line('planned_post_was_deleted'),
                        'meta_id' => $meta_id
                    );

                    echo json_encode($data);   
                
                }
            
            } else {
                
                $data = array(
                    'success' => FALSE,
                    'message' => $this->CI->lang->line('planned_post_was_not_deleted')
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
     * The public method planner_delete_planification deletes a planification
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_delete_planification() {
        
        // Get planification_id's input
        $planification_id = $this->CI->input->get('planification_id');
        
        if ( is_numeric($planification_id) ) {
        
            // Delete planification
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
                    'message' => $this->CI->lang->line('planification_was_not_deleted')
                );

                echo json_encode($data);                 
                
            }
        
        } else {
        
            $data = array(
                'success' => FALSE,
                'message' => $this->CI->lang->line('no_planification_found')
            );

            echo json_encode($data);
            
        }
        
    }
    
    /**
     * The public method planner_get_all_planifications gets all user's planifications
     *
     * @since 0.0.7.5
     * 
     * @return void
     */
    public function planner_get_all_planifications() {
        
        // Gets planifications
        $planifications = $this->CI->planner_planifications_model->get_all_planifications( $this->CI->user_id, 0, 4701052026 );
        
        $select = '<option value="0">' . $this->CI->lang->line('no_planification_selected') . '</option>';

        if ( $planifications ) {
            
            foreach ( $planifications as $planification ) {
                
                $select .= '<option value="' . $planification->planification_id . '">' . $planification->title . '</option>';
                
            }     

        }
        
        $data = array(
            'planifications' => $select
        );

        echo json_encode($data);  
        
    }

}