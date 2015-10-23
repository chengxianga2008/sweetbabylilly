<?php
/**
 * Australia Post shipping calculator for woocommerce
 *
 * @package    Woocommerce
 * @category   Checkout
 * @author     dtbaker
 * @copyright  Copyright (c) 2011 dtbaker.
 * @license    http://codecanyon.net
 *
 * last update Oct 15th 2012
 */

class WC_Australia_Post extends WC_Shipping_Method {

    public static $printed_admin_page = false;


    public function __construct() {
        $this->id = 'australia_post';
        $this->method_title = __('Australia Post', 'woocommerce');


        $this->admin_page_heading 		= __('Australia Post', 'woocommerce');
        $this->admin_page_description 	= __('Calculate shipping via Australia Post API.', 'woocommerce');
        
        // Load the form fields.
        $this->init_form_fields();

        // Load the settings.
        $this->init_settings();

        // Define user set variables
        $this->enabled		= $this->settings['enabled'];
        $this->title 		= $this->settings['title'];
        $this->tax_status 		= $this->settings['tax_status'];
        $this->fee 		= $this->settings['fee'];

        // Actions
        add_action('woocommerce_update_options_shipping_australia_post', array(&$this, 'process_admin_options'));
    }

    public function get_delivery_options_domestic(){
        $options = get_option('australia_post_domestic',array());
        if(!$options){
            $options=array();
        }
        return $options;
    }
    public function get_delivery_options_international(){
        $options = get_option('australia_post_international',array());
        if(!$options){
            $options=array();
        }
        return $options;
    }
    public function save_delivery_options_domestic($settings){
        update_option('australia_post_domestic',$settings);
    }
    public function save_delivery_options_international($settings){
        update_option('australia_post_international',$settings);
    }

    public function is_auspost_method_enabled($domestic, $key, $settings){
        $current = $domestic ? $this->get_delivery_options_domestic() : $this->get_delivery_options_international();
        if(!isset($current[$key]) && $settings){
            $settings['enabled']=1;
            $current[$key] = $settings;
            if($domestic){
                $this->save_delivery_options_domestic($current);
            }else{
                $this->save_delivery_options_international($current);
            }
            return $settings;
        }else{
            return $current[$key]['enabled'] ? $current[$key] : false;
        }
    }

    public function is_available(){
        // what is the current shipping country?
        global $woocommerce;
        $current_cc = $woocommerce->customer->get_shipping_country();
        $current_postcode = $woocommerce->customer->get_shipping_postcode();
        //var_dump($current_postcode);exit;
        if(!$current_postcode){
            return false;
        }else{

        }
        return true;
    }


    private function _add_multiple($product,$group,$cost){ //$tax
        $rate = array(
            'id' 		=> 'aust_post'.$group,
            'label' 	=> $group,
            'cost' 		=> $cost,
            'calc_tax' 	=> 'per_item', // not sure here?
        );

       // print_r($rate);echo '<br>';
        $this->add_rate( $rate );
    }

    public function calculate_shipping(){
        global $woocommerce;

        $add_weight_per_combined_package = 0;
        $max_combined_package_weight = 22; //kg
        $max_parcel_length = 105; //cm - todo
        $max_parcel_girth = 140; // cm - size of 4 shortest sides - todo

        $overall_shipping_error = false;

        $display_errors = false;

        $combined_index = 0;

        $calculate_products = array();

        // group / format our producs correctly:

        if (sizeof($woocommerce->cart->cart_contents)>0){
            foreach ($woocommerce->cart->cart_contents as $item_id => $values){
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity']>0 && $_product->product_type <> 'downloadable'){

                    // work out the cost of shipping this item via australia post.
                    // only if a method is selected.
                    $shipping_error = false;
                    $attributes = $_product->get_attributes();
                    $weight = $_product->get_weight();
                    $length = woocommerce_get_dimension($_product->length,'cm');
                    $height = woocommerce_get_dimension($_product->height,'cm');
                    $width = woocommerce_get_dimension($_product->width,'cm');


                    if($length<=0){
                        // check for default weight. (stored in CM)
                        $length = get_option('woocommerce_australia_post_default_length');
                    }
                    if($width<=0){
                        // check for default weight. (stored in CM)
                        $width = get_option('woocommerce_australia_post_default_width');
                    }
                    if($height<=0){
                        // check for default weight. (stored in CM)
                        $height = get_option('woocommerce_australia_post_default_height');
                    }
                    if($weight<=0){
                        // check for default weight. (stored in CM)
                        $weight = get_option('woocommerce_australia_post_default_weight');
                    }

                    $weight = woocommerce_get_weight($weight,'kg');

                    if($weight<=0){
                        if($display_errors)$woocommerce->add_error('Shipping Calculation Error: No product weight found for product <a href="'.get_permalink($values['product_id']).'">'.apply_filters('woocommerce_cart_product_title', $_product->get_title(), $_product).'</a>');
                        $shipping_error = true;
                    }
                    if($length<=0){
                        if($display_errors)$woocommerce->add_error('Shipping Calculation Error: No product length found for product <a href="'.get_permalink($values['product_id']).'">'.apply_filters('woocommerce_cart_product_title', $_product->get_title(), $_product).'</a>');
                        $shipping_error = true;
                    }
                    if($height<=0){
                        if($display_errors)$woocommerce->add_error('Shipping Calculation Error: No product height found for product <a href="'.get_permalink($values['product_id']).'">'.apply_filters('woocommerce_cart_product_title', $_product->get_title(), $_product).'</a>');
                        $shipping_error = true;
                    }
                    if($width<=0){
                        if($display_errors)$woocommerce->add_error('Shipping Calculation Error: No product width found for product <a href="'.get_permalink($values['product_id']).'">'.apply_filters('woocommerce_cart_product_title', $_product->get_title(), $_product).'</a>');
                        $shipping_error = true;
                    }

                    if($shipping_error){
                        $overall_shipping_error = true;
                        continue;
                    }



                    switch($this->settings['calculation_type']){
                        case 'individual':
                            // doing individiaul products.
                            // add each to our calc array.
                            /*if ($_product->is_shipping_taxable() && $this->tax_status=='taxable'){
                                $rate = $_tax->get_shipping_tax_rate( $_product->data['tax_class'] );
                            }else{
                                $rate = 0;
                            }*/
                            $calculate_products[] = array(
                                'width' => $width,
                                'height' => $height,
                                'length' => $length,
                                'weight' => $weight + $add_weight_per_combined_package,
                                //'tax_rate' => $rate,
                                'quantity' => $values['quantity'],
                            );
                            break;
                        case 'combined_weight':
                        default:
                            for($x=0;$x<$values['quantity'];$x++){
                                if(!isset($calculate_products[$combined_index])){
                                    $calculate_products[$combined_index] = array(
                                        'width' => $width,
                                        'height' => $height,
                                        'length' => $length,
                                        'weight' => $weight + $add_weight_per_combined_package,
                                        'quantity' => 1,
                                    );
                                }else if($calculate_products[$combined_index]['weight'] + $weight > $max_combined_package_weight){
                                    // next index.
                                    $combined_index++;
                                    $calculate_products[$combined_index] = array(
                                        'width' => $width,
                                        'height' => $height,
                                        'length' => $length,
                                        'weight' => $weight + $add_weight_per_combined_package,
                                        'quantity' => 1,
                                    );
                                }else{
                                    $calculate_products[$combined_index]['weight'] += $weight;
                                    // todo - do some box packing so products will fit within the max parcel sizes. (predefined sizes maybe?)
                                    $calculate_products[$combined_index]['height'] = max($calculate_products[$combined_index]['height'],$height);
                                    $calculate_products[$combined_index]['weight'] = max($calculate_products[$combined_index]['weight'],$weight);
                                    $calculate_products[$combined_index]['length'] = max($calculate_products[$combined_index]['length'],$length);
                                }
                            }
                            break;
                    }


                }// product exists and is not downloadable
            } // cart contents.
        }// > 0 // end grouping / formatting products.

        //print_r($calculate_products);
        if(get_option("_australia_post_debug",0)){
            echo '<pre>';
            echo "Product Settings:\n";print_r($calculate_products);
            echo '</pre>';
        }

        // we have our products ready for shipping calculation.
        if(count($calculate_products)>0 && !$overall_shipping_error){
            // work out if we're doing a local or international service.
            $current_cc = $woocommerce->customer->get_shipping_country();
            if(!$current_cc){
                $woocommerce->add_error('No country selected');
                return;
            }
            $destination_post_code = preg_replace('#[^0-9]#','',$woocommerce->customer->get_shipping_postcode());
            $from_post_code = preg_replace('#[^0-9]#','',$this->settings['origin_post_code']);

            $available_service_codes = array();

            // work out if we're doing a letter or parcel delivery
            // Letter max is 26cm x 36cm x 2cm / 0.5kg
            // everything larger will be parcel.
            /*$max_dimensions = array(
                array(26,36,2),
                array(36,26,2),
                array(26,2,36),
                array(2,26,36),
                array(36,2,26),
                array(2,36,26),
            );*/
            $max_dimensions = array(2,26,36);
            foreach($calculate_products as $key => $calculate_product){
                $is_letter = false;
                if($calculate_product['weight']<=0.5){
                    $product_dimensions = array($calculate_product['length'],$calculate_product['width'],$calculate_product['height']);
                    sort($product_dimensions);
                    $is_letter = (
                        $product_dimensions[0]<=$max_dimensions[0] &&
                        $product_dimensions[1]<=$max_dimensions[1] &&
                        $product_dimensions[2]<=$max_dimensions[2]
                    );
                    /*foreach($max_dimensions as $dimensions_to_check){
                        if(
                            $calculate_product['length'] < $dimensions_to_check[0] &&
                            $calculate_product['width'] < $dimensions_to_check[1] &&
                            $calculate_product['height'] < $dimensions_to_check[2]
                        ){
                            $is_letter=true;
                            break;
                        }
                    }*/
                }
                $calculate_products[$key]['is_letter'] = $is_letter;
                if($current_cc == 'AU'){
                    if($is_letter){
                        $url = '/api/postage/letter/domestic/service.json?length='.$calculate_product['length'].'&width='.$calculate_product['width'].'&thickness='.$calculate_product['height'].'&weight='.$calculate_product['weight'];
                    }else{
                        $url = '/api/postage/parcel/domestic/service.json?from_postcode='.$from_post_code.'&to_postcode='.$destination_post_code.'&length='.$calculate_product['length'].'&width='.$calculate_product['width'].'&height='.$calculate_product['height'].'&weight='.$calculate_product['weight'];
                    }
                }else{
                    $url = '/api/postage/'.($is_letter?'letter':'parcel').'/international/service.json?country_code='.$current_cc.'&weight='.$calculate_product['weight'];
                }
                $services = $this->api($url);
                //print_r($services);
                if(get_option("_australia_post_debug",0)){
                    echo '<pre>';
                    echo "Service Result from API Call: $url:\n\n";print_r($services);
                    echo '</pre>';
                }
                if($services && isset($services['services']) && isset($services['services']['service']) && is_array($services['services']['service'])){
                    $services = $services['services']['service'];
                    if(isset($services['code']))$services=array($services);
                    foreach($services as $service){

                        if(!isset($service['options'])||!count($service['options'])||$current_cc != 'AU'){
                            // add the top level option for international deliveries (eg: just "Air Mail:)
                            $available_service_codes[$service['code']] = array(
                                'service_code'=> $service['code'],
                                'option_code' => '',
                                'suboption_code' => '',
                                'name' => $service['name'],
                            );
                        }

                        if(isset($service['options']) && isset($service['options']['option'])){
                            $options = $service['options']['option'];
                            if(isset($options['code']))$options=array($options);
                            foreach($options as $option){
                                $available_service_codes[$service['code'] .'|'.$option['code']] = array(
                                    'service_code'=> $service['code'],
                                    'option_code' => $option['code'],
                                    'suboption_code' => '',
                                    'name' => $service['name'] .' '.$option['name'],
                                );
                                if(isset($option['suboptions']) && isset($option['suboptions']['option'])){
                                    $suboptions = $option['suboptions']['option'];
                                    if(isset($suboptions['code']))$suboptions=array($suboptions);
                                    foreach($suboptions as $suboption){
                                        if($suboption['code']=='AUS_SERVICE_OPTION_EXTRA_COVER' || $suboption['code'] == 'INTL_SERVICE_OPTION_EXTRA_COVER'){
                                            // don't support extra cover yet
                                        }else{
                                            $available_service_codes[$service['code'] .'|'.$option['code'].'|'.$suboption['code']] = array(
                                                'service_code'=> $service['code'],
                                                'option_code' => $option['code'],
                                                'suboption_code' => $suboption['code'],
                                                'name' => $service['name'] .' '.$option['name'].' '.$suboption['name'],
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }

                }
            } // forech products
            //print_r($available_service_codes);
            // we have our list of service codes now.
            // add a cost to woocommerce PER EACH service code.

            foreach($available_service_codes as $key => $available_service_code){
                // find out if this method is enabled in settings.
                // if this method doesn't exist (by $key) then we add it in for selection
                // if(! enabled ) continue;
                $available_service_code = $this->is_auspost_method_enabled($current_cc == 'AU',$key,$available_service_code);
                if(!$available_service_code){
                    continue;
                }

                $calculate_shipping_error = false;
                $service_shipping_total = 0;

                foreach($calculate_products as $calculate_product){

                    $is_letter = $calculate_product['is_letter']; // worked out above.
                    if($current_cc == 'AU'){
                        $url = '/api/postage/'.($is_letter?'letter':'parcel').'/domestic/calculate.json?&length='.$calculate_product['length'].'&width='.$calculate_product['width'].'&height='.$calculate_product['height'].'&from_postcode='.$from_post_code.'&to_postcode='.$destination_post_code.'&weight='.$calculate_product['weight'].'&service_code='.$available_service_code['service_code'].'&option_code='.$available_service_code['option_code'].'&suboption_code='.$available_service_code['suboption_code'].'&extra_cover=';
                    }else{
                        $url = '/api/postage/'.($is_letter?'letter':'parcel').'/international/calculate.json?&country_code='.$current_cc.'&weight='.$calculate_product['weight'].'&service_code='.$available_service_code['service_code'].'&option_code='.$available_service_code['option_code'].'&suboption_code='.$available_service_code['suboption_code'].'&extra_cover=';
                    }

                    if(strpos($url,'OPTION_EXTRA_COVER')!==false){
                        $url .= $woocommerce->cart->cart_contents_total;
                    }

                    $postage = $this->api($url);
                    if(get_option("_australia_post_debug",0)){
                        echo '<pre>';
                        echo "Postage Result from API Call: $url:\n\n";print_r($postage);
                        echo '</pre>';
                    }

                    if($postage && isset($postage['error'])){
                        $calculate_shipping_error=true;
                        $woocommerce->add_error("Australia Post Error: ".$postage['error']['errorMessage'].' '.var_export($available_service_code,true));
                    }else if ($postage && isset($postage['postage_result']) && isset($postage['postage_result']['total_cost']) && $postage['postage_result']['total_cost'] > 0){
                        // winner!
                        $item_shipping_price = $postage['postage_result']['total_cost'];
                        $item_shipping_price = $item_shipping_price * $calculate_product['quantity'];
                        $service_shipping_total = $service_shipping_total + $item_shipping_price;
                    }
                } // foreach calculated products

                if(!$calculate_shipping_error && $service_shipping_total>0){
                        // add a fee
                    $service_shipping_total = $service_shipping_total + $this->get_fee( $this->fee, $woocommerce->cart->cart_contents_total );
                    $this->_add_multiple($key,$available_service_code['name'],$service_shipping_total); //$shipping_tax_total
                }

                //
            } // foreach service code

        }else if($display_errors){
            $woocommerce->add_error('Failed to calculate Australia Post shipping prices. Please try again or contact us for more information.');
        }


    }


    /**
     * Initialise Gateway Settings Form Fields
     */
    function init_form_fields() {
        global $woocommerce;

        $this->form_fields = array(
            'enabled' => array(
                'title' 		=> __( 'Enable/Disable', 'woocommerce' ),
                'type' 			=> 'checkbox',
                'label' 		=> __( 'Enable Australia Post', 'woocommerce' ),
                'default' 		=> 'yes'
            ),
            'origin_post_code' => array(
                'title' 		=> __( 'Origin Post Code', 'woocommerce' ),
                'type' 			=> 'text',
                'description' 	=> __( 'Where you will be posting your products from (ie: the post office).', 'woocommerce' ),
                'default'		=> __( '4000', 'woocommerce' )
            ),
            'title' => array(
                'title' 		=> __( 'Method Title', 'woocommerce' ),
                'type' 			=> 'text',
                'description' 	=> __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
                'default'		=> __( 'Australia Post', 'woocommerce' )
            ),
            'tax_status' => array(
                'title' 		=> __( 'Tax Status', 'woocommerce' ),
                'type' 			=> 'select',
                'description' 	=> '',
                'default' 		=> 'taxable',
                'options'		=> array(
                    'taxable' 	=> __('Taxable', 'woocommerce'),
                    'none' 		=> __('None', 'woocommerce')
                )
            ),
            'calculation_type' => array(
                'title' 		=> __( 'Calculation Type', 'woocommerce' ),
                'type' 			=> 'select',
                'description' 	=> '',
                'default' 		=> 'individual',
                'options'		=> array(
                    'individual' 	=> __('Individual', 'woocommerce'),
                    'combined_weight' 		=> __('Combined Weight', 'woocommerce')
                )
            ),
            'fee' => array(
                'title' 		=> __( 'Handling Fee', 'woocommerce' ),
                'type' 			=> 'text',
                'description'	=> __('Fee excluding tax. Enter an amount, e.g. 2.50, or a percentage, e.g. 5%. Leave blank to disable.', 'woocommerce'),
                'default'		=> ''
            ),
        );

    } // End init_form_fields()


    public function admin_options() {
        global $woocommerce;
        ?>

    <h3><?php _e('Australia Post', 'woocommerce'); ?></h3>
    <p><?php _e('Australia Post lets you calculate the shipping costs of items from Australia.', 'woocommerce'); ?>
    </p>
    <table class="form-table">
        <?php
        // Generate the HTML For the settings form.
        $this->generate_settings_html();
        ?>

        <tr>
            <td class="titledesc"><?php _e('Product Defaults', 'woocommerce') ?>:</td>
            <td class="forminp">

                <?php foreach(array('Width','Height','Length','Weight') as $this_tax){ ?>
                <?php echo $this_tax;?>:
                <input type="text" name="woocommerce_australia_post_default_<?php echo strtolower($this_tax);?>" value="<?php echo esc_attr(get_option('woocommerce_australia_post_default_'.strtolower($this_tax)));?>" size="6">
                <?php
                if(in_array($this_tax,array('Width','Height','Length'))){
                    echo 'cm';
                }else{
                    echo get_option('woocommerce_weight_unit');
                }
                ?>
                <br/>
                <?php } ?>

                <span class="description"><?php _e('If all your products are similar, enter the default width/height/length and weight here. This will save you adding these values to all your products individually.','woocommerce') ?></span>

            </td>
        </tr>
    <tr>
        <td class="titledesc"><?php _e('Domestic Options', 'woocommerce') ?>:</td>
        <td class="forminp">

            <?php
            $deloptions = $this->get_delivery_options_domestic();
            if(!$deloptions){
                echo "<strong>No options available yet. Please do a test checkout/calculate prices to populate this list.</strong>";
            }else{
            foreach($deloptions as $code => $settings){ ?>
            <input type="checkbox" name="woocommerce_australia_post_domestic_parcel[<?php echo $code;?>][enabled]" value="1" <?php echo $this->is_auspost_method_enabled(true,$code,false) ? ' checked':'';?>>
            <input type="text" name="woocommerce_australia_post_domestic_parcel[<?php echo $code;?>][title]" value="<?php echo htmlspecialchars($settings['name']);?>" size="60">
            <br/>
            <?php } ?>
            <span class="description"><?php _e('What domestic delivery options would you like to give to your customer? You can change the description if you want. Changing description WILL NOT change the price. eg: the delivery confirmation option will always charge delivery confirmation.','woocommerce') ?></span>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td class="titledesc"><?php _e('International Options', 'woocommerce') ?>:</td>
        <td class="forminp">

            <?php
            $deloptions = $this->get_delivery_options_international();
            if(!$deloptions){
                echo "<strong>No options available yet. Please do a test checkout/calculate prices to populate this list.</strong>";
            }else{
            foreach($deloptions as $code => $settings){ ?>
            <input type="checkbox" name="woocommerce_australia_post_int_parcel[<?php echo $code;?>][enabled]" value="1" <?php echo $this->is_auspost_method_enabled(false,$code,false) ? ' checked':'';?>>
            <input type="text" name="woocommerce_australia_post_int_parcel[<?php echo $code;?>][title]" value="<?php echo htmlspecialchars($settings['name']);?>" size="60">
            <br/>
            <?php } ?>
            <span class="description"><?php _e('What international delivery options would you like to give to your customer? You can change the description if you want. Changing description WILL NOT change the price. eg: the delivery confirmation option will always charge delivery confirmation.','woocommerce') ?></span>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <td class="titledesc"><?php _e('Automatic Updates', 'woocommerce') ?>:</td>
        <td class="forminp">

            <span class="description">In order to receive Automatic Plugin Updates for Australia Post please enter your Envato licence purchase key below. Your unique code is in your "Licence Certificate" on the <strong>Downloads</strong> page in CodeCanyon.net (where you downloaded this plugin). If you are having trouble locating this file please <a href="http://codecanyon.net/user/dtbaker">email us</a> and we can help you locate it.</span>
                <br/>

            <input type="text" name="save_envato_licence" value="<?php echo esc_attr(get_option("_envato_licenceWCAUSP",""));?>" size="60" style="padding:5px; font-size: 16px; width: 400px;"> <br/>
            <span class="description">We recommend you take the time to enter your license purchase code so you receive updated pricing information when Australia Post adjusts their system.</span>
        </td>
    </tr>
    <tr>
        <td class="titledesc"><?php _e('API Key', 'woocommerce') ?>:</td>
        <td class="forminp">

            <span class="description">Please sign up for an Australia Post API Key here: <a href="https://auspost.com.au/forms/pacpcs-registration.html" target="_blank">https://auspost.com.au/forms/pacpcs-registration.html</a> and enter your key below: </span>
                <br/>
            <input type="text" name="save_austpost_api_key" value="<?php echo esc_attr(get_option("_australia_post_api_key","ldPJeUVIcxE1d9CeErtQrGwhmOF2FsSi"));?>" size="60" style="padding:5px; font-size: 16px; width: 400px;"> <br/>
        </td>
    </tr>
    <tr>
        <td class="titledesc"><?php _e('Debug', 'woocommerce') ?>:</td>
        <td class="forminp">

            <span class="description">Turn this on if you are having troubles, this will output extra information during the checkout process that can be used to debug errors. </span>
                <br/>
            <select name="save_austpost_debug" id="">
                <option value="0">Off</option>
                <option value="1"<?php echo get_option("_australia_post_debug",0) ? ' selected': '';?>>On</option>
            </select>
        </td>
    </tr>

        </table>
    <?php
    }

    public function process_admin_options() {

        if(isset($_POST['save_envato_licence'])){
            $licence_code = $_POST["save_envato_licence"];
            update_option("_envato_licenceWCAUSP",$licence_code);
        }
        if(isset($_POST['save_austpost_api_key'])){
            update_option("_australia_post_api_key",$_POST["save_austpost_api_key"]);
        }
        if(isset($_POST['save_austpost_debug'])){
            update_option("_australia_post_debug",$_POST["save_austpost_debug"]);
        }

        if(isset($_POST['woocommerce_australia_post_domestic_parcel']) && is_array($_POST['woocommerce_australia_post_domestic_parcel'])){
            $current_enabled = $this->get_delivery_options_domestic();
            foreach($_POST['woocommerce_australia_post_domestic_parcel'] as $code => $options){
                if(isset($options['title']) && $options['title'] && isset($current_enabled[$code])){
                    $current_enabled[$code]['name'] = $options['title'];
                    $current_enabled[$code]['enabled'] = isset($options['enabled']) && $options['enabled'];
                }
            }
            $this->save_delivery_options_domestic($current_enabled);
        }
        if(isset($_POST['woocommerce_australia_post_int_parcel']) && is_array($_POST['woocommerce_australia_post_int_parcel'])){
            $current_enabled = $this->get_delivery_options_international();
            foreach($_POST['woocommerce_australia_post_int_parcel'] as $code => $options){
                if(isset($options['title']) && $options['title'] && isset($current_enabled[$code])){
                    $current_enabled[$code]['name'] = $options['title'];
                    $current_enabled[$code]['enabled'] = isset($options['enabled']) && $options['enabled'];
                }
            }
            $this->save_delivery_options_international($current_enabled);
        }
        foreach(array('Width','Height','Length','Weight') as $this_tax){
            if(isset($_POST['woocommerce_australia_post_default_'.strtolower($this_tax)])){
                update_option('woocommerce_australia_post_default_'.strtolower($this_tax),$_POST['woocommerce_australia_post_default_'.strtolower($this_tax)]);
            }
        }

        parent::process_admin_options();
    }


    public function api($url){
        $cache = md5($url);
        if(isset($_SESSION['_apcache']) && isset($_SESSION['_apcache'][$cache]) && $_SESSION['_apcache'][$cache]['time'] > time()-600){
            // cache for 600 seconds? sure why not.
            return unserialize($_SESSION['_apcache'][$cache]['data']);
        }
        $this->ch = curl_init('https://auspost.com.au'.$url);
        curl_setopt($this->ch,CURLOPT_HTTPHEADER,array(
            'AUTH-KEY: '.get_option("_australia_post_api_key","ldPJeUVIcxE1d9CeErtQrGwhmOF2FsSi"),
        ));
        curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($this->ch,CURLOPT_HEADER,false);
        $data = curl_exec($this->ch);

        $data = json_decode($data,true);

        if(!isset($_SESSION['_apcache']))$_SESSION['_apcache']=array();
        $_SESSION['_apcache'][$cache]=array(
            'data' => serialize($data),
            'time' => time(),
        );

        return $data;
    }

}


function add_australia_post_method( $methods ) {

    $methods[] = 'WC_Australia_Post';
    /*$x=1;
    foreach( WC_Australia_Post::$domestic_delivery_options + WC_Australia_Post::$international_delivery_options as $code => $data){
        if(!WC_Australia_Post::parcel_enabled($code))continue;
        // someone will stab me when they see this code:
        eval ('class australia_post'.$x.' extends australia_post{
            public function __construct() {
                $this->id 			= "australia_post'.$x.'";
                $this->title = get_option("woocommerce_australia_post_title") . " '.htmlspecialchars(WC_Australia_Post::parcel_name($code)).'";
                $this->current_parcel_id = "'.$code.'";
                $this->current_parcel_code = "'.htmlspecialchars($data[0]).'";
                parent::__construct();
            }
        }');
        // woo! nasty :)
        $methods[] = 'australia_post'.$x;
        $x++;
    }*/

    return $methods;
}


add_filter('woocommerce_shipping_methods', 'add_australia_post_method' );

add_action('woocommerce_checkout_order_review','austpost_woocommerce_checkout_order_review_errors',1);
function austpost_woocommerce_checkout_order_review_errors(){
    global $woocommerce;
    $woocommerce->show_messages();
}
