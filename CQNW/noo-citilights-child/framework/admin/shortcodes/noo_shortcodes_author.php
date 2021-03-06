<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group .parent-control').change(function() {
      var $this = $(this);
      var parent_active = false;
      var parent_type = $this.attr('type');
      var parent_id   = $this.attr('id');
      if(parent_type == 'text') {
        parent_active = ($this.val() !== '');
      } else if(parent_type == 'checkbox') {
        parent_active = ($this.is(':checked'));
      }

      if(parent_active) {
        $('.' + parent_id + '-child').show().find('input.parent-control').change();
      } else {
        $('.' + parent_id + '-child').hide().find('input.parent-control').change();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="author"><?php _e('Select Author', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <?php wp_dropdown_users(array('id' => 'author', 'name' => 'author')); ?>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="custom_avatar"><?php _e('Custom Avatar', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="custom_avatar" type="text" name="custom_avatar" class="noo-wpmedia parent-control" value=""/>
          <small class="noo-control-desc"><?php _e('Leave it blank to use Author\'s default Avatar.', NOO_TEXT_DOMAIN); ?></small>
          <a id="custom_avatar-clear" style="display: none; text-decoration: none;" role="button" href="#" class="custom_avatar-child">
            <i class="dashicons dashicons-no"></i><?php _e('Clear Image', NOO_TEXT_DOMAIN); ?>
          </a>
        </div>
        <script type="text/javascript">
          jQuery(document).ready(function($) {   
            $('#custom_avatar-clear').click(function() {
              jQuery('#custom_avatar').val('').change();
            });
          });
        </script>
      </div>
      <div class="noo-form-group">
        <label for="role"><?php _e('Role', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="role" type="text" name="role" value=""></textarea>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="description"><?php _e('Description', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea id="description" name="description" value=""></textarea>
          <small class="noo-control-desc"><?php _e('Input description here to override Author\'s description.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="facebook"><?php _e('Facebook Profile', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="facebook" type="text" name="facebook" value=""></textarea>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="twitter"><?php _e('Twitter Profile', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="twitter" type="text" name="twitter" value=""></textarea>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="googleplus"><?php _e('Google+ Profile', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="googleplus" type="text" name="googleplus" value=""></textarea>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="linkedin"><?php _e('LinkedIn Profile', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="linkedin" type="text" name="linkedin" value=""></textarea>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="visibility"><?php _e('Visibility', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="visibility" id="visibility">
            <option value="all" selected="true"><?php _e('All Devices', NOO_TEXT_DOMAIN); ?></option>
            <option value="hidden-phone"><?php _e('Hidden Phone', NOO_TEXT_DOMAIN); ?></option>
            <option value="hidden-tablet"><?php _e('Hidden Tablet', NOO_TEXT_DOMAIN); ?></option>
            <option value="hidden-pc"><?php _e('Hidden PC', NOO_TEXT_DOMAIN); ?></option>
            <option value="visible-phone"><?php _e('Visible Phone', NOO_TEXT_DOMAIN); ?></option>
            <option value="visible-tablet"><?php _e('Visible Tablet', NOO_TEXT_DOMAIN); ?></option>
            <option value="visible-pc"><?php _e('Visible PC', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="class"><?php _e('Class', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="class" id="class" />
          <small class="noo-control-desc"><?php _e('(Optional) Enter a unique class name.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
    </div>
    <div class="noo-form-footer">
      <input type="button" name="insert" id="noo-save-shortcodes" class="button button-primary" value="<?php _e('Save', NOO_TEXT_DOMAIN); ?>"/>
      <input type="button" name="cancel" id="noo-cancel-shortcodes" class="button" value="<?php _e('Cancel', NOO_TEXT_DOMAIN); ?>"/>
    </div>
  </form>
</div>
