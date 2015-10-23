<?php @header( 'HTTP/1.1 404 Not found', true, 404 );

// Loads the header.php template.
get_header(); 
?>
	<div class="content-area has-sidebar" id="primary">

		<div id="content" class="site-content page-blog">
			<?php get_template_part( 'breadcrumbs' ); ?>
			
			<?php 
				// Loads the content-404.php template.
				get_template_part( 'content', '404' ); 
			?>
			
		</div><!-- #content .site-content -->

	</div><!-- #primary .content-area .has-sidebar -->

	<?php get_sidebar( 'primary' ); ?>

	<div class="clear">
	</div>

</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>