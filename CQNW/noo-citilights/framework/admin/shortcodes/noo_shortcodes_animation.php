<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group #animation').change(function() {
      var $this = $(this);
      if($this.find(':selected').val() !== "") {
        $('.animation-child').show();
      } else {
        $('.animation-child').hide();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label  class="noo-label" for="animation"><strong><?php _e('Select Animation', NOO_TEXT_DOMAIN); ?></strong></label>
        <div class="noo-control">
          <select name="animation" id="animation">
            <option value="" selected="true"><?php _e('None', NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceIn"><?php _e("Bounce In", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceInRight"><?php _e("Bounce In Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceInLeft"><?php _e("Bounce In Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceInUp"><?php _e("Bounce In Up", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceInDown"><?php _e("Bounce In Down", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeIn"><?php _e("Fade In", NOO_TEXT_DOMAIN); ?></option>
            <option value="growIn"><?php _e("Grow In", NOO_TEXT_DOMAIN); ?></option>
            <option value="shake"><?php _e("Shake", NOO_TEXT_DOMAIN); ?></option>
            <option value="shakeUp"><?php _e("Shake Up", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeInLeft"><?php _e("Fade In Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeInRight"><?php _e("Fade In Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeInUp"><?php _e("Fade In Up", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeInDown"><?php _e("Fade InDown", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateIn"><?php _e("Rotate In", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateInUpLeft"><?php _e("Rotate In Up Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateInDownLeft"><?php _e("Rotate In Down Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateInUpRight"><?php _e("Rotate In Up Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateInDownRight"><?php _e("Rotate In Down Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="rollIn"><?php _e("Roll In", NOO_TEXT_DOMAIN); ?></option>
            <option value="wiggle"><?php _e("Wiggle", NOO_TEXT_DOMAIN); ?></option>
            <option value="swing"><?php _e("Swing", NOO_TEXT_DOMAIN); ?></option>
            <option value="tada"><?php _e("Tada", NOO_TEXT_DOMAIN); ?></option>
            <option value="wobble"><?php _e("Wobble", NOO_TEXT_DOMAIN); ?></option>
            <option value="pulse"><?php _e("Pulse", NOO_TEXT_DOMAIN); ?></option>
            <option value="lightSpeedInRight"><?php _e("Light Speed In Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="lightSpeedInLeft"><?php _e("Light Speed In Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="flip"><?php _e("Flip", NOO_TEXT_DOMAIN); ?></option>
            <option value="flipInX"><?php _e("Flip In X", NOO_TEXT_DOMAIN); ?></option>
            <option value="flipInY"><?php _e("Flip In Y", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceOut"><?php _e("Bounce Out", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceOutUp"><?php _e("Bounce Out Up", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceOutDown"><?php _e("Bounce Out Down", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceOutLeft"><?php _e("Bounce Out Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="bounceOutRight"><?php _e("Bounce Out Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeOut"><?php _e("Fade Out", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeOutUp"><?php _e("Fade Out Up", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeOutDown"><?php _e("Fade Out Down", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeOutLeft"><?php _e("Fade Out Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="fadeOutRight"><?php _e("Fade Out Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="flipOutX"><?php _e("Flip Out X", NOO_TEXT_DOMAIN); ?></option>
            <option value="flipOutY"><?php _e("Flip Out Y", NOO_TEXT_DOMAIN); ?></option>
            <option value="lightSpeedOutLeft"><?php _e("Light Speed Out Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateOut"><?php _e("Rotate Out", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateOutUpLeft"><?php _e("Rotate Out Up Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateOutDownLeft"><?php _e("Rotate Out Down Left", NOO_TEXT_DOMAIN); ?></option>
            <option value="rotateOutUpRight"><?php _e("Rotate Out Up Right", NOO_TEXT_DOMAIN); ?></option>
            <option value="rollOut"><?php _e("Roll Out", NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group animation-child" style="display:none;">
        <label  class="noo-label" for="animation_offset"><strong><?php _e('Animation Offset (px)', NOO_TEXT_DOMAIN); ?></strong></label>
        <div class="noo-control">
          <input type="text" id="animation_offset" name="animation_offset" class="noo-slider" value="40" data-min="0" data-max="200" data-step="10"/>
        </div>
      </div>
      <div class="noo-form-group animation-child" style="display:none;">
        <label  class="noo-label" for="animation_delay"><strong><?php _e('Animation Delay (ms)', NOO_TEXT_DOMAIN); ?></strong></label>
        <div class="noo-control">
          <input type="text" id="animation_delay" name="animation_delay" class="noo-slider" value="0" data-min="0" data-max="3000" data-step="50"/>
        </div>
      </div>
      <div class="noo-form-group animation-child" style="display:none;">
        <label  class="noo-label" for="animation_duration"><strong><?php _e('Animation Duration (ms)', NOO_TEXT_DOMAIN); ?></strong></label>
        <div class="noo-control">
          <input type="text" id="animation_duration" name="animation_duration" class="noo-slider" value="1000" data-min="0" data-max="3000" data-step="50"/>
        </div>
      </div>
      <hr>
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