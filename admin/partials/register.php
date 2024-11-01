<?php
/**
 *
 * @link       https://wpvisualize.com
 * @since      1.0.0
 *
 * @package    WP_Visualize
 * @subpackage WP_Visualize/admin/partials
 */
?>
<?php

$wpv_authenticated = false;
if ($_SESSION['wpv_sub_active'] === true) {
    $wpv_authenticated = true;
}

$current_reg_code = get_option('wp_visualize_conf');
$vlogo = plugin_dir_url(__FILE__) . 'assets/wp-visualize-c.png';
$paypalLogo = plugin_dir_url(__FILE__) . 'assets/paypal.png';
?>

<h1><?php _e('WP-Visualize for WordPress', 'WpAdminStyle'); ?></h1>
<div class="wrap">
    <div class="postbox">
        <div class="inside">
            <img src="<?= $vlogo ?>" class="v-logo" alt="WP-Visualize logo">
            <?php if ($wpv_authenticated == false) { ?>
                <h2 id="msg_unreg" class="reg_status unregistered_user"><span
                            class="dashicons dashicons-warning"></span> <?php _e('Current Status: You are currently using the free version', 'wp-visualize'); ?>
                </h2>
                <h2 id="msg_reg" class="reg_status registered_user" style="display:none"><span
                            class="dashicons dashicons-yes"></span> <?php _e('Thank you: You are currently upgraded', 'wp-visualize'); ?>
                </h2>
            <?php } else { ?>
                <h2 class="reg_status registered_user"><span class="dashicons dashicons-yes"></span> <?php _e('Thank you: You are
                    currently upgraded', 'wp-visualize'); ?></h2>
            <?php } ?>

            <?php
            if (!$wpv_authenticated) {
                ?>

                <h2><?php _e('Why upgrade with WP-Visualize?', 'wp-visualize'); ?></h2>
                <ul>
                    <li>* <?php _e('Add Unlimited images of your products and services', 'wp-visualize'); ?></li>
                    <li>* <?php _e('White label to your brand', 'wp-visualize'); ?></li>
                    <li>* <?php _e('Integrate Unlimited Woocommerce products', 'wp-visualize'); ?></li>
                    <li>* <?php _e('Create unlimited shortcodes within your website', 'wp-visualize'); ?></li>
                    <li>* <?php _e('Customize buttons and logos', 'wp-visualize'); ?></li>
                    <li>* <?php _e('Access to Premium support & features', 'wp-visualize'); ?></li>
                </ul>
                <div class="wpv-border">
                    <h2><?php _e('How to Upgrade?', 'wp-visualize'); ?></h2>
                    <p><?php _e('Click the button below and become an Upgraded Member. As an Upgraded Member you help us to maintain and extend the
                capabilities of WP-Visualiser while getting SIGNIFICANT features and benefits. On upgrading, we will email your
                upgrade registration code. Copy that code and enter below on this page.', 'wp-visualize'); ?></p>
                <h2>For latest discounts and offers click the Paypal button below.</h2>
                    <p>
                        <a href="https://wpvisualize.com/specialtrialoffer/" target="_blank"><img src="<?= $paypalLogo ?>" alt="Choose your plan" style="width:180px; margin-top:15px;"></a>
                    </p>
                    <h2><?php _e('Enter your Upgrade Registration Code', 'wp-visualize'); ?></h2>
                    <textarea id="reg_code" cols="80" rows="2"
                              placeholder="<?php _e('Enter your WP-Visualizer registration code', 'wp-visualize'); ?>"><?php if ($current_reg_code && $current_reg_code !== '0') {
                            echo $current_reg_code;
                        } ?></textarea>
                    <p>
                        <input type="button" id="submit_register_code" class="button button-primary"
                               value="<?php _e('SAVE UPGRADE REGISTRATION CODE', 'wp-visualize'); ?>"
                               data-style="submit_register_code">
                        <span class="registration_response"></span>
                    </p>
                </div>

            <?php } ?>
        </div>
    </div>
</div>
