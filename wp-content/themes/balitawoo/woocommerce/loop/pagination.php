<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div class="pagination">
<?php get_template_part( 'loop', 'nav' ); // Loads the loop-nav.php template. ?>
</div>
<!-- <div class="pagination">
	<a class="next" href="#">Next</a> 
	<a class="prev" href="#">Prev</a> 

	<div class="pagenumber">
		<a class="on" href="#">1</a> / <a href="#">2</a> / <a href="#">3</a> / <a href="#">4</a> / <a href="#">5</a>
	</div> 
</div> -->