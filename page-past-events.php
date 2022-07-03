<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Past Events</h1>
        <div class="page-banner__intro">
            <p>A recap of our past events.</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php 
        $today = date('Ymd');
        $pastEvents = new WP_Query(array(
            //'posts_per_page' => 1, // defines number of objects on each page
            'paged' => get_query_var('paged', 1), // Gets the page number for the paged queries from the URL, the second parameter defines the default page, if WP doesnot find page num in URL
            'post_type' => 'event', // If not provided, fetches the default post type i.e. Posts
            'meta_key' => 'event_date', // meta_key is used for custom fields
            'orderby' => 'meta_value_num', // meta_value_num tells wordpress to orderby the field provided in the meta_key field. NOTE: meta_value without _num is used for string fields
            'order' => 'ASC',
            'meta_query' => array( // creates the filter query for the post type
                array(
                    'key' => 'event_date', // The field on the post type to filter on
                    'compare' => '<', // The operator used for filtering
                    'value' => $today, // The value to which the field will be compared
                    'type' => 'numeric' // The type of the field
                )
            )
        ));
        while ($pastEvents->have_posts()) {
		$pastEvents->the_post();
	?>
    <div class="event-summary">
        <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month">
                <?php
					$eventDate = new DateTime(get_field('event_date'));
					echo $eventDate->format('M');
					?>
            </span>
            <span class="event-summary__day">
                <?php echo $eventDate->format('d');  ?>
            </span>
        </a>
        <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p>
                <?php
					if (has_excerpt()) {
						echo get_the_excerpt();
					} else {
						echo wp_trim_words(get_the_content(), 18);
					}
					?>
                <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
            </p>
        </div>
    </div>
    <?php
	}
	echo paginate_links(array(
        'total' => $pastEvents->max_num_pages // The total option needs to be provided, since we are using a custom here and not the global query from WordPress
    ));
	?>
</div>

<?php get_footer(); ?>