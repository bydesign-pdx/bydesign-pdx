<?php
function register_flatroom_custom_menu_page(){
    add_theme_page( 'Flatroom Options', 'Flat Room', 'administrator', 'flatroom_options', 'create_flatroom_panel');
}
add_action( 'admin_menu', 'register_flatroom_custom_menu_page' );

function create_flatroom_panel(){
    ?>
    <div class="wrap">
        <?php screen_icon('themes'); ?>
        <h2>Theme Options</h2>

        <div class="flatroom">
            <?php settings_errors( 'flatroom-settings-errors' ); ?>            
            <form id="form-flatroom-options" action="options.php" method="post" enctype="multipart/form-data">
                <?php
                    settings_fields('theme_flatroom_options');
                    do_settings_sections('flatroom');
                ?>
                <p class="submit">
                    <input name="theme_flatroom_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'flatroom'); ?>" />
                    <input name="theme_flatroom_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'flatroom'); ?>" />      
                </p>
            </form>
        </div>
    <?php
}

function flatroom_get_default_options() {
    $options = array(
        'social'   => ''
    );
    return $options;
}

function flatroom_options_init() {
     $flatroom_options = get_option( 'theme_flatroom_options' );
     if ( false === $flatroom_options ) {
          // If not, we'll save our default options
          $flatroom_options = flatroom_get_default_options();
          add_option( 'theme_flatroom_options', $flatroom_options );
     }
}
add_action( 'after_setup_theme', 'flatroom_options_init' );

function flatroom_options_setup() {
    global $pagenow;
    if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
        add_filter( 'gettext', 'replace_thickbox_text' , 1, 2 );
    }
}
add_action( 'admin_init', 'flatroom_options_setup' );

function replace_thickbox_text($translated_text, $text ) {  
    if ( 'Insert into Post' == $text ) {
        $referer = strpos( wp_get_referer(), 'flatroom-settings' );
        if ( $referer != '' ) {
            return __('I want this to be my logo!', 'flatroom' );
        }
    }
    return $translated_text;
}

function flatroom_options_validate( $input ) {
    $default_options = flatroom_get_default_options();
    $valid_input = $default_options;
    $flatroom_options = get_option('theme_flatroom_options');
    $submit = ! empty($input['submit']) ? true : false;
    $reset = ! empty($input['reset']) ? true : false;
    $delete_logo = ! empty($input['delete_logo']) ? true : false;
    if ( $submit ) {
        $valid_input['social'] = $input['social'];
    }
    elseif ( $reset ) {
        $valid_input['social'] = $default_options['social'];
    }
    return $valid_input;
}

function flatroom_options_settings_init() {
    register_setting( 'theme_flatroom_options', 'theme_flatroom_options', 'flatroom_options_validate' );
    add_settings_section('flatroom_settings_header', __( 'Social Icons for Footer.', 'flatroom' ), 'flatroom_settings_header_text', 'flatroom');
    add_settings_field('flatroom_setting_social',  __( 'Social Icons', 'flatroom' ), 'flatroom_setting_social', 'flatroom', 'flatroom_settings_header');
}
add_action( 'admin_init', 'flatroom_options_settings_init' );

function flatroom_settings_header_text() {
}

function flatroom_setting_social() {
    $flatroom_options = get_option('theme_flatroom_options');
    ?>
        <input id="social_header_input" type="hidden" name="theme_flatroom_options[social]" value="<?php echo $flatroom_options['social']; ?>" />
        <select class="social">
            <option value="aim">aim</option>
            <option value="android">android</option>
            <option value="calendar">calendar</option>
            <option value="call">call</option>
            <option value="bitcoin">bitcoin</option>
            <option value="delicious">delicious</option>
            <option value="duckduckgo">duckduckgo</option>
            <option value="eventful">eventful</option>
            <option value="facebook">facebook</option>
            <option value="fivehundredpx">fivehundredpx</option>
            <option value="flattr">flattr</option>
            <option value="forrst">forrst</option>
            <option value="foursquare">foursquare</option>
            <option value="gplus">gplus</option>
            <option value="grooveshark">grooveshark</option>
            <option value="html5">html5</option>
            <option value="ie">ie</option>
            <option value="lanyrd">lanyrd</option>
            <option value="ninetyninedesigns">ninetyninedesigns</option>
            <option value="paypal">paypal</option>
            <option value="pinterest">pinterest</option>
            <option value="smashmag">smashmag</option>
            <option value="stumbleupon">stumbleupon</option>
            <option value="wikipedia">wikipedia</option>
            <option value="w3c">w3c</option>
            <option value="digg">digg</option>
            <option value="spotify">spotify</option>
            <option value="reddit">reddit</option>
            <option value="guest">guest</option>
            <option value="gowalla">gowalla</option>
            <option value="appstore">appstore</option>
            <option value="blogger">blogger</option>
            <option value="cc">cc</option>
            <option value="dribbble">dribbble</option>
            <option value="evernote">evernote</option>
            <option value="flickr">flickr</option>
            <option value="google">google</option>
            <option value="viadeo">viadeo</option>
            <option value="instapaper">instapaper</option>
            <option value="weibo">weibo</option>
            <option value="klout">klout</option>
            <option value="linkedin">linkedin</option>
            <option value="meetup">meetup</option>
            <option value="vk">vk</option>
            <option value="plancast">plancast</option>
            <option value="disqus">disqus</option>
            <option value="rss">rss</option>
            <option value="skype">skype</option>
            <option value="twitter">twitter</option>
            <option value="youtube">youtube</option>
            <option value="vimeo">vimeo</option>
            <option value="windows">windows</option>
            <option value="xing">xing</option>
            <option value="yahoo">yahoo</option>
            <option value="chrome">chrome</option>
            <option value="email">email</option>
            <option value="macstore">macstore</option>
            <option value="myspace">myspace</option>
            <option value="podcast">podcast</option>
            <option value="amazon">amazon</option>
            <option value="steam">steam</option>
            <option value="cloudapp">cloudapp</option>
            <option value="dropbox">dropbox</option>
            <option value="ebay">ebay</option>
            <option value="github">github</option>
            <option value="googleplay">googleplay</option>
            <option value="itunes">itunes</option>
            <option value="plurk">plurk</option>
            <option value="songkick">songkick</option>
            <option value="lastfm">lastfm</option>
            <option value="gmail">gmail</option>
            <option value="pinboard">pinboard</option>
            <option value="openid">openid</option>
            <option value="quora">quora</option>
            <option value="soundcloud">soundcloud</option>
            <option value="tumblr">tumblr</option>
            <option value="eventasaurus">eventasaurus</option>
            <option value="wordpress">wordpress</option>
            <option value="yelp">yelp</option>
            <option value="intensedebate">intensedebate</option>
            <option value="eventbrite">eventbrite</option>
            <option value="scribd">scribd</option>
            <option value="posterous">posterous</option>
            <option value="stripe">stripe</option>
            <option value="opentable">opentable</option>
            <option value="cart">cart</option>
            <option value="print">print</option>
            <option value="angellist">angellist</option>
            <option value="instagram">instagram</option>
            <option value="dwolla">dwolla</option>
            <option value="appnet">appnet</option>
            <option value="statusnet">statusnet</option>
            <option value="acrobat">acrobat</option>
            <option value="drupal">drupal</option>
            <option value="buffer">buffer</option>
            <option value="pocket">pocket</option>
            <option value="bitbucket">bitbucket</option>
        </select>
        <input type="text" class="social_link">
        <a href="#" id="social_add" class="button-secondary"><?php _e('Add', 'flatroom' ); ?></a>
        <ul class="social_preview">
            <?php
            if ($flatroom_options['social']) {
                echo do_shortcode($flatroom_options['social']);
            }
            ?>
        </ul>
    <?php
}