<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group #color').change(function() {
      var $this = $(this);
      if($this.find(':selected').val() == "custom") {
        $('.color-custom-child').show();
      } else {
        $('.color-custom-child').hide();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="word"><?php _e('Word', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="word" id="word" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="color"><?php _e('Color', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="color" id="color">
            <option value="default" selected="true"><?php _e('Default', NOO_TEXT_DOMAIN); ?></option>
            <option value="custom"><?php _e('Custom Style', NOO_TEXT_DOMAIN); ?></option>
            <option value="primary"><?php _e('Primary', NOO_TEXT_DOMAIN); ?></option>
            <option value="success"><?php _e('Success', NOO_TEXT_DOMAIN); ?></option>
            <option value="info"><?php _e('Info', NOO_TEXT_DOMAIN); ?></option>
            <option value="warning"><?php _e('Warning', NOO_TEXT_DOMAIN); ?></option>
            <option value="danger"><?php _e('Danger', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group color-custom-child" style="display: none;">
        <label for="custom_color"><?php _e('Custom Color', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="custom_color" type="text" name="custom_color" class="noo-color-picker" style="display: inline-block;" value="#ffffff" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="rounded"><?php _e('Rounded Corner', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="rounded" type="checkbox" checked="true" />
        </div>
      </div>
    <div class="noo-form-footer">
      <input type="button" name="insert" id="noo-save-shortcodes" class="button button-primary" value="<?php _e('Save', NOO_TEXT_DOMAIN); ?>"/>
      <input type="button" name="cancel" id="noo-cancel-shortcodes" class="button" value="<?php _e('Cancel', NOO_TEXT_DOMAIN); ?>"/>
    </div>
  </form>
</div>