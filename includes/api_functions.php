<?php

class CustomRes
{

    private $message;
    private $data;

    function __construct($data = null, $message = null)
    {
        if ($data !== null) {
            $this->data = $data;
        }

        if ($message !== null) {
            $this->message = $message;
        }

    }

    function success()
    {
        return array('message' => $this->message, 'data' => $this->data);
    }

    function error()
    {
        return array('message' => $this->message, 'data' => $this->data);
    }
}

function prepare_database_arr($data)
{
    if (!isset($data['data'])) {
        return null;
    }

    return $data['data'];
}

function create_delete_sc($request)
{
    $option_name = 'wp-visualize';
    $requestedUpdate = prepare_database_arr($request);
    $short_codes_current = get_option($option_name);
    $short_codes_current_count = count($short_codes_current);
    $check_auth = check_auth();

    // Checking if the user has reached their max for short codes
    $max_reached = false;
    if (($short_codes_current_count > 3 || count($requestedUpdate) > 3) && !$check_auth) {
        $max_reached = true;
    }

    // Creating a new arr
    $new_array = [];
    if (count($requestedUpdate) < 1) {
        $new_array = "";
    } else {
        $i = 0;
        foreach ($requestedUpdate as $key => $val) {
            $i++;
            if ($i <= 3 || $check_auth) {
                $new_array[$key] = $val;
            }
        }
    }

    // Setting a default boolean value (this will only be switched if there is a server based error with the DB)
    if ($short_codes_current_count > 0) {
        $wp_response = update_option($option_name, $new_array);
    } else {
        $wp_response = add_option($option_name, $new_array, 'no', 'yes');
    }

    $response_msg = 'success';
    if (!$wp_response) {
        $response_msg = 'error';
    }
    if ($max_reached) {
        $response_msg = 'max_reached';
    }

    $response = new CustomRes(format_sc_able($new_array), $response_msg);

    if (!$wp_response) {
        return $response->error();
    }

    return $response->success();
}

function format_sc_able($sc)
{
    if (!count($sc) > 0 || $sc === '') {
        return [];
    }

    $i = 0;
    $check_auth = check_auth();
    foreach ($sc as $key => $value) {
        $i++;
        if ($i > 3 && !$check_auth) {
            $sc[$key]['disabled'] = true;
        } else {
            $sc[$key]['disabled'] = false;
        }
    }
    return $sc;
}

function retrieve_sc($request)
{
    $option_name = 'wp-visualize';
    $wp_response = format_sc_able(get_option($option_name));

    $response = new CustomRes($wp_response, (count($wp_response) > 0) ? 'success' : 'error');
    if (!$response) {
        return $response->error();
    }
    return $response->success();
}

//function update_sc($request)
//{
//    $option_name = 'wp-visualize';
//    $value = prepare_database_arr($request);
//    $wp_response = update_option($option_name, $value);
//    $response = new CustomRes($value, $wp_response === true ? 'success' : 'error');
//
//    if (!$wp_response) {
//        return $response->error();
//    }
//    return $response->success();
//}

function get_modal_content($request)
{
    $option_name = 'wp-visualize';
    $response = get_option($option_name, $default = false);

    if ($response) {
        $json = json_encode($response);
        $json_array = json_decode($json, true);

        $resArr = array();
        for ($i = 0; $i < count($json_array); $i++) {

            if ($json_array[$i]['shortcode'] == $request['id']) {
                $resArr = $json_array[$i]['selected_images'];
            }
        }

        return $resArr;
    }

    return 'error';
}

function get_shortcode_button($request)
{
    $option_name = 'wp-visualize';
    $response = get_option($option_name, $default = false);

    $link_data = array();
    if (!empty($response)) {
        for ($i = 0; $i < count($response); $i++) {
            if ($response[$i]['shortcode'] == $request['id']) {
                return $response[$i]['wpvLinkData'];
            }

        }
    }

    return 'error';
}


function check_key($reg_code = null)
{

    $api_url = 'http://api.wpvisualize.com/api/v1/auth/check';

    if (!$reg_code) {
        $reg_code = get_option('wp_visualize_conf');
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
            'auth_code' => $reg_code,
            'reg_url' => $_SERVER['SERVER_NAME']
        )),
        'cookies' => array()
    );

    $res = json_decode(wp_remote_retrieve_body(wp_remote_post($api_url, $args)));

    return array('auth_status' => $res->body->status);
}

// Check auth rest route function
function check_auth()
{
    $key = get_option('wp_visualize_conf');
    $status = check_key($key)['auth_status'];

    if ($status === true) {
        // save code to options
        update_option('wp_visualize_conf', $key);
        $_SESSION['wpv_sub_active'] = true;
    } else {
        $_SESSION['wpv_sub_active'] = false;
    }

    return $status;

}

// Register user rest route function
function register_user($request)
{
    $reg_email = sanitize_email($request['reg_email']);
    $reg_code = sanitize_text_field($request['reg_code']);
    $check_key = check_key($reg_code);
    $status = $check_key['auth_status'];

    // Updating the wp_visualize_conf option as well as updating the session status
    if ($status === true) {
        // save code to options
        update_option('wp_visualize_conf', $reg_code);
        $_SESSION['wpv_sub_active'] = true;

        if (!get_option('wpv')) {
            $arr = array(
                'activation' => $reg_code,
                'email' => $reg_email
            );
            // save code to options
            update_option('wpv', $arr);
        }

    } else {
        $_SESSION['wpv_sub_active'] = false;
    }
    return $check_key;
}

function wpv_get_settings()
{
    return get_option('wpv-plugin-settings');
}

function wpv_update_settings($request)
{
    $option_name = 'wpv-plugin-settings';
    $settings = wpv_get_settings();

    $button_bg_colour = (!empty($request['button_bg_colour'])) ? sanitize_text_field($request['button_bg_colour']) : null;
    $preview_bg_colour = (!empty($request['preview_bg_colour'])) ? sanitize_text_field($request['preview_bg_colour']) : null;
    $custom_logo = (!empty($request['custom_logo'])) ? sanitize_text_field($request['custom_logo']) : null;
    $button_font_size = (!empty($request['button_font_size'])) ? sanitize_text_field($request['button_font_size']) : null;

    $show_branding = true;
    if (!empty($request['show_branding']) && ($request['show_branding'] === "false") || ($request['show_branding'] === false)) {
        $show_branding = false;
    }

    $data = array(
        'button_bg_colour' => $button_bg_colour,
        'preview_bg_colour' => $preview_bg_colour,
        'custom_logo' => $custom_logo,
        'show_branding' => (bool)$show_branding,
        'button_font_size' => $button_font_size
    );

    // Updating the database with the exact same value breaks, therefore checking for it
    if (!($settings === $data)) {
        if ($settings !== null) {
            $wp_response = update_option($option_name, $data);
        } else {
            $wp_response = add_option($option_name, $data);
        }
    } else {
        $wp_response = true;
    }

    $response = new CustomRes($data, $wp_response ? 'success' : 'error');

    return $response->success();

}

// check activate code against bizetools Db
function check_activate_code($activate_code = null)
{

    $args = array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array(
            'activate_code' => $activate_code
        ),
        'cookies' => array()
    );

    return json_decode(wp_remote_retrieve_body(wp_remote_post('https://wpvisualize.com/api/wp-visualize/v1/activate', $args)));
}

// Activate user rest route function
function activate_user($request)
{
    $activate_code = sanitize_text_field($request['activate_code']);
    $check_code = check_activate_code($activate_code);
    $status = $check_code->activatestatus;

    // Updating the wpv_activation option
    if ($status === true) {
        // get existing option: email
        $curr = get_option('wpv');
        $email = $curr['email'];
        $arr = array(
            'activation' => $activate_code,
            'email' => $email
        );

        // save code to options
        if ($curr) {
            update_option('wpv', $arr);
        } else {
            add_option('wpv', $arr);
        }

    }
    return array('activestatus' => $status);

}

function activator_add($request)
{
    $email = sanitize_email($request['activator']);
    $activator = array('email' => $email);
    // save code to options
    update_option('wpv', $activator);

    // Posting to send an activation email
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
            'name' => $request['name'],
            'email' => $request['email'],
            'industry' => $request['industry']
        )),
        'cookies' => array()
    );

    $res = json_decode(wp_remote_retrieve_body(wp_remote_post('https://wpvisualize.com/api/wp-visualize/v1/authkey', $args)));

    if ($res === '1' || $res === 'Already subscribed.') {
        $_SESSION['activating_free'] = true;
    } else {
        $_SESSION['activating_free'] = false;
    }

    return $res;

}
