<?php
/**
 * Register NOO Order.
 * This file register Item and Category for NOO Order.
 *
 * @package    NOO CitiLights
 * @subpackage NOO Order
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if(!class_exists('NooPayment')) :
	class NooPayment {

		const ORDER_SLUG = 'orders';
		const ORDER_POST_TYPE = 'noo_order';
		const ORDER_META_PREFIX = '_noo_order';

		public function __construct() {
			$membership_type = NooMembership::get_membership_type();
			if( $membership_type == 'none' || $membership_type == 'free' ) {
				return;
			}

			add_action('init', array(&$this,'register_post_type'));			

			if( is_admin() ) {
				add_action( 'add_meta_boxes', array (&$this, 'remove_meta_boxes' ), 20 );
				add_action( 'add_meta_boxes', array (&$this, 'add_meta_boxes' ), 30 );
				add_action( 'admin_menu', array(&$this,'settings_sub_menu') );

				add_filter('manage_edit-' . self::ORDER_POST_TYPE . '_columns', array(&$this, 'manage_edit_columns'));
				add_action('manage_posts_custom_column', array(&$this, 'manage_posts_custom_column'));
			}

			// Function for IPN stuff
			add_action('noo-paypal-ipn', array(&$this,'paypal_ipn'));
		}

		public function register_post_type() {
			$permalinks = get_option( 'noo_order_permalinks' );
			// Text for NOO Order.
			$noo_order_labels = array(
				'name' => __('Orders', NOO_TEXT_DOMAIN),
				'singular_name' => __('Order', NOO_TEXT_DOMAIN),
				'menu_name' => __('Payment', NOO_TEXT_DOMAIN),
				'all_items' => __('All Orders', NOO_TEXT_DOMAIN),
				'add_new' => __('Add Order', NOO_TEXT_DOMAIN),
				'add_new_item' => __('Add Order', NOO_TEXT_DOMAIN),
				'edit_item' => __('Edit Order', NOO_TEXT_DOMAIN),
				'new_item' => __('New Order', NOO_TEXT_DOMAIN),
				'view_item' => __('View Order', NOO_TEXT_DOMAIN),
				'search_items' => __('Search Order', NOO_TEXT_DOMAIN),
				'not_found' => __('No orders found', NOO_TEXT_DOMAIN),
				'not_found_in_trash' => __('No orders found in trash', NOO_TEXT_DOMAIN),
			);
			
			$noo_order_icon = NOO_FRAMEWORK_ADMIN_URI . '/assets/images/noo20x20.png';
			if ( floatval( get_bloginfo( 'version' ) ) >= 3.8 ) {
				$noo_order_icon = 'dashicons-cart';
			}
			

			// Options
			$noo_order_args = array(
				'labels' => $noo_order_labels,
				'public' => true,
				'publicly_queryable' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				// 'menu_position' => 5,
				'menu_icon' => $noo_order_icon,
				'capability_type' => 'post',
				'hierarchical' => false,
				'supports' => array(
					'title',
					'revisions'
				),
				'has_archive' => false,
				'can_export' => false
			);
			
			register_post_type(self::ORDER_POST_TYPE, $noo_order_args);
		}

		public function remove_meta_boxes() {
			remove_meta_box( 'slugdiv', self::ORDER_POST_TYPE, 'normal' );
			remove_meta_box( 'mymetabox_revslider_0', self::ORDER_POST_TYPE, 'normal' );
		}

		public function add_meta_boxes() {

			// Declare helper object
			$prefix = self::ORDER_META_PREFIX;
			$helper = new NOO_Meta_Boxes_Helper( $prefix, array( 'page' => self::ORDER_POST_TYPE ) );

			// Order Detail
			$meta_box = array(
				'id'           => "_meta_box_order",
				'title'        => __( 'Order Details', NOO_TEXT_DOMAIN ),
				'context'      => 'normal',
				'priority'     => 'core',
				// 'description'  => __( 'Details for Order ID:', NOO_TEXT_DOMAIN ) . ' <strong>' . get_the_ID() . '</strong>',
				'fields'       => array(
					array(
						'id' => "_order_id",
						'label' => __( 'Order ID', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'label',
						'std' => '<strong>' . get_the_ID() . '</strong>'
					)
				),
			);

			if( NooMembership::is_membership() ) {
				$meta_box['fields'][] = array(
						'id' => "_payment_type",
						'label' => __( 'Payment Type', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'membership_label',
						'std' => __( 'Membership Package', NOO_TEXT_DOMAIN ),
						'callback' => 'NooPayment::render_metabox_fields'
					);
				$meta_box['fields'][] = array(
						'id' => "_billing_type",
						'label' => __( 'Billing Type', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'select',
						'std'     => 'onetime',
						'options' => array(
							array('value'=>'onetime','label'=>__('One Time', NOO_TEXT_DOMAIN)),
							array('value'=>'recurring','label'=>__('Recurring', NOO_TEXT_DOMAIN)),
						)
					);
				$meta_box['fields'][] = array(
						'id' => "_item_id",
						'label' => __( 'Package', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'packages',
						'std'     => '',
						'callback' => 'NooAgent::render_metabox_fields'
					);
				$meta_box['fields'][] = array(
						'id' => "_total_price",
						'label' => __( 'Package Price', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'text',
						'std'     => ''
					);
			} elseif( get_option('noo_membership_type', 'membership') == 'submission' ) {
				$meta_box['fields'][] = array(
						'id' => "_payment_type",
						'label' => __( 'Payment Type', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'select',
						'std'     => 'listing',
						'options' => array(
							array('value'=>'listing','label'=>__('Publish Listing', NOO_TEXT_DOMAIN)),
							array('value'=>'featured','label'=>__('Upgrade to Featured', NOO_TEXT_DOMAIN)),
							array('value'=>'both','label'=>__('Publish Listing with Featured', NOO_TEXT_DOMAIN)),
						)
					);
				$meta_box['fields'][] = array(
						'id' => "_item_id",
						'label' => __( 'Property ID', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'text',
						'std'     => ''
					);
				$meta_box['fields'][] = array(
						'id' => "_total_price",
						'label' => __( 'Total Price', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'text',
						'std'     => ''
					);
			}

			$meta_box['fields'][] = array(
						'id' => "_payment_status",
						'label' => __( 'Payment Status', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'select',
						'std'  => 'pending',
						'options' => array(
							array('value'=>'pending','label'=>__('Pending', NOO_TEXT_DOMAIN)),
							array('value'=>'canceled','label'=>__('Canceled', NOO_TEXT_DOMAIN)),
							array('value'=>'failed','label'=>__('Failed', NOO_TEXT_DOMAIN)),
							array('value'=>'completed','label'=>__('Completed', NOO_TEXT_DOMAIN)),
							array('value'=>'reversed','label'=>__('Reversed', NOO_TEXT_DOMAIN)),
						)
					);
			$meta_box['fields'][] = array(
						'id' => "_purchase_date",
						'label' => __( 'Purchase Date', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'text',
						'std'     => ''
					);
			$meta_box['fields'][] = array(
						'id' => "_agent_id",
						'label' => __( 'Agent', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'agents',
						'std'     => '',
						'callback' => 'NooAgent::render_metabox_fields'
					);
			$meta_box['fields'][] = array(
						'id' => "_txn_id",
						'label' => __( 'Transaction ID', NOO_TEXT_DOMAIN ),
						'desc' => '',
						'type' => 'label',
						'std' => ''
					);

			$helper->add_meta_box($meta_box);
		}

		public function manage_edit_columns($columns) {
			$before = array_slice($columns, 1, 1);
			$after = array_slice($columns, 2);
			
			$order_columns = array(
				'payment_type' => __('Payment Type', NOO_TEXT_DOMAIN),
				'total_price' => __('Total Price', NOO_TEXT_DOMAIN),
				'payment_status' => __('Payment Status', NOO_TEXT_DOMAIN),
			);

			if( NooMembership::is_membership() ) {
				$order_columns['billing_type'] = __('Billing Type', NOO_TEXT_DOMAIN);
			}

			$order_columns['agent'] = __('by Agent', NOO_TEXT_DOMAIN);
			
			$columns = array_merge($before, $order_columns, $after);
			return $columns;
		}

		public function manage_posts_custom_column($column) {
			GLOBAL $post;
			$post_id = get_the_ID();
			
			if ($column == 'payment_type') {
				$payment_type = esc_attr( noo_get_post_meta($post_id, '_payment_type') );

				switch( $payment_type ) {
					case 'membership':
						_e( 'Membership Package', NOO_TEXT_DOMAIN );
						break;
					case 'listing':
						_e('Publish Listing', NOO_TEXT_DOMAIN);
						break;
					case 'featured':
						_e('Upgrade to Featured', NOO_TEXT_DOMAIN);
						break;
					case 'both':
						_e('Publish Listing with Featured', NOO_TEXT_DOMAIN);
						break;
				}
			}

			if ($column == 'total_price') {
				$total_price = floatval( noo_get_post_meta($post_id, '_total_price') );
				echo $total_price;
			}

			if ($column == 'payment_status') {
				$payment_status = esc_attr( noo_get_post_meta($post_id, '_payment_status') );
				switch( $payment_status ) {
					case 'pending':
						_e('Pending', NOO_TEXT_DOMAIN);
						break;
					case 'canceled':
						_e('Canceled', NOO_TEXT_DOMAIN);
						break;
					case 'failed':
						_e('Failed', NOO_TEXT_DOMAIN);
						break;
					case 'completed':
						_e( 'Completed', NOO_TEXT_DOMAIN );
						break;
					case 'reversed':
						_e('Reversed', NOO_TEXT_DOMAIN);
						break;
				}
			}

			if ($column == 'billing_type') {
				$billing_type = esc_attr( noo_get_post_meta($post_id, '_billing_type') );
				switch( $billing_type ) {
					case 'onetime':
						_e( 'Onetime Payment', NOO_TEXT_DOMAIN );
						break;
					case 'recurring':
						$recurring_count = intval( noo_get_post_meta($post_id, '_recurring_count') );
						if( $recurring_count == 0 ) {
							_e('Recurring', NOO_TEXT_DOMAIN);
						} elseif( $recurring_count == 1 ) {
							_e('Recurring 1 time', NOO_TEXT_DOMAIN);
						} elseif( $recurring_count > 1 ) {
							echo sprintf( __('Recurring %s times', NOO_TEXT_DOMAIN), $recurring_count );
						}						
						break;
				}
			}

			if ($column == 'agent') {
				$agent_id = esc_attr( noo_get_post_meta($post_id, '_agent_id') );
				echo get_the_title($agent_id);
			}
		}

		public function settings_sub_menu() {
			//create new setting menu
			add_submenu_page('edit.php?post_type=noo_order', __('Payment Settings', NOO_TEXT_DOMAIN), __('Payment Settings', NOO_TEXT_DOMAIN), 'administrator', 'noo-payment-settings', array (&$this, 'payment_settings'));

			//call register settings function
			add_action( 'admin_init', array(&$this,'register_settings') );
		}

		public function register_settings() {
			//register our settings
			register_setting( 'noo_payment_settings', 'noo_payment_settings' );
		}

		public function payment_settings() {
			?>
			<div class="wrap">
			<h2><?php _e('Payment Settings', NOO_TEXT_DOMAIN); ?></h2>

				<form method="post" action="options.php">
					<?php settings_fields( 'noo_payment_settings' ); ?>
					<?php do_settings_sections( 'noo_payment_settings' ); ?>
					<?php
						
					?>
					<table class="form-table">
						<tr valign="top" class="noo_payment_settings[merchant_account]">
							<th scope="row"><label for="noo_payment_settings[merchant_account]"><?php _e( 'PayPal Merchant Account (ID or Email)', NOO_TEXT_DOMAIN ); ?></label></th>
							<td>
								<input name="noo_payment_settings[merchant_account]" type="text" class="regular-text code" value="<?php echo esc_attr( self::get_option('merchant_account', '') ); ?>" />
							</td>
						</tr>
						<tr valign="top" class="noo_payment_settings[enable_sandbox]">
							<th scope="row"><label for="noo_payment_settings[enable_sandbox]"><?php _e( 'Enable PayPal Sandbox Testing', NOO_TEXT_DOMAIN ); ?></label></th>
							<td><input type="checkbox" name="noo_payment_settings[enable_sandbox]" <?php checked(  self::get_option('enable_sandbox', false) );?> value="1" /></td>
						</tr>
						<tr valign="top" class="noo_payment_settings[disable_ssl]">
							<th scope="row"><label for="noo_payment_settings[disable_ssl]"><?php _e( 'Disable SSL secure connection (Not recommended)', NOO_TEXT_DOMAIN ); ?></label></th>
							<td><input type="checkbox" name="noo_payment_settings[disable_ssl]" <?php checked(  self::get_option('disable_ssl', false) );?> value="1" /></td>
						</tr>
						<tr valign="top" class="noo_payment_settings[notify_email]">
							<th scope="row"><label for="noo_payment_settings[notify_email]"><?php _e( 'Email for sending payment notification', NOO_TEXT_DOMAIN ); ?></label></th>
							<td>
								<input name="noo_payment_settings[notify_email]" type="text" class="regular-text code" value="<?php echo esc_attr( self::get_option('notify_email', '') ); ?>" placeholder="youremail@email.com" />
							</td>
						</tr>
					</table>
					<?php submit_button(); ?>
				</form>
			</div>
			<?php
		}

		public function paypal_ipn($POST) {
			$has_err		= false;
			$err_message	= array();

			$order_id		= intval( $POST['custom'] );
			$txn_id			= esc_attr( $POST['txn_id'] );
			$txn_type		= esc_attr( $POST['txn_type'] );
			$payment_status	= esc_attr( $POST['payment_status'] );

			$receiver_email	= esc_attr( $POST['receiver_email'] );
			$mc_gross 		= floatval( $POST['mc_gross'] );
			$mc_currency 	= esc_attr( $POST['mc_currency'] );

			if( $receiver_email != self::get_option('merchant_account') ) {
				$has_err		= true;
				$err_message[]	= __('Different Receiver Email', NOO_TEXT_DOMAIN);
			}
			if( empty($order_id) ) {
				$has_err		= true;
				$err_message[]	= __('Empty Order ID', NOO_TEXT_DOMAIN);
			}

			$order					= array();
			$order['agent_id']		= intval( noo_get_post_meta( $order_id, '_agent_id' ) );
			if( empty( $order['agent_id'] ) ) {
				$has_err		= true;
				$err_message[]	= __('Order does not have Agent ID', NOO_TEXT_DOMAIN);
			}
			$order['item_id']		= intval( noo_get_post_meta( $order_id, '_item_id' ) );
			if( empty( $order['item_id']) ) {
				$has_err		= true;
				$err_message[]	= __('Order does not have Item ID', NOO_TEXT_DOMAIN);
			}
			$order['total_price']	= floatval( noo_get_post_meta( $order_id, '_total_price' ) );
			$order['currency_code']	= esc_attr( noo_get_post_meta( $order_id, '_currency_code' ) );
			if( $mc_gross != round($order['total_price'], 2) || strtoupper($mc_currency) != strtoupper($order['currency_code']) ) {
				$has_err		= true;
				$err_message[]	= __('Price or Currency does not match', NOO_TEXT_DOMAIN);
			}
			$order['total_price'] = NooProperty::format_price( $order['total_price'], 'text' );

			$order['recurring']	= esc_attr( noo_get_post_meta( $order_id, '_billing_type' ) ) == 'recurring';
			$order['status']	= esc_attr( noo_get_post_meta( $order_id, '_payment_status' ) );
			$order_status		= '';
			if( !$order['recurring']) {
				$order_status	= $this->_payment_status( $payment_status );
			} else {
				if(preg_match( "#(subscr_payment)#i", $txn_type)) {
					$order_status	= $this->_payment_status( $payment_status );
				}
				// elseif(preg_match( "#(subscr_signup)#i", $txn_type)) {
				// 	$order_status	= "pending";
				// }
				// elseif(preg_match( "#(subscr_cancel)#i", $txn_type)) {
				// 	$order_status	= "canceled";
				// }
				// elseif(preg_match( "#(subscr_failed)#i", $txn_type)) {
				// 	$order_status	= "failed";
				// }
			}

			if( empty( $order_status ) ) {
				$has_err		= true;
				$err_message[]	= __('Unknown order status!', NOO_TEXT_DOMAIN);
			}

			if( $has_err ) {
				// echo implode('<br/>', $err_message );
				// wp_mail( self::get_option('notify_email'), __('Error when processing Order', NOO_TEXT_DOMAIN), implode('<br/>', $err_message ) );
				return false;
			}

			if( $order['status'] != $order_status ) {
				update_post_meta( $order_id, '_payment_status', $order_status );

				if( $order['status'] == 'completed' ) {

					if( NooMembership::is_membership() ) {
						// Check if current membership is activated by this order
						$activation_date = noo_get_post_meta( $order['agent_id'], '_activation_date' );
						$purchase_date = noo_get_post_meta( $order_id, '_purchase_date' );
						if( $activation_date == $purchase_date ) {
							NooAgent::revoke_agent_membership( $order['agent_id'], $order['item_id'] );
						}

						if( $order['recurring'] ) {
							$recurring_count = intval( noo_get_post_meta( $order_id, '_recurring_count') );
							$recurring_count = max( 0, $recurring_count - 1 );
							update_post_meta( $order_id, '_recurring_count', $recurring_count );
						}
					} elseif( NooMembership::is_submission() ) {
						$order['payment_type'] = esc_attr( noo_get_post_meta( $order_id, '_payment_type' ) );
						NooAgent::revoke_property_status( $order['agent_id'], $order['item_id'], $order['payment_type'] );
					}
				}

				if( $order_status == 'completed' ) {
					$purchase_date = time();
					update_post_meta( $order_id, '_purchase_date', $purchase_date );
					update_post_meta( $order_id, '_txn_id', $txn_id );

					if( NooMembership::is_membership() ) {
						NooAgent::set_agent_membership( $order['agent_id'], $order['item_id'], $purchase_date );

						if( $order['recurring'] ) {
							$recurring_count = intval( noo_get_post_meta( $order_id, '_recurring_count') );
							update_post_meta( $order_id, '_recurring_count', $recurring_count + 1 );
						}

						// Email
						$admin_email = self::get_option('notify_email');
						if( empty($admin_email ) ) $admin_email = get_option('admin_email');

						$user_name = get_the_title( $order['agent_id'] );
						$user_email = noo_get_post_meta( $order['agent_id'], "_noo_agent_email");
						$package_name = get_the_title( $order['item_id'] );
						$site_name = get_option('blogname');

						$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

						// Admin email
						$message = sprintf( __("You have received a new payment for membership on %s", NOO_TEXT_DOMAIN), $site_name) . "\r\n\r\n";
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= sprintf( __("User's name: %s", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("Email address: %s", NOO_TEXT_DOMAIN), $user_email) . "\r\n\r\n";
						$message .= sprintf( __("Package: %s", NOO_TEXT_DOMAIN), $package_name) . "\r\n\r\n";
						$message .= sprintf( __("Amount: %s", NOO_TEXT_DOMAIN), $order['total_price']) . "\r\n\r\n";
						$message .= sprintf( __("Transaction #: %s", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= __("You may review your invoice history at any time by logging in to backend.", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($admin_email,
							sprintf(__('[%s] New Payment received for Membership purchase',NOO_TEXT_DOMAIN), $site_name),
							$message,
							$headers);

						// Agent email
						$message = sprintf( __("Hi %s,", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("You have paid %s for %s membership on %s.", NOO_TEXT_DOMAIN), $order['total_price'], $package_name, $site_name) . "\r\n\r\n";
						$message .= sprintf( __("Your transaction ID is: %s,", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= __("Thank you and enjoy listing,", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($user_email,
							sprintf(__('[%s] Payment for membership successfully processed',NOO_TEXT_DOMAIN), $site_name),
							$message,
							$headers);
					} elseif( NooMembership::is_submission() ) {
						$order['payment_type'] = esc_attr( noo_get_post_meta( $order_id, '_payment_type' ) );
						NooAgent::set_property_status( $order['agent_id'], $order['item_id'], $order['payment_type'] );

						// Email
						$admin_email = self::get_option('notify_email');
						if( empty($admin_email ) ) $admin_email = get_option('admin_email');
						$property_link = get_permalink( $order['item_id'] );
						$property_admin_link = admin_url( 'post.php?post=' . $order['item_id'] ) . '&action=edit';

						$user_name = get_the_title( $order['agent_id'] );
						$user_email = noo_get_post_meta( $order['agent_id'], "_noo_agent_email");
						$property_title = get_the_title( $order['item_id'] );
						$site_name = get_option('blogname');

						$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

						// Admin email
						$message = '';
						$title = '';
						if( $order['payment_type'] == 'listing' ) {
							$message .= sprintf( __("You have received a new payment for Paid Submission on %s", NOO_TEXT_DOMAIN), $site_name) . "\r\n\r\n";
							$title .= sprintf(__('[%s] New Payment received for Paid Property Submission',NOO_TEXT_DOMAIN), $site_name);

						} elseif( $order['payment_type'] == 'featured' ) {
							$message .= sprintf( __("You have received a new payment for Featured property on %s", NOO_TEXT_DOMAIN), $site_name) . "\r\n\r\n";
							$title .= sprintf(__('[%s] New Payment received for Featured property',NOO_TEXT_DOMAIN), $site_name);

						} elseif( $order['payment_type'] == 'both' ) {
							$message .= sprintf( __("You have received a new payment for Paid Submission and Featured property on %s", NOO_TEXT_DOMAIN), $site_name) . "\r\n\r\n";
							$title .= sprintf(__('[%s] New Payment received for Paid Submission and Featured property',NOO_TEXT_DOMAIN), $site_name);
						}
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= sprintf( __("User's name: %s", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("Email address: %s", NOO_TEXT_DOMAIN), $user_email) . "\r\n\r\n";
						$message .= sprintf( __("Amount: %s", NOO_TEXT_DOMAIN), $order['total_price']) . "\r\n\r\n";
						$message .= sprintf( __("Transaction #: %s", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= sprintf( __("Property link: %s", NOO_TEXT_DOMAIN), $property_admin_link) . "\r\n\r\n";
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= __("You may review your invoice history at any time by logging in to backend.", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($admin_email,
							$title,
							$message,
							$headers);

						// Agent email
						$message = sprintf( __("Hi %s,", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("You have paid %s for %s property on %s. This is the link to the listing: %s", NOO_TEXT_DOMAIN), $order['total_price'],$property_title, $site_name, $property_link) . "\r\n\r\n";
						$message .= sprintf( __("Your transaction ID is: %s,", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= __("Thank you and best regards,", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($user_email,
							sprintf(__('[%s] Payment for Property listing successfully processed',NOO_TEXT_DOMAIN), $site_name),
							$message,
							$headers);
					}
				}
			} else {
				if( $order['recurring'] && $order_status == 'completed' ) {
					$purchase_date = time();
					$recurring_count = intval( noo_get_post_meta( $order_id, '_recurring_count') );
					update_post_meta( $order_id, '_purchase_date', $purchase_date );
					update_post_meta( $order_id, '_txn_id', $txn_id );
					update_post_meta( $order_id, '_recurring_count', $recurring_count + 1 );

					if( NooMembership::is_membership() ) {
						NooAgent::set_agent_membership( $order['agent_id'], $order['item_id'], $purchase_date );

						// Email
						$admin_email = self::get_option('notify_email');
						if( empty($admin_email ) ) $admin_email = get_option('admin_email');

						$user_name = get_the_title( $order['agent_id'] );
						$user_email = noo_get_post_meta( $order['agent_id'], "_noo_agent_email");
						$package_name = get_the_title( $order['item_id'] );
						$site_name = get_option('blogname');

						$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

						// Admin email
						$message = sprintf( __("You have received a new recurring payment for membership on %s", NOO_TEXT_DOMAIN), $site_name) . "\r\n\r\n";
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= sprintf( __("User's name: %s", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("Email address: %s", NOO_TEXT_DOMAIN), $user_email) . "\r\n\r\n";
						$message .= sprintf( __("Package: %s", NOO_TEXT_DOMAIN), $package_name) . "\r\n\r\n";
						$message .= sprintf( __("Amount: %s", NOO_TEXT_DOMAIN), $order['total_price']) . "\r\n\r\n";
						$message .= sprintf( __("Transaction #: %s", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= __("----------------------------------------------", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						$message .= __("You may review your invoice history at any time by logging in to backend.", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($admin_email,
							sprintf(__('[%s] New Payment received for Membership purchase',NOO_TEXT_DOMAIN), $site_name),
							$message,
							$headers);

						// Agent email
						$message = sprintf( __("Hi %s,", NOO_TEXT_DOMAIN), $user_name) . "\r\n\r\n";
						$message .= sprintf( __("You have paid %s for %s membership on %s.", NOO_TEXT_DOMAIN), $order['total_price'], $package_name, $site_name) . "\r\n\r\n";
						$message .= sprintf( __("Your transaction ID is: %s,", NOO_TEXT_DOMAIN), $txn_id) . "\r\n\r\n";
						$message .= __("Thank you and enjoy listing,", NOO_TEXT_DOMAIN) . "\r\n\r\n";
						wp_mail($user_email,
							sprintf(__('[%s] Payment for membership successfully processed',NOO_TEXT_DOMAIN), $site_name),
							$message,
							$headers);
					}
				}
			}
		}

		private function _payment_status( $payment_status ) {
			if(preg_match ("#(canceled_reversal|completed)#i", $payment_status)) {
				return "completed";
			}
			elseif(preg_match ("#(created|processed|pending)#i", $payment_status)) {
				return "pending";
			}
			elseif(preg_match ("#(canceled|denied)#i", $payment_status)) {
				return "canceled";
			}
			elseif(preg_match ("#(failed|expired|voided)#i", $payment_status)) {
				return "failed";
			}
			elseif(preg_match ("#(refunded|reversed)#i", $payment_status)) {
				return "reversed";
			}

			return '';
		}

		public static function get_option( $id, $default = null ) {
			$options = get_option('noo_payment_settings');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}

		public static function render_metabox_fields( $post, $id, $type, $meta, $std = null, $field = null ) {
			switch( $type ) {
				case 'membership_label':
					$value = empty( $meta ) && ( $std != null && $std != '' ) ? $std : $meta;
					$value == 'membership' ? __('Membership Package', NOO_TEXT_DOMAIN ) : '';
					echo '<label id='.$id.' >'. $value . '</label>';
					break;
			}
		}

		public static function create_new_order( $payment_type = '', $billing_type = '', $item_id = '', $total_price = '', $agent_id = '', $title = '' ) {
			if( empty( $payment_type ) || empty( $item_id ) || empty( $total_price ) || empty( $agent_id ) ) {
				return 0;
			}

			if( $payment_type == 'membership' && empty( $billing_type ) ) {
				return 0;
			}

			if( !is_numeric( $item_id ) || !is_numeric( $agent_id ) ) {
				return 0;
			}

			$total_price = floatval($total_price);

			if( $total_price == 0 ) {
				return 0;
			}

			$order = array(
				'post_title' => $title,
				'post_type' => NooPayment::ORDER_POST_TYPE,
				'post_status' => 'publish'
			);
			$order_ID = wp_insert_post( $order );

			if( !$order_ID ) {
				return 0;
			}

			update_post_meta( $order_ID, '_payment_status', 'pending' );
			update_post_meta( $order_ID, '_currency_code', NooProperty::get_general_option('currency') );
			update_post_meta( $order_ID, '_payment_type', $payment_type );
			if( !empty( $billing_type )) {
				update_post_meta( $order_ID, '_billing_type', $billing_type );
			}
			update_post_meta( $order_ID, '_item_id', intval( $item_id ) );
			update_post_meta( $order_ID, '_total_price', $total_price );
			update_post_meta( $order_ID, '_agent_id', intval( $agent_id ) );

			return $order_ID;
		}
	}
endif;

new NooPayment();
