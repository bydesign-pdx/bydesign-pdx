<?php
	if ( ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4'  ) )
		return;
?>

<footer id="main-footer">
	<div id="footer-widgets" class="clearfix">
<?php
	$footer_sidebars = array( 'sidebar-2', 'sidebar-3', 'sidebar-4' );
	foreach ( $footer_sidebars as $key => $footer_sidebar ){
		if ( is_active_sidebar( $footer_sidebar ) ) {
			echo '<div class="footer-widget' . (  2 == $key ? ' last' : '' ) . '">';
			dynamic_sidebar( $footer_sidebar );
			echo '</div> <!-- end .footer-widget -->';
		}
	}
?>

<div class="footer-widget last"><div id="mlcalc" class="fwidget widget_mlcalc"><h4 class="widgettitle">Calculator</h4>
<div id="tabs">
<ul id="tab-nav">
<li><a href="#loan">Loan</a></li>

<li><a href="#mortgage">Mortgage</a></li>


</ul>


 <div class="calculator" id="loan">
      <?php echo do_shortcode('[mlcalc default="loan_only" size="wide" price="300,000" down="10" mterm="30" rate="4.5" tax="3,000" insurance="1,500" pmi="0.52" language="en"]');
 ?>
 </div>
 <div class="calculator" id="mortgage">
      <?php echo do_shortcode('[mlcalc default="mortgage_only" size="wide" price="300,000" down="10" mterm="30" rate="4.5" tax="3,000" insurance="1,500" pmi="0.52" language="en"]');
 ?>
 </div>
 </div>
      </div>
      </div>
      
      
      
	</div> <!-- end #footer-widgets -->
</footer> <!-- #main-footer -->