<?php

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php _e( 'Comments', 'flatroom' ); ?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'max_depth'   => 3,
					'avatar_size' => 90,
					'callback' => 'flatroom_comment'
				) );
			?>
			<li class="clearfix"></li>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'flatroom' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '← Older Comments', 'flatroom' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments →', 'flatroom' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'flatroom' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>
	<?php
		$fields = array(
			'author' => '<div class="row"><p class="comment-form-author span3"><label for="author">' . __( 'Name', 'flatroom' ) . ($req ? '<span class="required">*</span>' : '') . '</label><input type="text" id="author" name="author" class="author input-block-level" value="' . esc_attr($commenter['comment_author']) . '" pattern="[A-Za-zА-Яа-я]{3,}" maxlength="30" autocomplete="on" tabindex="1" required' . $aria_req . '></p>',
			'email' => '<p class="comment-form-email span3"><label for="email">' . __( 'Email', 'flatroom' ) . ($req ? '<span class="required">*</span>' : '') . '</label><input type="email" id="email" name="email" class="email input-block-level" value="' . esc_attr($commenter['comment_author_email']) . '" maxlength="30" autocomplete="on" tabindex="2" required' . $aria_req . '></p></div>',
			'url' => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'flatroom' ) . '</label><input type="url" id="url" name="url" class="site" value="' . esc_attr($commenter['comment_author_url']) . '" placeholder="www.example.com" maxlength="30" tabindex="3" autocomplete="on"></p>'
		);
		$args = array(
			'comment_notes_after' => '',
			'comment_field' => '<div class="row"><p class="comment-form-comment span6"><label for="comment">' . __( 'Comment', 'flatroom' ) . '</label><textarea id="comment" name="comment" class="comment-form" aria-required="true"></textarea></p></div>',
			'label_submit' => 'Submit',
			'id_submit' => 'submit',
			'fields' => apply_filters('comment_form_default_fields', $fields)
		);
		comment_form($args);	
	?>
</div><!-- #comments -->