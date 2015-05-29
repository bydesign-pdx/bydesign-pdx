<?php 
$noo_property_detail_map = noo_get_option('noo_property_detail_map',0);
?>
<?php get_header(); ?>
<div class="container-wrap">
	<?php if(!empty($noo_property_detail_map)):?>
	<?php echo do_shortcode('[noo_advanced_search_property style="'.noo_get_option('noo_property_detail_map_layout','horizontal').'"]');?>
	<?php endif;?>
	<div class="main-content container-boxed max offset">
		<div class="row">
			<div class="<?php noo_main_class(); ?>" role="main">
				<?php NooProperty::display_detail()?>
			</div>
			<?php get_sidebar(); ?>
		</div> <!-- /.row -->
	
	</div> <!-- /.container-boxed.max.offset -->
</div>
<?php get_footer(); ?>