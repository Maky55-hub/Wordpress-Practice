<?php

// This function loads all of the scripts and css files in the header
function university_files()
{
	wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('university_index_styles', get_theme_file_uri('/build/style-index.css'));
	wp_enqueue_Style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

// This function dynamically generates the title of the page in the tab
function university_features()
{
	// Inorder to set up dynamic menu locations throught wordpress
	register_nav_menu('headerMenuLocation', 'Header Menu Location');
	register_nav_menu('footerMenuLocationOne', 'Footer Menu Location One');
	register_nav_menu('footerMenuLocationTwo', 'Footer Menu Location Two');


	add_theme_support('title-tag');
}

function university_adjust_queries($query) {
	if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) { // Checks whether we are not on the WordPress Admin page and the post_type is event and is the global query from WordPress
		$today = date('Ymd');
		$query->set('meta_key', 'event_date'); // meta_key is used for custom fields
		$query->set('orderby', 'meta_value_num'); // meta_value_num tells wordpress to orderby the field provided in the meta_key field. NOTE: meta_value without _num is used for string fields
		$query->set('order', 'ASC');
		$query->set('meta_query', array( // creates the filter query for the post type
					array(
					'key' => 'event_date', // The field on the post type to filter on
					'compare' => '>=', // The operator used for filtering
					'value' => $today, // The value to which the field will be compared
					'type' => 'numeric' // The type of the field
					)
				)
			);
	}
}

// Tells wordpress when to call the above functions
add_action('wp_enqueue_scripts', 'university_files');
add_action('after_setup_theme', 'university_features');
add_action('pre_get_posts', 'university_adjust_queries');