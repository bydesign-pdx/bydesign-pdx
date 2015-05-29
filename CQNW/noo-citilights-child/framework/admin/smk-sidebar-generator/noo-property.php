<?php
if(!class_exists('NooPropertyFilterDropdown')):
class NooPropertyFilterDropdown extends Walker {

	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

	public function start_el( &$output, $cat, $depth = 0, $args = array(), $current_object_id = 0 ) {

		if ( ! empty( $args['hierarchical'] ) )
			$pad = str_repeat('-', $depth * 2);
		else
			$pad = '';

		$cat_name = $cat->name;

		$value = isset( $args['value'] ) && $args['value'] == 'id' ? $cat->term_id : $cat->slug;

		$output .= "\t<option class=\"level-$depth\" value=\"" . $value . "\"";

		if ( $value == $args['selected'] || ( is_array( $args['selected'] ) && in_array( $value, $args['selected'] ) ) )
			$output .= ' selected="selected"';

		$output .= '>';

		$output .= $pad . $cat_name;

		if ( ! empty( $args['show_count'] ) )
			$output .= '&nbsp;(' . $cat->count . ')';

		$output .= "</option>\n";
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || 0 === $element->count ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}
endif;


class NooPropertySearchDropdown extends Walker {

	var $tree_type = 'category';
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id', 'slug' => 'slug' );

	public function start_el( &$output, $term, $depth = 0, $args = array(), $current_object_id = 0 ) {

		if ( ! empty( $args['hierarchical'] ) ) {
			$pad = str_repeat('-', $depth * 2);
			$pad = !empty( $pad ) ? $pad . '&nbsp;' : '';
		} else {
			$pad = '';
		}

		$cat_name = $term->name;

		$value = isset( $args['value'] ) && $args['value'] == 'id' ? $term->term_id : $term->slug;
		$parent = '';
		if( $args['taxonomy'] == 'property_sub_location' ) {
			$parent_data = get_option( 'noo_sub_location_parent' );
			if( isset( $parent_data[$term->term_id] ) ) {
				$parent_location = get_term_by('id',$parent_data[$term->term_id],'property_location');
				$parent .= ' data-parent-location="' . $parent_location->slug . '"';
			}
		}

		$output .= "\t<li class=\"level-$depth\" $parent><a href=\"#\" data-value=\"" . $value . "\">";
		$output .= $pad . $cat_name;
		if ( ! empty( $args['show_count'] ) )
			$output .= '&nbsp;(' . $term->count . ')';
		$output .= "</a></li>\n";
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		if ( ! $element || 0 === $element->count ) {
			return;
		}
		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

function noo_dropdown_search($args = ''){
	$defaults = array(
		'show_option_all' => '', 'show_option_none' => '',
		'orderby' => 'id', 'order' => 'ASC',
		'show_count' => 1,
		'hide_empty' => 1, 'child_of' => 0,
		'exclude' => '', 'echo' => 1,
		'hierarchical' => 1,
		'depth' => 0,
		'taxonomy' => 'category',
		'hide_if_empty' => false,
		'option_none_value' => '',
		'meta' => '',
		'walker'=>new NooPropertySearchDropdown
	);
	$defaults['selected'] = ( is_category() ) ? get_query_var( 'cat' ) : 0;
	$r = wp_parse_args( $args, $defaults );
	$taxonomies = get_terms( $r['taxonomy'], $r );
	if ( ! $r['hide_if_empty'] || ! empty( $taxonomies ) ) {
		$output = "<ul class=\"dropdown-menu\">\n";
	} else {
		$output = '';
	}
	
	if ( empty( $taxonomies ) && ! $r['hide_if_empty'] && ! empty( $r['show_option_none'] ) ) {
		$show_option_none = $r['show_option_none'];
		$output .= "\t<li><a data-value=\"\" href=\"#\">$show_option_none</a></li>\n";
	}
	if ( $r['show_option_none'] ) {
		$show_option_none = $r['show_option_none'];
		$output .= "\t<li><a data-value=\"\" href=\"#\">$show_option_none</a></li>\n";
	}
	
	if ( $r['hierarchical'] ) {
		$depth = $r['depth'];  // Walk the full depth.
	} else {
		$depth = -1; // Flat.
	}
	$output .= walk_category_dropdown_tree( $taxonomies, $depth, $r );
	
	if ( ! $r['hide_if_empty'] || ! empty( $taxonomies ) ) {
		$output .= "</ul>\n";
	}
	if ( $r['echo'] ) {
		echo $output;
	}
	return $output;
}

if(!class_exists('NooProperty')):
	class NooProperty{
		public function __construct(){
			add_action('init', array(&$this,'init'));
			add_action('init', array(&$this,'register_post_type'));
			
			add_filter( 'template_include', array( $this, 'template_loader' ) );
		
			if(!is_admin())
				add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
			
			add_action( 'restrict_manage_posts', array( $this, 'restrict_manage_posts' ) );
			
			add_shortcode('noo_recent_properties', array(&$this,'recent_properties_shortcode'));
			add_shortcode('noo_single_property', array(&$this,'single_property_shortcode'));
			add_shortcode('noo_advanced_search_property', array(&$this,'advanced_search_property_shortcode'));
			add_shortcode('property_slider', array(&$this,'property_slider_shortcode'));  
			add_shortcode('property_slide', array(&$this,'property_slide_shortcode'));
			
			//Ajax Contact Agent
			add_action('wp_ajax_noo_contact_agent', array(&$this,'ajax_contact_agent'));
			add_action('wp_ajax_nopriv_noo_contact_agent', array(&$this,'ajax_contact_agent'));
			
			//Ajax Contact Agent
			add_action('wp_ajax_noo_agent_ajax_property', array(&$this,'ajax_agent_property'));
			add_action('wp_ajax_nopriv_noo_agent_ajax_property', array(&$this,'ajax_agent_property'));
				
			
			if(is_admin()):
				add_action('admin_init', array(&$this,'admin_init'));
				
				add_action ( 'add_meta_boxes', array (&$this, 'add_meta_boxes' ), 30 );
				
				add_action('admin_menu',array(&$this,'admin_menu'));
				//Property
				add_filter( 'manage_edit-noo_property_columns', array($this,'property_columns') );
				add_filter( 'manage_noo_property_posts_custom_column',  array($this,'property_column'), 2 );
				
				//Label
				add_action('property_label_add_form_fields',array(&$this,'add_property_label_color'));
				add_action('property_label_edit_form_fields',array(&$this,'edit_property_label_color'),10,3);
				add_action( 'created_term', array($this,'save_label_color'), 10,3 );
				add_action( 'edit_term', array($this,'save_label_color'), 10,3 );
				
				//Map Marker
				add_action('property_category_add_form_fields',array(&$this,'add_category_map_marker'));
				add_action('property_category_edit_form_fields',array(&$this,'edit_category_map_marker'),10,3);
				add_action( 'created_term', array($this,'save_category_map_marker'), 10,3 );
				add_action( 'edit_term', array($this,'save_category_map_marker'), 10,3 );
				
				//Location
				add_action('property_location_add_form_fields',array(&$this,'add_location'));
				add_action('property_location_edit_form_fields',array(&$this,'edit_location'),10,3);
				
				//Status
				add_action('property_status_add_form_fields',array(&$this,'add_status'));
				add_action('property_status_edit_form_fields',array(&$this,'edit_status'),10,3);
				
				//Sub location 
				add_action('property_sub_location_add_form_fields',array(&$this,'add_sub_location'));
				add_action('property_sub_location_edit_form_fields',array(&$this,'edit_sub_location'),10,3);
				add_action( 'created_term', array($this,'save_sub_location_callback'), 10,3 );
				add_action( 'edit_term', array($this,'save_sub_location_callback'), 10,3 );
				add_filter( 'manage_edit-property_sub_location_columns', array($this,'sub_location_columns') );
				add_filter( 'manage_property_sub_location_custom_column',  array($this,'sub_location_column'), 10, 3 );
				
				add_action( 'admin_print_scripts-post.php', array( &$this, 'enqueue_map_scripts' ) );
				add_action( 'admin_print_scripts-post-new.php', array( &$this, 'enqueue_map_scripts' ) );
				
				add_action( 'admin_enqueue_scripts', array(&$this,'enqueue_scripts'));
			endif;
		}
		
		public function init(){
			
		}
		
		public function restrict_manage_posts(){
			global $typenow, $wp_query;
			switch ( $typenow ) {
				case 'noo_property' :
					$this->property_filters();
				break;
			}
		}
		
		public function property_filters(){
			global $wp_query;
			$current_property_category = isset( $wp_query->query['property_category'] ) ? $wp_query->query['property_category'] : '';
			wp_dropdown_categories(array(
				'taxonomy'=>'property_category',
				'name'=>'property_category',
				'echo'=>true,
				'show_count'=>true,
				'show_option_none'=>__('--Show All--',NOO_TEXT_DOMAIN),
				'option_none_value'=>0,
				'selected'=>$current_property_category,
				'walker'=>new NooPropertyFilterDropdown
			));
			
			
			$current_property_location = isset( $wp_query->query['property_location'] ) ? $wp_query->query['property_location'] : '';
			wp_dropdown_categories(array(
				'taxonomy'=>'property_location',
				'name'=>'property_location',
				'echo'=>true,
				'show_count'=>true,
				'show_option_none'=>__('--Show All--',NOO_TEXT_DOMAIN),
				'option_none_value'=>0,
				'selected'=>$current_property_location,
				'walker'=>new NooPropertyFilterDropdown
			));
			
			$current_property_sub_location = isset( $wp_query->query['property_sub_location'] ) ? $wp_query->query['property_sub_location'] : '';
			wp_dropdown_categories(array(
				'taxonomy'=>'property_sub_location',
				'name'=>'property_sub_location',
				'echo'=>true,
				'show_count'=>true,
				'show_option_none'=>__('--Show All--',NOO_TEXT_DOMAIN),
				'option_none_value'=>0,
				'hierarchical'=>true,
				'selected'=>$current_property_sub_location,
				'walker'=>new NooPropertyFilterDropdown
			));
			
			$current_property_status = isset( $wp_query->query['property_status'] ) ? $wp_query->query['property_status'] : '';
			wp_dropdown_categories(array(
				'taxonomy'=>'property_status',
				'name'=>'property_status',
				'echo'=>true,
				'show_count'=>true,
				'show_option_none'=>__('--Show All--',NOO_TEXT_DOMAIN),
				'option_none_value'=>0,
				'selected'=>$current_property_status,
				'walker'=>new NooPropertyFilterDropdown
			));
				
		}
		
		/**
		 * Hook into pre_get_posts
		 *
		 * @param WP_Query $q query object
		 * @return void
		 */
		public function pre_get_posts($q){
			global $wpdb,$noo_show_sold;
			if(isset($q->query_vars['post_type']) && $q->query_vars['post_type'] === 'noo_property'){
					if(empty($noo_show_sold)){
						$sold = get_option('default_property_status');
						$tax_query = array(
								'taxonomy' => 'property_status',
								'terms'    => array( $sold ),
								'operator' => 'NOT IN',
						);
						$q->tax_query->queries[] = $tax_query;
						$q->query_vars['tax_query'] = $q->tax_query->queries;
					}
					if(isset($_GET['orderby'])){
						$orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'menu_order title';
						$orderby = strtolower( $orderby );
						$order   = 'DESC';
						$args    = array();
						$args['orderby']  = 'menu_order title';
						$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
						$args['meta_key'] = '';
						
						switch ( $orderby ) {
							case 'rand' :
								$args['orderby']  = 'rand';
								break;
							case 'date' :
								$args['orderby']  = 'date';
								$args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
								break;
							/*case 'bath' :
								$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
								$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
								$args['meta_key'] = '_bathrooms';
								break;
							case 'bed' :
								$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
								$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
								$args['meta_key'] = '_bedrooms';
								break;*/
							case 'area' :
								$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
								$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
								$args['meta_key'] = '_area';
								break;
							case 'name' :
								$args['orderby']  = 'title';
								$args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
								break;
						}
						$q->set( 'orderby', $args['orderby'] );
						$q->set( 'order', $args['order'] );
						if ( isset( $args['meta_key'] ) )
							$q->set( 'meta_key', $args['meta_key'] );
					}
			}
		}
		
		public function template_loader($template){
			if(is_tax('property_category') || is_tax('property_status') || is_tax('property_location') || is_tax('property_sub_location')){
				$template       = locate_template( 'taxonomy-property_category.php' );
			}
			return $template;
		}
		
		public static function get_general_option($id,$default = null){
			$options = get_option('noo_property_general');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}
		
		public static function get_custom_field_option($id,$default = null){
			$options = get_option('noo_property_custom_filed');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}
		
		public static function get_feature_option($id,$default = null){
			$options = get_option('noo_property_feature');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}
		
		public static function get_advanced_search_option($id,$default = null){
			$options = get_option('noo_property_advanced_search');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}
		
		
		public static function get_google_map_option($id,$default = null){
			$options = get_option('noo_property_google_map');
			if (isset($options[$id])) {
				return $options[$id];
			}
			return $default;
		}
		
		
		public function admin_init(){
			register_setting('noo_property_general','noo_property_general');
			register_setting('noo_property_custom_filed','noo_property_custom_filed');
			register_setting('noo_property_feature','noo_property_feature');
			register_setting('noo_property_advanced_search','noo_property_advanced_search');
			register_setting('noo_property_google_map','noo_property_google_map');
			
			add_action('noo_property_settings_general', array(&$this,'settings_general'));
			add_action('noo_property_settings_custom_field', array(&$this,'settings_custom_field'));
			add_action('noo_property_settings_feature', array(&$this,'settings_feature'));
			add_action('noo_property_settings_advanced_search', array(&$this,'settings_advanced_search'));
			add_action('noo_property_settings_google_map', array(&$this,'settings_google_map'));
			
			$this->feature_property();
			
		}
		
		
		public function add_meta_boxes(){
			$property_labels = array();
			$property_labels[] = array('value'=>'','label'=>__('Select a label',NOO_TEXT_DOMAIN));
			$property_labe_terms = (array) get_terms('property_label',array('hide_empty'=>0));

			foreach ($property_labe_terms as $label){
				$property_labels[] = array('value'=>$label->term_id,'label'=>$label->name);
			}
			$meta_box = array(
					'id' => "property_detail",
					'title' => __('Property Details', NOO_TEXT_DOMAIN) ,
					'page' => 'noo_property',
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array(
							array(
								'id'=>'_label',
								'label'=>__('Property Label',NOO_TEXT_DOMAIN),
								'type'=>'select',
								'options'=>$property_labels
							),
							array(
									'id' => '_address',
									'label' => __('Address',NOO_TEXT_DOMAIN),
									'type' => 'text',
							),
							array(
									'id' => '_price',
									'label' => __('Price',NOO_TEXT_DOMAIN) . ' (' . NooProperty::get_currency_symbol(NooProperty::get_general_option('currency')) . ')',
									'type' => 'text',
							),
							array(
									'id' => '_price_label',
									'label' => __('After Price Label',NOO_TEXT_DOMAIN),
									'type' => 'text',
							),
							array(
									'id' => '_area',
									'label' => __('Area',NOO_TEXT_DOMAIN) . ' (' . NooProperty::get_general_option('area_unit') . ')',
									'type' => 'text',
							),
							/*array(
									'id' => '_bedrooms',
									'label' => __('Bedrooms',NOO_TEXT_DOMAIN),
									'type' => 'text',
							),
							array(
									'id' => '_bathrooms',
									'label' => __('Bathrooms',NOO_TEXT_DOMAIN),
									'type' => 'text',
							)*/
					)
			);
			
			// Create a callback function
			$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
				
				
			
			$custom_fields = self::get_custom_field_option('custom_field');
			$property_detail_fields = array();
			if($custom_fields){
				foreach ($custom_fields as $custom_field){
					$id = '_noo_property_field_'.sanitize_title(@$custom_field['name']);
					$property_detail_fields[] = array(
						'label' => @$custom_field['label'] ,
						'id' => $id,
						'type' => 'text',
					);
				}
				

				$meta_box = array(
						'id' => "property_custom",
						'title' => __('Property Custom', NOO_TEXT_DOMAIN) ,
						'page' => 'noo_property',
						'context' => 'normal',
						'priority' => 'high',
						'fields' => $property_detail_fields
				);
					
				// Create a callback function
				$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
				add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
					
			}
			
			$features = self::get_feature_option('features');
			$property_feature_fields = array();
			if($features){
				foreach ($features as $feature){
						
					$property_feature_fields[] = array(
							'label' =>ucfirst($feature),
							'id' => '_noo_property_feature_'.sanitize_title($feature),
							'type' => 'checkbox',
					);
				}
			}
			if( !empty( $property_feature_fields ) ) {
				$meta_box = array(
						'id' => "property_feature",
						'title' => __('Property Features', NOO_TEXT_DOMAIN) ,
						'page' => 'noo_property',
						'context' => 'normal',
						'priority' => 'high',
						'fields' => $property_feature_fields
				);

				// Create a callback function
				$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
				add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
			}

			$meta_box = array(
					'id' => "property_map",
					'title' => __('Place in Map', NOO_TEXT_DOMAIN) ,
					'page' => 'noo_property',
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array(
							array(
									'id' => '_noo_property_gmap',
									'type' => 'gmap',
									'callback'=>array(&$this,'meta_box_google_map')
							),
							array(
									'label' =>__('Latitude',NOO_TEXT_DOMAIN),
									'id' => '_noo_property_gmap_latitude',
									'type' => 'text',
									'std'=> self::get_google_map_option('latitude','40.714398')
							),
							array(
									'label' =>__('Longitude',NOO_TEXT_DOMAIN),
									'id' => '_noo_property_gmap_longitude',
									'type' => 'text',
									'std' => self::get_google_map_option('longitude','-74.005279')
							),
							array(
								'label' =>__('Enable Google Street View',NOO_TEXT_DOMAIN),
								'id' => '_noo_property_gmap_street_view',
								'type' => 'checkbox',
							),
					)
			);
			$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
				
			$meta_box = array(
					'id' => "property_video",
					'title' => __('Property Video', NOO_TEXT_DOMAIN) ,
					'page' => 'noo_property',
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array(
							array(
									'label' => __('Video Embedded', NOO_TEXT_DOMAIN),
									'desc' => __('Enter a Youtube, Vimeo, Soundcloud, etc... URL. See supported services at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.', NOO_TEXT_DOMAIN),
									'id' => '_video_embedded',
									'type' => 'text',
							),
					),
			);
			// Create a callback function
			$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
			
				
			
			$meta_box = array(
					'id' => "property_gallery",
					'title' => __('Gallery', NOO_TEXT_DOMAIN) ,
					'page' => 'noo_property',
					'context' => 'normal',
					'priority' => 'high',
					'fields' => array(
							array(
									'label' =>__('Gallery',NOO_TEXT_DOMAIN),
									'id' => '_gallery',
									'type' => 'gallery',
							),
					),
			);
			// Create a callback function
			$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
			
			
			
			$meta_box = array(
				'id' => 'agent_responsible',
				'title' => __('Agent Responsible', NOO_TEXT_DOMAIN),
				'page' => 'noo_property',
				'context' => 'side',
				'priority' => 'default',
				'fields' => array(
					array(
						'label' => __('Agent Responsible', NOO_TEXT_DOMAIN),
						'id'    => '_agent_responsible',
						'type'  => 'agents',
						'callback' => 'NooAgent::render_metabox_fields'
					)
				)
			);
			// Create a callback function
			$callback = create_function( '$post,$meta_box', 'noo_create_meta_box( $post, $meta_box["args"] );' );
			add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['page'], $meta_box['context'], $meta_box['priority'], $meta_box );
		}
		
		public function meta_box_google_map($post,$meta_box){
			?>
			<style>
			<!--
			.noo-form-group._gallery > label{
				display: none;
			}
			.noo-form-group._gallery .noo-thumb-wrapper img{
				max-width: 112px;
				max-height: 112px;
				width: 112px;
				height: 112px;
			}
			._noo_property_gmap .noo-control{float: none;width: 100%;}
			-->
			</style>
			<div class="noo_property_google_map">
				<div id="noo_property_google_map" class="noo_property_google_map" style="height: 380px; margin-bottom: 30px; overflow: hidden;position: relative;width: 100%;">
				</div>
				<div class="noo_property_google_map_search">
					<input placeholder="<?php echo __('Search your map',NOO_TEXT_DOMAIN)?>" type="text" autocomplete="off" id="noo_property_google_map_search_input">
				</div>
			</div>
			<?php
		}
		
		public function admin_menu(){
			add_submenu_page('edit.php?post_type=noo_property',  __('Settings',NOO_TEXT_DOMAIN),   __('Settings',NOO_TEXT_DOMAIN), 'edit_posts', 'noo-property-setting',array(&$this,'settings_page'));			
		}
		
		public function settings_page(){
			$current_tab     = empty( $_GET['tab'] ) ? 'general' : sanitize_title( $_GET['tab'] );
			$tabs = apply_filters( 'noo_property_settings_tabs_array', array(
				'general'=>__('General',NOO_TEXT_DOMAIN),
				'custom_field'=>__('Custom Fields',NOO_TEXT_DOMAIN),
				'feature'	=>__('Listings Features & Amenities',NOO_TEXT_DOMAIN),
				'advanced_search'	=>__('Advanced Search',NOO_TEXT_DOMAIN),
				'google_map'	=>__('Google Map',NOO_TEXT_DOMAIN)
			));
			
			?>
			<div class="wrap">
				<form action="options.php" method="post">
					<h2 class="nav-tab-wrapper">
						<?php
							foreach ( $tabs as $name => $label )
								echo '<a href="' . admin_url( 'edit.php?post_type=noo_property&page=noo-property-setting&tab=' . $name ) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
						?>
					</h2>
					<?php 
					do_action( 'noo_property_settings_' . $current_tab );
					?>
					<p class="submit">
						<input type="submit" value="<?php echo __('Save Changes',NOO_TEXT_DOMAIN) ?>" class="button button-primary" id="submit" name="submit">
					</p>
				</form>
			</div>			
			<?php
		}
		
		public function settings_general(){
			$currency_code_options = self::get_currencies();
			$archive_slug = self::get_general_option('archive_slug','properties');
			$area_unit = self::get_general_option('area_unit');
			$currency = self::get_general_option('currency');
			$currency_position = self::get_general_option('currency_position');
			$price_thousand_sep = self::get_general_option('price_thousand_sep');
			$price_decimal_sep = self::get_general_option('price_decimal_sep');
			$price_num_decimals = self::get_general_option('price_num_decimals');
			foreach ( $currency_code_options as $code => $name ) {
				$currency_code_options[ $code ] = $name . ' (' . self::get_currency_symbol( $code ) . ')';
			}
			?>
			<?php settings_fields('noo_property_general'); ?>
			<h3><?php echo __('General Options',NOO_TEXT_DOMAIN)?></h3>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php esc_html_e('Property Archive base (slug)',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" name="noo_property_general[archive_slug]" value="<?php echo ($archive_slug ? $archive_slug :'properties') ?>">
							<p><small><?php echo sprintf( __( 'If you made change on this opiton, you will have to go to <a href="%s" target="_blank">Permalink Settings</a><br/> and click "Save Changes" button for reseting WordPress link structure.', NOO_TEXT_DOMAIN ), admin_url( '/options-permalink.php' ) ); ?></small></p>
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Area Unit',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" name="noo_property_general[area_unit]" value="<?php echo ($area_unit ? $area_unit :'m') ?>">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Currency',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_general[currency]">
								<?php foreach ($currency_code_options as $key=>$label):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($currency,$key)?>><?php echo esc_html($label)?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Currency Position',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<?php 
							$position = array(
									'left'        => __( 'Left', NOO_TEXT_DOMAIN ) . ' (' . self::get_currency_symbol() . '99.99)',
									'right'       => __( 'Right', NOO_TEXT_DOMAIN ) . ' (99.99' . self::get_currency_symbol() . ')',
									'left_space'  => __( 'Left with space', NOO_TEXT_DOMAIN ) . ' (' . self::get_currency_symbol() . ' 99.99)',
									'right_space' => __( 'Right with space', NOO_TEXT_DOMAIN ) . ' (99.99 ' . self::get_currency_symbol() . ')'
							)
							?>
							<select name="noo_property_general[currency_position]">
								<?php foreach ($position as $key=>$label):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($currency_position,$key)?>><?php echo esc_html($label)?></option>
								<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Thousand Separator',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" name="noo_property_general[price_thousand_sep]" value="<?php echo ($price_thousand_sep ? $price_thousand_sep :',') ?>">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Decimal Separator',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" name="noo_property_general[price_decimal_sep]" value="<?php echo ($price_decimal_sep ? $price_decimal_sep :'.') ?>">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Number of Decimals',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="number" step="1" min="0" name="noo_property_general[price_num_decimals]" value="<?php echo ($price_num_decimals !=='' && $price_num_decimals !== null && $price_num_decimals !== array() ? $price_num_decimals :'2') ?>">
						</td>
					</tr>
				</tbody>
			</table>
			<?php
			}
		
		public function settings_custom_field(){
		
			$fields = self::get_custom_field_option('custom_field');
			?>
			<?php settings_fields('noo_property_custom_filed'); ?>
			<h3><?php echo __('Custom Fields',NOO_TEXT_DOMAIN)?></h3>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php esc_html_e('Fields',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<table class="widefat noo_property_custom_field_table" data-num="<?php echo count($fields)?>" cellspacing="0" >
								<thead>
									<tr>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Field Name',NOO_TEXT_DOMAIN)?>
										</th>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Field Label',NOO_TEXT_DOMAIN)?>
										</th>
										<?php /*?>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Field Type',NOO_TEXT_DOMAIN)?>
										</th>
										*/ ?>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Action',NOO_TEXT_DOMAIN)?>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php  if(!empty($fields)): ?>
									<?php foreach ($fields as $key=>$field):?>
									<tr>
										<td>
											<input type="text" value="<?php echo esc_attr($field['name'])?>" placeholder="<?php esc_attr_e('Field Name',NOO_TEXT_DOMAIN)?>" name="noo_property_custom_filed[custom_field][<?php echo $key?>][name]">
										</td>
										<td>
											<input type="text" value="<?php echo esc_attr($field['label'])?>" placeholder="<?php esc_attr_e('Field Label',NOO_TEXT_DOMAIN)?>" name="noo_property_custom_filed[custom_field][<?php echo $key?>][label]">
										</td>
										<?php /*?>
										<td>
											<?php $custom_field_type=apply_filters('noo_property_custom_field_type', array(
												'text'=>__('Short text',NOO_TEXT_DOMAIN),
												'textarea'	=>__('Long text',NOO_TEXT_DOMAIN),
												'date'		=>__('Date',NOO_TEXT_DOMAIN)
											));?>
											<select name="noo_property_custom_filed[custom_field][<?php echo $key?>][type]">
												<?php foreach ($custom_field_type as $value=>$type):?>
													<option value="<?php echo esc_attr($value)?>" <?php selected(@$field['type'],$value)?>><?php esc_html_e($type)?></option>
												<?php endforeach;?>
											</select>
										</td>
										*/ ?>
										<td>
											<input class="button button-primary" onclick="return delete_noo_property_custom_field(this);" type="button" value="<?php esc_attr_e('Delete',NOO_TEXT_DOMAIN)?>">
										</td>
									</tr>
									<?php endforeach;?>
									<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">
											<input class="button button-primary" id="add_noo_property_custom_field" type="button" value="<?php esc_attr_e('Add',NOO_TEXT_DOMAIN)?>">
										</td>
									</tr>
								</tfoot>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}
		public function settings_feature(){
		
			$features = self::get_feature_option('features');
			?>
			<?php settings_fields('noo_property_feature'); ?>
			<h3><?php echo __('Listings Features & Amenities',NOO_TEXT_DOMAIN)?></h3>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php esc_html_e('Add New Element in Features and Amenities ',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<table class="widefat noo_property_feature_table" cellspacing="0" >
								<thead>
									<tr>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Feature Name',NOO_TEXT_DOMAIN)?>
										</th>
										<th style="padding: 9px 7px">
											<?php esc_html_e('Action',NOO_TEXT_DOMAIN)?>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php  if(!empty($features)): ?>
									<?php foreach ($features as $k=>$feature):?>
									<tr>
										<td>
											<input type="text" value="<?php echo esc_attr($feature)?>" placeholder="<?php esc_attr_e('Feature Name',NOO_TEXT_DOMAIN)?>" name="noo_property_feature[features][]">
										</td>
										<td>
											<input class="button button-primary" onclick="return delete_noo_property_feature(this);" type="button" value="<?php esc_attr_e('Delete',NOO_TEXT_DOMAIN)?>">
										</td>
									</tr>
									<?php endforeach;?>
									<?php endif;?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2">
											<input class="button button-primary" id="add_noo_property_feature" type="button" value="<?php esc_attr_e('Add',NOO_TEXT_DOMAIN)?>">
										</td>
									</tr>
								</tfoot>
							</table>
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Show the Features and Amenities that are not available',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<?php $show_no_feature = self::get_feature_option('show_no_feature')?>
							<select name="noo_property_feature[show_no_feature]">
								<option <?php selected($show_no_feature,'yes')?> value="yes"><?php esc_html_e("Yes",NOO_TEXT_DOMAIN)?></option>
								<option <?php selected($show_no_feature,'no')?> value="no"><?php esc_html_e("No",NOO_TEXT_DOMAIN)?></option>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}
		
		public function settings_advanced_search(){
			$fields = array(
				''=>__('None'),
				'property_location'=>__('Property Location',NOO_TEXT_DOMAIN),
				'property_sub_location'=>__('Property Sub Location',NOO_TEXT_DOMAIN),
				'property_status'=>__('Property Status',NOO_TEXT_DOMAIN),
				'property_category'=>__('Property Types',NOO_TEXT_DOMAIN),
				/*'_bedrooms'=>__('Bedrooms Meta',NOO_TEXT_DOMAIN),
				'_bathrooms'=>__('Bathrooms Meta',NOO_TEXT_DOMAIN),*/
				'_price'=>__('Price Meta',NOO_TEXT_DOMAIN),
				'_area'=>__('Area Meta',NOO_TEXT_DOMAIN),
			);
			$custom_fields = self::get_custom_field_option('custom_field');
			if($custom_fields){
				foreach ($custom_fields as $k=>$custom_field){
					$label = __('Custom Field: ',NOO_TEXT_DOMAIN).(isset($custom_field['label']) ? $custom_field['label'] : $k);
					$id = '_noo_property_field_'.sanitize_title(@$custom_field['name']).'|'.(isset($custom_field['label']) ? $custom_field['label'] : $k);
					$fields[$id] = $label;
				}
			}
			$pos1 = self::get_advanced_search_option('pos1','property_location');
			$pos2 = self::get_advanced_search_option('pos2','property_sub_location');
			$pos3 = self::get_advanced_search_option('pos3','property_status');
			$pos4 = self::get_advanced_search_option('pos4','property_category');
			/*$pos5 = self::get_advanced_search_option('pos5','_bedrooms');
			$pos6 = self::get_advanced_search_option('pos6','_bathrooms');*/
			$pos7 = self::get_advanced_search_option('pos7','_price');
			$pos8 = self::get_advanced_search_option('pos8','_area');
			
			wp_enqueue_style('vendor-chosen-css');
			wp_enqueue_script('vendor-chosen-js');
			
		?>
			<?php settings_fields('noo_property_advanced_search'); ?>
			<h3><?php echo __('Search Field Position',NOO_TEXT_DOMAIN)?></h3>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php _e('Position #1',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos1]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos1,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #2',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos2]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos2,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #3',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos3]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos3,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #4',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos4]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos4,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #5',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos5]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos5,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #6',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos6]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos6,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #7',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos7]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos7,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<?php _e('Position #8',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select name="noo_property_advanced_search[pos8]">
							<?php foreach ($fields as $key=>$field):?>
								<option value="<?php echo esc_attr($key)?>" <?php selected($pos8,esc_attr($key))?>><?php echo $field?></option>
							<?php endforeach;?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<h3><?php echo __('Advanced Search Field',NOO_TEXT_DOMAIN)?></h3>
			<?php 
			$features = self::get_feature_option('features');
			$feature_selected = self::get_advanced_search_option('advanced_search_field',array());
			?>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php _e('Select Advanced Search Field',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<select class="advanced_search_field" name="noo_property_advanced_search[advanced_search_field][]" multiple="multiple">
							<?php if($features):?>
								<?php foreach ((array)$features as $key=>$feature):?>
									<?php 
									$field_id = sanitize_title($feature);
									?>
									<option value="<?php echo esc_attr($field_id)?>" <?php if(in_array($field_id, $feature_selected)):?> selected<?php endif;?>><?php echo ucfirst($feature)?></option>
								<?php endforeach;?>
							<?php endif;?>
							</select>
							<script type="text/javascript">
								jQuery(document).ready(function(){
									jQuery("select.advanced_search_field").chosen({
										"disable_search_threshold":10
									});
								});
							</script>
							<style type="text/css">
							.chosen-container input[type="text"]{
								height: auto !important;
							}
							</style>
						</td>
					</tr>
				</tbody>
			</table>
		<?php
		}
		public function settings_google_map(){
		?>
			<?php settings_fields('noo_property_google_map'); ?>
			<h3><?php echo __('Google Map',NOO_TEXT_DOMAIN)?></h3>
			<table class="form-table" cellspacing="0">
				<tbody>
					<tr>
						<th>
							<?php esc_html_e('Starting Point Latitude',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" class="regular-text" value="<?php echo self::get_google_map_option('latitude','40.714398')?>" name="noo_property_google_map[latitude]">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Starting Point Longitude',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" class="regular-text"  value="<?php echo self::get_google_map_option('longitude','-74.005279')?>" name="noo_property_google_map[longitude]">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Default Zoom Level',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="text" class="regular-text"  value="<?php echo self::get_google_map_option('zoom','12')?>" name="noo_property_google_map[zoom]">
						</td>
					</tr>
					<tr>
						<th>
							<?php esc_html_e('Automatically Fit all Properties',NOO_TEXT_DOMAIN)?>
						</th>
						<td>
							<input type="hidden" value="0" name="noo_property_google_map[fitbounds]">
							<input type="checkbox" value="1" <?php checked(self::get_google_map_option('fitbounds','1'), '1'); ?> name="noo_property_google_map[fitbounds]">
							<small><?php _e('Enable this option and all your listings will fit into your map automatically. Sometimes, the above options will be disregarded.', NOO_TEXT_DOMAIN); ?></small>
						</td>
					</tr>
				</tbody>
			</table>
			<?php
		}
		
		public function property_slider_shortcode ( $atts, $content = null ) {
			wp_enqueue_script('noo-property-map');
			wp_enqueue_script('noo-property');
			extract( shortcode_atts( array(
			'visibility'         => '',
			'class'              => '',
			'id'                 => '',
			'custom_style'       => '',
			'animation'          => 'slide',
			'visible_items'      => '1',
			'slider_time'        => '3000',
			'slider_speed'       => '600',
			'auto_play'          => '',
			'indicator'          => '',
			'prev_next_control'  => '',
			'show_search_form'   => '',
			'advanced_search'    => '',
			'show_search_info'   => '',
			), $atts ) );
		
			wp_enqueue_script( 'vendor-carouFredSel' );
		
			$show_search_form = ( $show_search_form == 'true' );
			$show_search_info = $show_search_form ? ( $show_search_info == 'true' ) : false;
			$class            = ( $class              != '' ) ? esc_attr( $class ) : '' ;
			$visibility       = ( $visibility         != '' ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
			switch ($visibility) {
				case 'hidden-phone':
					$class .= ' hidden-xs';
					break;
				case 'hidden-tablet':
					$class .= ' hidden-sm hidden-md';
					break;
				case 'hidden-pc':
					$class .= ' hidden-lg';
					break;
				case 'visible-phone':
					$class .= ' visible-xs-block visible-xs-inline visible-xs-inline-block';
					break;
				case 'visible-tablet':
					$class .= ' visible-sm-block visible-sm-inline visible-sm-inline-block visible-md-block visible-md-inline visible-md-inline-block';
					break;
				case 'visible-phone':
					$class .= ' visible-lg-block visible-lg-inline visible-lg-inline-block';
					break;
			}
		
		
			$html  = array();
		
			$id    = ( $id    != '' ) ? esc_attr( $id ) : 'noo-slider-' . noo_vc_elements_id_increment();
			
			$class .=' property-slider';
			
			$class = ( $class != '' ) ? 'class="' . $class . '"' : '';
			$custom_style   = ( $custom_style  != '' ) ? 'style="' . $custom_style . '"' : '';
		
			$indicator_html = array();
			$indicator_js   = array();
			if( $indicator == 'true') {
				$indicator_js[] = '    pagination: {';
				$indicator_js[] = '      container: "#' . $id . '-pagination"';
				$indicator_js[] = '    },';
		
				$indicator_html[] = '  <div id="' . $id . '-pagination" class="slider-indicators"></div>';
			}
		
			$prev_next_control_html = array();
			$prev_next_control_js   = array();
			if( $prev_next_control == 'true') {
				$prev_next_control_js[]   = '    prev: {';
				$prev_next_control_js[]   = '      button: "#' . $id . '-prev"';
				$prev_next_control_js[]   = '    },';
				$prev_next_control_js[]   = '    next: {';
				$prev_next_control_js[]   = '      button: "#' . $id . '-next"';
				$prev_next_control_js[]   = '    },';
		
				$prev_next_control_html[] = '  <a id="' . $id . '-prev" class="slider-control prev-btn" role="button" href="#"><span class="slider-icon-prev"></span></a>';
				$prev_next_control_html[] = '  <a id="' . $id . '-next" class="slider-control next-btn" role="button" href="#"><span class="slider-icon-next"></span></a>';
			}
		
			$swipe  = $pause_on_hover = 'true';
			$animation = ( $animation == 'slide' ) ? 'scroll' : $animation; // Not allow fading with carousel
		
		
			$html[] = '<div '.$class.' '.$custom_style.'>';
			$html[] = "<div id=\"{$id}\" class=\"noo-slider noo-property-slide-wrap\">";
			$html[] = '  <ul class="sliders">';
			$html[] = do_shortcode( $content );
			$html[] = '  </ul>';
			$html[] = '  <div class="clearfix"></div>';
			$html[] = implode( "\n", $indicator_html );
			$html[] = implode( "\n", $prev_next_control_html );
			$html[] = '</div>';
			if( $show_search_form ) {
				ob_start();
				self::advanced_map(false,'',false,'',$show_search_info,false,'property',false,!!$advanced_search);
				$html[] = ob_get_clean();
			}
			$html[] = '</div>';
		
			// slider script
			$html[] = '<script>';
			$html[] = "jQuery('document').ready(function ($) {";
			$html[] = "  $('#{$id} .sliders').carouFredSel({";
			$html[] = "    infinite: true,";
			$html[] = "    circular: true,";
			$html[] = "    responsive: true,";
			$html[] = "    debug : false,";
			$html[] = '    scroll: {';
			$html[] = '      items: 1,';
			$html[] = ( $slider_speed   != ''         ) ? '      duration: ' . $slider_speed . ',' : '';
			$html[] = ( $pause_on_hover == 'true'     ) ? '      pauseOnHover: "resume",' : '';
			$html[] = '      fx: "' . $animation . '"';
			$html[] = '    },';
			$html[] = '    auto: {';
			$html[] = ( $slider_time    != ''     ) ? '      timeoutDuration: ' . $slider_time . ',' : '';
			$html[] = ( $auto_play      == 'true' ) ? '      play: true' : '      play: false';
			$html[] = '    },';
			$html[] = implode( "\n", $prev_next_control_js );
			$html[] = implode( "\n", $indicator_js );
			$html[] = '    swipe: {';
			$html[] = "      onTouch: {$swipe},";
			$html[] = "      onMouse: {$swipe}";
			$html[] = '    }';
			$html[] = '  });';
			$html[] = '});';
			$html[] = '</script>';
		
			return implode( "\n", $html );
		}
		
		public function property_slide_shortcode($atts, $content = null){
			extract( shortcode_atts( array(
				'property_id'=>'',
				'background_type'=>'thumbnail',
				'image'=>'',
				
			), $atts ) );
			if(empty($property_id))
				return '';
				
			
			$property = get_post($property_id);
			if(empty($property))
				return '';
			
			$output = '';
			$output .='<li class="slide-item noo-property-slide">';
			if($background_type == 'thumbnail'){
				//$thumbnail = wp_get_attachment_url(get_post_thumbnail_id($property->ID));
				$output .= get_the_post_thumbnail($property->ID,'property-slider');
				//$output .='<img class="slide-image" src="' . $thumbnail . '">';
			}elseif ($background_type == 'image' && !empty($image)){
				$thumbnail = wp_get_attachment_url($image);
				$output .='<img class="slide-image" src="' . $thumbnail . '">';
			}
			$output .='<div class="slide-caption">';
			$output .='<div class="slide-caption-info">';
			$output .='<h3><a href="'.esc_url(get_the_permalink($property->ID)).'">'.get_the_title($property->ID).'</a>';
			if($address=noo_get_post_meta($property->ID,'_address')){
				$output .='<small>'.$address.'</small>';
			}
			$output .='</h3>';
			$output .='<div class="info-summary">';
			$output .='<div class="size"><span>'.self::get_area_html($property->ID).'</span></div>';
			/*$output .='<div class="bathrooms"><span>'.noo_get_post_meta($property->ID,'_bathrooms').'</span></div>'; 
			$output .='<div class="bedrooms"><span>'.noo_get_post_meta($property->ID,'_bedrooms').'</span></div>';*/
			$output .='<div class="property-price">';
			$output .='<span>'.NooProperty::get_price_html($property->ID).'</span>';
			$output .='</div>';
			$output .='</div>';
			$output .='</div>';
			$output .='<div class="slide-caption-action">';
			$output .='<a href="'.esc_url(get_the_permalink($property->ID)).'">'.__('More Details',NOO_TEXT_DOMAIN).'</a>';
			$output .='</div>';
			$output .='</div>';
			$output .='</li>';
			return $output;
		}
		public function advanced_search_property_shortcode($atts, $content = null){
			wp_enqueue_script('noo-property-map');
			extract( shortcode_atts( array(
				'title'                     => '',
				'source'					=> 'property',
				'style'                     => 'horizontal',
				'disable_map'               => '',
				'disable_search_form'		=> '',
				'advanced_search'           => '',
				'no_search_container'       => '',
				'visibility'                => '',
				'class'                     => '',
				'custom_style'              => ''
			), $atts ) );
			$show_advanced_search_field = ($style == 'horizontal') ? !!$advanced_search : false;
			$disable_map          = ( $disable_map == 'true' );
			$no_search_container  = $disable_map ? ( $no_search_container == 'true' ) : false;
			if( $source == 'IDX' ) {
				$disable_search_form 