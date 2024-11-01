<?php
/**
 *
 * @package    WP_Visualize
 * @subpackage WP_Visualize/public
 * @author     Bizetools <support@bizetools.com>
 */
class WP_Visualize_Public
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
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        // All shortcode visualize items
        add_shortcode('wp-visualize', function ($atts) {
            $a = shortcode_atts(
                array(
                    'id' => '0',
                ), $atts);
            $id = $a['id'];
            return '<button id="v-' . $id . '" class="wpv-button"><i class="dashicons dashicons-visibility"></i> '. __( 'Visualize', 'wp-visualize' ) .'</button>';
        });
        // Product specific visualize items
        add_action('woocommerce_single_product_summary', function () {
            global $product;
            $id = $product->get_id();
            $option_name = 'wp-visualize';
            $data = get_option($option_name, $default = false);
            if (count($data) > 0) {
                foreach ($data as $shortcode) {
                    if ((int)$shortcode['shortcode'] === (int)$id) {
                        echo '<button id="v-' . $id . '" class="wpv-button"><i class="dashicons dashicons-visibility"></i> '. __( 'Visualize', 'wp-visualize' ) .'</button>';
                        break;
                    }
                }
            }
        });
    }
    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-visualize-public.css?v=1.7.55.6', array(), $this->version, 'all');
        wp_enqueue_style('dashicons');
    }
    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('wpv4', plugin_dir_url(__FILE__) . 'js/wpv_4.js?v=1.0.0.5', array('jquery'), $this->version, false);
        wp_enqueue_script('wpv3', plugin_dir_url(__FILE__) . 'js/wpv_3.js', array('jquery'), $this->version, false);
        wp_enqueue_script('wpv2', plugin_dir_url(__FILE__) . 'js/wpv_2.js', array('jquery'), $this->version, false);
        wp_enqueue_script('wpv1', plugin_dir_url(__FILE__) . 'js/wpv_1.js', null, true);
        $script_data = array(
            'default_img_path' => plugin_dir_url(__FILE__) . 'assets/img/visualize-logo.png',
            'plugin_dir_loc' => plugin_dir_url(__FILE__),
            'custom_settings' => wpv_get_settings()
        );
        wp_localize_script('wpv4', 'wpv_ajax_object', $script_data);
        wp_localize_script( 'wpv4', 'wpv', array(
        'add_photo'             => __( "add your photo", 'wp-visualize' ),
        'instructions_header'          => __( "Instructions", 'wp-visualize' ),
        'instructions_1'        => __( "Add your photo (button above)", 'wp-visualize' ),
        'instructions_2'        => __( "Tap thumbnail below to add", 'wp-visualize' ),
        'instructions_3'        => __( "To download screenshot click", 'wp-visualize' ),
        'learn_more'            => __( "Learn more", 'wp-visualize' ),
        'click_here'            => __( "CLICK HERE", 'wp-visualize' ),
        'menu_edit'             => __( "edit menu", 'wp-visualize' ),
        'menu_scale'            => __( "scale", 'wp-visualize' ),
        'menu_resize'           => __( "stretch", 'wp-visualize' ),
        'menu_warp'             => __( "warp", 'wp-visualize' ),
        'menu_remove'           => __( "remove selected", 'wp-visualize' ),
        'menu_hide_frames'      => __( "hide frames", 'wp-visualize' ),
        'menu_clear'            => __( "clear all", 'wp-visualize' ),
        'menu_clone'            => __( "clone", 'wp-visualize' ),
        'button_save'           => __( "SAVE", 'wp-visualize' ),
        'button_cta'            => __( "Add your photo (button above)", 'wp-visualize' ),
        'txt_footer'            => __( "Tap image below & then drag, resize, warp, pinch, zoom!", 'wp-visualize' ),
        'txt_tap'               => __( "Tap item to show/hide menu", 'wp-visualize' ),
        'txt_buy'               => __( "buy now", 'wp-visualize' ),
        'txt_learn'             => __( "learn more", 'wp-visualize' ),
        'txt_contact'           => __( "contact us", 'wp-visualize' ),
        'txt_call'              => __( "call now", 'wp-visualize' ),
        'txt_sms'               => __( "sms/text now", 'wp-visualize' ),
        'txt_email'             => __( "email us", 'wp-visualize' ),
        'txt_chat'              => __( "let\'s chat", 'wp-visualize' ),
        'txt_booking'           => __( "make a booking", 'wp-visualize' ),
        'txt_close'           => __( "close", 'wp-visualize' ),
        'txt_powered_by'           => __( "powered by", 'wp-visualize' )
    ));
    }
}
