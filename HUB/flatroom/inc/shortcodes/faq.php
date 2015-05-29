<?php

function flatroom_faq($attributes) {
    $output = '<div class="clearfix"></div>';
  
    $count = (isset($attributes['count']) && is_numeric($attributes['count']))
        ? $attributes['count']
        : -1;
    $faq_id = (isset($attributes['id']) )
        ? $attributes['id']
        : faq_chortcode;
    $title = $attributes['title'];
  
    $query = new WP_Query(
      array(
        'post_type'      => 'faqs',
        'post_status'    => 'publish',
        'posts_per_page' => $count,
      ));

    if ($query->have_posts()) {
        $output .= '<div class="shortcode faq-shortcode">';
            if (!empty ($title)) { $output .= '<h3 class="shortcode-title">'. $title .'</h3>'; }
            $output .= '<div id="'. $faq_id .'" class="row accordion">';
            foreach ($query->posts as $post) {
                $link  = post_permalink( $post->ID );
                
                $title = $post->post_title;
                $arr_title = explode(" ", $title);
                $arr = array_slice($arr_title, 0, 18);
                $title_count = implode(" ", $arr);
                if (count($arr_title) > 18) {
                    $title_count .= '...';
                }
                
                $content = $post->post_content;
                $arr_content = explode(" ", $content);
                $arr = array_slice($arr_content, 0, 90);
                $content_count = implode(" ", $arr);
                if (count($arr_content) > 90) {
                    $content_count .= _x( ' <a class="no-border more" href="'.$link.'">More <span>&#8250;</span></a>', 'flatroom' );
                }
               
                $output .=
                    '<div class="accordion-group span6 no-dark">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#'. $faq_id .'" href="#collapse-'.$post->ID.''. $faq_id.'"><span>
                                ' .  $title_count .'
                            </span></a>
                        </div>
                        <div id="collapse-'.$post->ID.''. $faq_id.'" class="accordion-body collapse">
                            <div class="accordion-inner">
                                ' . $content_count . '
                            </div>
                        </div>';
                    $output .= '</div>';
            }
            $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
}
add_shortcode('faq', 'flatroom_faq');