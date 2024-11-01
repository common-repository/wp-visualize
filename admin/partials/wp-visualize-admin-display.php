<?php
/**
 *
 * @link       https://wpvisualize.com
 * @since      1.0.0
 *
 * @package    WP_Visualize
 * @subpackage WP_Visualize/admin/partials
 */

$wpv_authenticated = false;
if ($_SESSION['wpv_sub_active'] === true) {
    $wpv_authenticated = true;
}

$current_reg_code = get_option('wp_visualize_conf', 'short_code_name');
$vlogo = plugin_dir_url(__FILE__) . 'assets/wp-visualize-c.png';
$paypalLogo = plugin_dir_url(__FILE__) . 'assets/paypal.png';

$shortcode_count = 0;
if (!$wpv_authenticated == true) {
    $data = get_option('wp-visualize');

    if (is_array($data)) {
        $shortcode_count = (int)count($data);
    }
}


?>
<h2><?php _e('WP-Visualize for WordPress', 'WpAdminStyle'); ?></h2>
<div class="wrap">
    <div id="poststuff" class="wpv-hero">
        <div id="post-body" class="metabox-holder columns-1">
            <!-- main content -->
            <div class="postbox-container">
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">
                            <img src="<?= $vlogo ?>" class="v-logo" alt="WP-Visualize logo">
                            <h2>
                                <i class="dashicons dashicons-info" style="font-size:1.3em; margin-right:16px;"></i>
                                <span><?php esc_attr_e('Welcome to WP Visualize.', 'WpAdminStyle'); ?></span>
                            </h2>
                            <div class="inside">
                                <?php
                                    if (!$wpv_authenticated == true) {
                                ?>
                                <a href="https://wpvisualize.com/promotion" target="_blank"><img src="https://wpvisualize.com/assets/plugin_news/plugin_news.png" alt="WP Visualize update"></a>
                                <?php
                                    }else{
                                ?>
                                  <a href="https://wpvisualize.com/promotion/?member" target="_blank"><img src="https://wpvisualize.com/assets/plugin_news/plugin_upgraded_news.png" alt="WP Visualize News"></a>
                                 <?php
                                    }
                                ?>                               
                                <p><?php _e('WP-Visualize is revolutionary, letting your customers see themselves with your products and services without the need for apps and 3D images. It\'s not just for your website. Let customers directly visualize from from Social Media, Digital Advertising and even QR-codes, in store or in the window when youre closed!. And because customers are engaged far, far longer, your \'bounce rate\' can massively decrease and your SEO goes up! Your brand gets shared more often and can sales improve dramatically. WP-Visualize works within Internet browsers on phones, tablets, laptops and desktops.', 'wp-visualize'); ?>
                                    <br><br>
                                    <?php _e('Create shortcodes below to paste anywhere throughout your website.', 'wp-visualize'); ?>
                                    <br>
                                <ul>
                                    <li>
                                        <b><?php _e('Just getting started?', 'wp-visualize'); ?> <a
                                                    href="?page=wp-visualize-getting-started"><?php _e('CLICK HERE', 'wp-visualize'); ?></a> <?php _e('to watch our FAST-START video and get up to speed ... FAST!', 'wp-visualize'); ?>
                                        </b>
                                    </li>
                                    <li>
                                        <div class="free-reg-form">
                                            <b><?php _e('Let us help you', 'wp-visualize'); ?>.</b>
                                            <form id="fActivate" method="post">
                                                <?php _e('We get to hear exactly whats working best for others and would love to help you get great results too. Share your name and email and let us provide specific tips to help you achieve the best results possible. We don\'t spam and any information we pass on will be specific and valuable', 'wp-visualize'); ?>.
                                            
                                                <span class="wpv-button-link">
                                                <input type="text" id="name" name="name"
                                                       placeholder="<?php _e('Your name', 'wp-visualize'); ?>" required>
                                                <input type="email" id="email" name="email"
                                                       placeholder="<?php _e('Your email', 'wp-visualize'); ?>"
                                                       required>
                                                   </span>
                                                <button type="button" id="send_activation" class="button-primary" style="display:inline-block;"><span class="dashicons dashicons-twitch" alt="f199" style="margin-top:5px"></span> <?php _e('SEND ME FREE TIPS & HACKS', 'wp-visualize'); ?></button>
                                            </form>
                                        </div>                                    
                                    </li>
                                    <li>
                                        <b><?php _e('We would really appreciate your support.', 'wp-visualize'); ?></b><br><?php _e('Please help us keep developing & improving WP-Visualize by showing your support a with a 5 Star review. It really helps', 'wp-visualize'); ?>
                                        <a href="https://wordpress.org/support/plugin/wp-visualize/reviews/#new-post"
                                           target="_blank"><?php _e('CLICK HERE', 'wp-visualize'); ?></a>. <?php _e('Thank you', 'wp-visualize'); ?>
                                        .
                                    </li>
                                </ol>
                            </div>
                    </div>
                </div>

                <?php
                $key = false;
                //Get the active tab from the $_GET param
                $default_tab = null;
                $tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : $default_tab;
                ?>
                
                <div class="nav-tab-wrapper">
                    <a href="?page=wp-visualize"
                       class="nav-tab <?php if ($tab === null): ?>nav-tab-active<?php endif; ?>"><?php _e('Your Shortcodes', 'wp-visualize'); ?></a>
                    <a href="?page=wp-visualize&tab=products"
                       class="nav-tab <?php if ($tab === 'products'): ?>nav-tab-active<?php endif; ?>"><?php _e('Your Products', 'wp-visualize'); ?></a>
                    <a href="?page=wp-visualize&tab=qr_code_download"
                       class="nav-tab <?php if ($tab === 'qr_code_download'): ?>nav-tab-active<?php endif; ?>"><?php _e('Your Link Generator & 
                        QR Codes', 'wp-visualize'); ?></a>
                    <a href="?page=wp-visualize&tab=currentreg"
                       class="nav-tab <?php if ($tab === 'currentreg'): ?>nav-tab-active<?php endif; ?>"><?php _e('Your Registration Code', 'wp-visualize'); ?></a>    
                </div>

                <div class="tab-content">
                    <?php switch ($tab) :
                        case 'products':
                            if ($key) {
                                echo '
                                <table class="form-table">
                                    <tr>
                                        <th class="row-title">' . esc_attr_e('Table header cell #11', 'WpAdminStyle') . '</th>
                                        <th>' . esc_attr_e('Table header cell #2', 'WpAdminStyle') . '</th>
                                    </tr>
                                    <tr>
                                        <td class="row-title"><label for="tablecell">
                                        ' . esc_attr_e('Table Cell #1, with label', 'WpAdminStyle') . '</label></td>
                                        <td>' . esc_attr_e('Table Cell #2', 'WpAdminStyle') . '</td>
                                    </tr>
                                    <tr class="alternate">
                                        <td class="row-title"><label for="tablecell">
                                        ' . esc_attr_e('Table Cell #3, with label and class', 'WpAdminStyle') . '<code>alternate</code></label></td>
                                        <td>' . esc_attr_e('Table Cell #4', 'WpAdminStyle') . '</td>
                                    </tr>
                                    <tr>
                                        <td class="row-title">' . esc_attr_e('Table Cell #5, without label', 'WpAdminStyle') . '</td>
                                        <td>' . esc_attr_e('Table Cell #6', 'WpAdminStyle') . '</td>
                                    </tr>
                                </table>';
                            } else {
                                echo '
                            <div class="wpv-options postbox-container">';
                                if (!$wpv_authenticated) {
                                    echo '
                                    <div class="wpv-border bg-white">
                                        <h3 style="display: flex; align-items: center;">
                                            <span class="dashicons dashicons-thumbs-up" style="font-size:1.3em; margin-right:16px;"></span>
                                            <span>' . __('Upgrade now to add to Woocommerce products & create UNLIMITED shortcodes', 'wp-visualize') . '</span>
                                        </h3>
                                            
                                        <span class="standout">' . __('Let your customers see themselves with your products!', 'wp-visualize') . '<br>
                                            <span>' . __('A MUST FOR EVERY BUSINESS WEBSITE', 'wp-visualize') . '</span><br>
                                            ' . __('Engage your customers!! Make your website work for you with better 
                                            bounce-rates/seo and BOOST SALES', 'wp-visualize') . '!!<br>' . __('UPGRADE SPECIAL OFFER', 'wp-visualize') . '
                                            <a href="https://wpvisualize.com/specialtrialoffer/">
                                                <button style="margin-left:15px;">' . __('LEARN MORE', 'wp-visualize') . '! <i class="dashicons dashicons-controls-play" style="font-size:1.3em;"></i></button>
                                            </a>
                                        </span>
                                    </div>
                                ';
                                }else{
                                echo '   
                            <div class="wpv-border bg-white">
                                <h3>' . __('Add WP-Visualize to your Woocommerce products', 'wp-visualize') . '</h3>
                                <p>' . __('To add WP-Visualise to your Woocommerce shop products', 'wp-visualize') . ' <a href="edit.php?post_type=product">' . __('CLICK HERE', 'wp-visualize') . '</a>.
                                <h3><i class="dashicons dashicons-info"></i>' . __('HOW TO SET UP', 'wp-visualize') . '</h3>
                                <ul>
                                    <li>' . __('Select a product to edit', 'wp-visualize') . ' <a href="edit.php?post_type=product">' . __('CLICK HERE', 'wp-visualize') . '</a></li>
                                    <li>' . __('Scroll down to', 'wp-visualize') . ' <b>' . __('General Options', 'wp-visualize') . '</b> ' . __('and you will see WP-Visualise', 'wp-visualize') . '</li>
                                    <li>' . __('Click to', 'wp-visualize') . ' <b>' . __('select images', 'wp-visualize') . '</b> (' . __('transparent backgrounds look best', 'wp-visualize') . ').</li>
                                    <li>' . __('Click the', 'wp-visualize') . ' <b>.' . __('Save button', 'wp-visualize') . '</b></li>
                                    <li class="no-ls">' . __('AND THAT\'S IT!!', 'wp-visualize') . '</li>
                                </ul>
                            </div>
                            ';
                            }}
                            break;
                        case 'qr_code_download':
                            echo '
                                <div class="wpv-border bg-white">
                                    <h2>' . __('Link Generator & Qr Codes', 'wp-visualize') . '</h2>
                                    <h4>' . __('A few tips on how to use this section', 'wp-visualize') . '.</h4>
                                    <ul>
                                        <li>' . __('Trigger links are links that can open any page on your site paired with any of your Visualizations. E.g. You might like to run a campaign that has a specific group of products over a specific contact or shop page. Or you might just want a link to add to your social media or digital campaign. Maybe open a page with a coupon. The customer can visualize, then proceed to an order page to use that coupon!', 'wp-visualize') . '</li>
                                        <li>' . __('On creating a QR-code, you might want to have a specific page, and also when the code is scanned, either have the visualization already opened, or just open your page containging a Visualize button', 'wp-visualize') . '.</li>
                                        <li>' . __('Use this page to also create links that you can use on image links and your own buttons to launch Visualizations', 'wp-visualize') . '.</li>
                                        <li>' . __('Trigger Attributes - Assign the class and id to any image or oject to trigger the Visualization window', 'wp-visualize') . '.</li>
                                    </ul>
                                    <div class="wpv-border wpv-overflow-scroll">
                                        <h3>' . __('Your ShortCodes', 'wp-visualize') . '</h3>
                                        <table class="widefat" id="qr_short_codes">
                                            <tr>
                                                <th>' . __('Name', 'wp-visualize') . '</th>
                                                <th>' . __('Page URL (optional)', 'wp-visualize') . '</th>                                       
                                                <th>' . __('Trigger Link', 'wp-visualize') . '</th>
                                                <th style="text-align:center;">' . __('Open Visualization from QR code', 'wp-visualize') . '</th>
                                                <th style="text-align: center;">' . __('Download', 'wp-visualize') . '</th>
                                                <th style="text-align: center;">' . __('Trigger Attributes', 'wp-visualize') . '</th>
                                            </tr>
                                        </table>
							        </div>
							    </div>
                            ';
                            if ($wpv_authenticated) {
                                echo '
                                    <h3>' . __('Your Products', 'wp-visualize') . '</h3>
                                    <table class="widefat" id="qr_products">
                                        <tr>
                                            <th>' . __('Product ID', 'wp-visualize') . '</th>
                                            <th>' . __('Page URL (*required)', 'wp-visualize') . ' <br><i>(' . __('The URL below can be replaced with a permalink URL', 'wp-visualize') . ')</i></th>
                                            <th>' . __('Trigger Link', 'wp-visualize') . '</th>
                                            <th style="text-align:center;">' . __('Open Visualization from QR code', 'wp-visualize') . '</th>
                                            <th style="text-align: center;">' . __('Download', 'wp-visualize') . '</th>
                                            <th style="text-align: center;">' . __('Attributes', 'wp-visualize') . '</th>
                                        </tr>
                                    </table>
                                ';
                            }
                            break;
// start
                        case 'currentreg':
                            echo '
                                <div class="wpv-border bg-white">
                                    <h2>' . __('Your Registration', 'wp-visualize') . '</h2>
                                    <h4>' . __('Update your registration code below.', 'wp-visualize') . '.</h4>
                                        <p>If you have updated your subscription, enter your new registration code in the box below</p>
                                        <form id="fActivate" method="post">
                                        <textarea id="reg_code" cols="80" rows="2"  placeholder="'.__('Enter your WP-Visualizer registration code', 'wp-visualize').'">';
                                            if ($current_reg_code && $current_reg_code !== '0') {
                                                echo $current_reg_code;
                                            };
                            echo '</textarea>
                                </p>
                                <p>
                                    <input type="button" id="submit_register_activate"
                                           class="button button-primary"
                                           value="' .__('SUBMIT REGISTRATION CODE', 'wp-visualize'). '"
                                           data-style="submit_register_activate">
                                    <span class="registration_response"></span>
                                </p>
                                        </form                                   
                                    </div>
                                </div>
                            ';
                            break;

// end


                        default:
                            echo '
                            <div class="wpv-border bg-white">
							    <div class="shortcode_add">
								    <h3>' . __('Create a Shortcode', 'wp-visualize') . '</h3>
								    <p>' . __('The following will create a \'shortcode\' that can be pasted anywhere in your 
                                    WordPress site. When you open that page or post it will enable users to add their image 
                                    and then drag your nominated product images into place', 'wp-visualize') . '.</p>
                                    <p><button id="remove_image_backgrounds" type="button" class="button-secondary">' . __('Remove Image Backgrounds (optional)', 'wp-visualize') . '</button></p>
                                    <input id="short_code_name" type="text" placeholder="' . __('Give your shortcode a name', 'wp-visualize') . '" class="regular-text">
								    <button id="wp_visualize_addmedia" type="button" class="button-secondary wpv-form-submit">' . __('Select Images', 'wp-visualize') . '</button>
                                    <span class="wpv-button-link">
                                        <select id="wpv_link_type">
                                            <option selected>' . __('ADD OPTIONAL BUTTON', 'wp-visualize') . '</option>
                                            <option value="buy">' . __('Buy Now', 'wp-visualize') . '</option>
                                            <option value="learn">' . __('Learn More', 'wp-visualize') . '</option>
                                            <option value="contact">' . __('Contact Us', 'wp-visualize') . '</option>
                                            <option value="call">' . __('Call Us', 'wp-visualize') . '</option>
                                            <option value="email">' . __('Email Us', 'wp-visualize') . '</option>
                                            <option value="sms">' . __('SMS Us', 'wp-visualize') . '</option>
                                            <option value="booking">' . __('Make a Booking', 'wp-visualize') . '</option>
                                            <option value="messenger">' . __('Messenger Chat', 'wp-visualize') . '</option>
                                        </select>                                
                                        <input id="wpv_link_url" type="text" placeholder="<- ' . __('Select a button type to display', 'wp-visualize') . ' " class="regular-text">
                                        <i>*** ' . __('Leave empty for no button', 'wp-visualize') . '</i>
                                    </span>
								    <button id="submit_short_code" type="button" class="button-primary"><span class="dashicons dashicons-insert" alt="f10f" style="margin-top:5px"></span>  ' . __('Create ShortCode', 'wp-visualize') . '</button>
                                </div>
                            </div>';


                            if (!$_SESSION['wpv_sub_active'] === true) {
                                echo '<br>' . __('Free users can create 3 ShortCodes, each with 3 maximum images. To remove all limits', 'wp-visualize') . ' <a href="https://wpvisualize.com/specialtrialoffer/" target="_blank">' . __('UPGRADE NOW', 'wp-visualize') . '</a> 
                                    <div class="max-reached-msg"></div>';
                            }

                            echo '
                                <div class="wpv-border bg-white">
                                    <h3>' . __('Your ShortCodes', 'wp-visualize') . '</h3>
    				      		    <table class="widefat wpv-border" id="append_short_codes">
                                        <tr>    
                                            <th class="row-title">' . __('Name', 'wp-visualize') . '</th>
                                            <th style="text-align: center;">' . __('Edit Images', 'wp-visualize') . '</th>
                                            <th class="row-title">' . __('Shortcode', 'wp-visualize') . '</th>
                                            <th class="row-title">' . __('Button Actions', 'wp-visualize') . '</th>
                                            <th style="text-align: center;">' . __('Delete', 'wp-visualize') . '</th>
                                        </tr>
    							    </table>
    							</div>';
                            break;
                    endswitch; ?>
                </div>
            </div>
           
        
        </div>
    </div>
    <br class="clear">
</div>

