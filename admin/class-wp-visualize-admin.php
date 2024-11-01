<?php

/**
 *
 * @package    WP_Visualize
 * @subpackage WP_Visualize/admin
 * @author     Bizetools <support@bizetools.com>
 */
class WP_Visualize_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('woocommerce_product_options_general_product_data', function () {
            if (isset($_GET['post'])){
                $id = sanitize_text_field($_GET['post']);

                if (!isset($_SESSION['wpv_sub_active']) || $_SESSION['wpv_sub_active'] !== true) {
                    return;
                }

                echo('<div>');

                echo '
                <p class="wp-visualize-wc" id="wp-vizualise-wc" style="margin-left:150px;">
                    <label>WP-Visualize</label>
                    <button class="button-secondary" id="wp_visualize_addmedia" data-id="' . esc_attr($id) . '" type="button">'. __( 'Select', 'wp-visualize' ).' WP-Visualize '. __( 'Images', 'wp-visualize' ).'</button>
                    <button class="button-primary delete-short-code" type="button" data-product_id="' . esc_attr($id) . '">'. __( 'Clear', 'wp-visualize' ) .'</button>
                    
                    <span class="woocommerce-help-tip" data-tip="'. __( 'Select images with transparent backgrounds for best results. 
                    Then click Save WP-Visualize. WP-Visualize will be available for this product. To remove from this product, 
                    click clear.', 'wp-visualize' ) .'"></span>
                </p>';
                echo('</div>');
            }else{
                echo '<p class="wp-visualize-wc" id="wp-vizualise-wc" style="margin-left:150px;">WP Visualize can be added to Woocommerce products once they have been saved by visiting the Product Edit screen.</p>';
            }
        });

        // Starting the session
        add_action('init', array($this, 'start_sess'), 1);

    }

    /*
     * Method for starting the session
     */
    function start_sess() {
        if (!session_id()) {
            session_start();
        }
    }


    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-visualize-admin.css?v=1.1.1', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        wp_enqueue_media();

        wp_enqueue_script('admin_script_main', plugin_dir_url(__FILE__) . 'js/wp-visualize-admin.js?v=7.6.21', array('jquery'), $this->version, false);
        wp_localize_script('admin_script_main', 'wp_visualize_conf', array('wpv_sub_active' => $_SESSION['wpv_sub_active']));

    }

    public function add_plugin_admin_menu()
    {

        $wpv_authenticated = check_auth();

        add_menu_page('WP-Visualize', 'WP-Visualize', 'manage_options', $this->plugin_name, array($this, 'display_admin_pages'), 'dashicons-visibility', 26);
       
            add_submenu_page('wp-visualize', __('Customize','wp-visualize'), __('Customize','wp-visualize'), 'manage_options', $this->plugin_name . '-customize', array($this, 'display_customize'));

                add_submenu_page('wp-visualize', __('Upgrade','wp-visualize'), __('Upgrade','wp-visualize'), 'manage_options', $this->plugin_name . '-register', array($this, 'display_register'));

            add_submenu_page('wp-visualize', __('Getting Started','wp-visualize'), __('Getting Started','wp-visualize'), 'manage_options', $this->plugin_name . '-getting-started', array($this, 'display_getting_started'));
       
    }

    public function add_action_links($links)
    {
        $settings_link = array(
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);

    }

    public function display_admin_pages()
    {
        include_once('partials/wp-visualize-admin-display.php');
    }

    public function display_register()
    {
        include_once('partials/register.php');
    }

    public function display_customize()
    {

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('wp-color-picker');

        wp_enqueue_script('wp_customize_script', plugin_dir_url(__FILE__) . 'js/wp-visualize-customize.js?v=0.0.3', $this->version, false);
        wp_localize_script('wp_customize_script', 'localPath', array('pluginsURL' => plugins_url('wp-visualize')));

        include_once('partials/customize.php');
    }

    public function display_getting_started()
    {
        include_once('partials/help.php');
    }


    function add_short_code($request)
    {
        $short_code_images = $request['selected_image[]'];
        $short_code_name = $request['shortcode_name'];
        return rest_ensure_response(array(
            'image' => $short_code_images,
            'name' => $short_code_name
        ));
    }

    public function wpv_check_field()
    {

        $auth = false;
        $option_name = 'wp_visualize_conf';
        $auth_code = get_option($option_name);
        $api_url = 'http://api.wpvisualize.com/api/v1/auth/check';

        if (!$auth_code) {
            $auth_code = get_option('wp_visualize_conf');
        }

        $args = array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking' => true,
            'headers' => array(
                'Content-Type' => 'application/json'
            ),
            'body' => json_encode(array(
                'auth_code' => $auth_code,
                'reg_url' => $_SERVER['SERVER_NAME']
            )),
            'cookies' => array()
        );

        $res = json_decode(wp_remote_retrieve_body(wp_remote_post($api_url, $args)));

        if ($res->body->status) {
            $auth = $res->body->status;
        }

        $_SESSION['wpv_sub_active'] = $auth;

    }

}
