<?php
/**
*
* Setup OCS theme
*/
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/post-types/post-types.php';
require get_template_directory() . '/inc/post-types/block-meta.php';

//SHORTCODES
require get_template_directory() . '/inc/shortcodes/block.php';
require get_template_directory() . '/inc/shortcodes/slider.php';

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Premese Options',
		'menu_title'	=> 'Premese Options',
		'menu_slug' 	=> 'premese-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Core Values',
		'menu_title'	=> 'Core Values',
		'parent_slug'	=> 'premese-options',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'FAQS',
		'menu_title'	=> 'FAQS',
		'parent_slug'	=> 'premese-options',
	));
}
