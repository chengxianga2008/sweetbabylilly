<?php
	// Loads the header.php template.
	get_header(); 
?>
	<div class="container">
	<div class="content-area has-sidebar" id="primary">
		<!-- Kalo ada sidebarnya tambahin class .has-sidebar -->
		<div id="content" class="site-content page-blog">
			
			<?php get_template_part( 'breadcrumbs' ); ?>
			
			<?php if ( is_singular() ) { ?>
			
				<?php hybrid_get_content_template(); // Loads the content template. ?>
			
			<?php
				// Loads the comments.php template.
				if ( comments_open() ) comments_template( '/comments.php', true ); 
			?>
			
			<?php }else{
				
				$home_cat_obj = get_category_by_slug("home-post");
					
				$query = new WP_Query( array( 'cat' => "-$home_cat_obj->term_id",  ) );
					
				if ( $query->have_posts() ) : ?>
				
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
								
						<?php hybrid_get_content_template(); // Loads the content template. ?>
				
					<?php endwhile; ?>
				
				<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>
				
						<?php get_template_part( 'no-results' ); ?>
				
				<?php endif; ?>
				
				
				<?php loop_pagination(); ?>
			
			<?php }?>
			
		</div><!-- #content .site-content -->
	</div>
	
	<?php get_sidebar( 'primary' ); ?>
	
	<div class="clear">
	</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>