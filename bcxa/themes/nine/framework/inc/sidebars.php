<?php

/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */

if (function_exists('register_sidebar')) {
	
	/* ------------------------------------------------------------------------ */
	/* Blog Widgets */

	register_sidebar(array(
		'name' => __('Blog Widgets','moutheme-framework' ),
		'id'   => 'blog-widgets',
		'description'   => __( 'These are widgets for the Blog sidebar.','moutheme-framework' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>'
	));
	
	/* ------------------------------------------------------------------------ */
	/* Footer Widgets */
	
	register_sidebar(array(
		'name' => 'Footer Sidebar Column 1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Sidebar Column 2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Sidebar Column 3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Footer Sidebar Column 4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

}
    
?>