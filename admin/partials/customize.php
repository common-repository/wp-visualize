<?php
/**
 *
 * @link       https://wpvisualize.com
 * @since      1.0.4
 *
 * @package    WP_Visualize
 * @subpackage WP_Visualize/admin/partials
 */

$wpv_authenticated = check_auth();

$v_logo = plugin_dir_url(__FILE__) . 'assets/wp-visualize-c.png';
$default_img_path = plugins_url('wp-visualize') . '/public/assets/img/visualize-logo.png';
$current_settings = wpv_get_settings();


$logo_location = (isset($current_settings['custom_logo']) && !empty($current_settings['custom_logo'])) ? $current_settings['custom_logo'] : $default_img_path;
$preview_bg_colour = (isset($current_settings['preview_bg_colour']) && !empty($current_settings['preview_bg_colour'])) ? $current_settings['preview_bg_colour'] : '#000000';
$button_bg_colour = (isset($current_settings['button_bg_colour']) && !empty($current_settings['button_bg_colour'])) ? $current_settings['button_bg_colour'] : '#396A9B';
$button_font_size = (isset($current_settings['button_font_size']) && !empty($current_settings['button_font_size'])) ? $current_settings['button_font_size'] : '14';

?>

<div class="wrap">
    <div class="postbox">
        <div class="inside">
            <h1><?php _e('WP-Visualize for WordPress', 'wp-visualize'); ?></h1>

            <img src="<?= $v_logo ?>" class="v-logo" alt="WP-Visualize logo">
            <?php if ($wpv_authenticated === false) { ?>
                <?php _e('Customizations are only available to paid members.', 'wp-visualize'); ?><br>
                <?php _e('Upgrade now', 'wp-visualize'); ?> <a href="https://wpvisualize.com/specialtrialoffer/"
                                                               target="_blank"><?php _e('CLICK HERE', 'wp-visualize'); ?></a>
            <?php } ?>

            <h2><?php _e('Customize', 'wp-visualize'); ?> WP Visualize</h2>
            <h4><?php _e('Background Logo', 'wp-visualize'); ?></h4>
            <p><?php _e('Add your own branding to the Visualize screen.', 'wp-visualize'); ?></p>

            <div>
                <img id="preview_custom_logo" class="wpv-logo" src="<?= $logo_location ?>"
                     alt="<?php _e('Selected logo for screen', 'wp-visualize'); ?>"
                     style="background-color:<?= $preview_bg_colour ?>; padding:20px;">
                <button class="custom-logo"><?php _e('Select Logo', 'wp-visualize'); ?></button>
                <button class="clear-logo"><?php _e('Clear Logo', 'wp-visualize'); ?></button>
            </div>

            <h4>WP Visualize <?php _e('Screen Background Color', 'wp-visualize'); ?></h4>
            <p><?php _e('Select the background color of your Visualize screen.', 'wp-visualize'); ?></p>
            <input type="hidden" id="wpv_custom_img_loc" value="<?= $logo_location ?>">
            <input name="wpv-background-color" type="text" id="wpv_preview_bg_colour" value="<?= $preview_bg_colour ?>"
                   data-default-color="#000000">

            <h4>WP Visualize <?php _e('Button Color', 'wp-visualize'); ?></h4>
            <p><?php _e('Select the background color of the Visualize button displayed on your page.', 'wp-visualize'); ?></p>
            <input name="wpv-button-color" type="text" id="wpv_button_bg_colour" value="<?= $button_bg_colour ?>"
                   data-default-color="#396A9B">

            <h4><?php _e('Button font size', 'wp-visualize'); ?></h4>
            <div>
                <input name="wpv-button-font-size" type="text" id="wpv_button_font_size" value="<?= $button_font_size ?>">
            </div>

            <h4><?php _e('Show Powered By Visualize', 'wp-visualize'); ?></h4>
            <div>
                <button data-selected="true" class="button medium tgl-branding">Yes</button>
            </div>

            <div style="margin-top: 20px;">
                <?php if ($wpv_authenticated === false) { ?>
                    <?php _e('Upgrade to save changes', 'wp-visualize'); ?>: <a href="https://wpvisualize.com/specialtrialoffer/"
                                                                                target="_blank"><?php _e('CLICK HERE', 'wp-visualize'); ?></a>
                <?php } else { ?>
                    <button id="submit_wp_settings"
                            class="button medium"><?php _e('SAVE CHANGES', 'wp-visualize'); ?></button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
