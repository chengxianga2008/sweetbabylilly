<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );


// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array('product');
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';

$classes[] = 'item';
$classes[] = 'grid-item';
?>

	<div <?php post_class( $classes ); ?>> 
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
			<a class="custom-product-img" href="<?php the_permalink()?>">
				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			</a>
			
			<?php 
			$title_str = get_the_title();
			$truncated = strlen($title_str) > 50 ? substr($title_str,0,50)."..." : $title_str;
			?>
			<h4 class="custom-product-title" >
				<a href="<?php the_permalink()?>" data-toggle="tooltip" title="<?php the_title();?>"><?php echo $truncated; ?>
				</a>
			</h4>
			<p>
				<strong>	
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				</strong>
			</p>
		
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
