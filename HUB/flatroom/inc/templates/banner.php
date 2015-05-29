<?php
    $classes = array('shortcode', 'banner-shortcode', 'no-dark');
?>

<div class="<?php echo implode(' ', $classes); ?>">

    <div class="clearfix"></div>

    <?php if (!empty($attributes['title'])) : ?>
        <h3 class="title">
            <?php echo $attributes['title']; ?>
        </h3>
    <?php endif; ?>
    
    <?php if (!empty($attributes['content'])) : ?>
        <div class="description">
            <?php echo $attributes['content']; ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($attributes['link'])) : ?>
        <a class="btn" href="<?php if (!empty($attributes['link_url'])) { echo $attributes['link_url']; } ?>"><?php echo $attributes['link']; ?></a>
    <?php endif; ?>
    
</div>