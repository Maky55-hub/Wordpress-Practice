<?php 

    // This function loads all of the scripts and css files in the header
    function university_files() {
        wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
        wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
        wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
        wp_enqueue_style('university_index_styles', get_theme_file_uri('/build/style-index.css'));
        wp_enqueue_Style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    }

    // This function dynamically generates the title of the page in the tab
    function university_features() {
        // Inorder to set up dynamic menu locations throught wordpress
        register_nav_menu('headerMenuLocation', 'Header Menu Location');
        register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
        register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');

         
        add_theme_support('title-tag');
    }

    // Tells wordpress when to call the above functions
    add_action('wp_enqueue_scripts', 'university_files');
    add_action('after_setup_theme', 'university_features');
