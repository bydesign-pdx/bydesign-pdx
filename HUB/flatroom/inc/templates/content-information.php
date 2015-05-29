<?php
    $classes = array('about-us-box');
    
    if (isset($attributes['class'])) {
        $classes[] = $attributes['class'];
    }
?>
    
<div class="<?php echo implode(' ', $classes); ?>">
    <?php if (!empty($attributes['img'])) : ?>
        <div class="icon"><?php echo $attributes['img']; ?></div>
        <div class="bow">}</div>
    <?php endif; ?>
    
    <?php if ((!empty($attributes['title'])) || (!empty($attributes['count'])) || (!empty($attributes['link']))) : ?>
        <div class="more-then">
            <?php if (!empty($attributes['title'])) : ?>
                <div class="title"><?php echo $attributes['title']; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($attributes['count'])) : ?>
                <div class="count"><?php echo $attributes['count']; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($attributes['link'])) : ?>
                <a href="<?php if (!empty($attributes['link_url'])) { echo $attributes['link_url']; } ?>" class="go-to no-border">
                    <?php echo $attributes['link']; ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($attributes['more_text'])) : ?>
        <div class="more-text"><?php echo $attributes['more_text']; ?></div>
    <?php endif; ?>
</div>