<?php global $smof_data; ?>
<!-- Footer -->
<footer id="footer"><?php
	if(isset($smof_data['check_footer_widgets']) && $smof_data['check_footer_widgets'] == true) { ?>
		<div class="container">
			<div class="row<?php if($smof_data['first_col_accent'] == true) echo " accent-col"; ?>"><?php
				// Footer Widgets
				if($smof_data['footer_column_one'] != 'disabled') {
					$column_width = footer_column_width( $smof_data['footer_column_one'] );
					echo('<div class="' . $column_width . '">');
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar Column 1'));
					echo('</div>');
				}
				if($smof_data['footer_column_two'] != 'disabled') {
					$column_width = footer_column_width( $smof_data['footer_column_one'] );
					echo('<div class="' . $column_width . '">');
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar Column 2'));
					echo('</div>');
				}
				if($smof_data['footer_column_three'] != 'disabled') {
					$column_width = footer_column_width( $smof_data['footer_column_one'] );
					echo('<div class="' . $column_width . '">');
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar Column 3'));
					echo('</div>');
				}
				if($smof_data['footer_column_four'] != 'disabled') {
					$column_width = footer_column_width( $smof_data['footer_column_one'] );
					echo('<div class="' . $column_width . ' last">');
						if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Sidebar Column 4'));
					echo('</div>');
				} ?>
			</div>
		</div><?php
	} ?>
	<section id="copyright">
		<div class="container">
			<nav><?php
				wp_nav_menu(array(
					'theme_location' => 'footer_navigation'
				)); ?>
			</nav><?php					
			if(isset($smof_data['textarea_copyright']) && $smof_data['textarea_copyright'] != "") { ?>
				<div><?php echo $smof_data['textarea_copyright']; ?></div><?php
			} ?>
		</div>
	</section>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>