<?php
/**
 * eWAY Shared Payment Gateway
 *
 * Provides an eWAY Payment Gateway for eWAY AU, NZ, UK shared payments
 *
 * @class 		WC_EWAY_Shared
 * @extends		WC_Payment_Gateway
 * @version		2.0
 * @package		WooCommerce/Classes/Payment
 * @author 		Gerhard Potgieter
 */

class WC_EWAY_Shared extends WC_Payment_Gateway {

	/**
	 * Class contructor
	 *
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	function __construct() {
		global $woocommerce;
		$this->id = 'eway_shared';
		$this->icon = apply_filters( 'eway_shared_icon', $this->plugin_url() . '/assets/images/eway_icon.png' );
		$this->method_title = __( 'eWAY Shared Payments', 'wc_eway_shared' );
		$this->has_fields = false;
		$this->urls = array(
			'AU' => array(
				'request' => 'https://au.ewaygateway.com/Request',
				'result' => 'https://au.ewaygateway.com/Result'
			),
			'NZ' => array(
				'request' => 'https://nz.ewaygateway.com/Request',
				'result' => 'https://nz.ewaygateway.com/Result'
			),
			'UK' => array(
				'request' => 'https://payment.ewaygateway.com/Request',
				'result' => 'https://payment.ewaygateway.com/Result'
			)
		);

		// Load the form fields.
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();

		// Define setting variables
		$this->enabled = $this->get_option( 'enabled' );
		$this->title = $this->get_option( 'title' );
		$this->description = $this->get_option( 'description' );
		$this->testmode = $this->get_option( 'testmode' );
		$this->customer_id = ( $this->testmode == 'yes' ) ? '87654321' : $this->get_option( 'customer_id' );
		$this->customer_username = ( $this->testmode == 'yes' ) ? 'TestAccount' : $this->get_option( 'customer_username' );
		$this->country = $this->get_option( 'country' );

		// Define gateway extra settings with filters for override
		$this->return_url = $woocommerce->api_request_url( get_class( $this ) );
		$this->cancel_url = apply_filters( 'eway_shared_cancel_url', add_query_arg( array( 'status' => 'cancel' ), $woocommerce->api_request_url( get_class( $this ) ) ) );
		$this->page_title = apply_filters( 'eway_shared_page_tite', '' );
		$this->page_description = apply_filters( 'eway_shared_page_description', '' );
		$this->page_footer = apply_filters( 'eway_shared_page_footer', '' );
		$this->language = apply_filters( 'eway_shared_language', 'EN' );
		$this->company_logo = apply_filters( 'eway_shared_company_logo', '' );
		$this->company_name = apply_filters( 'eway_shared_company_name', '' );
		$this->page_banner = apply_filters( 'eway_shared_page_banner', '' );
		$this->modifiable_customer_details = apply_filters( 'eway_shared_modifiable_customer_details', 'False' );
		$this->use_avs = apply_filters( 'eway_shared_use_avs', 'False' );
		$this->use_zip = apply_filters( 'eway_shared_use_zip', 'False' );

		// Hooks
		add_action( 'woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options' ) ); // WC <= 1.6.6
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );  // WC >= 2.0
		add_action( 'woocommerce_api_' . strtolower( get_class( $this ) ), array( $this, 'process_response' ) );
		add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'receipt_page' ) );
	} // End __construct()

	/**
	 * Get the plugin URL
	 *
	 * @since 1.0
	 * @access public
	 * @return string
	 */
	function plugin_url() {
		if( isset( $this->plugin_url ) ) return $this->plugin_url;

		if ( is_ssl() ) {
			return $this->plugin_url = str_replace('http://', 'https://', WP_PLUGIN_URL) . "/" . plugin_basename( dirname( dirname( __FILE__ ) ) );
		} else {
			return $this->plugin_url = WP_PLUGIN_URL . "/" . plugin_basename( dirname( dirname( __FILE__ ) ) );
		}
	} // End plugin_url()

	/**
	 * Initialize Gateway Settings form fields
	 *
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title' => __( 'Enable/Disable', 'wc_eway_shared' ),
				'label' => __( 'Enable eWAY Shared Payments', 'wc_eway_shared' ),
				'type' => 'checkbox',
				'description' => '',
				'default' => 'no'
			),
			'title' => array(
				'title' => __( 'Title', 'wc_eway_shared' ),
				'type' => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'wc_eway_shared' ),
				'default' => __( 'Credit Card (eWAY Shared Payments)', 'wc_eway_shared' )
			),
			'description' => array(
				'title' => __( 'Description', 'wc_eway_shared' ),
				'type' => 'textarea',
				'description' => __( 'This controls the description which the user sees during checkout.', 'wc_eway_shared' ),
				'default' => 'Pay with your credit card via eWAY gateway.'
			),
			'customer_id' => array(
				'title' => __( 'eWAY Customer ID', 'wc_eway_shared' ),
				'type' => 'text',
				'description' => __( 'Your eWAY Customer ID emailed to you in your "eWAY Welcome Letter" when you join eWAY.', 'wc_eway_shared' ),
				'default' => ''
			),
			'customer_username' => array(
				'title' => __( 'eWAY Username', 'wc_eway_shared' ),
				'type' => 'text',
				'description' => __( 'Your eWAY Username, used to sign into eWAY', 'wc_eway_shared' ),
				'default' => ''
			),
			'country' => array(
				'title' => __( 'eWAY Location', 'wc_eway_shared' ),
				'type' => 'select',
				'description' => __( 'The location of the eWAY service you are using.', 'wc_eway_shared' ),
				'options' => array(
					'AU' => __( 'eWAY Australia', 'wc_eway_shared' ),
					'NZ' => __( 'eWAY New Zealand', 'wc_eway_shared' ),
					'UK' => __( 'eWAY United Kingdom', 'wc_eway_shared' )
				),
				'default' => 'AU'
			),
			'testmode' => array(
				'title' => __( 'eWAY Sandbox', 'wc_eway_shared' ),
				'type' => 'checkbox',
				'description' => __( 'Place the gateway in development mode', 'wc_eway_shared' )
			)
		);
	} // End init_form_fields()

	/**
	 * Process the payment
	 *
	 * @since 1.0
	 * @param int $order_id
	 * @return mixed
	 */
	function process_payment( $order_id ) {
		global $woocommerce;
		// Get the order
		$order = new WC_Order( $order_id );
		// Build the GET url
		$eway_args = $this->get_eway_args( $order );
		$eway_args = http_build_query( $eway_args, '', '&' );

		// Retrieve the form URL
		$url = $this->urls[$this->country]['request'];
		$url .= '?' . $eway_args;
		$response = wp_remote_get( $url, array(
			'timeout' => 100,
			'user-agent' => 'WooCommerce/' . $woocommerce->version . '; ' . get_site_url()
		) );

		if ( is_wp_error( $response ) ) {
			$woocommerce->add_error( $response->get_error_message() );
			return;
		}

		$result = simplexml_load_string( $response['body'] );

		if ( ! is_object( $result ) ) {
			$woocommerce->add_error( __( 'There was an error processing your transaction.', 'wc_eway_shared' ) );
			return;
		}

		if ( $result->Result == 'False' ) {
			$woocommerce->add_error( $result->Error );
			return;
		}

		$redirect_url = $result->URI;

		return array(
			'result' 	=> 'success',
			'redirect'	=> add_query_arg( array ( 'key' => $order->order_key, 'uri' => base64_encode( $redirect_url ) ), $order->get_checkout_payment_url( true ) )
		);

	} // End process_payment()

	/**
	 * Reciept page.
	 *
	 * Display text and a button to direct the user to eWAY to make payment.
	 *
	 * @since 1.0
	 * @param object $order
	 * @return void
	 */
	function receipt_page( $order_id ) {
		global $woocommerce;
		$order = new WC_Order( $order_id );
		echo '<p>' . __( 'Thank you for your order, please click the button below to pay with eWAY.', 'wc_eway_shared' ) . '</p>';
		$form_url = base64_decode( $_REQUEST['uri'] );
		echo '	<a class="button" id="submit_eway_payment_form" href="' . $form_url . '">' . __( 'Pay via eWAY', 'wc_eway_shared' ) . '</a> <a class="button cancel" href="' . $order->get_cancel_order_url() . '">' . __( 'Cancel order &amp; restore cart', 'wc_eway_shared' ) . '</a>
				<script type="text/javascript">
					jQuery(function(){
						jQuery("body").block(
							{
								message: "<img src=\"' . $woocommerce->plugin_url() . '/assets/images/ajax-loader.gif\" alt=\"Redirecting...\" />' . __( 'Thank you for your order. We are now redirecting you to eWAY to make payment.', 'wc_eway_shared' ) . '",
								overlayCSS:
								{
									background: "#fff",
									opacity: 0.6
								},
								css: {
							        padding:        20,
							        textAlign:      "center",
							        color:          "#555",
							        border:         "3px solid #aaa",
							        backgroundColor:"#fff",
							        cursor:         "wait"
							    }
							});
						window.location.replace("' . $form_url . '");
					});
				</script>';
	} // End receipt_page()

	/**
	 * Build the query to request a form url
	 *
	 * @since 1.0
	 * @param object $order
	 * @return string
	 */
	function get_eway_args( $order ) {
		// Build the args to send to get form url
		$form_args = array(
			'CustomerID' => $this->customer_id,
			'UserName' => $this->customer_username,
			'Amount' => number_format( $order->order_total, 2, '.', '' ),
			'Currency' => get_woocommerce_currency(),
			'ReturnURL' =>$this->return_url,
			'CancelURL' =>$this->cancel_url,
			'PageTitle' =>$this->page_title,
			'PageDescription' =>$this->page_description,
			'PageFooter' => $this->page_footer,
			'CompanyLogo' => $this->company_logo,
			'Pagebanner' => $this->page_banner,
			'ModifiableCustomerDetails' => $this->modifiable_customer_details,
			'Language' => $this->language,
			'CompanyName' => $this->company_name,
			'CustomerFirstName' => $order->billing_first_name,
			'CustomerLastName' => $order->billing_last_name,
			'CustomerAddress' => $order->billing_address_1 . "\n" . $order->billing_address_2,
			'CustomerCity' => $order->billing_city,
			'CustomerState' => $order->billing_state,
			'CustomerPostCode' => $order->billing_postcode,
			'CustomerCountry' => $order->billing_country,
			'CustomerPhone' => $order->billing_phone,
			'CustomerEmail' => $order->billing_email,
			'InvoiceDescription' => apply_filters( 'eway_shared_invoice_description', $this->get_order_items_as_string( $order ), $order ),
			'MerchantReference' => $order->get_order_number(),
			'MerchantInvoice' => $order->get_order_number(),
			'MerchantOption1' => $order->id,
			'MerchantOption2' => $order->order_key,
			'MerchantOption3' => '',
			'UseAVS' => $this->use_avs,
			'UseZIP' => $this->use_zip
		);
		return $form_args;
	} // End get_eway_args()

	/**
	 * Process the response
	 *
	 * @since 1.0
	 * @return void
	 */
	function process_response() {
		global $woocommerce;
		// Clean
		@ob_clean();
		// Header
		header('HTTP/1.1 200 OK');
		// Clean the response variables up
		$_REQUEST = stripslashes_deep( $_REQUEST );

		if ( isset( $_REQUEST['AccessPaymentCode'] ) ) {
			$result_args = array(
				'CustomerID' => $this->customer_id,
				'UserName' => $this->customer_username,
				'AccessPaymentCode' => $_REQUEST['AccessPaymentCode']
			);
			$result_url = $this->urls[$this->country]['result'] . '?' . http_build_query( $result_args, '', '&' );
			$response = wp_remote_get( $result_url, array(
				'timeout' => 100,
				'user-agent' => 'WooCommerce/' . $woocommerce->version . '; ' . get_site_url()
			) );
			if ( is_wp_error( $response ) ) {
				throw new Exception( $response->get_error_message() );
				return;
			}

			$result = simplexml_load_string( $response['body'] );

			// get the order
			$order_id = (int)$result->MerchantOption1;
			$order = new WC_Order( $order_id );

			if ( $order->status <> 'Completed' ) {
				if ( $order->order_key <> $result->MerchantOption2 ) {
					$order->update_status( 'failed', __( 'eWAY Payment Failed: Order key not the same as was sent through.', 'wc_eway_shared' ) );
					wp_redirect( $this->get_return_url( $order ) );
					exit;
				}

				// Check the response code and process order accordingly
				switch( $result->ResponseCode ) {
					case '00' :
					case '08' :
					case '10' :
					case '11' :
					case '16' :
							$order->add_order_note( sprintf( __( 'eWAY Payment Completed Successfully: Response Code %s', 'wc_iveri' ), $result->ResponseCode ) );
							$order->payment_complete();
						break;
					case 'CX' :
							wp_redirect( $order->get_cancel_order_url() );
							exit;
						break;
					default :
							$order->update_status( 'failed', sprintf( __( 'eWAY Payment Failed: %s', 'wc_eway_shared' ), $result->ErrorMessage ) );
						break;
				}
				wp_redirect( $this->get_return_url( $order ) );
				exit;
			}
			wp_redirect( $this->get_return_url( $order ) );
			exit;
		}
		exit;
	}

	/**
	 * Get a list of order items in string format
	 *
	 * @since 1.0
	 * @param object $order
	 * @return string
	 */
	function get_order_items_as_string( $order ) {
		$item_names = array();
		if ( sizeof( $order->get_items() ) > 0 )
			foreach ( $order->get_items() as $item )
				if ( $item['qty'] )
					$item_names[] = $item['qty'] . ' x ' . htmlentities( $item['name'] );

		if ( ( $order->get_shipping() + $order->get_shipping_tax() ) > 0 )
			$item_names[] = __( 'Shipping via', 'woocommerce' ) . ' ' . ucwords( $order->shipping_method_title );

		return implode( $item_names, ', ' );
	}


}
?>