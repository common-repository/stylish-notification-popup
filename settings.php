<?php

class stylish_notification_popup_settings {

    //Holds the values to be used in the fields callbacks
    private $options;

    public function __construct(){

        add_action("admin_menu", array($this,"add_plugin_menu"));
        add_action("admin_init", array($this,"page_init"));

        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));


    }

    public function add_plugin_menu(){

        add_options_page( "Stylish Notification Popup", //page_title
        "Stylish Notification Popup", //menu_title
        "administrator", //capability
        "stylish-notification-popup-settings", //menu_slug
        array($this, "create_admin_page")); //callback function

    }

    public function register_admin_scripts(){
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'snp_admin', plugins_url('js/snp_admin.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
        wp_enqueue_style( 'custom-admin-style', plugins_url('css/admin-css.css', __FILE__));
    }

    public function create_admin_page(){

        $this->options = get_option( 'stylish_notification_popup_settings' );

        ?>
        <div class="wrap">

            <div id="poststuff">
                <div id="post-body" class="metabox-holder columns-2">


                    <div id="post-body-content">
                        <div class="meta-box-sortables ui-sortable">
                            <div class="postbox">
                                <h3><span class="dashicons dashicons-admin-generic"></span>Stylish Notification Popup Settings (Lite Version)</h3>
                                <div class="inside">
                                    <form method="post" action="options.php">
                                        <?php
                                        // This prints out all hidden setting fields
                                        settings_fields( 'stylish_notification_popup_settings_group' ); //option group
                                        do_settings_sections( 'stylish-notification-popup-settings' ); //settings page slug
                                        submit_button(); ?>

                                        <div class="postbox">
                                            <h3><span>Upgrade to Pro</span></h3>
                                            <div class="inside">
                                                <strong>Upgrade to Pro and get the following features</strong>
                                                <ul>
                                                    <li> > WYSIWYG editor to enter your message in the backend with media upload Button</li>
                                                    <li> > Customization options to change font size, popup color, button color, button hover color</li>
                                                    <li> > You can set popup delay and Show Every X Day(s) option to avoid disturbance to your visitor</li>
                                                </ul>
                                                <a href="http://techsini.com/our-wordpress-plugins/stylish-notification-popup" target="_blank"><button type="button" class="button button-primary" name="getpro">Get Pro Version Now!</button></a><br>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!--post-body-content-->


                    <!-- sidebar -->
                    <div id="postbox-container-1" class="postbox-container">
                        <div class="meta-box-sortables">


                            <div class="postbox">
                                <h3><span>About</span></h3>
                                <div class="inside">
                                    <strong>Stylish Notification Popup Lite</strong><br>
                                    Author: Shrinivas Naik <br>
                                    Website: <a href="http://techsini.com" target="_blank">TechSini.com</a> <br>
                                    <br>
                                    <a href="http://techsini.com/our-wordpress-plugins/stylish-notification-popup" target="_blank"><button type="button" class="button button-primary" name="getpro">Get Pro Version Now!</button></a><br>
                                    
                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->

                            <div class="postbox">
                                <h3><span>Rate This Plugin!</span></h3>
                                <div class="inside">
                                    <p>Please <a href="https://wordpress.org/plugins/stylish-notification-popup/" target="_blank">rate this plugin</a> and share it to help the development.</p>

                                    <ul class="soc">
                                        <li><a class="soc-facebook" href="https://www.facebook.com/techsini" target="_blank"></a></li>
                                        <li><a class="soc-twitter" href="https://twitter.com/techsini" target="_blank"></a></li>
                                        <li><a class="soc-google soc-icon-last" href="https://plus.google.com/+Techsini" target="_blank"></a></li>
                                    </ul>

                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->

                            <div class="postbox">
                                <h3><span>Our other WordPress Plugins</span></h3>
                                <div class="inside">
                                    <ul>
                                        <li><a href="http://techsini.com/our-wordpress-plugins/fluid-notification-bar/">Fluid Notification Bar</a></li>
                                        <li><a href="http://techsini.com/our-wordpress-plugins/simple-adblock-notice/">Simple Adblock Notice</a></li>
                                        <li><a href="http://techsini.com/our-wordpress-plugins/elegant-subscription-popup/">Elegant Subscription Popup</a></li>
                                    </ul>
                                </div> <!-- .inside -->
                            </div> <!-- .postbox -->

                        </div> <!-- .meta-box-sortables -->
                    </div> <!-- #postbox-container-1 .postbox-container -->

                </div>
            </div>
        </div>
        <?php
    }

    public function page_init(){

        register_setting(
        'stylish_notification_popup_settings_group', // Option group
        'stylish_notification_popup_settings' // Option name
    );

    add_settings_section(
    'section_1', // ID
    '', // Title
    array( $this, 'section_1_callback' ), // Callback
    'stylish-notification-popup-settings' // Page
);

add_settings_field(
'snp_enabled', // ID
'Enable Popup', // Title
array( $this, 'snp_enabled_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

add_settings_field(
'popup_title', // ID
'Popup Title', // Title
array( $this, 'popup_title_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

add_settings_field(
'popup_description', // ID
'Popup Description', // Title
array( $this, 'popup_description_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

add_settings_field(
'popup_button_title', // ID
'Popup Button Title', // Title
array( $this, 'popup_button_title_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

add_settings_field(
'popup_button_url', // ID
'Popup Button URL', // Title
array( $this, 'popup_button_url_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

add_settings_field(
'credittoauthor', // ID
'Wanna Give Credit to Author with a backlink?', // Title
array( $this, 'credittoauthor_callback' ), // Callback
'stylish-notification-popup-settings', // Page
'section_1' // Section
);

}
public function section_1_callback(){
}

public function snp_enabled_callback(){
    if(isset($this->options['snp_enabled'])){
        $snpenabled = $this->options['snp_enabled'];
    } else {
        $snpenabled = 0;
    }

    printf ('<label for="snp_enabled">
    <input type = "checkbox"
    id = "snp_enabled"
    name= "stylish_notification_popup_settings[snp_enabled]"
    value = "1"' . checked(1, $snpenabled, false) . '/>'.
    ' Yes</label>');

}


public function popup_title_callback(){
    printf('<input type="text" id="popup_title" name="stylish_notification_popup_settings[popup_title]" value="%s" />',  isset( $this->options['popup_title'] ) ? esc_attr( $this->options['popup_title']) : '');
}

public function popup_description_callback(){
    printf('<textarea id="popup_description" rows="4" class="large-text" name="stylish_notification_popup_settings[popup_description]">%s</textarea>',  isset( $this->options['popup_description'] ) ? esc_attr( $this->options['popup_description']) : '');
}

public function popup_button_title_callback(){
    printf('<input type="text" id="popup_button_title" name="stylish_notification_popup_settings[popup_button_title]" value="%s" />',  isset( $this->options['popup_button_title'] ) ? esc_attr( $this->options['popup_button_title']) : '');
}

public function popup_button_url_callback(){
    printf('<input class="regular-text" type="url" id="popup_button_url" name="stylish_notification_popup_settings[popup_button_url]" value="%s" />',  isset( $this->options['popup_button_url'] ) ? esc_attr( $this->options['popup_button_url']) : '');
}

public function credittoauthor_callback(){

    if (!isset($this->options['credittoauthor']))
    {
        $this->options['credittoauthor'] = 0;
    }

    echo ('<input type = "checkbox"
    id = "credittoauthor"
    name= "stylish_notification_popup_settings[credittoauthor]"
    value = "1"' . checked(1, $this->options['credittoauthor'], false) . '/>' );
}

}


?>
