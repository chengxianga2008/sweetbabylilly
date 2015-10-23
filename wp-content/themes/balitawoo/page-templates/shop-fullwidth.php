<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Shop Fullwidth
 *
 * Description: A Page Template for Shop Fullwidth
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */
get_header('shop');?>
	
<?php get_template_part( 'contents', 'slider' ); ?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', false ) ) : ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

	<div class="content-area <?php tokokoo_dynamic_sidebar_class(); ?>" id="primary">
		<div id="content" class="site-content page-product">
			<?php woocommerce_breadcrumb(); ?>

			<?php 
				$temp = $wp_query;
				$per_page = get_option( 'posts_per_page' );
				$wp_query = null; 
				$wp_query = new WP_Query(); 
				$wp_query->query( 'showposts=' . $per_page . '&paged='.$paged . '&post_type=product' . '&post_status=publish' );

				if ( $wp_query->have_posts() ) :

					woocommerce_product_loop_start();

					while ( $wp_query->have_posts() ) : $wp_query->the_post();

						wc_get_template_part( 'content', 'product' ); 

					endwhile; // end of the loop.

					woocommerce_product_loop_end();?>
		
					<div class="clear"></div>

					<?php
						/**
						 * woocommerce_after_shop_loop hook
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					?>

				<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

				<?php wc_get_template( 'loop/no-products-found.php' ); ?>

				<?php endif; ?>

				<?php 
					$wp_query = null; 
					$wp_query = $temp;  // Reset */
				?>

		</div>
	</div>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

<?php get_footer(); ?>

