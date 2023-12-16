<?php

function theme_styles_scripts() {
wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), time());
    wp_enqueue_style('owl-themef', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css', array(), time());
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), time());
    wp_enqueue_style('lity', get_template_directory_uri() . '/assets/css/lity.css', array(), time());
  
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), time());
    wp_enqueue_script('fontkit', 'https://kit.fontawesome.com/a5763fe082.js', array(), time(), true);
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), time(), true);
   
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), time(), true);
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-3.3.1.min.js', array(), time(), true);
    wp_enqueue_script('lity', get_template_directory_uri() . '/assets/js/lity.js', array(), time(), true);
	wp_enqueue_script('function', get_template_directory_uri() . '/assets/js/function.js', array(), time(), true);
}

add_action( 'wp_enqueue_scripts', 'theme_styles_scripts' );

add_theme_support( 'post-thumbnails' );

function site_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	$title .= get_bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'forekidz' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'site_title', 10, 2 );

function wp_nav() {
  register_nav_menus(
    array(
      'main_nav' => __( 'Main Menu', 'forekidz' ),
      'foot_nav' => __( 'Footer Menu', 'forekidz' )
    )
  );
}
add_action( 'after_setup_theme', 'wp_nav' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	

}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function zafeer_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'forekidz' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'forekidz' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'zafeer_widgets_init' );



/*
* Creating a function to create portfolio CPT
*/
  
// Register Custom Post Type
function custom_portfolio_post_type() {

	$labels = array(
		'name'                  => _x( 'Portfolios', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolios', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Portfolio Archives', 'text_domain' ),
		'attributes'            => __( 'Portfolio Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'text_domain' ),
		'all_items'             => __( 'All Portfolios', 'text_domain' ),
		'add_new_item'          => __( 'Add New Portfolio', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Portfolio', 'text_domain' ),
		'edit_item'             => __( 'Edit Portfolio', 'text_domain' ),
		'update_item'           => __( 'Update Portfolio', 'text_domain' ),
		'view_item'             => __( 'View Portfolio', 'text_domain' ),
		'view_items'            => __( 'View Portfolios', 'text_domain' ),
		'search_items'          => __( 'Search Portfolio', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into portfolio', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this portfolio', 'text_domain' ),
		'items_list'            => __( 'Portfolios list', 'text_domain' ),
		'items_list_navigation' => __( 'Portfolios list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter portfolios list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'text_domain' ),
		'description'           => __( 'Portfolio news and reviews', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'custom_portfolio_post_type', 0 );

// Register Custom Taxonomy
function custom_portfolio_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Portfolio Categories', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Portfolio Category', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Portfolio Category', 'text_domain' ),
		'all_items'                  => __( 'All Portfolio Categories', 'text_domain' ),
		'parent_item'                => __( 'Parent Portfolio Category', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Portfolio Category:', 'text_domain' ),
		'new_item_name'              => __( 'New Portfolio Category Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Portfolio Category', 'text_domain' ),
		'edit_item'                  => __( 'Edit Portfolio Category', 'text_domain' ),
		'update_item'                => __( 'Update Portfolio Category', 'text_domain' ),
		'view_item'                  => __( 'View Portfolio Category', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate portfolio categories with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove portfolio categories', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Portfolio Categories', 'text_domain' ),
		'search_items'               => __( 'Search Portfolio Categories', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Portfolio Categories', 'text_domain' ),
		'items_list'                 => __( 'Portfolio categories list', 'text_domain' ),
		'items_list_navigation'      => __( 'Portfolio categories list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'portfolio-category',
		'with_front'                 => true,
		'hierarchical'               => true,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'portfolio-category', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_portfolio_taxonomy', 0 );



function portfolio_latest_posts_shortcode($atts) {
    // Define shortcode attributes
    $atts = shortcode_atts(
        array(
            'number' => 5, // Number of posts to display
        ),
        $atts,
        'portfolio_latest_posts'
    );

    // Query the latest posts of the 'portfolio' post type
    $query_args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $atts['number'],
    );

    $portfolio_query = new WP_Query($query_args);

    // Start output buffer
    ob_start();

    // Check if there are posts
    if ($portfolio_query->have_posts()) {
        echo '<div class="row portfolio-row">';
        while ($portfolio_query->have_posts()) {
            $portfolio_query->the_post();
            echo '<div class="col-md-4"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></div>';
        }
        echo '</div>';
    } else {
        echo 'No portfolio posts found.';
    }

    // Reset post data
    wp_reset_postdata();

    // End output buffer and return its contents
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('portfolio_latest_posts', 'portfolio_latest_posts_shortcode');


function portfolio_cat_posts_shortcode($atts) {
    // Define shortcode attributes
    $atts = shortcode_atts(
        array(
            'category' => '', // Custom taxonomy category name
            'number'   => 5,  // Number of posts to display
        ),
        $atts,
        'portfolio_latest_posts'
    );

    // Query the latest posts of the 'portfolio' post type with a specific category
    $query_args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => $atts['number'],
        'tax_query'      => array(
            array(
                'taxonomy' => 'portfolio-category',
                'field'    => 'name',
                'terms'    => $atts['category'],
            ),
        ),
    );

    $portfolio_query = new WP_Query($query_args);

    // Start output buffer
    ob_start();

    // Check if there are posts
    if ($portfolio_query->have_posts()) {
        echo '<div class="row portfolio-row">';
        while ($portfolio_query->have_posts()) {
            $portfolio_query->the_post();
            echo '<div class="col-md-4"><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></div>';
        }
        echo '</div>';
    } else {
        echo 'No portfolio posts found.';
    }

    // Reset post data
    wp_reset_postdata();

    // End output buffer and return its contents
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('portfolio_show', 'portfolio_cat_posts_shortcode');

function display_portfolio_count_dashboard() {
    // Query the total number of published 'portfolio' posts
    $portfolio_count = wp_count_posts('portfolio')->publish;

    // Display the count in the dashboard
    echo '<div class="dashboard-widget">
            <p>Total Portfolio Items: <strong>' . esc_html($portfolio_count) . '</strong></p>
          </div>';
}

function add_portfolio_count_to_dashboard() {
    // Use 'normal' context to display the widget on the main dashboard
    wp_add_dashboard_widget(
        'portfolio_count_dashboard_widget',
        'Portfolio Count',
        'display_portfolio_count_dashboard'
    );
}

// Hook the function to the dashboard setup
add_action('wp_dashboard_setup', 'add_portfolio_count_to_dashboard');



// add wiget for random portfolio items.
include_once('custom-portfolio-widget.php');



?>
