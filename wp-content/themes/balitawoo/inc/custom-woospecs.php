<?php
 
/**
 * Custom Tabs for Product Display. Compatible with WooCommerce 2.0+ only!
 *
 * Outputs an extra tab to the default set of info tabs on the single product page.
 * This file needs to be called via your functions.php file.
 */
 
function custom_tab_options_tab() {
?>
        <li class="custom_tab"><a href="#custom_tab_data"><?php _e('Custom Tab', 'woothemes'); ?></a></li>
<?php
}
add_action('woocommerce_product_write_panel_tabs', 'custom_tab_options_tab');
 
 
/**
 * Custom Tab Options
 *
 * Provides the input fields and add/remove buttons for custom tabs on the single product page.
 */
function custom_tab_options() {
        global $post;
       
        $custom_tab_options = array(
                'title' => get_post_meta($post->ID, 'custom_tab_title', true),
                'content' => get_post_meta($post->ID, 'custom_tab_content', true),
        );
       
?>
        <div id="custom_tab_data" class="panel woocommerce_options_panel">
                <div class="options_group">
                        <p class="form-field">
                                <?php woocommerce_wp_checkbox( array( 'id' => 'custom_tab_enabled', 'label' => __('Enable Custom Tab?', 'woothemes'), 'description' => __('Enable this option to enable the custom tab on the frontend.', 'woothemes') ) ); ?>
                        </p>
                </div>
               
                <div class="options_group custom_tab_options">                                                                         
                        <p class="form-field">
                                <label><?php _e('Custom Tab Title:', 'woothemes'); ?></label>
                                <input type="text" size="5" name="custom_tab_title" value="<?php echo @$custom_tab_options['title']; ?>" placeholder="<?php _e('Enter your custom tab title', 'woothemes'); ?>" />
                        </p>
                       
                        <p class="form-field">
                                <?php _e('Custom Tab Content:', 'woothemes'); ?>
                </p>
                       
                        <table class="form-table">
                                <tr>
                                        <td>
                                                <textarea class="theEditor" rows="10" cols="40" name="custom_tab_content" placeholder="<?php _e('Enter your custom tab content', 'woothemes'); ?>"><?php echo @$custom_tab_options['content']; ?></textarea>
                                        </td>
                                </tr>  
                        </table>
        </div> 
        </div>
<?php
}
add_action('woocommerce_product_write_panels', 'custom_tab_options');
 
 
/**
 * Process meta
 *
 * Processes the custom tab options when a post is saved
 */
function process_product_meta_custom_tab( $post_id ) {
        update_post_meta( $post_id, 'custom_tab_enabled', ( isset($_POST['custom_tab_enabled']) && $_POST['custom_tab_enabled'] ) ? 'yes' : 'no' );
        update_post_meta( $post_id, 'custom_tab_title', $_POST['custom_tab_title']);
        update_post_meta( $post_id, 'custom_tab_content', $_POST['custom_tab_content']);
}
add_action('woocommerce_process_product_meta', 'process_product_meta_custom_tab', 10, 2);
 
 
/**
 * Display Tab
 *
 * Display Custom Tab on Frontend of Website for WooCommerce 2.0
 */
 
add_filter( 'woocommerce_product_tabs', 'woocommerce_product_custom_tab' );
 
 
        function woocommerce_product_custom_tab( $tabs ) {
                global $post, $product;
 
                $custom_tab_options = array(
                        'enabled' => get_post_meta($post->ID, 'custom_tab_enabled', true),
                        'title' => get_post_meta($post->ID, 'custom_tab_title', true),
                        'content' => get_post_meta($post->ID, 'custom_tab_content', true),                     
                );
               
                        if ( $custom_tab_options['enabled'] != 'no' ){
                                $tabs['custom-tab-first'] = array(
                                        'title'    => $custom_tab_options['title'],
                                        'priority' => 25,
                                        'callback' => 'custom_product_tabs_panel_content',                                     
                                        'content'  => $custom_tab_options['content']
                                );
                        }
 
                return $tabs;
        }
 
        /**
         * Render the custom product tab panel content for the callback 'custom_product_tabs_panel_content'
         */
   function custom_product_tabs_panel_content( $key, $custom_tab_options ) {
                echo '<h2>' . $custom_tab_options['title'] . '</h2>';
                echo $custom_tab_options['content'];
 
        }
 
 
?>