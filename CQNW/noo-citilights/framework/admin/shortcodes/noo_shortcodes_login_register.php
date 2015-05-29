<?php
$full_path = __FILE__;
$path = explode('wp-content', $full_path);
require_once( $path[0] . '/wp-load.php' );
?>
<script>
  jQuery(document).ready(function($) {
    $('.noo-form-group #mode').change(function() {
      var value = $(this).find(':selected').val();
      
      $('.mode-child').hide();
      if( value == "login") {
        $('.mode-login-child').show();
      } else if( value == "register" ) {
        $('.mode-register-child').show();
      } else if( value == "both" ) {
        $('.mode-both-child').show();
      }
    });
  });
</script>
<div id="noo-shortcodes-form-wrapper">
  <form id="noo-shortcodes-form" name="noo-shortcodes-form" method="post" action="">
    <div class="noo-form-body">
      <div class="noo-form-group">
        <label for="mode"><?php _e('Mode', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <select name="mode" id="mode">
            <option value="login" selected="true"><?php _e('Only Login form', NOO_TEXT_DOMAIN); ?></option>
            <option value="register"><?php _e('Only Register form', NOO_TEXT_DOMAIN); ?></option>
            <option value="both"><?php _e('Login and Register', NOO_TEXT_DOMAIN); ?></option>
          </select>
        </div>
      </div>
      <div class="noo-form-group mode-child mode-login-child mode-both-child">
        <label for="login_text"><?php _e('Login Text', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea id="login_text" name="login_text" ><?php _e( 'Already a member of CitiLights. Please use the form below to log in site.', NOO_TEXT_DOMAIN ); ?></textarea>
        </div>
      </div>
      <div class="noo-form-group mode-child mode-login-child mode-both-child">
        <label for="show_register_link"><?php _e('Show Register Link', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <input type="checkbox" id="show_register_link" name="show_register_link" />
        </div>
      </div>
      <div class="noo-form-group mode-child mode-register-child mode-both-child" style="display: none;">
        <label for="register_text"><?php _e('Register Text', NOO_TEXT_DOMAIN); ?></label>
        <div class="noo-control">
          <textarea id="register_text" name="register_text" ><?php _e( 'Don\'t have an account? Please fill in the form below to create one.', NOO_TEXT_DOMAIN ); ?></textarea>
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
