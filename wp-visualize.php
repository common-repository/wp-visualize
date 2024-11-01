<?php
/**
 *
 * @link              https://wpvisualize.com
 * @since             1.0.0
 * @package           WP_Visualize
 *
 * @wordpress-plugin
 * Plugin Name:       WP-Visualize
 * Plugin URI:        https://wpvisualize.com
 * Description:       WP-Visualize lets your customers see themselves with your products. Potential customers can add their own image to their screen and then add your products, for example clothes and fashion, home renovations, floor coverings, furnishings, swimming pools or ... anything.. even tennis courts!
 * Version:           2.0.9.1
 * Author:            Bizetools
 * Author URI:        https://wpvisualize.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-visualize
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 */
define('WP_VISUALIZE_VERSION', '2.0.9.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-visualize-activator.php
 */


function activate_wp_visualize()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wp-visualize-activator.php';
    WP_Visualize_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-visualize-deactivator.php
 */
function deactivate_wp_visualize()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-wp-visualize-deactivator.php';
    WP_Visualize_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_visualize');
register_deactivation_hook(__FILE__, 'deactivate_wp_visualize');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wp-visualize.php';

/**
 * Begins execution of the plugin.
 *
 *
 * @since    1.0.0
 */

require plugin_dir_path(__FILE__) . 'includes/api_routes.php';

function run_wp_visualize()
{

    add_action('rest_api_init', 'register_wp_visualize_routes');

    $plugin = new WP_Visualize();
    $plugin->run();

}

run_wp_visualize();
