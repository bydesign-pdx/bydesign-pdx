<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group #layout').change(function() {
      var value = $(this).find(':selected').val();
      if( value == "masonry") {
        $('.layout-masonry-child').show();
      } else {
        $('.layout-masonry-child').hide();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="layout"><?php _e('Layout', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name='layout' id='layout'>
            <option value="list" selected="true"><?php _e('Default List', NOO_TEXT_DOMAIN); ?></option>
            <option value="masonry"><?php _e('Masonry', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group layout-masonry-child">
        <label for="columns"><?php _e('Columns', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="columns" name="columns" class="noo-slider" value="3" data-min="1" data-max="6"/>
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="categories"><?php _e('Blog Categories', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="categories" id="categories" multiple="true">
            <option value="all" selected="true"><?php _e('All', NOO_TEXT_DOMAIN); ?></option>
            <?php $categories = get_categories( array(
              'orderby' => 'NAME',
              'order' => 'ASC'
            ));
            foreach ($categories as $category) {
              echo '<option value="' . $category->term_id . '">';
              echo $category->name . '</option>';
            }
          ?>
          </select>
          <label for="filter" class="layout-masonry-child">
            <input name="filter" id="filter" type="checkbox" checked="true" /><?php _e('Show Filter', NOO_TEXT_DOMAIN); ?>
          </label>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="orderby"><?php _e('Order By', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="orderby" id="orderby">
            <option value="latest" selected="true"><?php _e('Recent First', NOO_TEXT_DOMAIN); ?></option>
            <option value="oldest"><?php _e('Older First', NOO_TEXT_DOMAIN); ?></option>
            <option value="alphabet"><?php _e('Title Alphabet', NOO_TEXT_DOMAIN); ?></option>
            <option value="ralphabet"><?php _e('Title Reversed Alphabet', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="post_count"><?php _e('Max Number of Posts', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="post_count" name="post_count" class="noo-slider" value="4" data-min="1" data-max="20"/>
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_featured"><?php _e('Hide Featured Image(s)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_featured" id="hide_featured" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_author"><?php _e('Hide Author Meta', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_author" id="hide_author" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_date"><?php _e('Hide Date Meta', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_date" id="hide_date" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_category"><?php _e('Hide Category Meta', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_category" id="hide_category" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_comment"><?php _e('Hide Comment Meta', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_comment" id="hide_comment" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="hide_readmore"><?php _e('Hide Readmore link', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input name="hide_readmore" id="hide_readmore" type="checkbox" checked="true" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="excerpt_length"><?php _e('Excerpt Length', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="excerpt_length" name="excerpt_length" value="55" />
        </div>
      </div>
      <hr>
      <div class="noo-form-group">
        <label for="title"><?php _e('Heading (optional)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="text" id="title" name="title" />
        </div>
      </div>
      <div class="noo-form-group">
        <label for="sub_title"><?php _e('Sub-Heading (optional)', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea id="sub_title" name="sub_title" ></textarea>
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
