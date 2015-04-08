<?php get_header(); //include header.php ?>

<?php 
/**
 * The template that is used on Individual blog posts and attachments
 * @since  0.1
 * @author  Melissa <mcabral@platt.edu>
 */
 ?>
<main id="content">
	<?php //THE LOOP
		if( have_posts() ): ?>
		<?php while( have_posts() ): the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
			
			<h2 class="entry-title"> 
				<a href="<?php the_permalink(); ?>"> 
					<?php the_title(); ?> 
				</a>
			</h2>

			<?php the_post_thumbnail( 'large', array( 'class' => 'product-image' ) ); ?>

			<div class="entry-content">
				<?php the_meta(); /* list of ALL custom fields */ ?>

				<?php the_content(); ?>
			</div>

			
				
		</article><!-- end post -->


		<?php endwhile; ?>

		<div class="pagination">
			<?php 			
			previous_post_link( '%link', '&larr; Earlier: %title' );
			next_post_link( '%link', 'Later: %title &rarr;' );
			?>
		</div>

	<?php else: ?>

	<h2>Sorry, no posts found</h2>
	<p>Try using the search bar instead</p>

	<?php endif;  //end THE LOOP ?>

</main><!-- end #content -->

<?php get_sidebar(); //include sidebar.php ?>
<?php get_footer(); //include footer.php ?>