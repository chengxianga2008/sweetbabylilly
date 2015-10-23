<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Blog 2 column
 *
 * Description: A Page Template for displaying blog
 *
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */
get_header();


?>
<?php query_posts('post_type=post') ?>
<div class="site-main" id="main">
	<div class="content-area no-sidebar two-column" id="primary">
		<!-- Kalo ada sidebarnya tambahin class .has-sidebar -->
		<div id="content" class="site-content page-blog">
			
			<?php if ( have_posts() ) : ?>
				<?php
					$posts_per_page = get_option( 'posts_per_page' ); 
					$counter = 0;
					$postfull = false;
				?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php if ( 1 == $counter ): ?>
						<div class="postleft">
					<?php elseif ( ($posts_per_page/2)+1 == $counter ): ?>
						</div>
						<div class="postright">
					<?php endif; ?>

					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); $counter++; ?>

				<?php endwhile; ?>

				</div><!-- end postright -->
				<div class="clear"></div>
				<?php
				  $nonce = wp_create_nonce("ajaxify_load_post_nonce");
				  $link = admin_url('admin-ajax.php?action=ajaxify_load_post&page=2&nonce='.$nonce);
				?>
				<div class="loadmore" ><a data-nonce="<?php echo $nonce; ?>" data-page="2" href="<?php echo $link; ?>"><?php _e('Load More Posts','balitawoo') ?></a></div>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results' ); ?>

			<?php endif; ?>
			
		</div><!-- #content .site-content -->
	</div>
</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>