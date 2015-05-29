<?php
    $classes = array('shortcode', 'posts-shortcode');

    if (isset($attributes['class'])) {
        $classes[] = $attributes['class'];
    }
    
    if (isset($attributes['link'])) {
        $titleclass = "title-link";
    }
?>

<?php if ($query->have_posts()) : ?>

    <div class="<?php echo implode(' ', $classes); ?>">
        <?php if (!empty($attributes['title'])) : ?>
            <h3 class="shortcode-title <?php echo $titleclass ?>">
                <?php if (isset($attributes['link'])) { ?>
                    <a href="<?php echo $attributes['link_url']; ?>" class="link no-border"><?php echo $attributes['link']; ?></a>
                <?php } ?>
                <?php echo $attributes['title']; ?>
            </h3>
        <?php endif; ?>

        <div class="posts-list">

            <?php while ($query->have_posts()) : ?>
            <?php $query->the_post(); ?>
    
            <div class="one-post no-border">
                <div class="title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
                <div class="meta">
                    <a href="<?php the_permalink(); ?>" class="more"><?php _e( 'More', 'flatroom' ); ?> <span>&#8250;</span></a>
                    <?php _e( 'Posted by', 'flatroom' ); ?>
                    <a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php echo get_the_author(); ?>
                    </a>
                    <?php _e( 'on', 'flatroom' ); ?>
                    <?php flatroom_entry_date(); ?>
                    <?php the_time(); ?>
                </div>
            </div>
    
            <?php endwhile; ?>

        </div>
    </div>

<?php endif; ?>