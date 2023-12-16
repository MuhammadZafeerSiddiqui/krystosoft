<?php
class Portfolio_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'portfolio_widget',
            'Portfolio Posts',
            array('description' => 'Display custom post type "portfolio" posts')
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];

        $query_args = array(
            'post_type'      => 'portfolio',
			'orderby'        => 'rand',
            'posts_per_page' => $instance['posts_per_page'],
        );

        $portfolio_query = new WP_Query($query_args);

        if ($portfolio_query->have_posts()) {
            while ($portfolio_query->have_posts()) {
                $portfolio_query->the_post();
                echo '<h4><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h4>';
            }
            wp_reset_postdata();
        } else {
            echo 'No portfolio items found.';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : 'Portfolio Posts';
        $posts_per_page = isset($instance['posts_per_page']) ? absint($instance['posts_per_page']) : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts_per_page'); ?>">Number of Posts:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" min="1" value="<?php echo esc_attr($posts_per_page); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['posts_per_page'] = absint($new_instance['posts_per_page']);
        return $instance;
    }
}

// Register the widget
function register_portfolio_widget() {
    register_widget('Portfolio_Widget');
}
add_action('widgets_init', 'register_portfolio_widget');
