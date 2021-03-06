<?php
/**
* Template Name: Page Register
*/

if (is_user_logged_in()) {
    return header('Location: ' . site_url());
} else {
  $redirect_to = ( !empty( $_REQUEST['redirect_to'] ) ) ? $_REQUEST['redirect_to'] : '/';
  get_header();
?>

	<header class="page-header bg-color">
		<div class="container">
			<div class="row">
				<div class="span3 pull-right">
					<div id="breadcrumb">
						<?php flatroom_breadcrumb(); ?>
					</div>
				</div>
				<div class="span9">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</div>
			</div>
			<div class="setsquare">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="40.566px" height="10px" viewBox="0 0 40.566 10" enable-background="new 0 0 40.566 10" xml:space="preserve">
				<path fill-rule="evenodd" clip-rule="evenodd" fill="#111111" d="M28.284,2c-3.806,2.188-8,8-8,8s-4.214-5.957-8.062-8.062
					C8.742,0.035,0,0,0,0h40.566C40.566,0,31.703,0.035,28.284,2z"/>
				</svg>
			</div>
			<div class="setsquare two">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="40.566px" height="10px" viewBox="0 0 40.566 10" enable-background="new 0 0 40.566 10" xml:space="preserve">
				<path fill-rule="evenodd" clip-rule="evenodd" fill="#111111" d="M28.284,2c-3.806,2.188-8,8-8,8s-4.214-5.957-8.062-8.062
					C8.742,0.035,0,0,0,0h40.566C40.566,0,31.703,0.035,28.284,2z"/>
				</svg>
			</div>
		</div>
	</header><!-- .page-header -->
	
	<div id="primary" class="container page-login-register">
		<div class="row">
			<div class="span4">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#register" data-toggle="tab"><?php _e( 'Register', 'flatroom' ); ?></a></li>
					<li><a href="#login" data-toggle="tab"><?php _e( 'Login', 'flatroom' ); ?></a></li>
				</ul><!-- /.nav -->
				<div class="clearfix"></div>
				<div class="tab-content">
					<div id="register" class="tab-pane active">
						<form method="post" action="<?php echo esc_url( home_url( '/wp-login.php?action=register' ) ); ?>">
							<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( $redirect_to ) ); ?>">
							<input type="text" id="inputRegisterEmail" class="input-block-level" required="required" name="user_login" placeholder="Username *">
							<input type="email" id="inputRegisterPassword" class="input-block-level" required="required" name="user_email" placeholder="Email *">

              <?php do_action('register_form'); ?>

							<div class="form-actions">
								<input type="submit" value="Register" class="btn btn-block">
							</div>
						</form>
					</div><!-- #register -->
					
					<div id="login" class="tab-pane">
						<form method="post" action="<?php echo esc_url( home_url( '/wp-login.php' ) ); ?>">
							<input type="hidden" name="redirect_to" value="<?php echo esc_url( home_url( $redirect_to ) ); ?>">
							<input type="text" id="inputLoginLogin" class="input-block-level" name="log" required="required" placeholder="Login *">
							<input type="password" id="inputLoginPassword" class="input-block-level" name="pwd" required="required" placeholder="Password *">
							<div class="clearfix"></div>

              <?php do_action('login_form'); ?>

							<div class="form-actions">
								<input type="submit" value="Login" class="btn btn-block">
							</div>
						</form>
					</div><!-- #login -->
				</div><!-- .tab-content -->
			</div><!-- .span4-->
			<div id="content" class="span7 offset1 bg-dark" role="main">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flatroom' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post -->
				<?php endwhile; ?>
			</div><!-- .span7.offset1 -->
		</div><!-- .row -->
	</div><!-- #primary -->

<?php } get_footer(); ?>