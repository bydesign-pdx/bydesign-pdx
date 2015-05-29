
<td class="<?php
    if (isset($attributes['align']) && ($attributes['align'] == 'left')) {
        echo "left";
    }
    if (isset($attributes['size']) && ($attributes['size'] == 'big')) {
        echo " big";
    }
?>">
    <a href="<?php if (!empty($attributes['link_url'])) { echo $attributes['link_url']; } ?>">
        <?php if (!empty($attributes['title'])) : ?>
            <div class="title">
                <?php echo $attributes['title']; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($attributes['count'])) : ?>
            <div class="count">
                <?php echo $attributes['count']; ?>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($attributes['link'])) : ?>
            <div class="go-to">
                <?php echo $attributes['link']; ?> <span>&#8250;</span>
            </div>
        <?php endif; ?>
    </a>
</td>
