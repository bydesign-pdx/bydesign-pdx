<?php 
// Variables
$prefix = '_noo_agent';

$avatar_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
if( empty($avatar_src) ) {
	$avatar_src		= NOO_ASSETS_URI . '/images/default-avatar.png';
} else {
	$avatar_src		= $avatar_src[0];
}

// Agent's info
$phone			= noo_get_post_meta( get_the_ID(), "{$prefix}_phone", '' );
$mobile			= noo_get_post_meta( get_the_ID(), "{$prefix}_mobile", '' );
$email			= noo_get_post_meta( get_the_ID(), "{$prefix}_email", '' );
$skype			= noo_get_post_meta( get_the_ID(), "{$prefix}_skype", '' );
$facebook		= noo_get_post_meta( get_the_ID(), "{$prefix}_facebook", '' );
$twitter		= noo_get_post_meta( get_the_ID(), "{$prefix}_twitter", '' );
$google_plus	= noo_get_post_meta( get_the_ID(), "{$prefix}_google_plus", '' );
$linkedin		= noo_get_post_meta( get_the_ID(), "{$prefix}_linkedin", '' );
$pinterest		= noo_get_post_meta( get_the_ID(), "{$prefix}_pinterest", '' );

?>

<?php get_header(); ?>
<div class="main-content container-boxed max offset">
	<div class="row">
		<div class="<?php noo_main_class(); ?>" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" class="noo-agent">
					<h1 class="content-title">
						<?php the_title(); ?>
					</h1>
					<?php //if( !empty($facebook) || !empty($twitter) || !empty($google_plus) || !empty($linkedin) || !empty($pinterest) ) : ?>
					<div class="agent-social clearfix">
						<?php echo ( !empty($facebook) ? '<a class="noo-social-facebook" href="' . $facebook . '"></a>' : '' ); ?>
						<?php echo ( !empty($twitter) ? '<a class="noo-social-twitter" href="' . $twitter . '"></a>' : '' ); ?>
						<?php echo ( !empty($google_plus) ? '<a class="noo-social-googleplus" href="' . $google_plus . '"></a>' : '' ); ?>
						<?php echo ( !empty($linkedin) ? '<a class="noo-social-linkedin" href="' . $linkedin . '"></a>' : '' ); ?>
						<?php echo ( !empty($pinterest) ? '<a class="noo-social-pinterest" href="' . $pinterest . '"></a>' : '' ); ?>
					</div>
					<?php //endif; ?>
					<div class="agent-info">
						<div class="content-featured">
					        <div class="content-thumb">
					        	<img src="<?php echo $avatar_src; ?>" alt="<?php the_title(); ?>"/>
					        </div>
					    </div>
						<div class="agent-detail">
							<h4 class="agent-detail-title"><?php _e('Contact Info',NOO_TEXT_DOMAIN)?></h4>
							<div class="agent-detail-info">
								<?php if( !empty( $phone ) ) : ?>
									<div class=""><i class="fa fa-phone"></i>&nbsp;<span><?php _e('Phone:',NOO_TEXT_DOMAIN)?></span><?php echo $phone; ?></div>
								<?php endif; ?>
								<?php if( !empty( $mobile ) ) : ?>
									<div class=""><i class="fa fa-tablet"></i>&nbsp;<span><?php _e('Mobile:',NOO_TEXT_DOMAIN)?></span><?php echo $mobile; ?></div>
								<?php endif; ?>
								<?php if( !empty( $email ) ) : ?>
									<div class=""><i class="fa fa-envelope-square"></i>&nbsp;<span><?php _e('Email:',NOO_TEXT_DOMAIN)?></span><?php echo $email; ?></div>
								<?php endif; ?>
								<?php if( !empty( $skype ) ) : ?>
									<div class=""><i class="fa fa-skype"></i>&nbsp;<span><?php _e('Skype:',NOO_TEXT_DOMAIN)?></span><?php echo $skype; ?></div>
								<?php endif; ?>
							</div>
							<div class="agent-desc">
								<h4 class="agent-detail-title"><?php _e('About Me',NOO_TEXT_DOMAIN)?></h4>
								<?php the_content();?>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="conact-agent row">
						<h2 class="content-title col-md-12">
							<?php _e('Contact Me',NOO_TEXT_DOMAIN)?>
						</h2>
						<form role="form" id="conactagentform" method="post">
							<div style="display: none;">
								<input type="hidden" name="action" value="noo_contact_agent">
								<input type="hidden" name="agent_id" value="<?php echo get_the_ID()?>">
								<input type="hidden" name="security" value="<?php echo wp_create_nonce('noo-contact-agent-'.get_the_ID())?>">
							</div>
							<div class="form-group col-md-6 col-sm-6">
							    <input type="text" name="name" class="form-control" placeholder="<?php _e('Your Name *',NOO_TEXT_DOMAIN)?>">
							</div>
							<div class="form-group  col-md-6 col-sm-6">
							    <input type="email" name="email" class="form-control" placeholder="<?php _e('Your Email *',NOO_TEXT_DOMAIN)?>">
							</div>
							<div class="form-group message col-md-12 col-sm-12">
								<textarea name="message" class="form-control" rows="5" placeholder="<?php _e('Message *',NOO_TEXT_DOMAIN)?>"></textarea>
							</div>
							<div class="form-action col-md-12 col-sm-12">
								<img class="ajax-loader" src="<?php echo NOO_ASSETS_URI ?>/images/ajax-loader.gif" alt="<?php _e('Sending ...',NOO_TEXT_DOMAIN)?>" style="visibility: hidden;">
								<button type="submit" class="btn btn-default"><?php _e('Send Me',NOO_TEXT_DOMAIN)?></button>
							</div>
						</form>
					</div>
					<div class="agent-properties" data-agent-id="<?php the_ID()?>">
						<?php 
						global $noo_show_sold;
						$noo_show_sold = true;
						$args = array(
								'paged'=> 1,
								'posts_per_page' =>4,
								'post_type'=>'noo_property',
								'meta_query' => array(
									array(
										'key' => '_agent_responsible',
										'value' => get_the_ID(),
									),
								),
						);
						$r = new WP_Query($args);
						NooProperty::display_content($r,__('My Properties',NOO_TEXT_DOMAIN),true,'',true,true);
						wp_reset_query();
						wp_reset_postdata();
						$noo_show_sold = false;
						?>
					</div>
				</article> <!-- /#post- -->
				
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div> <!-- /.row -->

</div> <!-- /.container-boxed.max.offset -->

<?php get_footer(); ?>