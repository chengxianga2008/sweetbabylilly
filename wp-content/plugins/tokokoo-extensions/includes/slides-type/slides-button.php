<?php
/**
 * Slides button to add the shortcode to editor.
 *
 * @package TokokooExtensions
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */

/* Register slides button. */
add_action( 'admin_init', 'tokokoo_register_slides_button' );

/**
 * Register slides button.
 *
 * @since 1.0
 */
function tokokoo_register_slides_button() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
		return;

	add_filter( 'media_buttons_context', 'tokokoo_add_slides_button' );
	add_filter( 'admin_footer', 'tokokoo_add_media_display' );
}

/**
 * Slides button shortcode.
 *
 * @since 1.0
 */
function tokokoo_add_slides_button( $button ) {

	global $pagenow, $wp_version;

	$output = '';

	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {

		if ( version_compare( $wp_version, '3.5', '<' ) ) {
			$img 	= '<img src="' . trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides-icon.png" width="16px" height="16px" alt="' . esc_attr__( 'Add Slides', 'tokokoo' )  . '" />';
			$output = '<a href="#TB_inline?width=640&inlineId=tokokoo-slides-iframe-container" class="thickbox" title="' . esc_attr__( 'Add Slides', 'tokokoo' )  . '">' . $img . '</a>';
		} else {
			$img 	= '<span class="wp-media-buttons-icon" style="background-image: url(' . trailingslashit( TOKOKOO_EXTENSIONS_ASSETS ) . 'img/slides-icon.png ); margin-top: -1px;"></span>';
			$output = '<a href="#TB_inline?width=640&inlineId=tokokoo-slides-iframe-container" class="thickbox button" title="' . esc_attr__( 'Add Slides', 'tokokoo' ) . '" style="padding-left: .4em;">' . $img . ' ' . esc_attr__( 'Add Slides', 'tokokoo' ) . '</a>';
		}
		
	}

	return $button . $output;

}

/**
 * Media button display
 *
 * @since 1.0
 */
function tokokoo_add_media_display() {

	global $pagenow;

	/* Only run in post/page new and edit */
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) ) {

		$groups = get_terms( 'slide-group' );

		?>

		<script type="text/javascript">
			function tokokoo_insert_slides() {
				var id = jQuery( '#select-slides-group' ).val();

				/* Alert user if there is no slides selected */
				if ( '' == id ) {
					alert("<?php echo esc_js( __( 'Please select the slides first!', 'tokokoo' ) ); ?>");
					return;
				}

				/* Send shortcode to editor */
				window.send_to_editor('[koo-slides id="' + id + '"]');
			}
		</script>

		<div id="tokokoo-slides-iframe-container" style="display: none;">
			<div class="wrap" style="padding: 1em">

				<?php
				/* If there is no slides created yet */
				if ( empty( $groups ) ) {
					echo sprintf( __( 'You don\'t create any slides group yet. Let\'s %s', 'tokokoo' ), '<a href="' . esc_url( admin_url() ) . 'edit-tags.php?taxonomy=slide-group&post_type=slides">create one!</a>' );
					return;
				}
				?>							

				<h3><?php _e( 'Choose Your Slides', 'tokokoo' ); ?></h3><br />
				<select id="select-slides-group" style="clear: both; min-width:200px; display: inline-block; margin-right: 3em;">
					<?php
						foreach ( $groups as $group )
							echo '<option value="' . absint( $group->term_id ) . '">' . esc_attr( $group->name ) . '</option>';
					?>
				</select>

				<input type="button" id="slides-insert-template" class="button-primary" value="<?php echo esc_attr__( 'Insert Slides', 'tokokoo' ); ?>" onclick="tokokoo_insert_slides();" />
				<a id="slides-cancel-template" class="button-secondary" onclick="tb_remove();" title="<?php echo esc_attr__( 'Cancel', 'tokokoo' ); ?>"><?php echo esc_attr__( 'Cancel', 'tokokoo' ); ?></a>

			</div>
		</div>

		<?php
	}

}
?>