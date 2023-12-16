<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
<section class="porfolio-detail pt-5 pb-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-8 col-sm-12">
				<div class="top">
					<?php the_post_thumbnail(); ?>
					<h1><?php the_title(); ?></h1>
					<h4>
						Date: <?php echo get_the_date(); ?>
					</h4>
				
					<?php
					// Get the custom taxonomy terms for the current post
					$portfolio_categories = get_the_terms(get_the_ID(), 'portfolio-category');

					// Check if there are terms
					if (!empty($portfolio_categories)) {
						echo '<p>Portfolio Categories: ';
						foreach ($portfolio_categories as $category) {
							$category_name = $category->name;
							$category_url = get_term_link($category);
							echo '<a href="' . esc_url($category_url) . '">' . esc_html($category_name) . '</a>';

							// Add a comma between multiple categories
							if(next($portfolio_categories)) {
								echo ', ';
							}
						}
						echo '</p>';
					}
					?>
					
					 <?php the_content(); ?>
				</div>

				
			</div>
			<div class="col-md-4 col-lg-4 col-sm-12">
			<?php get_sidebar(); ?>
		    </div>
		</div>
	</div>
</section>

	
         
<?php endwhile; ?>



<?php get_sidebar(); ?>
<?php get_footer(); ?>