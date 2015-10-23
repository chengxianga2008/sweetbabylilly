<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Archive
 *
 * Description: A Page Template for displaying archives
 *
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */
	// Loads the header.php template.
	get_header();
	//query_posts('post_type=post');
?>

	<div class="content-area has-sidebar" id="primary">
		<!-- Kalo ada sidebarnya tambahin class .has-sidebar -->
		<div id="content" class="site-content page-archive">
			<?php get_template_part( 'breadcrumbs' ); ?>
			<h2><?php _e('Archive','balitawoo') ?></h2>
			<h3><?php _e('The last','balitawoo'); ?> <?php echo get_option( 'posts_per_page' ); ?> <?php _e('posts','balitawoo'); ?></h3>
			
			<?php if ( have_posts() ) : ?>
				<ul>
				<?php while ( have_posts() ) : the_post(); ?>
					<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php the_time(get_option('date_format')); ?> - <a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></a>
					</li>
				<?php endwhile; ?>
				</ul>
			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results' ); ?>

			<?php endif; ?>
			
			<?php
				$args = array(
				'type'                     => 'post',
				'orderby'                  => 'count',
				'order'                    => 'DESC',
				'hide_empty'               => 1,
				'hierarchical'             => 0,
				'number'                   => 5,
				'taxonomy'                 => 'category',
				'pad_counts'               => false );
				$categories = get_categories( $args );
			?>
			<div class="col">
				<h3><?php _e( 'Categories', 'balitawoo' ); ?></h3>
				<ul>
					<?php foreach( $categories as $category ) { ?>
					<li><a href="<?php echo home_url( '/category/'.$category->slug ); ?>"><?php echo $category->cat_name; ?></a> (<?php echo $category->count; ?>)</li>
					<?php } ?>
				</ul>
			</div>
			<?php
				$args = array(
				'type'            => 'monthly',
				'limit'           => 5,
				'format'          => 'html', 
				'before'          => '',
				'after'           => '',
				'show_post_count' => true,
				'echo'            => 1,
				'order'           => 'DESC');

			?>
			<div class="col col2">
				<h3><?php _e('Monthly Archive','balitawoo'); ?></h3>
				<ul>
					<?php wp_get_archives( $args ); ?>
				</ul>
			</div>
			<div class="clear"></div>

		</div><!-- #content .site-content -->
	</div>
	<?php get_template_part( 'sidebar', 'primary' ); ?>
	<div class="clear">
	</div>

<div>
	
	
</div><!-- #primary .content-area .has-sidebar -->

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>