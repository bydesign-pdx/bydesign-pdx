<?php

class Flatroom_Faq_Widget extends WP_Widget { 
	function __construct() {
		parent::__construct(
			'faq_widget',
			'Faq',
			array( 'description' => __( 'Faq Posts Widget', 'flatroom' ), )
		);
	}
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'post_type' => 'faqs', 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title']; ?>
        
		<div class="accordion faq-widget" id="faq-widget">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#faq-widget" href="#collapse-<?php the_ID(); ?>">
                        <?php echo wp_trim_words( get_the_title(), 10); ?>
                    </a>
                </div>
                <div id="collapse-<?php the_ID(); ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <?php echo wp_trim_words( get_the_content(), 50, ' <a class="no-border more" href="'. post_permalink( $post->ID ) .'">More <span>&#8250;</span></a>'); ?>
                    </div>
                </div>
			</div>
		<?php endwhile; ?>
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
			$title = __( 'Faq', 'flatroom' );
		}
        if ( isset( $instance[ 'number' ] ) ) {
			$number = $instance[ 'number' ];
		}
		else {
			$number = 6;
		}
		?>
		<p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'flatroom' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'flatroom' ); ?></label>
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
function register_faq_widget() {
    register_widget( 'Flatroom_Faq_Widget' );
}
add_action( 'widgets_init', 'register_faq_widget' );