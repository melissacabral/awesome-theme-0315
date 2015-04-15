<?php
//required for auto embeds
if ( ! isset( $content_width ) ) $content_width = 694;

//required for good Comment UX
add_action('wp_enqueue_scripts', 'awesome_scripts' );
function awesome_scripts(){
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}

//required since 4.1
add_theme_support( 'title-tag' );

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

//allows you to style the editor window with editor-style.css
add_editor_style();

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

/**
 * Add Widget Areas (Dynamic Sidebars)
 */
add_action( 'widgets_init', 'awesome_widget_areas' );
function awesome_widget_areas(){
	register_sidebar( array(
		'name' 			=> 'Blog Sidebar',
		'id'			=> 'blog_sidebar',
		'description' 	=> 'Appears alongside all blog and archive pages',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Home Area',
		'id'			=> 'home_area',
		'description' 	=> 'Appears in the middle of the home page content',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Page Sidebar',
		'id'			=> 'page_sidebar',
		'description' 	=> 'Appears alongside all pages',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
	register_sidebar( array(
		'name' 			=> 'Footer Area',
		'id'			=> 'footer_area',
		'description' 	=> 'Appears at the bottom of everything',
		'before_widget'	=> '<section class="widget %2$s" id="%1$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
}

/**
 * Display a set of products with thumbnail images
 * @param int $number - the number of posts to show
 */
function awesome_show_products( $number = 4 ){
	//custom query to get up to 6 recent products
	$products_query = new WP_Query( array(
		'post_type' 		=> 'product', //we registered this in our products plugin
		'posts_per_page' 	=> $number,
	) );
	//custom loop
	if( $products_query->have_posts() ):
	 ?>
	<section class="latest-products">
		<h2>Newest Products in the shop:</h2>
		<ul>
			<?php while( $products_query->have_posts() ):
				$products_query->the_post();
			 ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<div class="product-info">
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</a>
			</li>
			<?php endwhile; ?>
		</ul>
	</section>
	<?php 
	endif; //custom loop 
	//prevent clashing with other loops
	wp_reset_postdata();
}//end of function



/**
 * Exclude a specific category from the blog loop
 * Example of how to use pre_get_posts
 */
//add_action( 'pre_get_posts', 'awesome_hide_category' );
function awesome_hide_category( $query ){
	//only if on the main query on the blog
	if( $query->is_home()  ):
		$query->set( 'cat', '-1' );
	endif;
}
//no close PHP!