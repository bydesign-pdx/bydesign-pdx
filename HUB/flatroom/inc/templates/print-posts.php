<?php if (have_posts()): ?>
  <?php while (have_posts()): the_post(); ?>
    <p id="BlogTitle"><?php the_title(); ?></p>
    <p id="BlogDate"><?php _e('Posted By', 'wp-print'); ?> <u><?php the_author(); ?></u> <?php _e('On', 'wp-print'); ?> <?php the_time(sprintf(__('%s @ %s', 'wp-print'), get_option('date_format'), get_option('time_format'))); ?> <?php _e('In', 'wp-print'); ?> <?php print_categories('<u>', '</u>'); ?> | <u><a href='#comments_controls'><?php print_comments_number(); ?></a></u></p>
    <div id="BlogContent"><?php print_content(); ?></div>
  <?php endwhile; ?>
  <hr class="Divider" style="text-align: center;" />
  <?php if(print_can('comments')): ?>
    <?php comments_template(); ?>
  <?php endif; ?>
  <p><?php _e('Article printed from', 'wp-print'); ?> <?php bloginfo('name'); ?>: <strong dir="ltr"><?php bloginfo('url'); ?></strong></p>
  <p><?php _e('URL to article', 'wp-print'); ?>: <strong dir="ltr"><?php the_permalink(); ?></strong></p>
  <?php if(print_can('links')): ?>
    <p><?php print_links(); ?></p>
  <?php endif; ?>
<?php else: ?>
  <p><?php _e('No posts matched your criteria.', 'wp-print'); ?></p>
<?php endif; ?>