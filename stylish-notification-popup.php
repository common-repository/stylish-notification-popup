<?php

/*
  Plugin Name: Stylish Notification Popup
  Plugin URI: http://techsini.com
  Description: Stylish Notification Popup is a responsive popup plugin for wordpress to show attention grabbing message to your visitors with call to action button and customization options.
  Version: 1.1.0
  Author: Shrinivas Naik
  Author URI: http://techsini.com
  License: GPL V3
 */

/*
Copyright (C) 2017 Shrinivas Naik

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/.

*/


if(!class_exists('stylish_notification_popup') && !class_exists('stylish_notification_popup_settings')){

    class stylish_notification_popup{

        private $options;

        public function __construct(){

            //Activate the plugin for first time
            register_activation_hook(__FILE__, array($this, "activate"));

            //Initialize settings page
            require_once(plugin_dir_path(__file__) . "settings.php");
            $stylish_notification_popup_settings = new stylish_notification_popup_settings();

            //Load scipts and styles
            add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
		    add_action('wp_enqueue_scripts', array($this, 'register_styles'));

            //Store options in a variable
            $this->options = get_option( 'stylish_notification_popup_settings' );

            //Run the plugin in footer
            add_action('wp_footer', array($this, 'run_plugin'));


            //plugin action links
            add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), array($this, 'my_plugin_action_links'));

        }


        public function activate(){

            //Set default options for the plugin
            $initial_settings = array(
                'snp_enabled'   => '1',
                'popup_title'   => 'Stylish Notification Popup',
                'popup_description' => 'Stylish notification popup is a responsive popup plugin for wordpress to show attention grabbing message to your visitors.',
                'popup_button_title' => 'Example Button',
                'popup_button_url' => 'http://techsini.com',
                'popup_content_font_size' => '20',
                'popup_heading_font_size' => '32',
                'popup_color'   => '#fff',
                'popup_button_bg_color' => '#2785C8',
                'popup_button_bg_hover_color' => '#52A9E7',
                'popupdelay'    => '5',
                'credittoauthor'=> '0'
                );
            add_option("stylish_notification_popup_settings", $initial_settings);

        }

        public function deactivate(){

        }

        public function register_scripts(){
            wp_enqueue_script('jquery');
            wp_enqueue_script('snpjs', plugins_url( 'js/snp.js' , __FILE__ ),array( 'jquery' ));
        }

        public function register_styles(){
            wp_enqueue_style( 'StylishNotificationPopupStyle', plugins_url('css/style.css', __FILE__) );
            wp_enqueue_style( 'AnimateCSS', plugins_url('css/animate.css', __FILE__) );
        }

        public function run_plugin() {

            //Get plugin settings
            if(isset($this->options["snp_enabled"])){
                $snp_enabled = $this->options["snp_enabled"];
            } else {
                $snp_enabled = 0;
            }

            $popup_title = $this->options['popup_title'];
            $popup_description = $this->options['popup_description'];
            $popup_button_title = $this->options['popup_button_title'];
            $popup_button_url = $this->options['popup_button_url'];

            $popupdelay = 10;

            @$credit = $this->options['credittoauthor'];

            if($snp_enabled == 1) {

            ?>
                <style>
                    .stylishnotificationpopup-close {
                        background-image:url(<?php echo plugins_url('images/close.png', __FILE__ )?>);
                    }
                </style>

                <div id="openModal" class="stylishnotificationpopup-modal">
	               <div class="animated">
                        <a title="Close" class="stylishnotificationpopup-close"></a>

                        <h2><?php echo $popup_title; ?></h2>
                        <p><?php echo $popup_description; ?></p>

                        <br>
                        <?php if(!empty($popup_button_url) && !empty($popup_button_title)) {?>
                        <a class="snp_button_link" href="<?php echo $popup_button_url; ?>"><button class="stylishnotificationpopup-button"><?php echo $popup_button_title; ?></button></a>
                        <?php } ?>
                        <?php
                            if($credit == "1"){

                                //Backlink has been removed (commented out) in the version 1.1
                                //as it may create unnatural backlinks to our website

                                //echo "<br><a href='http://techsini.com' target='_blank'>By TECHSINI</a>";
                            }
                        ?>
	               </div>
                </div>

                <script>
                    jQuery(document).ready(function() {

                        jQuery(".stylishnotificationpopup-modal").delay(<?php echo $popupdelay * 1000  ?>).fadeIn("slow", function() {
                            jQuery("div", this).fadeIn("slow");
                            jQuery("div", this).addClass("swing");
                        });
                    });
                </script>
            <?php
            }
	    }

        function my_plugin_action_links( $links ) {
           $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page=stylish-notification-popup-settings') ) .'">Settings</a>';
           $links[] = '<br><b><a class="stylishnotificationpopup-moreplugins" href="http://techsini.com" target="_blank">Check Out More Plugins >></a></b>';
           return $links;
        }

    } //class

}//if

$stylish_notification_popup = new stylish_notification_popup();

?>
