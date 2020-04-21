<?php
/**
 * User Inc
 *
 * PHP Version 7.2
 *
 * This files contains the hooks for
 * the User's Settings from the User Panel
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */

 // Define the constants
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Registers options for User's Settings
 * 
 * @since 0.0.7.9
 */
set_user_settings_options(

    array (
        'section_name' => $this->lang->line('planner'),
        'section_slug' => 'planner',
        'component' => false,
        'section_fields' => array (

            array (
                'type' => 'checkbox_input',
                'slug' => 'settings_planner_media_categories',
                'name' => $this->lang->line('planner_display_media_categories'),
                'description' => $this->lang->line('planner_display_media_categories_description')
            )

        )
        
    )

);
