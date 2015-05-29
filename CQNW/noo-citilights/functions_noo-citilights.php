<?php


/* =============================================================================
 *
 * Function for specific theme, remember to keep all the functions
 * specified for this theme inside this file.
 *
 * ============================================================================*/

// Define theme specific constant
if (!defined('NOO_THEME_NAME'))
{
  define('NOO_THEME_NAME', 'noo-citilights');
}

if (!defined('NOO_THEME_VERSION'))
{
  define('NOO_THEME_VERSION', '0.0.1');
}

function noo_social_share( $post_id = null ) {
	$post_id = (null === $post_id) ? get_the_id() : $post_id;
	$post_type =  get_post_type($post_id);
	$prefix = 'noo_blog';

	if($post_type == 'portfolio_project' ) {
		$prefix = 'noo_portfolio';
	}

	if(noo_get_option("{$prefix}_social", true ) === false) {
		return '';
	}

	$share_url     = urlencode( get_permalink() );
	$share_title   = urlencode( get_the_title() );
	$share_source  = urlencode( get_bloginfo( 'name' ) );
	$share_content = urlencode( get_the_content() );
	$share_media   = wp_get_attachment_thumb_url( get_post_thumbnail_id() );
	$popup_attr    = 'resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0';

	$facebook     = noo_get_option( "{$prefix}_social_facebook", true );
	$twitter      = noo_get_option( "{$prefix}_social_twitter", true );
	$google		  = noo_get_option( "{$prefix}_social_google", true );
	$pinterest    = noo_get_option( "{$prefix}_social_pinterest", true );
	$linkedin     = noo_get_option( "{$prefix}_social_linkedin", true );
	$html = array();

	if ( $facebook || $twitter || $google || $pinterest || $linkedin ) {
		$html[] = '<div class="content-share">';
		// $html[] = '<p class="share-title">';
		// $html[] = '</p>';
		$html[] = '<div class="noo-social social-share">';

		if($facebook) {
			$html[] = '<a href="#share" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" class="noo-share"'
					. ' title="' . __( 'Share on Facebook', NOO_TEXT_DOMAIN ) . '"'
							. ' onclick="window.open('
									. "'http://www.facebook.com/sharer.php?u={$share_url}&amp;t={$share_title}','popupFacebook','width=650,height=270,{$popup_attr}');"
									. ' return false;">';
			$html[] = '<i class="nooicon-facebook"></i>';
			$html[] = '</a>';
		}

		if($twitter) {
			$html[] = '<a href="#share" class="noo-share"'
					. ' title="' . __( 'Share on Twitter', NOO_TEXT_DOMAIN ) . '"'
							. ' onclick="window.open('
									. "https://twitter.com/intent/tweet?text={$share_title}&amp;url={$share_url}','popupTwitter','width=500,height=370,{$popup_attr}');"
									. ' return false;">';
			$html[] = '<i class="nooicon-twitter"></i></a>';
		}

		if($google) {
			$html[] = '<a href="#share" class="noo-share"'
					. ' title="' . __( 'Share on Google+', NOO_TEXT_DOMAIN ) . '"'
							. ' onclick="window.open('
							. "'https://plus.google.com/share?url={$share_url}','popupGooglePlus','width=650,height=226,{$popup_attr}');"
							. ' return false;">';
							$html[] = '<i class="nooicon-google-plus"></i></a>';
		}

		if($pinterest) {
			$html[] = '<a href="#share" class="noo-share"'
					. ' title="' . __( 'Share on Pinterest', NOO_TEXT_DOMAIN ) . '"'
							. ' onclick="window.open('
									. "'http://pinterest.com/pin/create/button/?url={$share_url}&amp;media={$share_media}&amp;description={$share_title}','popupPinterest','width=750,height=265,{$popup_attr}');"
									. ' return false;">';
			$html[] = '<i class="nooicon-pinterest"></i></a>';
		}

		if($linkedin) {
			$html[] = '<a href="#share" class="noo-share"'
					. ' title="' . __( 'Share on LinkedIn', NOO_TEXT_DOMAIN ) . '"'
							. ' onclick="window.open('
									. "'http://www.linkedin.com/shareArticle?mini=true&amp;url={$share_url}&amp;title={$share_title}&amp;summary={$share_content}&amp;source={$share_source}','popupLinkedIn','width=610,height=480,{$popup_attr}');"
									. ' return false;">';
			$html[] = '<i class="nooicon-linkedin"></i></a>';
		}

		$html[] = '</div>'; // .noo-social.social-share
		$html[] = '</div>'; // .share-wrap
	}

	echo implode("\n", $html);
}

function noo_list_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	GLOBAL $post;
	$avatar_size = isset($args['avatar_size']) ? $args['avatar_size'] : 60;
	?>
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<div class="comment-wrap">
				<div class="comment-img">
					<?php echo get_avatar($comment, $avatar_size); ?>
				</div>
				<article id="comment-<?php comment_ID(); ?>" class="comment-block">
					<header class="comment-header">
						<cite class="comment-author"><?php echo get_comment_author_link(); ?> 
							<?php if ($comment->user_id === $post->post_author): ?>
							<span class="ispostauthor">
								<?php _e('Author', NOO_TEXT_DOMAIN); ?>
							</span>
							<?php endif; ?>
						</cite>
						
						<div class="comment-meta">
							<time datetime="<?php echo get_comment_time('c'); ?>">
								<?php echo sprintf(__('%1$s at %2$s', NOO_TEXT_DOMAIN) , get_comment_date() , get_comment_time()); ?>
							</time>
							<span class="comment-edit">
								<?php edit_comment_link('' . __('Edit', NOO_TEXT_DOMAIN)); ?>
							</span>
						</div>
						<?php if ('0' == $comment->comment_approved): ?>
							<p class="comment-pending"><?php _e('Your comment is awaiting moderation.', NOO_TEXT_DOMAIN); ?></p>
						<?php endif; ?>
					</header>
					<section class="comment-content">
						<?php comment_text(); ?>
						<span class="comment-reply">
							<?php comment_reply_link(array_merge($args, array(
								'reply_text' => (__('Reply', NOO_TEXT_DOMAIN) . '') ,
								'depth' => $depth,
								'max_depth' => $args['max_depth']
							))); ?>
						</span>
					</section>

				</article>
			</div>
		<?php
}

function noo_content_meta($is_shortcode=false) {
	$post_type = get_post_type();

	if ( $post_type == 'post' ) {
		if ((!is_single() && noo_get_option( 'noo_blog_show_post_meta' ) === false)
				|| (is_single() && noo_get_option( 'noo_blog_post_show_post_meta' ) === false)) {
					return;
				}
	} elseif ($post_type == 'portfolio_project') {
		if (noo_get_option( 'noo_portfolio_show_post_meta' ) === false) {
			return;
		}
	} else {
		return;
	}

	$html = array();
	$html[] = '<p class="content-meta">';
	if(get_post_format() =='video')
		$html[] = '<i class="nooicon-file-video-o"></i>';
	elseif (get_post_format() == 'audio')
		$html[] = '<i class="nooicon-file-audio-o"></i>';
	elseif (get_post_format() == 'gallery')
		$html[] = '<i class="nooicon-file-image-o"></i>';
	elseif (get_post_format() == 'quote')
		$html[] = '<i class="nooicon-file-quote-left"></i>';
	elseif (get_post_format() == 'link')
		$html[] = '<i class="nooicon-file-link-o"></i>';
	elseif (get_post_format() == 'image')
		$html[] = '<i class="nooicon-file-image-o"></i>';
	else
	$html[] = '<i class="nooicon-file-image-o"></i>';
	// Categories
	$categories_html = '';
	$separator = ', ';

	// if (get_post_type() == 'portfolio_project') {
	// 	if (has_term('', 'portfolio_category', NULL)) {
	// 		$categories = get_the_terms(get_the_id() , 'portfolio_category');
	// 		foreach ($categories as $category) {
	// 			$categories_html .= '<a' . ' href="' . get_term_link($category->slug, 'portfolio_category') . '"' . ' title="' . esc_attr(sprintf(__("View all Portfolio Items in: &ldquo;%s&rdquo;", NOO_TEXT_DOMAIN) , $category->name)) . '">' . ' ' . $category->name . '</a>' . $separator;
	// 		}
	// 	}
	// } else {
		$categories = get_the_category();
		foreach ($categories as $category) {
			$categories_html.= '<a' . ' href="' . get_category_link($category->term_id) . '"' . ' title="' . esc_attr(sprintf(__("View all posts in: &ldquo;%s&rdquo;", NOO_TEXT_DOMAIN) , $category->name)) . '">' . ' ' . $category->name . '</a>' . $separator;
		}
	// }

	$html[] = '<span>';
	$html[] = __('Posted in', NOO_TEXT_DOMAIN);
	$html[] = trim($categories_html, $separator) . '</span>';

	// Date
	$html[] = '<span>';
	$html[] = __('on', NOO_TEXT_DOMAIN);
	$html[] = '<time class="entry-date" datetime="' . esc_attr(get_the_date('c')) . '">';	
	$html[] = esc_html(get_the_date());
	$html[] = '</time>';
	$html[] = '</span>';

	// Author
	$html[] = '<span>';
	$html[] = __('by', NOO_TEXT_DOMAIN);
	ob_start();
	the_author_posts_link();
	$html[] = ob_get_clean();
	$html[] = '</span>';
	
	
	// Comments
	$comments_html = '';

	if (comments_open()) {
		$comment_title = '';
		$comment_number = '';
		if (get_comments_number() == 0) {
			$comment_title = sprintf(__('Leave a comment on: &ldquo;%s&rdquo;', NOO_TEXT_DOMAIN) , get_the_title());
			$comment_number = __(' Leave a Comment', NOO_TEXT_DOMAIN);
		} else if (get_comments_number() == 1) {
			$comment_title = sprintf(__('View a comment on: &ldquo;%s&rdquo;', NOO_TEXT_DOMAIN) , get_the_title());
			$comment_number = ' 1 ' . __('Comment', NOO_TEXT_DOMAIN);
		} else {
			$comment_title = sprintf(__('View all comments on: &ldquo;%s&rdquo;', NOO_TEXT_DOMAIN) , get_the_title());
			$comment_number =  ' ' . get_comments_number() . ' ' . __('Comments', NOO_TEXT_DOMAIN);
		}
			
		$comments_html.= '<span><a' . ' href="' . esc_url(get_comments_link()) . '"' . ' title="' . esc_attr($comment_title) . '"' . ' class="meta-comments">';
		if(!is_singular() || $is_shortcode)
			$comments_html.= '<i class="nooicon-comments"></i> ';
		$comments_html.=  $comment_number . '</a></span>';
	}

	$html[] = $comments_html;

	echo implode($html, "\n");
}

function noo_comment_form( $args = array(), $post_id = null ) {
	if ( null === $post_id )
		$post_id = get_the_ID();
	else
		$id = $post_id;

	$commenter = wp_get_current_commenter();
	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$args = wp_parse_args( $args );
	if ( ! isset( $args['format'] ) )
		$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = 'html5' === $args['format'];
	$fields   =  array(
			'author' => '<p class="comment-form-author col-xs-6">'.
			'<input id="author" name="author" type="text" placeholder="' . __( 'Name*', NOO_TEXT_DOMAIN ) . '" size="30"' . $aria_req . ' /></p>',
			'email'  => '<p class="comment-form-email col-xs-6">' .
			'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . __( 'Email*', NOO_TEXT_DOMAIN ) . '" size="30"' . $aria_req . ' /></p>',
			'url'    => '<p class="comment-form-url col-xs-12">' . 
			'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . __( 'Website', NOO_TEXT_DOMAIN ) . '" value="" size="30" /></p>',
	);

	$required_text = sprintf( ' ' . __('Required fields are marked %s', NOO_TEXT_DOMAIN), '<span class="required">*</span>' );

	/**
	 * Filter the default comment form fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $fields The default comment fields.
	*/
	$fields = apply_filters( 'comment_form_default_fields', $fields );
	$defaults = array(
			'fields'               => $fields,
			'comment_field'        => '<p class="comment-form-comment col-xs-12"> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', NOO_TEXT_DOMAIN ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', NOO_TEXT_DOMAIN ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', NOO_TEXT_DOMAIN ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', NOO_TEXT_DOMAIN ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave <span>Your thought</span> on this post', NOO_TEXT_DOMAIN ),
			'title_reply_to'       => __( 'Leave a Reply to %s', NOO_TEXT_DOMAIN ),
			'cancel_reply_link'    => __( 'Cancel reply', NOO_TEXT_DOMAIN ),
			'label_submit'         => __( 'Post Comment', NOO_TEXT_DOMAIN ),
			'format'               => 'xhtml',
	);

	/**
	 * Filter the comment form default arguments.
	 *
	 * Use 'comment_form_default_fields' to filter the comment fields.
	 *
	 * @since 3.0.0
	 *
	 * @param array $defaults The default comment form arguments.
	*/
	$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

	?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php
			/**
			 * Fires before the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_before' );
			?>
			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php
					/**
					 * Fires after the HTML-formatted 'must log in after' message in the comment form.
					 *
					 * @since 3.0.0
					 */
					do_action( 'comment_form_must_log_in_after' );
					?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php
						/**
						 * Fires at the top of the comment form, inside the <form> tag.
						 *
						 * @since 3.0.0
						 */
						do_action( 'comment_form_top' );
						?>
						<div class="comment-form-fields <?php if (is_user_logged_in()) echo "comment-form-in-as"?>">
						<?php if ( is_user_logged_in() ) : ?>
							<?php
							/**
							 * Filter the 'logged in' message for the comment form for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_logged_in The logged-in-as HTML-formatted message.
							 * @param array  $commenter      An array containing the comment author's
							 *                               username, email, and URL.
							 * @param string $user_identity  If the commenter is a registered user,
							 *                               the display name, blank otherwise.
							 */
							echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity );
							?>
							<?php
							/**
							 * Fires after the is_user_logged_in() check in the comment form.
							 *
							 * @since 3.0.0
							 *
							 * @param array  $commenter     An array containing the comment author's
							 *                              username, email, and URL.
							 * @param string $user_identity If the commenter is a registered user,
							 *                              the display name, blank otherwise.
							 */
							do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
							?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
								<div class="comment-form-input row">
							<?php
							/**
							 * Fires before the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								/**
								 * Filter a comment form field for display.
								 *
								 * The dynamic portion of the filter hook, $name, refers to the name
								 * of the comment form field. Such as 'author', 'email', or 'url'.
								 *
								 * @since 3.0.0
								 *
								 * @param string $field The HTML-formatted output of the comment form field.
								 */
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							/**
							 * Fires after the comment fields in the comment form.
							 *
							 * @since 3.0.0
							 */
							do_action( 'comment_form_after_fields' );
							?>
							</div>
						<?php endif; ?>
							<div class="comment-form-textarea row">
							<?php
							/**
							 * Filter the content of the comment textarea field for display.
							 *
							 * @since 3.0.0
							 *
							 * @param string $args_comment_field The content of the comment textarea field.
							 */
							echo apply_filters( 'comment_form_field_comment', $args['comment_field'] );
							?>
							</div>
						</div>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<input name="submit" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php
						/**
						 * Fires at the bottom of the comment form, inside the closing </form> tag.
						 *
						 * @since 1.5.0
						 *
						 * @param int $post_id The post ID.
						 */
						do_action( 'comment_form', $post_id );
						?>
					</form>
				<?php endif; ?>
			</div><!-- #respond -->
			<?php
			/**
			 * Fires after the comment form.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_after' );
		else :
			/**
			 * Fires after the comment form if comments are closed.
			 *
			 * @since 3.0.0
			 */
			do_action( 'comment_form_comments_closed' );
		endif;
}

// function noo_excerpt_read_more( $more ) {
// 	return '';
// }
// add_filter( 'excerpt_more', 'noo_excerpt_read_more' );

function noo_content_read_more( $more ) {
	return '';
}

add_filter( 'the_content_more_link', 'noo_content_read_more' );


//// Include specific widgets
// require_once( $widget_path . '/<widgets_name>.php');