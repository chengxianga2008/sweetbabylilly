<?php
/**
 * Theme options Dashboard
 * Display news, support link and recent themes
 * 
 * @package TokokooCore
 * @version 1.0
 * @author Tokokooo
 * @copyright Copyright (c) 2013, Tokokoo
 * @license license.txt
 */
function tokokoo_dashboard() {
?>
	<div class="wrap">
		
		<?php screen_icon( 'tools' ); ?>

		<h2><?php _e( 'Theme Dashboard', 'balitawoo' ); ?></h2>

		<div id="welcome-panel" class="welcome-panel">

			<div class="welcome-panel-content">
				
				<h3><?php _e( 'Setup your cool ecommerce site here!', 'balitawoo' ); ?></h3>

				<p class="about-description"><?php _e( 'Follow us to get WordPress practical tips, recent updates and monthly deals.', 'balitawoo' ); ?><span class="follow"><a href="<?php echo esc_url( 'https://twitter.com/tokokoo' ); ?>" class="twitter-follow-button" data-show-count="false">Follow @tokokoo</a></span></p>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

				<div class="welcome-panel-column-container">
					
					<div class="welcome-panel-column">
						<h4><?php _e( 'Quick Start', 'balitawoo' ); ?></h4>
						<p class="desc-alt"><?php _e( 'First things first, install WooCommerce plugin to get your theme runs your ecommerce site properly.', 'balitawoo' ); ?></p>
						<?php if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) { ?>
							<?php add_thickbox(); ?>
							<a class="button button-primary button-hero thickbox onclick" href="<?php echo esc_url( admin_url() . 'plugin-install.php?tab=plugin-information&plugin=woocommerce&TB_iframe=true&width=640&height=517' ); ?>"><?php _e( 'Install WooCommerce', 'balitawoo' ); ?></a>
						<?php }  else { ?>
							<span class="button button-primary button-hero"><?php _e( 'WooCommerce Already Installed!', 'balitawoo' ); ?></span>
						<?php } ?>
					</div>

					<div class="welcome-panel-column">
						<h4><?php _e( 'Next Steps', 'balitawoo' ); ?></h4>
						<ul>
							<li>
								<a class="welcome-icon welcome-write-blog" href="<?php echo esc_url( admin_url( 'themes.php?page=options-framework' ) ); ?>"><?php _e( 'Adjust theme setting', 'balitawoo' ); ?></a>
							</li>
							<li>
								<a class="welcome-icon welcome-add-page" href="<?php echo esc_url( admin_url( 'themes.php?page=custom-background' ) ); ?>"><?php _e( 'Customize site background', 'balitawoo' ); ?></a>
							</li>
							<li>
								<a class="welcome-icon welcome-view-site" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php _e( 'Pick awesome widgets', 'balitawoo' ); ?></a>
							</li>
							<li>
								<a class="welcome-icon welcome-widgets-menus" href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php _e( 'Manage the menus', 'balitawoo' ); ?></a>
							</li>
						</ul>
					</div>

					<div class="welcome-panel-column">
						<h4><?php _e( 'Advanced', 'balitawoo' ); ?></h4>
						<ul>
							<li>
								<a class="welcome-icon welcome-learn-more" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=slides' ) ); ?>"><?php _e( 'Add cool slides', 'balitawoo' ); ?></a>
							</li>
							<?php do_action( 'tokokoo_dashboard_advanced_list' ); ?>
						</ul>
					</div>

				</div>

				<p class="desc-alt-hero"><?php printf( __( 'If you&#8217;d like to read more detailed documentations, please go to the <a class="button button-primary" href="%s" target="_blank">Documentation Page</a>', 'balitawoo' ), esc_url( 'http://tokokoo.com/support/' ) ); ?>
				</p>

			</div><!-- .welcome-panel-content -->

		</div><!-- #welcome-panel .welcome-panel -->

		<div id="dashboard-widgets-wrap">

			<div id="dashboard-widgets" class="metabox-holder">
				
				<div id="postbox-container-1" class="postbox-container" style="width:50%;">
					<div id="normal-sortables" class="meta-box-sortables">
						
						<div id="tokokoo_themes" class="postbox">

						    <h3 class="hndle"><span><?php _e( 'Tokokoo Latest Themes', 'balitawoo' ); ?></span></h3>
						    <div class="inside">
						        <div class="rss-widget">
						            <?php tokokoo_get_theme_feed(); ?>                            
						        </div>
						        <a href="<?php echo esc_url( 'http://tokokoo.com/tokokoo-themes/' ); ?>" target="_blank" class="button button-primary button-hero"><?php _e( 'VIEW ALL' , 'balitawoo' ); ?></a>
						    </div>

						</div><!-- #tokokoo_themes .postbox -->

					</div><!-- #normal-sortables .meta-box-sortables -->
				</div><!-- #postbox-container-1 .postbox-container -->

				<div id="postbox-container-2" class="postbox-container" style="width:50%;">

					<div id="tokokoo_support" class="postbox ">
						
						<h3 class="hndle"><span><?php _e( 'Tokokoo Useful Links', 'balitawoo' ); ?></span></h3>
						<div class="inside">
							<div class="rss-widget">
								
								<ul>
					              	<li style="display: block; border-bottom: 1px solid #ddd; padding-bottom: .5em;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://tokokoo.com/ticketing/' ); ?>" title="<?php esc_attr_e( 'Tokokoo ticketing', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="<?php echo esc_url( 'http://tokokoo.com/wp-content/uploads/2012/06/support1.png' ); ?>"><?php _e( 'Ticketing', 'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Find a bug or need a support? Submit your ticket!', 'balitawoo' ); ?></span>
									</li>
		                            <li style="display: block; border-bottom: 1px solid #ddd; padding-bottom: .5em;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://tokokoo.com/support/' ); ?>" title="<?php esc_attr_e( 'Tokokoo Documentation', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="<?php echo esc_url( 'http://tokokoo.com/wp-content/uploads/2012/06/docs1.png' ); ?>"><?php _e( 'Documentation' ,'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Read our documentations before you start something!', 'balitawoo' ); ?></span>
									</li>
		                            <li style="display: block; border-bottom: 1px solid #ddd; padding-bottom: .5em;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://tokokoo.com/contact/' ); ?>" title="<?php esc_attr_e( 'Tokokoo Contact', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="<?php echo esc_url( 'http://tokokoo.com/wp-content/uploads/2012/06/contact1.png' ); ?>"><?php _e( 'Contact', 'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Need an intensive support? Contact us!', 'balitawoo' ); ?></span>
									</li>
									<li style="display: block; border-bottom: 1px solid #ddd; padding-bottom: .5em;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://tokokoo.com/faq/' ); ?>" title="<?php esc_attr_e( 'FAQ', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="<?php echo esc_url( 'http://tokokoo.com/wp-content/uploads/2012/06/faq.png' ); ?>"><?php _e( 'FAQ', 'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Guaranteed answer for your frequently asked questions', 'balitawoo' ); ?></span>
									</li>					
									<li style="display: block; border-bottom: 1px solid #ddd; padding-bottom: .5em;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://tokokoo.com/knowledgebase' ); ?>" title="<?php esc_attr_e( 'Knowledge base', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="http://tokokoo.com/wp-content/uploads/2012/06/kbase.png"><?php _e( 'Knowledge base', 'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Having a trouble ? Try to browse our knowledge base', 'balitawoo' ); ?></span>
									</li>
		                            <li style="display: block;">
										<a style="color: #333; font-weight: bold; display: inline-block; width: 200px;" href="<?php echo esc_url( 'http://twitter.com/tokokoo' ); ?>" title="<?php esc_attr_e( 'Follow Us', 'balitawoo' ); ?>" target="_blank">
											<img style="vertical-align: middle; margin-right: 5px;" src="<?php echo esc_url( 'http://tokokoo.com/wp-content/uploads/2012/06/twitter1.png' ); ?>"><?php _e( 'Twitter account', 'balitawoo' ); ?>
										</a>
										<span class="desc"><?php _e( 'Get in touch with us by following us on twitter', 'balitawoo' ); ?></span>
									</li>
								</ul>

							</div><!-- .rss-widget -->
						</div><!-- .inside -->
					</div><!-- #tokokoo_support .postbox -->

					<div id="tokokoo_news" class="postbox ">
					    <h3 class="hndle"><span><?php _e( 'Tokokoo News', 'balitawoo' ); ?></span></h3>
					    <div class="inside">
					        <div class="rss-widget">

					            <?php 
					                // get RSS FEED
					                $rss_url = esc_url( 'http://feeds.feedburner.com/tokokoo' );
					                $rss = @fetch_feed( $rss_url );
					                
					                wp_widget_rss_output( $rss, array( 'items' => 5, 'show_summary' => 1, 'show_date' => 1 ) );
					            ?>

					        </div><!-- .rss-widget -->                   
					    </div><!-- .inside -->
					</div><!-- #tokokoo_news .postbox -->

				</div><!-- #postbox-container-2 .postbox-container -->

			</div><!-- #dashboard-widgets .metabox-holder -->

			<div class="clear"></div>

		</div><!-- #dashboard-widgets-wrap -->

	</div><!-- .wrap -->

	<?php
	}

	/**
	 * Display the RSS entries in a list.
	 *
	 * @since 1.0
	 */
	function tokokoo_get_theme_feed() {
	    
		include_once( ABSPATH . WPINC . '/feed.php' );

		$rss = fetch_feed( esc_url( 'http://tokokoo.com/feed/?post_type=portfolio' ) );
	    if ( ! is_wp_error( $rss ) ) :
	        $maxitems = $rss->get_item_quantity( 5 ); 
	        $rss_items = $rss->get_items( 0, $maxitems ); 
	    endif;

	    ?>

        <ul>

            <?php 
            if ( $maxitems == 0 ) 
           		echo '<li>' . __( 'No items.', 'balitawoo' ) . '</li>';
            else
            
	        foreach ( $rss_items as $item ) :

	        	$desc = strip_tags( $item->get_description() );
	        	$desc = wp_trim_words( $desc, 20 ); 

	        	?>

		        <li style='margin-bottom:10px; padding-bottom:5px; border-bottom:1px solid #ddd;'>

	            	<div class="rssthumb" style="float: left;">
	            		<?php $img = $item->get_item_tags( '', 'thumb' ); ?>
	            		<img src="<?php echo esc_url( $img[0]['data'] ); ?>" width="250" style="border:1px solid #ddd;" />
	            	</div>

		            <div class="rssdescription" style="float: right; width: 48%;">

		                <a class="rsswidget" href="<?php echo esc_url( $item->get_permalink() ); ?>"><?php echo esc_html( $item->get_title() ); ?></a>

		                <div><?php echo $desc; ?></div><br />

	                 	<a href="<?php echo esc_url( $item->get_permalink() ); ?>" class="button" target="_blank"><?php _e( 'See Detail', 'balitawoo' ) ?></a> 

	                 	<?php $demo = $item->get_item_tags( '', 'tkk_demo_url' ); ?>
	                 	<a href="<?php echo esc_url( $demo[0]['data'] ); ?>" class="button-primary" target="_blank"><?php _e( 'Theme Demo', 'balitawoo' ) ?></a>

		            </div>

		            <div class='clear'></div>

		        </li>

	        <?php endforeach; ?>

        </ul>
	    
        <?php
	}

	/**
	 * Custom dashboard style
	 *
	 * @since 1.0
	 */
	if ( is_admin() ) {
	    $on_page = 'toplevel_page_tokokoo-dashboard';
	    add_action( "admin_print_styles-$on_page", 'tokokoo_dashboard_custom_css' );
	}
	 
	function tokokoo_dashboard_custom_css () {
		?>

		<style type="text/css">
			.dashboard-message {
				*zoom: 1;
				background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #8F9C21), color-stop(100%, #768818));
				background-image: -webkit-linear-gradient(top, #8F9C21, #768818);
				background-image: -moz-linear-gradient(top, #8F9C21, #768818);
				background-image: -o-linear-gradient(top, #8F9C21, #768818);
				background-image: -ms-linear-gradient(top, #8F9C21, #768818);
				background-image: linear-gradient(top, #8F9C21, #768818);
				height: 40px;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				-ms-border-radius: 5px;
				-o-border-radius: 5px;
				border-radius: 5px;
				border:3px solid #5b6b0e;
				padding:10px;
				margin: 10px 0;
			}
			.view-deals-button {
				*zoom: 1;
				background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f4f4f4), color-stop(100%, #cccccc));
				background-image: -webkit-linear-gradient(top, #f4f4f4, #cccccc);
				background-image: -moz-linear-gradient(top, #f4f4f4, #cccccc);
				background-image: -o-linear-gradient(top, #f4f4f4, #cccccc);
				background-image: -ms-linear-gradient(top, #f4f4f4, #cccccc);
				background-image: linear-gradient(top, #f4f4f4, #cccccc);
				-webkit-border-radius: 2px;
				-moz-border-radius: 2px;
				-ms-border-radius: 2px;
				-o-border-radius: 2px;
				border-radius: 5px;
				border: 2px solid #5b6b0e;
				padding: 10px 25px;
				text-decoration: none;
				color: #333;
				float: right;
				margin-top: -12px;
				text-shadow: 1px 1px 0px #F4F4F4;
				font-weight:bold;
			}
			.follow {
				margin-left: 10px;
				position: relative;
				top: 3px;
			}
			.welcome-panel-column .desc-alt {
				color: #777;
				margin-top: 0;
				line-height: 1.5;
			}

			.desc-alt-hero {
				color: #777;
				margin-top: 20px;
			}
		</style>

		<?php
	}
?>