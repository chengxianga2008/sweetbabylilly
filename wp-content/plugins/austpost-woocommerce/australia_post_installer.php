<?php
/**
 * Australia Post shipping calculator for woocommerce - installer (ie: from envato)
 *
 * @package    Woocommerce
 * @category   Checkout
 * @author     dtbaker
 * @copyright  Copyright (c) 2011 dtbaker.
 * @license    http://codecanyon.net
 */
class australia_post extends woocommerce_shipping_method {



    public function __construct() {
        if(!$this->id)$this->id 			= 'australia_post';
        $this->method_title = __('Australia Post', 'woothemes');

        $old_id = $this->id;
        $this->id = 'australia_post';
        // Load the form fields.
        $this->init_form_fields();

        // Load the settings.
        $this->init_settings();
        $this->id = $old_id;

        // Define user set variables
        $this->enabled		= $this->settings['enabled'];
        if(!$this->title)$this->title 		= $this->settings['title'];
        $this->tax_status 		= $this->settings['tax_status'];
        $this->fee 		= $this->settings['fee'];

        // Actions
        //add_action('woocommerce_update_options_shipping_methods', array(&$this, 'process_admin_options'));
        add_action('woocommerce_update_options_shipping_australia_post', array(&$this, 'process_admin_options'));
    }



    public function is_available(){
        return true;
    }

    public function calculate_shipping() {


    }



    /**
     * Initialise Gateway Settings Form Fields
     */
    function init_form_fields() {
        global $woocommerce;

        $this->form_fields = array(

        );

    } // End init_form_fields()


    public function admin_options() {
        ?>

    <h3><?php _e('Australia Post Shipping Calculator - Installer', 'woothemes'); ?></h3>
    </p>
    <table class="form-table">
        <?php
        // Generate the HTML For the settings form.
        $this->generate_settings_html();
        ?>

    <tr>
        <td class="forminp">

            <?php
            $licence_code = get_option("_envato_licenceWCAUSP","");
            // now validate this code.
            if(strlen($licence_code)>5){
                // time to check if this key is correct.
                $f = new stdClass();
                $f->installer="1";
                $f->slug = basename(dirname(__FILE__));
                $res = dtbaker_plugin_api_call5(1,"plugin_information",$f);
                if(is_wp_error($res)){
                    ?>
                    <div style="padding:10px; color:#FF0000;">
                        Sorry, an unknown error occured. The license key you entered "<strong><?php echo htmlspecialchars($licence_code);?></strong>" may be invalid. Please try again.
                        <div style="font-size:10px;"><pre><?php var_export($res);?></pre></div>
                    </div>
                    <?php
                }else if($res && isset($res->key_error)){
                    ?>
                    <div style="padding:10px; color:#FF0000;">
                        <?php echo $res->installer_message;?>
                    </div>
                    <?php
                }else if($res && isset($res->download_link)){

                    ini_set("display_errors",true);
                    require_once(ABSPATH . "wp-admin/includes/plugin-install.php");
                    $api = plugins_api("plugin_information", array("slug" => basename(dirname(__FILE__)) ));
                    if($api){
                        $status = install_plugin_install_status($api);
                    }else{
                        $status = false;
                    }
                    ?>
                    <div style="font-size: 16px; margin:10px 0 60px 0;">
                        <strong>Congratulations! The license key you entered is VALID.</strong> <br>
                        You can now install to the latest version of this plugin. <br>
                        Thanks again for buying our plugin - remember our support website is here: http://support.dtbaker.com.au <br>
                        <br>
                        Please <?php if($status && $status["url"]){ ?><a href="<?php echo $status["url"];?>">click here</a> to upgrade this plugin to the latest version,
                        or <?php } ?> upgrade this plugin from your <a href="plugins.php">plugins</a> page. <br>
                    </div>
                <?php
                }
            }
             ?>

            <p>In order to install the most up to date version of the plugin <strong>please enter your licence purchase code</strong> below. This ensures your website will always have the most up to date Australia Post features.</p>

            <input type="text" name="save_envato_licence" value="<?php echo esc_attr(get_option("_envato_licenceWCAUSP",""));?>" size="60" style="padding:5px; font-size: 16px; width: 400px;"> <br/>

            <p>Your unique code is in your "Licence Certificate" on the <strong>Downloads</strong> page in CodeCanyon (where you downloaded this plugin).</p>
            <p>The key looks something like this: 39d40592-12c0-1234-988b-123458cd736b</p>
            <p>If you are having trouble locating this file please <a href="http://codecanyon.net/user/dtbaker">email us</a> and we can help you locate it.</p>

            
        </td>
    </tr>

        </table>
    <?php
    }

    public function process_admin_options() {

        if(isset($_POST['save_envato_licence'])){
            $licence_code = $_REQUEST["save_envato_licence"];
            update_option("_envato_licenceWCAUSP",$licence_code);
        }

        parent::process_admin_options();
    }

}


function add_australia_post_method( $methods ) {

    $methods[] = 'australia_post';
    return $methods;
}


add_filter('woocommerce_shipping_methods', 'add_australia_post_method' );
