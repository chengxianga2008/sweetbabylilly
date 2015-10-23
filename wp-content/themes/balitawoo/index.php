<?php
	// Loads the header.php template.
	get_header(); 
?>

	<div class="content-area has-sidebar" id="primary">
		<!-- Kalo ada sidebarnya tambahin class .has-sidebar -->
		<div id="content" class="site-content page-blog">
			<?php get_template_part( 'breadcrumbs' ); ?>
			
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php hybrid_get_content_template(); // Loads the content template. ?>

					<?php if ( is_singular() ) { ?>

						<?php
							// Loads the comments.php template.
							if ( comments_open() ) comments_template( '/comments.php', true ); 
						?>

					<?php } ?>

				<?php endwhile; ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results' ); ?>

			<?php endif; ?>


			<?php loop_pagination(); ?>
			
		</div><!-- #content .site-content -->
	</div>
	
	<?php get_sidebar( 'primary' ); ?>
	
	<div class="clear">
	</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>