<?php

/******************************************************************************
    Metaboxes
*******************************************************************************/

function flatroom_meta_boxes() {
    // Features
    add_meta_box(
        'flatroom_features_other',
        __( 'Single Icon', 'flatroom' ),
        'flatroom_features_other',
        'features',
        'side'
    );
    
    // Pricing
    add_meta_box(
        'flatroom_pricing_other',
        __( 'General options', 'flatroom' ),
        'flatroom_pricing_other',
        'pricing',
        'normal'
    );
    add_meta_box(
        'flatroom_pricing_price',
        __( 'Price', 'flatroom' ),
        'flatroom_pricing_price',
        'pricing',
        'normal'
    );
    add_meta_box(
        'flatroom_pricing_options',
        __( 'Options', 'flatroom' ),
        'flatroom_pricing_options',
        'pricing',
        'normal'
    );
    add_meta_box(
        'flatroom_team_options',
        __( 'Additional information', 'flatroom' ),
        'flatroom_team_options',
        'team',
        'normal'
    );
}
add_action( 'add_meta_boxes', 'flatroom_meta_boxes' );

function flatroom_team_options($post, $meta) {
    flatroom_get_template('team-member-metaboxes.php', array('post' => $post));
}

function flatroom_meta_box_textfield($post, $meta) {
    $placeholder = isset($meta['args']['placeholder']) ? 'placeholder="' . $meta['args']['placeholder'] . '"' : '';
    $value = get_post_meta($post->ID, $meta['args']['field'], true);
    echo '<input type="text" name="' . $meta['args']['field'] . '" value="' . $value . '" ' . $placeholder . ' />';
}

function flatroom_save_postdata($ID) {
    // Features
    switch (get_post_type($ID)) {
        case 'features':
            $data = (isset($_POST['features_icon']))
        ? $_POST['features_icon']
        : '';
            update_post_meta($ID, 'features_icon', $data);
    }

    // Pricing
    switch (get_post_type($ID)) {
        case 'pricing':
            $data = (isset($_POST['pricing_price']))
                ? $_POST['pricing_price']
                : '';
            update_post_meta($ID, 'pricing_price', $data);

            $data = (isset($_POST['pricing_period']))
                ? $_POST['pricing_period']
                : '';
            update_post_meta($ID, 'pricing_period', $data);

            $data = (isset($_POST['pricing_url']))
                ? $_POST['pricing_url']
                : '';
            update_post_meta($ID, 'pricing_url', $data);

            $data = (isset($_POST['pricing_best']))
                ? $_POST['pricing_best']
                : '';
            update_post_meta($ID, 'pricing_best', $data);

            $data = (isset($_POST['pricing_best']))
                ? $_POST['pricing_best']
                : '';
            update_post_meta($ID, 'pricing_best', $data);

            $data = !empty($_POST['selected_options'])
                ? str_replace('\\', '', $_POST['selected_options'])
                : '';
            update_post_meta($ID, 'pricing_options', $data);
            break;

        case 'team':
            $data = !empty($_POST['social_icons'])
                ? str_replace('\\', '', $_POST['social_icons'])
                : '';
            update_post_meta($ID, 'social_icons', $data);

            $data = !empty($_POST['member_post'])
                ? $_POST['member_post']
                : '';
            update_post_meta($ID, 'member_post', $data);
            break;
    }
}
add_action( 'save_post', 'flatroom_save_postdata' );

// Features
function flatroom_features_other($post) {
    ?>
    <table name="social-icons-section" class="form-table">
        <tr valign="top">
            <th><b><?php echo __('Icon', 'flatroom'); ?></b></th>
            <td>
                <input type="hidden" value="<?php echo get_post_meta($post->ID, 'features_icon', true); ?>" name="features_icon" class="features-icon-selected">
                <dl class="dropdown">
                    <dt><span><?php echo __('Select icon', 'flatroom'); ?></span></dt>
                    <dd><?php flatroom_icons_list(); ?></dd>
                </dl>
            </td>
        </tr>
    </table><?php
}

// Pricing
function flatroom_pricing_price($post) {
    flatroom_meta_box_textfield(
        $post,
        array(
          'args' => array(
        'field' => 'pricing_price',
        'placeholder' => __('$75', 'flatroom'),
          ),
        )
    );
    flatroom_meta_box_textfield(
        $post,
        array(
          'args' => array(
        'field' => 'pricing_period',
        'placeholder' => __('/ month', 'flatroom'),
          ),
        )
    );
}

function flatroom_pricing_other($post) {
    $checked = (get_post_meta($post->ID, 'pricing_best', true) == 'on')
        ? 'checked'
        : '';
    ?>
    <table class="form-table">
        <tr valign="top">
            <th><?php echo __('Url', 'flatroom'); ?></th>
            <td>
                <?php flatroom_meta_box_textfield($post, array('args' => array('field' => 'pricing_url'))); ?>
            </td>
        </tr>
        <tr>
            <th><?php echo __('Best Offer', 'flatroom'); ?></th>
            <td>
                <input type="checkbox" name="pricing_best" <?php echo $checked; ?> />
            </td>
        </tr>
    </table><?php
}

function flatroom_pricing_options($post) {
    $json = get_post_meta($post->ID, 'pricing_options', true);
    $options = array(
        'included' => __('Included', 'flatroom'),
        'excluded' => __('Excluded', 'flatroom'),
    );
    ?>
    <table name="social-icons-section" class="form-table">
        <tr valign="top">
            <td>
                <label for="option_type_select"><?php echo __('Select option type', 'flatroom'); ?>:</label>
                <select name="option_type_select" id="option-type-select" >
                    <?php foreach ($options as $type => $title) : ?>
                    <option value="<?php echo $type; ?>"><?php echo $title; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="option_name"><?php echo __('Option name', 'flatroom'); ?>:</label>
                <input name="option_name" type="text" id="option-name" />
                <input type="button" value="<?php echo __('Add', 'flatroom'); ?>" onClick="addFlatroomOption();" />
            </td>
        </tr>
        <tr>
            <td class="footer">
                <input type="hidden" id="selected-options" name="selected_options" value='<?php echo $json; ?>' />
                <ul id="selected-options-preview" class="sortable-options-list span3"><?php
                    $array = json_decode($json);
                    if (!empty($array)):
                    foreach ($array as $v) :
                    if (!empty($v->name) && !empty($v->type) && !empty($v->class_name)) : ?>
                    <li class="<?php echo $v->class_name; ?> widget ui-draggable">
                        <input type="hidden" value="<?php echo $v->type; ?>" class="hidden-option-type">
                        <input type="hidden" value="<?php echo $v->name; ?>" class="hidden-option-name">
                        <input type="hidden" value="<?php echo $v->class_name; ?>" class="hidden-option-class">
                        <span><?php echo $v->name; ?> (<?php echo $options[$v->type]; ?>)</span>
                        <input type="button" class="btn" value="<?php echo __('Remove', 'flatroom'); ?>" onClick="removeFlatroomOption('<?php echo $v->class_name; ?>');">
                    </li>
                    <?php endif;
                    endforeach;
                    endif;
                ?></ul>
            </td>
        </tr>
    </table>
<?php } 