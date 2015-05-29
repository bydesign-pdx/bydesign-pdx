<?php
    $classes = array('shortcode', 'chart-shortcode');
    
    if (isset($attributes['class'])) {
        $classes[] = $attributes['class'];
    }
?>
    
<div class="<?php echo implode(' ', $classes); ?>">
    
    <div class="chart-content">
        <div class="clearfix"></div>

        <?php if (!empty($attributes['title'])) : ?>
            <h3 class="chart-title ">
                <?php echo $attributes['title']; ?>
            </h3>
        <?php endif; ?>
        
        <div id="chart-param">
            
            <?php if (!empty($attributes['xtitle'])) : ?>
                <input type="hidden" class="title-x" value="<?php echo $attributes['xtitle']; ?>" />
            <?php endif; ?>
            
            <?php if (!empty($attributes['ytitle'])) : ?>
                <input type="hidden" class="title-y" value="<?php echo $attributes['ytitle']; ?>" />
            <?php endif; ?>
            
            <?php if (!empty($attributes['linecolor'])) : ?>
                <input type="hidden" class="linecolor" value="<?php echo $attributes['linecolor']; ?>" />
            <?php endif; ?>
        
        </div>
        
        <div class="graph-params">  
            <?php $data = isset($attributes['data']) ? $attributes['data'] : ''; ?>
            <?php foreach (array_map('trim', explode(';', $data)) as $param) : ?>
              <?php if (!empty($param)) : ?>
                <?php if ($params = array_map('trim', explode(':', $param))) : ?>
                  <?php if (isset($params[0]) && isset($params[1]) && ($time = strtotime($params[0]))) : ?>
                    <input type="hidden" id="<?php echo date('d-M-y', $time); ?>" class="praph-param" value="<?php echo $params[1]; ?>" />
                  <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
        </div>
        
        <div id="chart" <?php if (!empty($attributes['height'])) { echo 'style="height:' .$attributes['height']; } ?>"></div>
    </div>
</div>