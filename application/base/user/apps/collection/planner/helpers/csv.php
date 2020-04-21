<?php
/**
 * Csv Helper
 *
 * This file contains the class Csv
 * with all methods for CSV importation
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
 * Csv imports posts from csv
 * 
 * @author Scrisoft
 * @package Midrub
 * @since 0.0.7.5
*/
class Csv {
    
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
     * The public method upload_csv imports posts from csv
     * 
     * @since 0.0.7.5
     * 
     * @return array with limits
     */ 
    public function upload_csv() {
        
        // Load Media Model
        $this->CI->load->model('media');
        
        // Verify if post data was sent
        if ( $this->CI->input->post() ) {
            
            $type = $this->CI->security->xss_clean($_FILES['file']['type']);

            if ( $type === 'application/octet-stream' || $type === 'text/csv' || $type === 'application/vnd.ms-excel' || $type === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'  ) {
                
                // Get upload limit
                $upload_limit = get_option('upload_limit');
                
                if ( !$upload_limit ) {

                    $upload_limit = 6291456;

                } else {

                    $upload_limit = $upload_limit * 1048576;

                }
                
                if ( $_FILES['file']['size'] > $upload_limit ) {
                    
                    $data = array(
                        'success' => FALSE,
                        'message' => $this->CI->lang->line('csv_file_too_large')
                    );

                    echo json_encode($data);
                    die();
                    
                }
                
                // Generate a new file name
                $csv_file = uniqid() . '-' . time();

                $config['upload_path'] = 'assets/share';
                $config['file_name'] = $csv_file;
                $config['file_ext_tolower'] = TRUE;
                $this->CI->load->library('upload', $config);
                $this->CI->upload->initialize($config);
                $this->CI->upload->set_allowed_types('*');

                // Upload file 
                if ( $this->CI->upload->do_upload('file') ) {
                    
                    // Verify if the CSV file was upoaded
                    if ( file_exists($config['upload_path'] . '/' . $csv_file . '.csv') ) {
                        
                        // Decode the csv file
                        $handle = fopen($config['upload_path'] . '/' . $csv_file . '.csv', 'r');
                        
                        $row = 1;
                        
                        $count = 0;
                        
                        // Get user storage
                        $user_storage = get_user_option('user_storage', $this->CI->user_id);
                        
                        // Get the user plan
                        $plan_id = get_user_option('plan', $this->CI->user_id);

                        $storage = plan_feature('storage', $plan_id);

                        while ( ($data = fgetcsv($handle, 1000, ",") ) !== FALSE) {

                            $num = count($data);
                            
                            $row++;
                            
                            $args = array(
                                'title' => '',
                                'post' => '',
                                'url' => '',
                                'img' => ''
                            );
                            
                            for ($c=0; $c < $num; $c++) {

                                switch ( $c ) {
                                
                                    case '0':
                                        $args['title'] = $this->CI->security->xss_clean($data[$c]);
                                        break;
                                    
                                    case '1':
                                        $args['post'] = $this->CI->security->xss_clean($data[$c]);
                                        break;
                                    
                                    case '2':
                                        $args['url'] = $this->CI->security->xss_clean($data[$c]);
                                        break;
                                    
                                    case '3':
                                        
                                        $img = $this->CI->security->xss_clean($data[$c]);
                                            
                                        if ( !filter_var( $img, FILTER_VALIDATE_URL) ) {
                                            
                                            $args['img'] = '';
                                            
                                        } else {
                                            
                                            // Supported formats
                                            $check_format = array('image/png', 'image/jpeg', 'image/gif');
                                            
                                            // Get info
                                            $info = @getimagesize($img);

                                            if (isset($info['mime'])) {

                                                if (in_array($info['mime'], $check_format)) {

                                                    $source = file_get_contents($img);

                                                    // Get total storage
                                                    $total_storage = strlen($source) + ($user_storage ? $user_storage : 0);

                                                    // Verify if user has enough storage
                                                    if (($total_storage >= $storage) || (strlen($source) > $upload_limit)) {

                                                        $args['img'] = '';
                                                        
                                                    } else {

                                                        // Generate a new file name
                                                        $file_name = uniqid() . '-' . time() . '.png';

                                                        // Open the file
                                                        $fop = fopen(FCPATH . 'assets/share/' . $file_name, 'wb');

                                                        // Decode the cover output
                                                        $decode_data = explode(',', str_replace('[removed]', 'data:image/png;base64,', $source));

                                                        // Save cover
                                                        fwrite($fop, $source);

                                                        // Close the opened file
                                                        fclose($fop);

                                                        // Update the user storage
                                                        update_user_option($this->CI->user_id, 'user_storage', $total_storage);

                                                        if (file_exists(FCPATH . 'assets/share/' . $file_name)) {

                                                            // Set read permission
                                                            chmod(FCPATH . 'assets/share/' . $file_name, 0644);

                                                            $cover = base_url() . 'assets/share/' . $file_name;

                                                            // Save uploaded file data
                                                            $last_id = $this->CI->media->save_media($this->CI->user_id, base_url() . 'assets/share/' . $file_name, 'image', $cover, strlen($source));

                                                            if ($last_id) {

                                                                $args['img'] = serialize(array($last_id));

                                                            } else {
                                                                $args['img'] = '';
                                                            }

                                                        } else {

                                                            $args['img'] = '';
                                                        }

                                                    }

                                                } else {

                                                    $args['img'] = '';
                                                }

                                            } else {

                                                $args['img'] = '';

                                            }
                                            
                                        }
                                        
                                        break;
                                
                                }
                                
                            }
                            
                            // Verify if post is not empty
                            if ( empty($args['post']) ) {

                                continue;

                            } else {

                                // Save the post
                                if ( $this->CI->planner_posts_model->save_post($this->CI->user_id, $args['post'], $args['url'], $args['img'], '', time(), 0, $args['title']) ) {

                                    $count++;

                                }

                            }
                            
                        }
                        
                        fclose($handle);
                        
                        unlink($config['upload_path'] . '/' . $csv_file . '.csv');
                        
                        $data = array(
                            'success' => TRUE,
                            'message' => $count . $this->CI->lang->line('posts_imported')
                        );

                        echo json_encode($data);
                        exit();
                        
                    }

                }
                
            }
            
        }
        
        $data = array(
            'success' => FALSE,
            'message' => $this->CI->lang->line('error_occurred')
        );

        echo json_encode($data);
        
    }

    /**
     * The public method export_csv exports a CSV example
     * 
     * @since 0.0.8.1
     * 
     * @return void
     */ 
    public function export_csv() {
        
        // Prepare the header
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=csv.csv");
        $csv = fopen('php://output', 'w');
            
        // Create CSV
        fputcsv($csv, array(
            $this->CI->lang->line('csv_post_title'),
            $this->CI->lang->line('csv_post_content'),
            $this->CI->lang->line('csv_post_url'),
            $this->CI->lang->line('csv_image_url')
        ));
        
        // Close CSV
        fclose($csv);
        
    }

}