<?php
    $classes = array('shortcode', 'features-shortcode', 'carousel-box', 'no-responsive');
    
    if (!isset($attributes['type'])) {
        $classes[] = 'features-first';
    }
?>

<?php if ($query->have_posts()) : ?>
<div class="<?php echo implode(' ', $classes); ?>">

    <div class="clearfix"></div>
    
    <?php if (!empty($attributes['title'])) : ?>
        <h3 class="shortcode-title"><?php echo $attributes['title']; ?></h3>
    <?php endif; ?>

    <div class="row">
        <a href="#" class="prev-next prev">&#8249;</a>
        <a href="#" class="prev-next next">&#8250;</a>

        <div class="carousel">
  
            <?php while ($query->have_posts()) : ?>
            <?php $query->the_post(); ?>
                <?php if (isset($attributes['type']) && ($attributes['type'] == 'second')) { ?>
                    <div class="span3 features-single senond">
                        <div class="features-icon-box">
                            <div class="border"></div>
                            <div class="features-icon">
                                <i class="<?php echo get_post_meta(get_the_ID(), 'features_icon', true); ?>"></i>
                            </div>
                        </div>
                        <h4 class="features-title"><?php the_title(); ?></h4>
                        <div class="features-text"><?php the_content(); ?></div>
                    </div>
                <?php } else { ?>
                    <div class="span4 features-single">
                        <div class="features-icon">
                            <i class="<?php echo get_post_meta(get_the_ID(), 'features_icon', true); ?>"></i>
                        </div>
                        <div class="features-text"><?php the_content(); ?></div>
                        <div class="clearfix"></div>
                    </div>
                <?php } ?>
            <?php endwhile; ?>
        </div>

    </div>

</div>
<?php endif; ?>