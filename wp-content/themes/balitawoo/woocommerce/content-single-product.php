<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>




<div class="container">
<div class="row">
<div class="content-area has-sidebar" id="primary">
	<div id="content" class="site-content page-product">
			<?php woocommerce_breadcrumb(); ?>
			<?php
				/**
				 * woocommerce_before_single_product hook
				 *
				 * @hooked woocommerce_show_messages - 10
				 */
				 do_action( 'woocommerce_before_single_product' );
			?>
<!-- <div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>> -->
	<div class="produkimg">
		<?php
			/**
			 * woocommerce_show_product_images hook
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
		?>

	</div>

	<div class="produktxt clearfix">
		<div class="clearfix"><h2><?php the_title(); ?></h2></div>
		<div class="clearfix"><h4 class="price"><?php woocommerce_template_single_price(); ?></h4></div>
		<?php woocommerce_template_single_excerpt(); ?>



	<!-- </div> --><!-- .summary -->
		<div class="product-right">
			<div class="summary">

				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
								
			</div><!-- /.summary --> 
			
		</div>
	</div>
	<div class="clear"></div>
<?php woocommerce_output_product_data_tabs(); ?>

		<?php woocommerce_output_related_products(); ?>
	<div class="clear"></div>
		<?php woocommerce_upsell_display(); ?>

	<div class="clear"></div>

	
	</div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
<?php woocommerce_get_sidebar(); ?>
</div>
</div>