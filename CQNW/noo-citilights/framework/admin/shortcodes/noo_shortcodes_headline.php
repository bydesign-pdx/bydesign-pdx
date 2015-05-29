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
        <label for="headline"><?php _e('Headline', NOO_TEXT_DOMAIN); ?></label>
        <?php
        $editor_id = 'headline' . uniqid();
        add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
        wp_editor( '', $editor_id, array(
                    'media_buttons' => false,
                    'tinymce' => true,
                    'quicktags' => true,
                    'textarea_rows' => 6,
                    'textarea_cols' => 80,
                    'wpautop' => false));
        $mce_init = noo_editor_helper::get_mce_init($editor_id);
        $qt_init = noo_editor_helper::get_qt_init($editor_id);
        ?>
        <input type="hidden" id="headline_editor_id" name="headline_editor_id" value="<?php echo $editor_id; ?>">
        <script type="text/javascript">
          tinyMCEPreInit.mceInit = jQuery.extend( tinyMCEPreInit.mceInit, <?php echo $mce_init; ?>);
          tinyMCEPreInit.qtInit = jQuery.extend( tinyMCEPreInit.qtInit, <?php echo $qt_init; ?>);
        </script>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="level"><?php _e('Heading Level', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="level" id="level">
            <option value="h1" selected="true"><?php _e('H1', NOO_TEXT_DOMAIN); ?></option>
            <option value="h2"><?php _e('H2', NOO_TEXT_DOMAIN); ?></option>
            <option value="h3"><?php _e('H3', NOO_TEXT_DOMAIN); ?></option>
            <option value="h4"><?php _e('H4', NOO_TEXT_DOMAIN); ?></option>
            <option value="h5"><?php _e('H5', NOO_TEXT_DOMAIN); ?></option>
            <option value="h6"><?php _e('H6', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="alignment"><?php _e('Alignment', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="alignment" id="alignment">
            <option value="center"><?php _e('Center', NOO_TEXT_DOMAIN); ?></option>
            <option value="left"><?php _e('Left', NOO_TEXT_DOMAIN); ?></option>
            <option value="right"><?php _e('Right', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="icon"><?php _e('Icon', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <div class="icon-selector">
            <input type="text" name="icon" id="icon" />
            <a class="noo-fontawesome-dialog" id="nooFontAwesomeDialog" href="#" target="_blank"><i class="dashicons dashicons-search"></i><?php _e('Font Awesome', NOO_TEXT_DOMAIN); ?></a>
          </div>
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
  <div id="idIconsDialog" class="modal hide" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
    <div class="modal-body">
      <div class="divDialogElements">
        <div class="tabbable">
          <ul id="idTabTitles" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#one" data-toggle="tab">A</a></li>
            <li><a href="#two" data-toggle="tab">B</a></li>
            <li><a href="#three" data-toggle="tab">C</a></li>
            <li><a href="#four" data-toggle="tab">D</a></li>
            <li><a href="#five" data-toggle="tab">E</a></li>
            <li><a href="#six" data-toggle="tab">F</a></li>
            <li><a href="#seven" data-toggle="tab">G</a></li>
            <li><a href="#eight" data-toggle="tab">H</a></li>
            <li><a href="#nine" data-toggle="tab">I</a></li>
          </ul>
          <div id="idTabsContent" class="tab-content" style="margin-top: 15px;">
            <div class="active tab-pane" id="one"></div>
            <div class="tab-pane" id="two"></div>
            <div class="tab-pane" id="three"></div>
            <div class="tab-pane" id="four"></div>
            <div class="tab-pane" id="five"></div>
            <div class="tab-pane" id="six"></div>
            <div class="tab-pane" id="seven"></div>
            <div class="tab-pane" id="eight"></div>
            <div class="tab-pane" id="nine"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>