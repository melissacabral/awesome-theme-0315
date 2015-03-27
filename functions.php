<?php
//use this file for custom functions and activating 'sleeping' wordpress features
//allow you to attach a "featured image" to each post or page
add_theme_support('post-thumbnails');
add_theme_support( 'post-formats', array( 'audio', 'video', 'image', 'quote' ) );
add_theme_support( 'custom-background' );
//don't forget to display the custom header in header.php
// add_theme_support( 'custom-header', array( 
// 					'width' => 200,
// 					'height' => 100,
// 				 ) );

//activated html5 forms - better for mobile devices				 
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'comment-list' ) );

//add <link> elements in the head to your feeds
add_theme_support('automatic-feed-links' );

add_image_size( 'big-banner', 1300, 300, true );

/**
 * Improve Excerpts - change the length and annoying [...]
 */
function awesome_ex_length(){
	//uses user agent strings to detect a "mobile" device
	if(wp_is_mobile()){
		return 10;
	}else{
		return 70;
	}
}
add_filter( 'excerpt_length', 'awesome_ex_length' );

function awesome_readmore(){
	return ' <a href="' . get_permalink() . '" class="readmore">Read More</a>';
}
add_filter( 'excerpt_more', 'awesome_readmore' );


/**
 * Menu Areas
 * Registers two menu areas
 * display them in your theme with wp_nav_menu
 */
add_action( 'init', 'awesome_menus' );
function awesome_menus(){
	register_nav_menus( array(
		//'code_name' 	=> 'Human Readable',
		'main_nav' 		=> 'Main Navigation Area',
		'utilities' 	=> 'Utility and Social Icons',
	) );
}











//no close PHP!