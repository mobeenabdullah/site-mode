<?php

/**
 * Responsible for plugin menu
 *
 * This class defines all code necessary to run during the plugin's menu
 *
 * @since      1.0.0
 * @package    Rex_Maintenance_Mode
 * @subpackage Rex_Maintenance_Mode/includes
 * @author     Mobeen Abdullah <mobeenabdullah@gmail.com>
 */
class Social_Field
{


    public function __construct()
    {
        $this->add_fields();
    }
    public function add_fields()
    {
        //Social Section Field
        add_settings_field('rex_maintenance_social_icons_show_section_field', 'Show Social Icons', [$this,'rex_maintenance_social_icons_show_cb'],'rex-maintenance-social-page','rex-maintenance-social-section');
        add_settings_field('rex_maintenance_content_social_media_list', 'List of Social Icons', [$this, 'rex_maintenance_content_social_media_list_cb'], 'rex-maintenance-social-page', 'rex-maintenance-social-section');

    }
    public function rex_maintenance_social_icons_show_cb() { ?>
        <div class="um_checkbox_wrapper">
            <input type="checkbox" id="show-social-icons-setting" class="enable_disable-rows" checked name="show-social-icons-setting" value="<?php esc_attr_e(get_option('show-social-icons-setting'),'rex-maintenance-mode'); ?>" />
            <label for="show-social-icons-setting">Enable/Disable</label>
        </div>
        <?php
    }


    public function rex_maintenance_content_social_media_list_cb()
    {
        ?>
        <div class="socialmedia__wrapper">
            <div class="social_media_field">
                <div class="sortable_icon">
                    <button type="button">
                        <svg fill="none" height="15" viewBox="0 0 15 15" width="15" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M4.49999 2.5C4.49999 1.94772 4.9477 1.5 5.49999 1.5C6.05227 1.5 6.49999 1.94772 6.49999 2.5C6.49999 3.05228 6.05227 3.5 5.49999 3.5C4.9477 3.5 4.49999 3.05228 4.49999 2.5ZM8.49999 2.5C8.49999 1.94772 8.9477 1.5 9.49999 1.5C10.0523 1.5 10.5 1.94772 10.5 2.5C10.5 3.05228 10.0523 3.5 9.49999 3.5C8.9477 3.5 8.49999 3.05229 8.49999 2.5ZM4.49998 7.5C4.49998 6.94772 4.9477 6.5 5.49998 6.5C6.05227 6.5 6.49998 6.94772 6.49998 7.5C6.49998 8.05228 6.05227 8.5 5.49998 8.5C4.9477 8.5 4.49998 8.05228 4.49998 7.5ZM8.49998 7.5C8.49998 6.94771 8.9477 6.5 9.49999 6.5C10.0523 6.5 10.5 6.94772 10.5 7.5C10.5 8.05228 10.0523 8.5 9.49998 8.5C8.9477 8.5 8.49998 8.05228 8.49998 7.5ZM4.49998 12.5C4.49998 11.9477 4.9477 11.5 5.49998 11.5C6.05227 11.5 6.49998 11.9477 6.49998 12.5C6.49998 13.0523 6.05227 13.5 5.49998 13.5C4.9477 13.5 4.49998 13.0523 4.49998 12.5ZM8.49998 12.5C8.49998 11.9477 8.9477 11.5 9.49998 11.5C10.0523 11.5 10.5 11.9477 10.5 12.5C10.5 13.0523 10.0523 13.5 9.49998 13.5C8.9477 13.5 8.49998 13.0523 8.49998 12.5Z" fill="black" fill-rule="evenodd"/></svg>
                    </button>
                </div>
                <div class="social_icon">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
                    </span>
                </div>
                <div class="social_field">
                    <input type="text" name="content-social-fb-setting" value="<?php esc_attr_e(get_option('content-social-fb-setting'), 'rex-maintenance-mode') ?>" />
                </div>
                <div class="social_delete">
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                    </button>
                </div>

            </div>
            <div class="social_media_field">
                <div class="sortable_icon">
                    <button type="button">
                        <svg fill="none" height="15" viewBox="0 0 15 15" width="15" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M4.49999 2.5C4.49999 1.94772 4.9477 1.5 5.49999 1.5C6.05227 1.5 6.49999 1.94772 6.49999 2.5C6.49999 3.05228 6.05227 3.5 5.49999 3.5C4.9477 3.5 4.49999 3.05228 4.49999 2.5ZM8.49999 2.5C8.49999 1.94772 8.9477 1.5 9.49999 1.5C10.0523 1.5 10.5 1.94772 10.5 2.5C10.5 3.05228 10.0523 3.5 9.49999 3.5C8.9477 3.5 8.49999 3.05229 8.49999 2.5ZM4.49998 7.5C4.49998 6.94772 4.9477 6.5 5.49998 6.5C6.05227 6.5 6.49998 6.94772 6.49998 7.5C6.49998 8.05228 6.05227 8.5 5.49998 8.5C4.9477 8.5 4.49998 8.05228 4.49998 7.5ZM8.49998 7.5C8.49998 6.94771 8.9477 6.5 9.49999 6.5C10.0523 6.5 10.5 6.94772 10.5 7.5C10.5 8.05228 10.0523 8.5 9.49998 8.5C8.9477 8.5 8.49998 8.05228 8.49998 7.5ZM4.49998 12.5C4.49998 11.9477 4.9477 11.5 5.49998 11.5C6.05227 11.5 6.49998 11.9477 6.49998 12.5C6.49998 13.0523 6.05227 13.5 5.49998 13.5C4.9477 13.5 4.49998 13.0523 4.49998 12.5ZM8.49998 12.5C8.49998 11.9477 8.9477 11.5 9.49998 11.5C10.0523 11.5 10.5 11.9477 10.5 12.5C10.5 13.0523 10.0523 13.5 9.49998 13.5C8.9477 13.5 8.49998 13.0523 8.49998 12.5Z" fill="black" fill-rule="evenodd"/></svg>
                    </button>
                </div>
                <div class="social_icon">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><circle cx="4.983" cy="5.009" r="2.188"></circle><path d="M9.237 8.855v12.139h3.769v-6.003c0-1.584.298-3.118 2.262-3.118 1.937 0 1.961 1.811 1.961 3.218v5.904H21v-6.657c0-3.27-.704-5.783-4.526-5.783-1.835 0-3.065 1.007-3.568 1.96h-.051v-1.66H9.237zm-6.142 0H6.87v12.139H3.095z"></path></svg>
                    </span>
                </div>
                <div class="social_field">
                    <input type="text" name="content-social-linkedin-setting" value="<?php esc_attr_e(get_option('content-social-linkedin-setting'), 'rex-maintenance-mode') ?>" />
                </div>
                <div class="social_delete">
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                    </button>
                </div>

            </div>
            <div class="social_media_field">
                <div class="sortable_icon">
                    <button type="button">
                        <svg fill="none" height="15" viewBox="0 0 15 15" width="15" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M4.49999 2.5C4.49999 1.94772 4.9477 1.5 5.49999 1.5C6.05227 1.5 6.49999 1.94772 6.49999 2.5C6.49999 3.05228 6.05227 3.5 5.49999 3.5C4.9477 3.5 4.49999 3.05228 4.49999 2.5ZM8.49999 2.5C8.49999 1.94772 8.9477 1.5 9.49999 1.5C10.0523 1.5 10.5 1.94772 10.5 2.5C10.5 3.05228 10.0523 3.5 9.49999 3.5C8.9477 3.5 8.49999 3.05229 8.49999 2.5ZM4.49998 7.5C4.49998 6.94772 4.9477 6.5 5.49998 6.5C6.05227 6.5 6.49998 6.94772 6.49998 7.5C6.49998 8.05228 6.05227 8.5 5.49998 8.5C4.9477 8.5 4.49998 8.05228 4.49998 7.5ZM8.49998 7.5C8.49998 6.94771 8.9477 6.5 9.49999 6.5C10.0523 6.5 10.5 6.94772 10.5 7.5C10.5 8.05228 10.0523 8.5 9.49998 8.5C8.9477 8.5 8.49998 8.05228 8.49998 7.5ZM4.49998 12.5C4.49998 11.9477 4.9477 11.5 5.49998 11.5C6.05227 11.5 6.49998 11.9477 6.49998 12.5C6.49998 13.0523 6.05227 13.5 5.49998 13.5C4.9477 13.5 4.49998 13.0523 4.49998 12.5ZM8.49998 12.5C8.49998 11.9477 8.9477 11.5 9.49998 11.5C10.0523 11.5 10.5 11.9477 10.5 12.5C10.5 13.0523 10.0523 13.5 9.49998 13.5C8.9477 13.5 8.49998 13.0523 8.49998 12.5Z" fill="black" fill-rule="evenodd"/></svg>
                    </button>
                </div>
                <div class="social_icon">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"></path></svg>
                    </span>
                </div>
                <div class="social_field">
                    <input type="text" name="content-social-twitter-setting" value="<?php esc_attr_e(get_option('content-social-twitter-setting'), 'rex-maintenance-mode') ?>" />
                </div>
                <div class="social_delete">
                    <button type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M5 20a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8h2V6h-4V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v2H3v2h2zM9 4h6v2H9zM8 8h9v12H7V8z"></path><path d="M9 10h2v8H9zm4 0h2v8h-2z"></path></svg>
                    </button>
                </div>
            </div>
            <div class="social_btn_wrapper">
                <a href="#" class="button um_btn"><?php _e('Add More', 'rex-maintenance-mode')?></a>
            </div>
        </div>

        <?php
    }

}

