<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="title"><?php _e('Title (optional)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="title" id="title" />
          <small class="noo-control-desc"><?php _e( 'Enter text which will be used as element title. Leave blank if no title is needed.', NOO_TEXT_DOMAIN ); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="style"><?php _e('Style', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="style" id="style">
            <option value="grid" selected="true"><?php _e('Grid', NOO_TEXT_DOMAIN); ?></option>
            <option value="list"><?php _e('List', NOO_TEXT_DOMAIN); ?></option>
            <option value="slider"><?php _e('Slider', NOO_TEXT_DOMAIN); ?></option>
            <option value="featured"><?php _e('Featured Style', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="show_control"><?php _e('Show layout control', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="show_control" id="show_control">
            <option value="no" selected="true"><?php _e( 'Hide', NOO_TEXT_DOMAIN ); ?></option>
            <option value="yes"><?php _e('Show', NOO_TEXT_DOMAIN); ?></option>
          </select>
          <small class="noo-control-desc"><?php _e( 'Show/hide grid/list switching button.', NOO_TEXT_DOMAIN ); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="show_pagination"><?php _e('Show Pagination', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="show_pagination" id="show_pagination">
            <option value="no" selected="true"><?php _e( 'Hide', NOO_TEXT_DOMAIN ); ?></option>
            <option value="yes"><?php _e('Show', NOO_TEXT_DOMAIN); ?></option>
          </select>
          <small class="noo-control-desc"><?php _e( 'Show/hide Pagination.', NOO_TEXT_DOMAIN ); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="show"><?php _e('Show', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="show" id="show">
            <option value="" selected="true"><?php _e('All Property',NOO_TEXT_DOMAIN); ?></option>
            <option value="featured"><?php _e('Only Featured Property',NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="number"><?php _e('Number of Properties to show', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="number" name="number" class="noo-slider" value="6" data-min="1" data-max="30"/>
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
