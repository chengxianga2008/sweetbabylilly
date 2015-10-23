<?php
/**
 * Portfolip post type & shortcode function.
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Shortcode to display the portfolio. */
add_shortcode( 'koo-portfolio-recent', 'tokokoo_portfolio_shortcode_recent' );
add_shortcode( 'koo-portfolio-random', 'tokokoo_portfolio_shortcode_random' );

/**
 * Recent Portfolio shortcode.
 *
 * @since 1.0
 */
function tokokoo_portfolio_shortcode_recent( $atts ) {

	extract( shortcode_atts( array(
		'per_page'  => '12',
		'orderby' => 'date',
		'order' => 'desc',
		'image_size' => 'thumbnail'
	), $atts ) );

	$args = array(
		'post_type'	=> 'portfolio',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $per_page,
		'orderby' => $orderby,
		'order' => $order
	);

	ob_start();

	$portfolio = new WP_Query( $args );

	if ( $portfolio->have_posts() ) : 

		tokokoo_portfolio_markup( $portfolio, $image_size );

	endif;

	wp_reset_postdata();

	$output = ob_get_clean();

	return $output;

}


/**
 * Random Portfolio shortcode.
 *
 * @since 1.0
 */
function tokokoo_portfolio_shortcode_random( $atts ) {

	extract( shortcode_atts( array(
		'per_page'  => '12',
		'image_size' => 'thumbnail'
	), $atts ) );

	$args = array(
		'post_type'	=> 'portfolio',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'posts_per_page' => $per_page,
		'orderby' => 'rand'
	);

	ob_start();

	$portfolio = new WP_Query( $args );

	if ( $portfolio->have_posts() ) : 

		tokokoo_portfolio_markup( $portfolio, $image_size );

	endif;

	wp_reset_postdata();

	$output = ob_get_clean();

	return $output;

}


/**
 * Portfolio Markup; ready to be overriden in theme
 *
 * @since 1.0
 */
if ( ! function_exists( 'tokokoo_portfolio_markup' ) ):

	function tokokoo_portfolio_markup( $portfolio, $image_size ) {

	?>

		<ul class="portfolios">

			<?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
							
				<li class="portfolio">
				
					<?php 
						if ( current_theme_supports( 'get-the-image' ) ) 
							get_the_image( array( 'meta_key' => 'Thumbnail', 'size' => $image_size, 'link_to_post' => false, 'image_class' => 'portfolio-thumb' ) ); 
					?>

					<div class="entry-content">
						<span class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					</div>

				</li>

			<?php endwhile; ?>

		</ul><!-- .portfolios -->

	<?php		

	}

endif;