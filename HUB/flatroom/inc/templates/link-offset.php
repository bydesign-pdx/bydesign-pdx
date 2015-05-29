<?php
    $classes = array('shortcode', 'link-offers-shortcode');
    
    if (!isset($attributes['title'])) {
        $classes[] = 'border';
    }
?>

<div class="<?php echo implode(' ', $classes); ?>">

    <div class="clearfix"></div>

    <?php if (!empty($attributes['title'])) : ?>
        <h3 class="shortcode-title ">
            <?php if (isset($attributes['link'])) { ?>
                <a href="<?php if (isset($attributes['link_url'])) { echo $attributes['link_url']; } ?>" class="link no-border">
                    <?php echo $attributes['link']; ?>
                </a>
            <?php } ?>
            <?php echo $attributes['title']; ?>
        </h3>
    <?php endif; ?>
    
    <div class="link-offers-content">
        <table>
            <tr>
                <?php echo do_shortcode( $content ) ?>
            </tr>
        </table>
    </div>
    
</div>