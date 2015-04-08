<?php get_header(); //include header.php ?>

<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			
			<?php 
			//show the featured image
			the_post_thumbnail( 'thumbnail', array( 'class' => 'thumb clearfix' ) );  
			?>

			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>		

			<div class="entry-content">
				<?php 
				if( is_singular() ):
					the_content(); 
				else:
					the_excerpt();
				endif;
				?>
				
				<?php //get the price custom field
				$price = get_post_meta( $post->ID, 'price', true ); 
				//check to make sure there is a price to show
				if( $price ):
				?>
				<span class="product-price"><?php echo $price; ?></span>
				<?php endif; //price ?>
			</div>
					
		</article><!-- end post -->

		<?php endwhile; ?>

		<div class="pagination">
			<?php 
			//check to see if pagenavi plugin is running
			if(function_exists('wp_pagenavi') && !wp_is_mobile()):
				wp_pagenavi();
			else:
				previous_posts_link('&larr; Newer Posts');
				next_posts_link('Older Posts &rarr;');
			endif;
			?>
		</div>


	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>