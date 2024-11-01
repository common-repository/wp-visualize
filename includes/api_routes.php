<?php

require plugin_dir_path(__FILE__) . 'api_functions.php';

function register_wp_visualize_routes()
{

    // Creating a short code
    register_rest_route('wp-visualize/v1', 'short-code', [
        'methods' => WP_REST_Server::EDITABLE,
        'callback' => 'create_delete_sc',
        'permission_callback' => '__return_true'
    ]);

    // Retrieving a short code
    register_rest_route('wp-visualize/v1', 'short-code', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'retrieve_sc',
        'permission_callback' => '__return_true'
    ]);

    // Deleting a short code
    register_rest_route('wp-visualize/v1', 'short-code', [
        'methods' => WP_REST_Server::DELETABLE,
        'callback' => 'create_delete_sc',
        'permission_callback' => '__return_true'
    ]);

    // Get data for modal
    register_rest_route('wp-visualize/v1', 'get-modal', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'get_modal_content',
        'permission_callback' => '__return_true'
    ]);

    // get data for modal
    register_rest_route('wp-visualize/v1', 'get-button', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'get_shortcode_button',
        'permission_callback' => '__return_true'
    ]);    

    // Register
    register_rest_route('wp-visualize/v1', 'register', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'register_user',
        'permission_callback' => '__return_true'
    ]);

    // Updating plugin settings / preferences
    register_rest_route('wp-visualize/v1', 'settings', [
        'methods' => WP_REST_Server::EDITABLE,
        'callback' => 'wpv_update_settings',
        'permission_callback' => '__return_true'
    ]);

    // Retrieving plugin settings / preferences
    register_rest_route('wp-visualize/v1', 'settings', [
        'methods' => WP_REST_Server::EDITABLE,
        'callback' => 'wpv_update_settings',
        'permission_callback' => '__return_true'
    ]);

    // Register
    register_rest_route('wp-visualize/v1', 'activate', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'activate_user',
        'permission_callback' => '__return_true'
    ]);

    // Register
    register_rest_route('wp-visualize/v1', 'activator', [
        'methods' => WP_REST_Server::EDITABLE,
        'callback' => 'activator_add',
        'permission_callback' => '__return_true'
    ]);

}
