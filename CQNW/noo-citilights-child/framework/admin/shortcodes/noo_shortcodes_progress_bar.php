<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery('document').ready(function($) {
    $('#bar_count').change(function() {
      var bar_count = parseInt(jQuery(this).val(), 10);
      $('#bar-item-group').empty();
      for(var i = 1; i <= bar_count; i++) {
        $('#bar-item-group').append(
          '<hr>' +
          '<div class="noo-form-group">' +
          ' <label for="bar_title_' + i + '"><?php _e("Bar Title", NOO_TEXT_DOMAIN); ?></label>' +
          ' <div class="noo-control">' +
          '   <input type="text" name="bar_title_' + i + '" id="bar_title_' + i + '" />' +
          ' </div>' +
          '</div>' +
          '<div class="noo-form-group">' +
          ' <label for="bar_progress_' + i + '"><?php _e("Progress", NOO_TEXT_DOMAIN); ?></label>' +
          ' <div class="noo-control">' +
          '   <input type="text" id="bar_progress_' + i + '" name="bar_progress_' + i + '" class="noo-slider" value="50" data-min="1" data-max="100"/>' +
          ' </div>' +
          '</div>' +
          '<div class="noo-form-group">' +
          ' <label for="bar_color_' + i + '"><?php _e("Color", NOO_TEXT_DOMAIN); ?></label>' +
          ' <div class="noo-control">' +
          '   <select type="text" id="bar_color_' + i + '" name="bar_color_' + i + '">' +
          '     <option value="primary" selected="true"><?php _e("Primary", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="success"><?php _e("Success", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="info"><?php _e("Info", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="warning"><?php _e("Warning", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="danger"><?php _e("Danger", NOO_TEXT_DOMAIN); ?></option>' +
          '    </select>' +
          ' </div>' +
          '</div>' +
          '<div class="noo-form-group">' +
          '  <label for="color_effect_' + i + '"><?php _e("Color Effect", NOO_TEXT_DOMAIN); ?></label>' +
          '  <div class="noo-control">' +
          '    <select name="color_effect_' + i + '" id="color_effect_' + i + '">' +
          '      <option value="" selected="true"><?php _e("None", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="striped"><?php _e("Striped", NOO_TEXT_DOMAIN); ?></option>' +
          '      <option value="striped_animation"><?php _e("Striped with Animation", NOO_TEXT_DOMAIN); ?></option>' +
          '    </select>' +
          '  </div>' +
          '</div>'
        );
      }

      $('#bar-item-group').find('.noo-slider').each(function() {
        var $this = jQuery(this);

        var $slider = jQuery('<div>', {id: $this.attr("id") + "-slider"}).insertAfter($this);
        $slider.slider(
          {
            range: "min",
            value: $this.val() || $this.data('min') || 0,
            min: $this.data('min') || 0,
            max: $this.data('max') || 100,
            step: $this.data('step') || 1,
            slide: function(event, ui) {
              $this.val(ui.value).attr('value', ui.value);
            }
          }
        );

        $this.change(function() {
          $slider.slider( "option", "value", $this.val() );
        });
      })
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="title"><?php _e('Title (optional)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="title" id="title" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="style"><?php _e('Bar Style', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="style" id="style">
            <option value="lean" selected="true"><?php _e('Lean', NOO_TEXT_DOMAIN); ?></option>
            <option value="thick"><?php _e('Thick', NOO_TEXT_DOMAIN); ?></option>
          </select>
          <label for="rounded">
            <input type="checkbox" name="rounded" id="rounded" checked="true" />
            <?php _e('Rounded Bar', NOO_TEXT_DOMAIN); ?>
          </label>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="bar_count"><?php _e('Number of Bar', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="bar_count" name="bar_count" value="3"/>
        </div>
      </div>
      <div class="noo-form-group bar-item-group" id="bar-item-group">
        <?php for( $i = 1; $i <= 3; $i++) : ?>
          <hr>
          <div class="noo-form-group">
            <label for="bar_title_<?php echo $i; ?>"><?php _e("Bar Title", NOO_TEXT_DOMAIN); ?></label>
            <div class="noo-control">
              <input type="text" name="bar_title_<?php echo $i; ?>" id="bar_title_<?php echo $i; ?>" />
            </div>
          </div>
          <div class="noo-form-group">
            <label for="bar_progress_<?php echo $i; ?>"><?php _e("Progress", NOO_TEXT_DOMAIN); ?></label>
            <div class="noo-control">
              <input type="text" id="bar_progress_<?php echo $i; ?>" name="bar_progress_<?php echo $i; ?>" class="noo-slider" value="50" data-min="1" data-max="100"/>
            </div>
          </div>
          <div class="noo-form-group">
            <label for="bar_color_<?php echo $i; ?>"><?php _e('Color', NOO_TEXT_DOMAIN); ?></label>
            <div class="noo-control">
              <select name="bar_color_<?php echo $i; ?>" id="bar_color_<?php echo $i; ?>">
                <option value="primary" selected="true"><?php _e('Primary', NOO_TEXT_DOMAIN); ?></option>
                <option value="success"><?php _e('Success', NOO_TEXT_DOMAIN); ?></option>
                <option value="info"><?php _e('Info', NOO_TEXT_DOMAIN); ?></option>
                <option value="warning"><?php _e('Warning', NOO_TEXT_DOMAIN); ?></option>
                <option value="danger"><?php _e('Danger', NOO_TEXT_DOMAIN); ?></option>
              </select>
            </div>
          </div>
          <div class="noo-form-group">
            <label for="color_effect_<?php echo $i; ?>"><?php _e('Color Effect', NOO_TEXT_DOMAIN); ?></label>
            <div class="noo-control">
              <select name="color_effect_<?php echo $i; ?>" id="color_effect_<?php echo $i; ?>">
                <option value="" selected="true"><?php _e('None', NOO_TEXT_DOMAIN); ?></option>
                <option value="striped"><?php _e('Striped', NOO_TEXT_DOMAIN); ?></option>
                <option value="striped_animation"><?php _e('Striped with Animation', NOO_TEXT_DOMAIN); ?></option>
              </select>
            </div>
          </div>
        <?php endfor; ?>
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
