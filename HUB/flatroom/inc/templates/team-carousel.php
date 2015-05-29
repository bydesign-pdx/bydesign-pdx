<?php
  $classes = array('shortcode', 'team-shortcode', 'carousel-box', 'no-responsive');

  if (isset($attributes['class'])) {
    $classes[] = $attributes['class'];
  }
?>

<?php if ($query->have_posts()) : ?>

  <div class="<?php echo implode(' ', $classes); ?>">

    <?php if (!empty($attributes['title'])) : ?>
      <h3 class="shortcode-title"><?php echo $attributes['title']; ?></h3>
    <?php endif; ?>

    <div class="row">

      <a href="#" class="prev-next prev">&#8249;</a>
      <a href="#" class="prev-next next">&#8250;</a>

      <div class="carousel">

        <?php while ($query->have_posts()) : ?>
          <?php $query->the_post(); ?>

          <div class="span3 team-member">

            <div class="worker-info">

              <?php if ($image = wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), '220x200c')): ?>
                <div class="worker-image"><?php echo $image; ?></div>
              <?php endif; ?>

              <?php if ($social = get_post_meta(get_the_ID(), 'social_icons', true)) : ?>
                <div class="image-hover"><ul>

                  <?php foreach (json_decode($social) as $v) : ?>

                    <?php if (!empty($v->icon) && !empty($v->url)) :?>

                      <li class="social-icons">
                        <a href="<?php echo $v->url; ?>">
                          <i class="icon-<?php echo $v->icon; ?>"></i>
                        </a>
                      </li>

                    <?php endif; ?>

                  <?php endforeach; ?>

                </ul></div>
              <?php endif; ?>

            </div><!-- .worker-info -->

            <div class="worker-name">
              <?php the_title(); ?>
            </div>

            <div class="worker-post">
              <?php echo get_post_meta(get_the_ID(), 'member_post', true); ?>
            </div>

            <div class="worker-description">
              <?php the_content(); ?>
            </div>

          </div>

        <?php endwhile; ?>

      </div>

    </div>

  </div>

<?php endif; ?>