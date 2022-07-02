<!-- Add the "mu-plugins" folder to the "wp-content" folder of the site. Don't change the folder name from "mu-plugins".
This file is used to add new Post Types to the site. The "mu-plugins" should only reside in the "wp-content"´folder. -->

<?php 

    // WordPress comes with two post types, 'Pages' and 'Post'. This method is used to setup new post types
    function university_post_types() {
        register_post_type('event', array(
            'rewrite' => array('slug' => 'events'),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'labels' => array(
                'name' => 'Events',
                'add_new_item' => 'Add New Event',
                'edit_item' => 'Edit Event',
                'all_items' => 'All Events',
                'singular_name' => 'Event'
            ),
            'menu_icon' => 'dashicons-calendar'
        ));
    }

    add_action('init', 'university_post_types');

?>