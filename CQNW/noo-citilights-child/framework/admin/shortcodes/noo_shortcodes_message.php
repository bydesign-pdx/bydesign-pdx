<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
require_once( 'class_editor_helper.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group #style').change(function() {
      var $this = $(this);
      if($this.find(':selected').val() == "custom") {
        $('.style-custom-child').show();
      } else {
        $('.style-custom-child').hide();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="title"><?php _e('Title (Heading)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="title" id="title" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="message"><?php _e('Message', NOO_TEXT_DOMAIN); ?></label>
        <?php
        $editor_id = 'message' . uniqid();
        add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
        wp_editor( '', $editor_id, array(
                    'media_buttons' => false,
                    'tinymce' => true,
                    'quicktags' => true,
                    'textarea_rows' => 5,
                    'textarea_cols' => 80,
                    'wpautop' => false));
        $mce_init = noo_editor_helper::get_mce_init($editor_id);
        $qt_init = noo_editor_helper::get_qt_init($editor_id);
        ?>
        <input type="hidden" id="message_editor_id" name="message_editor_id" value="<?php echo $editor_id; ?>">
        <script type="text/javascript">
          tinyMCEPreInit.mceInit = jQuery.extend( tinyMCEPreInit.mceInit, <?php echo $mce_init; ?>);
          tinyMCEPreInit.qtInit = jQuery.extend( tinyMCEPreInit.qtInit, <?php echo $qt_init; ?>);
        </script>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="type"><?php _e('Message Type', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="type" id="type">
            <option value="success"><?php _e('Success', NOO_TEXT_DOMAIN); ?></option>
            <option value="info" selected="true"><?php _e('Info', NOO_TEXT_DOMAIN); ?></option>
            <option value="warning"><?php _e('Warning', NOO_TEXT_DOMAIN); ?></option>
            <option value="danger"><?php _e('Danger', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="dismissible"><?php _e('Dismissible', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input id="dismissible" type="checkbox" name="dismissible" checked="true"/>
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