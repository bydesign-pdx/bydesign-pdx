<?php
  $social      = get_post_meta($post->ID, 'social_icons', true);
  $member_post = get_post_meta($post->ID, 'member_post', true);
?>
<table class="form-table">

  <tr>
    <th>
      <span><?php _e('Social networks', 'flatroom'); ?></span>
    </th>
    <td>

      <table name="social-icons-section" class="form-table">
        <tr valign="top">
          <td>
            <label for="social_icons_select"><?php echo __('Select social icon', 'flatroom'); ?>:</label>
            <?php flatroom_get_template('social-icons.php'); ?>
            <input name="social_icons_url" type="text" id="social-icons-url" />
            <input type="button" class="add-social-icon" value="<?php echo __('Add', 'flatroom'); ?>" />
          </td>
        </tr>

        <tr>
          <td class="footer">

            <input type="hidden" id="selected-social-icons" name="social_icons" value='<?php echo $social; ?>' />

            <ul id="social-icons-preview" class="social">

              <?php
                $array = json_decode($social);
                if (!empty($array)):
                  foreach ($array as $v):
                    if (!empty($v->icon) && !empty($v->url)) :?>

                      <li class="widget ui-sortable">

                        <input type="hidden" value="<?php echo $v->icon; ?>" class="hidden-option-icon">
                        <input type="hidden" value="<?php echo $v->url; ?>" class="hidden-option-url">

                        <i class="icon-<?php echo $v->icon; ?>"></i>

                        <a href="#" class="remove-social-icon"><?php echo __('Remove', 'flatroom'); ?></a>

                      </li>

                    <?php endif;
                  endforeach;
                endif;
              ?>

            </ul>
          </td>
        </tr>

      </table>
    </td>
  </tr>

  <tr>
    <th>
      <span><?php _e('Post', 'flatroom'); ?></span>
    </th>
    <td>
      <input type="text" value="<?php echo $member_post; ?>" name="member_post" />
    </td>
  </tr>

</table>