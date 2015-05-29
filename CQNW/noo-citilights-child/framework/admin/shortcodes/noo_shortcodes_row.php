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
        <label for="bg_color"><?php _e('Background Color', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_color" type="text" name="bg_color" class="noo-color-picker" style="display: inline-block;" value="" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="bg_image"><?php _e('Background Image', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_image" type="text" name="bg_image" class="noo-wpmedia parent-control" value=""/>
          <a id="bg_image-clear" style="display: none; text-decoration: none;" role="button" href="#" class="bg_image-child">
            <i class="dashicons dashicons-no"></i><?php _e('Remove Image', NOO_TEXT_DOMAIN); ?>
          </a>
        </div>
        <script type="text/javascript">
          jQuery(document).ready(function($) {   
            $('#bg_image-clear').click(function() {
              jQuery('#bg_image').val('').change();
            });
          });
        </script>
      </div>
      <div class="noo-form-group bg_image-child" style="display: none;">
        <label for="bg_color_overlay"><?php _e('Background Color Overlay', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_color_overlay" type="text" name="bg_color_overlay" class="noo-color-picker" style="display: inline-block;" value="" />
        </div>
      </div>
      <div class="noo-form-group bg_image-child" style="display: none;">
        <label for="bg_image_repeat"><?php _e('Background Repeat', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_image_repeat" type="checkbox" name="bg_image_repeat"/>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="parallax"><?php _e('Parallax Background', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="parallax" type="checkbox" name="parallax" checked="true" class="parent-control"/>
        </div>
      </div>
      <div class="noo-form-group parallax-child">
        <label for="parallax_no_mobile"><?php _e('Disable Parallax on Mobile', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="parallax_no_mobile" type="checkbox" name="parallax_no_mobile" />
        </div>
      </div>
      <div class="noo-form-group parallax-child">
        <label for="parallax_velocity"><?php _e('Parallax Velocity', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="parallax_velocity" type="text" name="parallax_velocity" value="0.1"/>
          <small class="noo-control-desc"><?php _e('The movement speed, value should be between -1.0 and 1.0', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <div class="noo-control">
          <input id="bg_video" type="checkbox" name="bg_video" class="parent-control"/>
          <label for="bg_video"><?php _e('Enable Video Background', NOO_TEXT_DOMAIN); ?></label>
        </div>
      </div>
      <div class="noo-form-group bg_video-child" style="display: none;">
        <label for="bg_video_url"><?php _e('Video URL', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_video_url" type="text" name="bg_video_url" checked="true"/>
        </div>
      </div>
      <div class="noo-form-group bg_video-child" style="display: none;">
        <label for="bg_video_poster"><?php _e('Video Poster Image', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="bg_video_poster" type="text" name="bg_video_poster" class="noo-wpmedia" value=""/>
          <a id="bg_video_poster-clear" style="text-decoration: none;" role="button" href="#" onclick="jQuery('#bg_video_poster').val('');">
            <i class="dashicons dashicons-no"></i><?php _e('Remove Poster', NOO_TEXT_DOMAIN); ?>
          </a>
        </div>
        <script type="text/javascript">
          jQuery(document).ready(function($) {   
            $('#bg_video_poster-clear').click(function() {
              jQuery('#bg_video_poster').val('').change();
            });
          });
        </script>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="inner_container"><?php _e('Enable Inner Container', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="inner_container" type="checkbox" name="inner_container" />
          <small class="noo-control-desc"><?php _e('If enable, element inside this row will be wrapped in a container.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="border"><?php _e('Border', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="border" id="border">
            <option value=""><?php _e('None', NOO_TEXT_DOMAIN); ?></option>
            <option value="top"><?php _e('Top', NOO_TEXT_DOMAIN); ?></option>
            <option value="right"><?php _e('Right', NOO_TEXT_DOMAIN); ?></option>
            <option value="left"><?php _e('Left', NOO_TEXT_DOMAIN); ?></option>
            <option value="bottom"><?php _e('Bottom', NOO_TEXT_DOMAIN); ?></option>
            <option value="vertical"><?php _e('Vertical', NOO_TEXT_DOMAIN); ?></option>
            <option value="horizontal"><?php _e('Horizontal', NOO_TEXT_DOMAIN); ?></option>
            <option value="all"><?php _e('All', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="padding_top"><?php _e('Padding Top (px)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="padding_top" name="padding_top" class="noo-slider" value="20" data-min="0" data-max="100"/>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="padding_bottom"><?php _e('Padding Bottom (px)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="padding_bottom" name="padding_bottom" class="noo-slider" value="20" data-min="0" data-max="100"/>
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
      <div class="noo-form-group">
        <label for="id"><?php _e('Row ID', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="id" id="id" />
          <small class="noo-control-desc"><?php _e('(Optional) Enter an unique ID. You will need this ID when creating One Page layout.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
    </div>
    <div class="noo-form-footer">
      <input type="button" name="insert" id="noo-save-shortcodes" class="button button-primary" value="<?php _e('Save', NOO_TEXT_DOMAIN); ?>"/>
      <input type="button" name="cancel" id="noo-cancel-shortcodes" class="button" value="<?php _e('Cancel', NOO_TEXT_DOMAIN); ?>"/>
    </div>
  </form>
</div>