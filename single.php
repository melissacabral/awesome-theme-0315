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

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<div class="gallery slides">
			<?php
			$attachments = get_attached_media( 'image', $post->ID );

			foreach($attachments as $attachment) {
				$img_full = wp_get_attachment_url($attachment->ID);
				$img = wp_get_attachment_image_src($attachment->ID, 'large');
    			//Now you can output any HTML you want to make it work
				if($img !== false) :
					?>
					<a href="<?php echo $img_full; ?>" title="<?php echo $attachment->post_title; ?>" target="_blank"><img src="<?php echo $img[0]; ?>" /></a>
					<?php
				endif; //image exists
			}//end foreach
			?>
		</div>

		<div class="postmeta"> 
			<span class="author"> Posted by: <?php the_author(); ?></span>
			<span class="date"><a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></span>
			<span class="num-comments"> <?php comments_number(); ?></span>
			<span class="categories"><?php the_category(); ?></span>
			<span class="tags"><?php the_tags(); ?></span> 
		</div><!-- end postmeta -->	

	</article><!-- end post -->

	<?php comments_template(); ?>

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