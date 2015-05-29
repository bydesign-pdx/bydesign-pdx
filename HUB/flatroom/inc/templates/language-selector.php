<?php
  global $sitepress;

  if(function_exists('wpml_home_url_ls_hide_check') && wpml_home_url_ls_hide_check()){
    return;
  }
?>

<?php if (!empty($active_languages)): ?>
  <div id="lang_sel_list"<?php if(empty($settings['icl_lang_sel_type']) || $settings['icl_lang_sel_type'] == 'dropdown') echo ' style="display:none;"';?> class="lang_sel_list_<?php echo $settings['icl_lang_sel_orientation'] ?>">
    <ul>
      <?php foreach($active_languages as $lang): ?>
        <li class="icl-<?php echo $lang['language_code'] ?>">
          <a href="<?php echo apply_filters('WPML_filter_link', $lang['url'], $lang)?>"<?php if ($lang['language_code'] == $sitepress->get_current_language()) echo ' class="lang_sel_sel"'; else echo ' class="lang_sel_other"'; ?>>
            <?php echo @icl_disp_language(ucfirst($lang['language_code']), false); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
