<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Template Name: Contact page
 *
 * Description: Page to show contact
 *
 * @package balita
 * @author	Tokokoo
 * @license	license.txt
 * @since 	1.0
 *
 */
	// Loads the header.php template.
	get_header(); 
?>
<?php setup_postdata($post) ?>
	<div class="content-area has-sidebar" id="primary">
		<!-- Kalo ada sidebarnya tambahin class .has-sidebar -->
		<div id="content" class="site-content page-contact">
			<?php get_template_part( 'breadcrumbs' ); ?>
			<h2><?php the_title( ); ?></h2>
			<?php
				$lat = ( of_get_option( 'balitawoo_lat' ) ) ? of_get_option( 'balitawoo_lat' ) : '-6.895326';
				$lon = ( of_get_option( 'balitawoo_lon' ) ) ? of_get_option( 'balitawoo_lon' ) : '+107.621971';
				$lat = ( preg_match('~(\+|\-)[\d\.]+~', $lat) ) ? $lat : '+'.$lat;
				$lon = ( preg_match('~(\+|\-)[\d\.]+~', $lon) ) ? $lon : '+'.$lon;
				$lat_lon = urlencode($lat.$lon);
			?>
			<div>
				<iframe width="770" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo $lat_lon; ?>&ie=UTF8&z=16&t=m&iwloc=addr&output=embed"></iframe><br>
				<small>
					<a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?php echo $lat_lon; ?>&ie=UTF8&z=16&t=m&iwloc=addr" target="_blank"><?php _e('View Larger Map','balitawoo'); ?></a>
				</small>
			</div>
				<div class="clear"></div>
				<br><br>
				<?php if( of_get_option('balitawoo_street') ): ?>
				<div class="street">
					<img src="<?php echo get_template_directory_uri(); ?>/img/ico_map.png" width="40" height="40">
					<p><?php echo nl2br( of_get_option('balitawoo_street') ); ?></p>
					<div class="clear"></div>
				</div>
				<?php endif; ?>
				<?php if( of_get_option( 'balitawoo_desc' ) ): ?>
				<div class="desc">
					<p><?php echo of_get_option( 'balitawoo_desc' ); ?></p>
				</div>
				<?php endif; ?>
				<div class="clear"></div>
				<div class="contact-form comment-area">
					<?php the_content( ); ?>
				</div>

				<div class="clear"></div>
			
		</div><!-- #content .site-content -->
	</div>
	<?php get_template_part( 'sidebar', 'primary' ); ?>
	<div class="clear">
	</div>

<?php 
	// Loads the footer.php template.
	get_footer(); 
?>