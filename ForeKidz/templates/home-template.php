<?php

/**
 * Template Name: Portfolio Template
 *
 * @package WordPress
 * @subpackage Artisticore
 * @since  text_domain 1.0
 */
?>
<?php get_header(); ?>

<div id="primary" class="content-area pt-5 pb-5">
    <main id="main" class="site-main">
        <div class="container">
			<div class="row">
				<div class="col-md-8 col-lg-8 col-sm-12">
					 <?php while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php the_content(); ?>
							</div><!-- .entry-content -->

						</article><!-- #post-<?php the_ID(); ?> -->

					<?php endwhile; ?>
					<br>
					<br>
					<h3>
						Create a custom query to fetch and display portfolio items with the project date
within the last year.
					</h3>
					<?php
					// Custom query to fetch "portfolio" items with project date from last year
					function custom_portfolio_query() {
						$args = array(
							'post_type'      => 'portfolio',
							'posts_per_page' => -1, // Set to -1 to retrieve all posts
							'meta_query'     => array(
								array(
									'key'     => 'project_date', // ACF date field key
									 'value'   => array(date('Y-m-d', strtotime('first day of last year')), date('Y-m-d', strtotime('last day of last year'))),
									'compare' => 'BETWEEN',
									'type'    => 'DATE',
								),
							),
						);

						$portfolio_query = new WP_Query($args);

						// Check if there are posts
						if ($portfolio_query->have_posts()) {
							while ($portfolio_query->have_posts()) {
								$portfolio_query->the_post();
								// Output your post data as needed
								$date = get_field( 'project_date' ); 
								echo '<h2><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h2>';
								echo '<h5>' . esc_html(get_field( 'project_date' )) . '</h5>';
								// Output other post details
							}
							// Reset post data
							wp_reset_postdata();
						} else {
							echo 'No portfolio items found from last year.';
						}
					}

					// Call the custom query function where you want to display the data
					custom_portfolio_query();

					
					?>
				</div>
				<div class="col-md-4 col-lg-4 col-sm-12">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
       

    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>
