<?php

/**
 * Responsible for plugin menu
 *
 * @link       https://https://mobeenabdullah.com
 * @since      1.0.0
 *
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 */

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Site_Mode
 * @subpackage Site_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Utilities
{

    protected   $current_user = '';
    protected   $user_role = '';


    public function __construct()
    {
        add_action('init',[$this,'get_current_user']);
    }

    public function get_current_user()
    {
        $this->current_user = wp_get_current_user();
        $this->user_roles = $this->current_user->roles;
        $this->user_role = array_shift($this->user_roles);
        return $this->user_role;
    }

}