<?php global $data;

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	_e('This post is password protected. Enter the password to view comments.', 'moutheme');
	return;
}

if ( have_comments() ) : ?>
		
	<div class="comments-header"><?php
		if($data['check_sharebox'] == true) {
			get_template_part( 'framework/inc/sharebox' );
		} ?>
		<h5 class="comments-title">
			<span></span><?php
			comments_number(__('comments', 'moutheme'), __('1 comment', 'moutheme'), __('% comments', 'moutheme') ); ?>
		</h5>
	</div>

	<ol class="commentlist"><?php
		wp_list_comments(array( 'callback' => 'moutheme_comment' )); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div><?php

else : // this is displayed if there are no comments so far

 	if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

		<div class="comments-header"><?php
			if($data['check_sharebox'] == true) {
				get_template_part( 'framework/inc/sharebox' );
			} ?>
			<h5 class="comments-title">					
				<span></span><?php
				_e('no comments', 'moutheme'); ?>
			</h5>
		</div><?php

	else : /* ?>

	 	<div class="comments-header"><?php
	 		if($data['check_sharebox'] == true) {
				get_template_part( 'framework/inc/sharebox' );
			} ?>
		 	<h5 class="comments-title">
				<span></span>
				<?php _e('Comments are closed', 'moutheme'); ?>
			</h5>
		</div><?php */

	endif;
	
endif;
		
if ( comments_open() ) :
	
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	//Custom Fields
	$fields =  array(
		'author' => '<div class="input-wrap"><label>' . __('Your Name *', 'moutheme') . '</label><input name="author" type="text" size="30"' . $aria_req . '></div>',
		
		'email'  => '<div class="input-wrap"><label>' . __('E-Mail Address *', 'moutheme') . '</label><input name="email" type="text" size="30"' . $aria_req . '></div>',
		
		'url' 	 => '<div class="input-wrap"><label>' . __('Website', 'moutheme') . '</label><input name="url" type="text" size="30"></div>',
	);

	//Comment Form Args
    $comments_args = array(
		'fields' => $fields,
		'title_reply'=> __('Leave a reply', 'moutheme'),
		'comment_field' => '<div class="input-wrap"><label>' . __('Comment *', 'moutheme') . '</label><textarea id="comment" name="comment" aria-required="true" cols="58" rows="10" tabindex="4"></textarea></div>',
		'label_submit' => __('Post Comment','moutheme')
	);
	
	// Show Comment Form
	comment_form($comments_args);

endif; ?>