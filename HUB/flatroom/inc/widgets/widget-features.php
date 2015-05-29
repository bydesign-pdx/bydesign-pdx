<?php

class Features_Widget extends WP_Widget { 
	function __construct() {
		parent::__construct(
			'features_widget',
			'Features',
			array( 'description' => __( 'Features List Widget', 'flatroom' ), 'classname' => 'carousel-box widget-features')
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_type' => 'features', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title']; ?>
		<div class="row">
            <a href="#" class="prev-next prev">&#8249;</a>
            <a href="#" class="prev-next next">&#8250;</a>
            <div class="carousel">
            <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                <div class="span3 features-single">
                    <div class="features-icon"><i class="<?php echo get_post_meta(get_the_ID(), 'features_icon', true) ?>"></i></div>
                    <div class="features-text"><?php the_content(); ?></div>
                </div>
            <?php endwhile; ?>
            </div>
		</div>
		<?php echo $args['after_widget'];
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;
	}
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Features', 'flatroom' );
		}
        if ( isset( $instance[ 'number' ] ) ) {
			$number = $instance[ 'number' ];
		}
		else {
			$number = 10;
		}
		?>
		<p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" />
        </p>
		<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = (int) $new_instance['number'];
		return $instance;
	}
}
function register_features_widget() {
    register_widget( 'Features_Widget' );
}
add_action( 'widgets_init', 'register_features_widget' );