<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="content"><?php _e('Map Embed Iframe', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea name="content" id="content" ></textarea>
          <small class="noo-control-desc"><?php echo sprintf( __( 'Visit <a href="%s" target="_blank">Google maps</a> and create your map with following steps: 1) Find a location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.</span>', NOO_TEXT_DOMAIN ), 'http://maps.google.com/'); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="size"><?php _e('Map Height', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="size" id="size" />
          <small class="noo-control-desc"><?php _e('Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="disable_zooming"><?php _e('Disable Zooming', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" name="diable_zooming" id="diable_zooming" />
          <small class="noo-control-desc"><?php _e('Disable zooming to prevent map accidentally zoom when mouse scroll over it.', NOO_TEXT_DOMAIN); ?></small>
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
