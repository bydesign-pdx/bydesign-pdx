<?php
    $classes = array('shortcode', 'plicing-shortcode');
?>

<?php if ($query->have_posts()) : ?>
<div class="<?php echo implode(' ', $classes); ?>">

    <div class="clearfix"></div>
    
    <?php if (!empty($attributes['title'])) : ?>
        <h3 class="shortcode-title"><?php echo $attributes['title']; ?></h3>
    <?php endif; ?>

    <div class="row pricings clearfix">
        <?php while ($query->have_posts()) : ?>
        <?php $query->the_post(); ?>
            <?php
            $url    = get_post_meta( get_the_ID(), 'pricing_url', true );
            $price  = get_post_meta( get_the_ID(), 'pricing_price', true);
            $period = get_post_meta( get_the_ID(), 'pricing_period', true);
            $class  = (get_post_meta( get_the_ID(), 'pricing_best', true) == 'on')
                ? 'pricing-box best'
                : 'pricing-box';
                
            if (isset($attributes['size']) && ($attributes['size'] == 'big')) { ?>
                <div class="span4">
                    <div class="<?php echo $class ?> no-dark">
                        <div>
                            <h3 class="title">
                                <a href="<?php echo $url; ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="starting"><?php _e('Starting at', 'flatroom') ?></div>
                            <div class="price-box"><?php echo $price; ?><span><?php echo $period; ?></span></div>
                            
                            <?php
                                $json = get_post_meta(get_the_ID(), 'pricing_options', true);
                                $array = json_decode($json);
                                if (!empty($array)) { ?>
                                    <ul class="options">
                                    <?php foreach ($array as $v) {
                                        if (!empty($v->name) && !empty($v->type)) {
                                            $active = ($v->type == 'included')
                                              ? ' class="active" '
                                              : ''; ?>
                                            <li <?php echo $active; ?>><span class="act">✓</span><?php echo $v->name; ?></li>
                                        <?php }
                                    } ?>
                                    </ul>
                                <?php }
                            ?>
                            <?php $class  = (get_post_meta( get_the_ID(), 'pricing_best', true) == 'on')
                            ? 'btn btn-block btn-large btn-inverse'
                            : 'btn btn-block btn-large';
                            ?>
                            <div class="bnt-box"><a href="<?php echo $url; ?>" class="<?php echo $class; ?>"><?php _e('Buy Now', 'flatroom') ?></a></div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="span3">
                    <div class="<?php echo $class ?> no-dark">
                        <div>
                            <h3 class="title">
                                <a href="<?php echo $url; ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="starting"><?php _e('Starting at', 'flatroom') ?></div>
                            <div class="price-box"><?php echo $price; ?><span><?php echo $period; ?></span></div>
                            
                            <?php
                                $json = get_post_meta(get_the_ID(), 'pricing_options', true);
                                $array = json_decode($json);
                                if (!empty($array)) { ?>
                                    <ul class="options">
                                    <?php foreach ($array as $v) {
                                        if (!empty($v->name) && !empty($v->type)) {
                                            $active = ($v->type == 'included')
                                              ? ' class="active" '
                                              : ''; ?>
                                            <li <?php echo $active; ?>><span class="act">✓</span><?php echo $v->name; ?></li>
                                        <?php }
                                    } ?>
                                    </ul>
                                <?php }
                            ?>
                            <?php $class  = (get_post_meta( get_the_ID(), 'pricing_best', true) == 'on')
                            ? 'btn btn-block btn-large btn-inverse'
                            : 'btn btn-block btn-large';
                            ?>
                            <div class="bnt-box"><a href="<?php echo $url; ?>" class="<?php echo $class; ?>"><?php _e('Buy Now', 'flatroom') ?></a></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endwhile; ?>
    </div>

</div>
<?php endif; ?>