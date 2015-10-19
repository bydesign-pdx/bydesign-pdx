<li><strong><?php _e('Date', 'moutheme'); ?>:</strong> <time datetime="<?php echo date(DATE_W3C); ?>" class="updated"><?php the_time(get_option('date_format')); ?></time></li>
<li><?php _e('Posted by', 'moutheme'); ?> <strong><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" title="<?php _e('View all posts by', 'moutheme'); ?> <?php the_author(); ?>"><?php the_author(); ?></a></strong></li>
<?php if ( comments_open() ) : ?>
<li><?php comments_popup_link(__('<strong>No</strong> Comments', 'moutheme'), __('<strong>1</strong> Comment', 'moutheme'), __('<strong>%</strong> Comments', 'moutheme'), 'comments-link', ''); ?></li>
<?php endif; ?>