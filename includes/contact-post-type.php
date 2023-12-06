<?php
// Register Custom Post Type Contact
function site_mode_create_contact_cpt() {

    $labels = array(
        'name' => _x( 'Contacts', 'Post Type General Name', 'site-mode' ),
        'singular_name' => _x( 'Contact', 'Post Type Singular Name', 'site-mode' ),
        'menu_name' => _x( 'Contacts', 'Admin Menu text', 'site-mode' ),
        'name_admin_bar' => _x( 'Contact', 'Add New on Toolbar', 'site-mode' ),
        'archives' => __( 'Contact Archives', 'site-mode' ),
        'attributes' => __( 'Contact Attributes', 'site-mode' ),
        'parent_item_colon' => __( 'Parent Contact:', 'site-mode' ),
        'all_items' => __( 'All Contacts', 'site-mode' ),
        'add_new_item' => __( 'Add New Contact', 'site-mode' ),
        'add_new' => __( 'Add New', 'site-mode' ),
        'new_item' => __( 'New Contact', 'site-mode' ),
        'edit_item' => __( 'Edit Contact', 'site-mode' ),
        'update_item' => __( 'Update Contact', 'site-mode' ),
        'view_item' => __( 'View Contact', 'site-mode' ),
        'view_items' => __( 'View Contacts', 'site-mode' ),
        'search_items' => __( 'Search Contact', 'site-mode' ),
        'not_found' => __( 'Not found', 'site-mode' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'site-mode' ),
        'featured_image' => __( 'Featured Image', 'site-mode' ),
        'set_featured_image' => __( 'Set featured image', 'site-mode' ),
        'remove_featured_image' => __( 'Remove featured image', 'site-mode' ),
        'use_featured_image' => __( 'Use as featured image', 'site-mode' ),
        'insert_into_item' => __( 'Insert into Contact', 'site-mode' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Contact', 'site-mode' ),
        'items_list' => __( 'Contacts list', 'site-mode' ),
        'items_list_navigation' => __( 'Contacts list navigation', 'site-mode' ),
        'filter_items_list' => __( 'Filter Contacts list', 'site-mode' ),
    );
    $args = array(
        'label' => __( 'Contact', 'site-mode' ),
        'description' => __( '', 'site-mode' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-businessman',
        'supports' => array('title', 'custom-fields'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'contact', $args );


}
add_action( 'init', 'site_mode_create_contact_cpt', 0 );