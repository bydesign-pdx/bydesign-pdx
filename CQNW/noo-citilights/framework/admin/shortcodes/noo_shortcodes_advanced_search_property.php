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
        <label for="title"><?php _e('Title (optional)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" name="title" id="title" />
          <small class="noo-control-desc"><?php _e( 'Enter text which will be used as widget title. Leave blank if no title is needed.', NOO_TEXT_DOMAIN ); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="style"><?php _e('Search Layout', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="style" id="style">
            <option value="horizontal" selected="true"><?php _e('Search Horizontal', NOO_TEXT_DOMAIN); ?></option>
            <option value="vertical"><?php _e('Search Vertical', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="disable_map"><?php _e('Diable Map', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" id="disable_map" name="disable_map" class="parent-control"/>
          <small class="noo-control-desc"><?php _e('Disable map to show only Property Search form.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="disable_search_form"><?php _e('Diable Search', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" id="disable_search_form" name="disable_search_form" class="parent-control"/>
          <small class="noo-control-desc"><?php _e('Diable search form to show only map.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="advanced_search"><?php _e('Show Advanced Search', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" id="advanced_search" name="advanced_search" class="parent-control"/>
          <small class="noo-control-desc"><?php _e('Enable Advanced search to search with Amenities (Only work with Horizontal Search).', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div>
      <!-- <div class="noo-form-group disable_map-child" style="display:none;">
        <label for="no_search_container"><?php //_e('Disable Search Container', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" id="no_search_container" name="no_search_container"/> 
          <small class="noo-control-desc"><?php// _e('Disable search container will remove the container and background around Search form, it will help if you want to display search form inside other element.', NOO_TEXT_DOMAIN); ?></small>
        </div>
      </div> -->
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
