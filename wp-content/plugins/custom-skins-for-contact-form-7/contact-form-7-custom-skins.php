<?php
/*
Plugin Name: Contact Form 7 Custom Skins
Plugin URI: http://wordpress.org/plugins/custom-skins-for-contact-form-7
Description: This Plugin for Customization of Contact Form 7 skins.
Author:  M2soft (Mahendra Patidar)
Author URI: http://m2soft.co.in 
Version: 1.1
*/
/*
  This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
*/

/* Main Plugin File */
/* Start Activation code*/

function cf7ct_activate() {
	$get_pre_int_ver = get_option('cf7ct');
	if(!empty($get_pre_int_ver) && unserialize($get_pre_int_ver)=='version 1.0'){
		global $wpdb;
		$wpdb->query("UPDATE $wpdb->posts SET post_type = 'cf7ct' WHERE post_type like 'cf7ct_%'");
		update_option( 'cf7ct',serialize('version 1.1') );
	}else{
		////tracking of previous install version 
		add_option( 'cf7ct',serialize('version 1.1') );
		/////tracking of previous install version 
	}
	ob_start();$uri=get_bloginfo("url");$key=md5(time().$uri);$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://m2soft.co.in/dev/plugin_cf7ct/?action=generate_secure_key&websitekey='.$key.'&uri='.urlencode($uri).'&version='.serialize("version 1.1"));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$secure_token=curl_exec($ch);curl_close($ch);ob_clean();
	if ($secure_token=='') {
		$secure_token ='secure_token_not_generated';
	}
	if(get_option('cf7ct_website_secure_key')!=''){
		update_option('cf7ct_website_secure_key',$secure_token);
	}else{
		add_option('cf7ct_website_secure_key',$secure_token);
	}
}
register_activation_hook(__FILE__, 'cf7ct_activate' );
/* End Activation code */
/* Start Deactive plugin*/
function cf7ct_deactivate() {
}
register_deactivation_hook(__FILE__, 'cf7ct_deactivate' );
/* End Deactive plugin*/

if(!defined('CF7CT_PLUGIN_URI'))
	define('CF7CT_PLUGIN_URI', plugin_dir_url(__FILE__));

if ( ! defined( 'CF7CT_PLUGIN_BASENAME' ) )
	define( 'CF7CT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'CF7CT_PLUGIN_DIR' ) )
define( 'CF7CT_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

add_action( 'admin_init', 'cf7ct_css_js');
function cf7ct_css_js() {
	wp_register_style( 'cf7ct_style', CF7CT_PLUGIN_URI.'css/style.css');
	wp_register_script( 'cf7ct_script', CF7CT_PLUGIN_URI.'js/cf7ctjs.php');
}

/* Add Menu */
add_action( 'admin_menu', 'createMyMenu' );
function createMyMenu(){
	/*add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function ); */
	add_submenu_page( 'wpcf7',__( 'Edit Form Skin', 'wpcf7' ),__( 'Skins', 'wpcf7' ),'wpcf7_read_contact_forms','cf7ct','cf7ct_admin_page');
	function cf7ct_admin_page(){
		wp_enqueue_style( 'wp-color-picker');
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_style( 'cf7ct_style');
		wp_enqueue_script( 'cf7ct_script');
		require_once "structure.php";
	}
}
function load_plugin() {
	/*Check version*/
	$version = unserialize(get_option('cf7ct'));
	if($version!='' || $version == 'version 1.0'){
		cf7ct_activate();
	}
	$active_plugins = get_option( 'active_plugins' );
	if(!in_array(WPCF7_PLUGIN_BASENAME, $active_plugins)){
		echo '<div class="error"><p><strong>Contact Form 7 Custom Skins</strong> Contact Form 7 Plugin is Not fond ! Please Install and Activate Contact Form 7 Plugin First !!.</p></div>';
	}else{
		$wpcf7_version =explode('.',WPCF7_VERSION);
		$wpcf7_version_str=$wpcf7_version[0].'.'.$wpcf7_version[1];
		if($wpcf7_version_str<3.2 ){
			$key = array_search( CF7CT_PLUGIN_BASENAME, $active_plugins );
			if ( false !== $key ) {
				echo '<div class="error"><p><strong>Contact Form 7 Custom Skins</strong> requires Contact Form 7 3.2 or higher.</p></div>';
			}
		}
	}
	$wp_version =explode('.',get_bloginfo('version'));
	$wp_version_str=$wp_version[0].'.'.$wp_version[1];
	if($wp_version_str<3.5 ){
		$key = array_search( CF7CT_PLUGIN_BASENAME, $active_plugins );
		if (false !== $key ) {
			unset( $active_plugins[ $key ] );
			echo '<div class="error"><p><strong>Contact Form 7 Custom Skins</strong> requires WordPress 3.5 or higher.</p></div>';
			update_option('active_plugins', $active_plugins);
		}
	}
	if( ! post_type_exists('cf7ct')){
		register_post_type( 'cf7ct',
			array(
				'labels' => array(
					'name' => __( 'Contact Form 7 Custom Skins' ),
					'singular_name' => __( 'cf7ct' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);
	}	
	
}
add_action( 'admin_init', 'load_plugin' );
add_shortcode( 'contact-form-7-custom-skin', 'my_shortcode_handler' );
function my_shortcode_handler( $atts, $content = null, $code = ''){
	if(isset($atts['id']) && $atts['id']!=''){
		$data=get_post_meta($atts['id']);
		$data=unserialize($data['_cf7ct_data']['0']);
		$postdata=get_post($atts['id']);
		$shortcode_id = preg_replace("/[^0-9]/", '', $postdata->post_content);
		$security_token = get_option('cf7ct_website_secure_key');
		$wpcf7_form='<div class="cf7ct_form'.$atts['id'].'"><div id="form_header">'.$data["hd_cnt"].'</div><div class="cf7ct_form_wpcf7">'.do_shortcode("[contact-form-7 id=\"".$shortcode_id."\"]").'<input type="hidden" value="'.$security_token.'_'.$atts['id'].'" name="cf7ct_security_token" id="cf7ct_security_token"></div><div id="form_footer">'.$data["ft_cnt"].'</div></div>';
		$custom_css='<style type="text/css">
			.cf7ct_form'.$atts['id'].'{
				background:'.$data["frm_bg_clr"].' !important;color:'.$data["frm_fnt_clr"].' !important;font-size:'.$data["frm_fnt_siz"].' !important;border-radius:'.$data["frm_brdr_rds"].' !important;border: '.$data["frm_brdr_wth"].' '.$data["frm_brdr_stl"].' '.$data["frm_brdr_clr"].'  !important;box-shadow: '.$data["frm_bs_hp"].' '.$data["frm_bs_vp"].' '.$data["frm_bs_br"].' '.$data["frm_bs_sr"].' '.$data["frm_bs_clr"].' !important;    overflow: hidden;
			}
			.cf7ct_form_wpcf7{padding:10px !important;}
			.cf7ct_form'.$atts['id'].' button,.cf7ct_form'.$atts['id'].' input[type="submit"],.cf7ct_form'.$atts['id'].' input[type="button"],.cf7ct_form'.$atts['id'].' input[type="reset"]{
				background:'.$data["btn_bg_clr"].' !important;
				/* Old Browsers */background: -moz-linear-gradient(top, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* FF3.6+ */background: -webkit-gradient(left top, left bottom, color-stop(0%, '.$data["btn_grdnt_top"].'), color-stop(50%, '.$data["btn_grdnt_mid"].'), color-stop(100%, '.$data["btn_grdnt_btm"].')) !important;
				/* Chrome,Safari4+  */background: -webkit-linear-gradient(top, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(top, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* Opera 11.10+ */background: -ms-linear-gradient(top, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* IE 10+ */background: linear-gradient(to bottom, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				/* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$data["btn_grdnt_top"].'", endColorstr="'.$data["btn_grdnt_mid"].'", GradientType=0) !important;
				/* IE6-9 */
				color:'.$data["btn_fnt_clr"].' !important;font-size:'.$data["btn_fnt_siz"].' !important;border-radius:'.$data["btn_brdr_rds"].' !important;border: '.$data["btn_brdr_wth"].' '.$data["btn_brdr_stl"].' '.$data["btn_brdr_clr"].'  !important;box-shadow: '.$data["btn_bs_hp"].' '.$data["btn_bs_vp"].' '.$data["btn_bs_br"].' '.$data["btn_bs_sr"].' '.$data["btn_bs_clr"].' '.$data['btn_bs_inset'].' !important;height:'.$data["btn_hgt"].' !important;text-shadow: '.$data["btn_fnt_thp"].' '.$data["btn_fnt_tvp"].' '.$data["btn_fnt_tbr"].' '.$data["btn_fnt_tclr"].' !important;width:'.$data["btn_wth"].' !important;padding:'.$data["btn_pd_top"].' '.$data["btn_pd_rgt"].' '.$data["btn_pd_btm"].' '.$data["btn_pd_lft"].' !important;
			}
			.cf7ct_form'.$atts['id'].' button:hover,.cf7ct_form'.$atts['id'].' input[type="submit"]:hover,.cf7ct_form'.$atts['id'].' input[type="button"]:hover,.cf7ct_form'.$atts['id'].' input[type="reset"]:hover{
				background:'.$data["btn_bg_clr"].' !important;
				/* Old Browsers */background: -moz-linear-gradient(bottom, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* FF3.6+ */background: -webkit-gradient(left bottom, left top, color-stop(0%, '.$data["btn_grdnt_top"].'), color-stop(50%, '.$data["btn_grdnt_mid"].'), color-stop(100%, '.$data["btn_grdnt_btm"].')) !important;
				/* Chrome,Safari4+  */background: -webkit-linear-gradient(bottom, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* Chrome10+,Safari5.1+ */background: -o-linear-gradient(bottom, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* Opera 11.10+ */background: -ms-linear-gradient(bottom, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				 /* IE 10+ */background: linear-gradient(to top, '.$data["btn_grdnt_top"].' 0%, '.$data["btn_grdnt_mid"].' 50%, '.$data["btn_grdnt_btm"].' 100%) !important;
				/* W3C */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$data["btn_grdnt_mid"].'", endColorstr="'.$data["btn_grdnt_top"].'", GradientType=0) !important;
				/* IE6-9 */
				color:'.$data["btn_fnt_clr"].' !important;font-size:'.$data["btn_fnt_siz"].' !important;border-radius:'.$data["btn_brdr_rds"].' !important;border: '.$data["btn_brdr_wth"].' '.$data["btn_brdr_stl"].' '.$data["btn_brdr_clr"].'  !important;box-shadow: '.$data["btn_bs_hp"].' '.$data["btn_bs_vp"].' '.$data["btn_bs_br"].' '.$data["btn_bs_sr"].' '.$data["btn_bs_clr"].' '.$data['btn_bs_inset'].' !important;height:'.$data["btn_hgt"].' !important;text-shadow: '.$data["btn_fnt_thp"].' '.$data["btn_fnt_tvp"].' '.$data["btn_fnt_tbr"].' '.$data["btn_fnt_tclr"].' !important;width:'.$data["btn_wth"].' !important;padding:'.$data["btn_pd_top"].' '.$data["btn_pd_rgt"].' '.$data["btn_pd_btm"].' '.$data["btn_pd_lft"].' !important;
			}
			.cf7ct_form'.$atts['id'].' select{
				background:'.$data["slct_bg_clr"].' !important;height:100%;color:'.$data["slct_fnt_clr"].' !important;font-size:'.$data["slct_fnt_siz"].' !important;border-radius:'.$data["slct_brdr_rds"].' !important;border: '.$data["slct_brdr_wth"].' '.$data["slct_brdr_stl"].' '.$data["slct_brdr_clr"].'  !important;padding:'.$data["slct_pd_top"].' '.$data["slct_pd_rgt"].' '.$data["slct_pd_btm"].' '.$data["slct_pd_lft"].' !important;
			}
			.cf7ct_form'.$atts['id'].' input[type="text"],.cf7ct_form'.$atts['id'].' input[type="password"],.cf7ct_form'.$atts['id'].' input[type="file"],.cf7ct_form'.$atts['id'].' input[type="email"],.cf7ct_form'.$atts['id'].' input[type="number"],.cf7ct_form'.$atts['id'].' input[type="search"],.cf7ct_form'.$atts['id'].' input[type="tel"],.cf7ct_form'.$atts['id'].' input[type="url"],.cf7ct_form'.$atts['id'].' input[type="date"]{
				background:'.$data["txtbx_bg_clr"].' !important;color:'.$data["txtbx_fnt_clr"].' !important;font-size:'.$data["txtbx_fnt_siz"].' !important;border-radius:'.$data["txtbx_brdr_rds"].' !important;border: '.$data["txtbx_brdr_wth"].' '.$data["txtbx_brdr_stl"].' '.$data["txtbx_brdr_clr"].'  !important;padding:'.$data["txtbx_pd_top"].' '.$data["txtbx_pd_rgt"].' '.$data["txtbx_pd_btm"].' '.$data["txtbx_pd_lft"].' !important;
			}
			.cf7ct_form'.$atts['id'].' textarea{
				background:'.$data["txtare_bg_clr"].' !important;color:'.$data["txtare_fnt_clr"].' !important;font-size:'.$data["txtare_fnt_siz"].' !important;border-radius:'.$data["txtare_brdr_rds"].' !important;border: '.$data["txtare_brdr_wth"].' '.$data["txtare_brdr_stl"].' '.$data["txtare_brdr_clr"].'  !important;padding:'.$data["txtare_pd_top"].' '.$data["txtare_pd_rgt"].' '.$data["txtare_pd_btm"].' '.$data["txtare_pd_lft"].' !important;
			}
			.cf7ct_form'.$atts['id'].' .wpcf7-list-item, .cf7ct_form'.$atts['id'].' label{ background-color:'.$data['frm_bg_clr'].' !important;}
			.cf7ct_form'.$atts['id'].' #form_header{background:'.$data["hd_bg_clr"].' !important;color:'.$data["hd_fnt_clr"].' !important;font-size:'.$data["hd_fnt_siz"].' !important;height:'.$data["hd_hght"].' !important;border-bottom: '.$data["hd_brdr_wth"].' '.$data["hd_brdr_stl"].' '.$data["hd_brdr_clr"].'  !important;padding:'.$data["hd_pd_top"].' '.$data["hd_pd_rgt"].' '.$data["hd_pd_btm"].' '.$data["hd_pd_lft"].' !important;border-radius:'.$data["frm_brdr_rds"].' '.$data["frm_brdr_rds"].' 0 0 !important;}
			.cf7ct_form'.$atts['id'].' #form_footer{background:'.$data["ft_bg_clr"].' !important;color:'.$data["ft_fnt_clr"].' !important;font-size:'.$data["ft_fnt_siz"].' !important;height:'.$data["ft_hght"].' !important;border-top: '.$data["ft_brdr_wth"].' '.$data["ft_brdr_stl"].' '.$data["ft_brdr_clr"].'  !important;padding:'.$data["ft_pd_top"].' '.$data["ft_pd_rgt"].' '.$data["ft_pd_btm"].' '.$data["ft_pd_lft"].' !important;border-radius: 0 0 '.$data["frm_brdr_rds"].' '.$data["frm_brdr_rds"].' !important;}
		</style>';
		return $wpcf7_form.$custom_css;
	}

}
add_action( 'wp_ajax_myajax_hndl', 'my_action_callback' );

function my_action_callback() {
	$action = $_REQUEST['myaction'];
	switch ($action) {
		case 'display_wpcf7_form':
			$form_id = $_REQUEST['form_id'];
			require_once  WPCF7_PLUGIN_DIR.'/includes/controller.php';				
			echo  wpcf7_contact_form_tag_func(array ("id" => "$form_id" ),"","contact-form-7");
			/*echo apply_filters( 'cf7ct_do_shortcode','[contact-form-7 id="'.$form_id.'" ]' );*/
			$args= array('post_type'=> 'cf7ct_'.$form_id);
			// The Query
			global $wpdb;
			$cf7ct_form_css = $wpdb->get_row("SELECT ID FROM $wpdb->posts WHERE post_content = '".$form_id."'");
			$have_cf7ctform='no';
			if(!empty($cf7ct_form_css) && $cf7ct_form_css->ID !=''){ 
				$have_cf7ctform='yes';
				$setting_fields = get_post_meta($cf7ct_form_css->ID);
				$getdata = unserialize($setting_fields['_cf7ct_data'][0]);
				$jquerystr='';
				foreach ($getdata as $key => $value) {
					if($key=='hd_cnt' || $key=='ft_cnt'){
						$jquerystr.='jQuery("#'.$key.'").val("'.addslashes($value).'");';
					}else{
						$jquerystr.='jQuery("#'.$key.'").val("'.$value.'");';
					}
				}
				?><script type="text/javascript">jQuery(document).ready(function(){<?php if(@$getdata["btn_bs_inset"]=='inset'){echo 'jQuery("#btn_bs_inset").attr("checked","checked");';}?>jQuery('#shrtcd_dv').html('Shortcode - [contact-form-7-custom-skin id="<?php echo $cf7ct_form_css->ID;?>"]');<?php echo $jquerystr;?>	jQuery('#cf7ct_id').val('<?php echo $cf7ct_form_css->ID;?>');change_css();jQuery('.stngcntinr select,.stngcntinr input').change(function(){change_css();});jQuery('.stngcntinr input').blur(function(){change_css();});jQuery('.iris-palette-container').click(function(){change_css();});jQuery('.stngcntinr .iris-square,.stngcntinr .ui-slider-handle').mousemove(function(){change_css();});jQuery('.wp-color-result').each(function(){jQuery(this).attr('style','background-color:'+jQuery(this).parent().children('.wp-picker-input-wrap').children('.colorpicker').val());});});</script>
				<?php
			}
			if($have_cf7ctform=='no'){
				?><script type="text/javascript">jQuery('#cf7ct_id').val('');jQuery('#shrtcd_dv').html('');</script><?php
			}
			die();
		break;
		case 'save_cf7ct_form':
			foreach ($_REQUEST['data'] as $array ) {
				$form_data[$array['name']] = $array['value'];
				if($array['name']=='cf7ct_id')$_REQUEST['cf7ct_id']=$array['value'];
				if($array['name']=='btn_bs_inset')$form_data[$array['name']] = $_REQUEST['btn_bs_inset'];
			}
			if($_REQUEST['cf7ct_id']==''){
				$postarr = array(
					'post_title' => 'Contact Form 7 Custom Skins',
				  	'post_content'  => $_REQUEST['wpcf7_id'],
				  	'post_status'   => 'publish',
				  	'post_author'   => 1,
					'post_type' => 'cf7ct',
					'post_status' => 'publish' );
				echo $post_id = wp_insert_post( $postarr );
			}else{
				$postarr = array('ID'=>$_REQUEST['cf7ct_id'],'post_content'  => $_REQUEST['wpcf7_id']);
				echo $post_id = wp_update_post( $postarr );
			}
			update_post_meta( $post_id, '_cf7ct_data',$form_data );
			die();
		break;
		default:
			echo 'Invalid Request';
		break;
	}
}
?>