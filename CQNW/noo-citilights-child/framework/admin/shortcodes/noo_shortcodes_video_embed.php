<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="video_ratio"><?php _e('Video Aspect Ratio', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="video_ratio" id="video_ratio">
            <option value="16:9" selected="true"><?php echo '16:9'; ?></option>
            <option value="5:3"><?php echo '5:3'; ?></option>
            <option value="5:4"><?php echo '5:4'; ?></option>
            <option value="4:3"><?php echo '4:3'; ?></option>
            <option value="3:2"><?php echo '3:2'; ?></option>
          </select>
          <small class="noo-control-desc"><?php _e('Choose the aspect ratio for your video.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="content"><?php _e('Embed Code', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea name="content" id="content" ></textarea>
          <small class="noo-control-desc"><?php _e('Input your &lt;iframe&gt; or &lt;embed&gt; code.', NOO_TEXT_DOMAIN); ?></small>
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
