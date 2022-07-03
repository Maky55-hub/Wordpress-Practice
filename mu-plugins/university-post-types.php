<!-- Add the "mu-plugins" folder to the "wp-content" folder of the site. Don't change the folder name from "mu-plugins".
This file is used to add new Post Types to the site. The "mu-plugins" should only reside in the "wp-content"´folder.
NOTE: If the Permalink for the newly created Post Type is not working do following:
    WordPress Admin -> Settings (from left-side menu) -> Permalinks -> Save Changes (Just click the save changes button, no need to change anything else. 
    Saving changes makes the wordpress reload the permalinks history and hence the permalinks for the newly created post type works)
-->

<?php 

    // WordPress comes with two post types, 'Pages' and 'Post'. This method is used to setup new post types
    function university_post_types() {
        register_post_type('event', array(
            'supports' => array('title', 'editor', 'excerpt'),
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