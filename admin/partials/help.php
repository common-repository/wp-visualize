 <?php
/**
 *
 * This file is used to markup the admin-facing aspects of the plugin.
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
	if ($_SESSION['wpv_sub_active'] === true){
		$wpv_authenticated = true;
	}

	$current_reg_code = get_option('wp_visualize_conf');
	$vlogo = plugin_dir_url(__FILE__) . 'assets/wp-visualize-c.png';
?>

<h1><?php _e( 'Fast Start Tips', 'wp-visualize' ); ?></h1>
<div class="wrap">
	<div class="postbox">
		<div class="inside">
	    <img src="<?= $vlogo ?>" class="v-logo" alt="WP-Visualize logo">


	    <h2><?php _e( 'Get up to speed FAST! Watch our Fast Start Video', 'wp-visualize' ); ?></h2>

	    <div class="membervideo">
<iframe src="https://player.vimeo.com/video/448744591" width="100%" height="315" frameborder="0" allow="fullscreen" allowfullscreen></iframe>
	    </div>
	    <h2><?php _e( 'For best results remove image backgrounds', 'wp-visualize' ); ?></h2>
	    <p><?php _e( 'As mentioned in our video, remove the backgrounds from your images. It\'s instant and using the following link is simple!', 'wp-visualize' ); ?><br><br><a href="https://www.remove.bg/?aid=wyjhfkttxstgcdch" target="_blank"><button type="button" class="button button-primary"><?php _e( 'CLICK HERE TO REMOVE BACKGROUNDS FROM IMAGES', 'wp-visualize' ); ?></button></a>.</p>

		<div class='v-help-container'>
			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'What\'s a shortcode?', 'wp-visualize' ); ?>
				<div class='v-help-content'><a href="" target="_blank"><span class="v-help-vid-icon dashicons dashicons-format-video"></span></a>
					<p>
						<?php _e( 'Shortcodes in WordPress are little bits of code that, when pasted in your webpages, can add extensive functionality. In WP-Visualize, shortcodes are created on the', 'wp-visualize' ); ?> <a href="admin.php?page=wp-visualize"><?php _e( 'main WP-Visualize page', 'wp-visualize' ); ?></a>.
					</p>
					<h3><?php _e( 'How to create a WP Visualize shortcode.', 'wp-visualize' ); ?></h3>
					<p>
						<ol> 
							<li><?php _e( 'Enter a shortcode name in the box provided.', 'wp-visualize' ); ?></li>
							<li><?php _e( 'Click \'Select Images\' and either add or select from already uploaded images. Once selected, click \'Choose Images\' button on the bottom right of the page.<br>For best results we strongly recommend to use images with the backgrounds removed.', 'wp-visualize' ); ?><br><a href="https://www.remove.bg/?aid=wyjhfkttxstgcdch" target="_blank"><?php _e( 'Use this for best background removal results', 'wp-visualize' ); ?></a> <?php _e( 'in seconds.', 'wp-visualize' ); ?></li>
							<li><?php _e( 'Then click the \'Create Shortcode\' button.', 'wp-visualize' ); ?></li>
						</ol>

						<b><?php _e( 'Your shortcode is created and now appears on your list of shortcodes.', 'wp-visualize' ); ?></b>
					</p>
						<h3><?php _e( 'To Add your shortcode to a webpage.', 'wp-visualize' ); ?></h3>
					<p>
						<ol>
							<li><?php _e( 'Click the copy icon next to your shortcode to copy the shortcode.', 'wp-visualize' ); ?></li>
							<li><?php _e( 'Open any page or post in your website and paste the code. Then click save', 'wp-visualize' ); ?></li>
							<li><?php _e( 'You have now successfully integrated WP-Visualize to that page or post.', 'wp-visualize' ); ?></li>
						</ol>
						<b><?php _e( 'View that page or post and you will see a visualize button where the shortcode was pasted. Clicking that button will launch WP-Visualize.', 'wp-visualize' ); ?></b>
					</p>
				</div>
			</div>

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'How to add Visualizer to Products', 'wp-visualize' ); ?>
			<div class='v-help-content'><a href="" target="_blank"><span class="v-help-vid-icon dashicons dashicons-format-video"></span></a>
				<p><?php _e( 'WP-Visualize is fully integrated with Woocommerce so long as you have upgraded to a paid Member. If not', 'wp-visualize' ); ?> <a href="https://wpvisualize.com/specialtrialoffer/" target="_blank"><?php _e( 'UPGRADE for this feature', 'wp-visualize' ); ?></a>

				<h3><?php _e( 'To add WP-Visualize to a product:', 'wp-visualize' ); ?></h3>
				<p>
				<ol>
				<li><?php _e( 'open a product for edit', 'wp-visualize' ); ?></li>
				<li><?php _e( 'scroll down to the general options.', 'wp-visualize' ); ?></li> 
				<li><?php _e( 'Click the \'Select WP-Visualize Images\' button.', 'wp-visualize' ); ?></li>
				<li><?php _e( 'To select images for WP-Visualizer for this product, either add or select from already uploaded images.', 'wp-visualize' ); ?></li> 
				<li><?php _e( 'Once images are selected, click \'Choose Images\' button on the bottom right of the page to close the media library.', 'wp-visualize' ); ?></li>
				</ol>
				</p>
				<p>
				<b><?php _e( 'WP-Visualize is now added to this product and a Visualize button now appears on that product\'s page.', 'wp-visualize' ); ?></b>
				<?php _e( 'To remove WP-Visualize from this product, return to the product edit page and click the clear button in the WP-Visualize section of general settings.', 'wp-visualize' ); ?>
				</p>
			</div></div>

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span><?php _e( 'Use Examples', 'wp-visualize' ); ?>
			<div class='v-help-content'><a href="" target="_blank"><span class="v-help-vid-icon dashicons dashicons-format-video"></span></a>
				<h3><?php _e( 'There are limitless possibilities on how you can boost business with WP-Visualize', 'wp-visualize' ); ?></h3>
				<h4><?php _e( 'Below are just a few examples.', 'wp-visualize' ); ?></h4>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Air Conditioning Evap Units', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Air Conditioning Inverters', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Auto - Accessories', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Air Conditioning Splits', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Auto - Wheels & Tyres', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Carpets & Flooring', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Curtains & Blinds', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Dresses', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Fencing', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Furniture', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Garage Doors', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Garages & Sheds', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Glasses', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Hair Styles', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Hats', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Heaters & Fireplaces', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Electrical', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Houses & Properties', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Kitchens & Cabinetry', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Lighting', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Patio Doors', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Pergolas & Gazebos', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Plants & Trees', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Roller Shutters', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Screen Doors', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Shirts', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Swimming Pools', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Tennis Courts', 'wp-visualize' ); ?></a>
    <a class="v-example-link" href="#" target_blank><?php _e( 'Whitegoods (eg. TVs Fridges)', 'wp-visualize' ); ?></a>









			</div></div>

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'How to add Images', 'wp-visualize' ); ?>
			<div class='v-help-content'><a href="" target="_blank"><span class="v-help-vid-icon dashicons dashicons-format-video"></span></a>
				<ol>
				<li><?php _e( 'Images are added to WP-Visualize By clicking the \'Select Images\' button.', 'wp-visualize' ); ?></li>
				<li><?php _e( 'To edit your shortcode selection at anytime, click the edit Images button in your list of shortcodes. To edit your product images, open your product edit page and click the Select Images button.', 'wp-visualize' ); ?></li>
				<li><?php _e( 'Make your selection and then close the Medial Library by clicking the \'Choose Images\' button on the bottom right of the screen.', 'wp-visualize' ); ?></li>
				</ol>

				<p>
					<?php _e( 'For best and easiest results remove the background from your product images. Transparent backgrounds look best!', 'wp-visualize' ); ?> <a href="https://www.remove.bg/?aid=wyjhfkttxstgcdch"><?php _e( 'CLICK HERE', 'wp-visualize' ); ?></a> <?php _e( 'to remove backgrounds from your images.', 'wp-visualize' ); ?>
				</p>
			</div></div>

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'Placing Shortcodes', 'wp-visualize' ); ?>
			<div class='v-help-content'><a href="" target="_blank"><span class="v-help-vid-icon dashicons dashicons-format-video"></span></a>
				<p>
					<ol>
					<li><?php _e( 'Copy your shortcode from your \'Shortcodes List\' on your main shortcodes page.  Each Shortcode can be used multiple times on different pages.', 'wp-visualize' ); ?></li>
					<li><?php _e( 'Once copied, open the page or post edit screen to integrate WP-Visualize.', 'wp-visualize' ); ?></li>

					<li><?php _e( 'Paste the shortcode wherever you would like the WP-Visualize button to appear.', 'wp-visualize' ); ?></li>
					<li><?php _e( 'Save the page or post.', 'wp-visualize' ); ?></li>
				</ol>
					<h4><?php _e( 'Job Done!! Your shortcode is now integrated.', 'wp-visualize' ); ?></h4>
				</p>

			</div></div>

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'Is there an Affiliate Program?', 'wp-visualize' ); ?>
			<div class='v-help-content'><p><?php _e( 'Yes! We pay generous recurring commisions for those who help promote WP-Visualize to others. For details about our Affiliate Program or to get started', 'wp-visualize' ); ?> <a href="https://wpvisualize.com/affiliate-about/" target="_blank"><?php _e( 'CLICK HERE', 'wp-visualize' ); ?></a></p></div></div>			

			<div class='v-help-heading' id='item1'><span class="dashicons dashicons-plus-alt2"></span> <?php _e( 'Need Support?', 'wp-visualize' ); ?>
			<div class='v-help-content'><p><?php _e( 'Premium Support is available to upgraded members via', 'wp-visualize' ); ?> <a href="https://support.bizetools.com" target="_blank"><?php _e( 'CLICK HERE', 'wp-visualize' ); ?></a></p></div></div>
			</div>
	    </div>
	</div>
</div>
