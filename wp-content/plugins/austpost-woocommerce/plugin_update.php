<?php

//$current = get_transient( 'update_plugins' );	//Get the current update info
//$current->last_checked = 0;						//wp_update_plugins() checks this value when determining
//set_transient( 'update_plugins', null);

/***** BEGIN AUTOMATIC UPDATE CODE *******/
if(!function_exists("dtbaker_prepare_request5")){
    function dtbaker_prepare_request5($action, $args) {
        global $wp_version;
        return array(
            "body" => array(
                "action" => $action,
                "args" => serialize($args),
                "envatolicence" => get_option("_envato_licenceWCAUSP",""),
                "envatoitem" => "WCAUSP",
                "install" => get_bloginfo("url"),
            ),
            "user-agent" => "WordPress/" . $wp_version . "; " . get_bloginfo("url")
        );
    }
}
add_filter("pre_set_site_transient_update_plugins", "dtbaker_check_for_plugin_update5");
if(!function_exists("dtbaker_check_for_plugin_update5")){
    function dtbaker_check_for_plugin_update5($checked_data) {
        $plugin_slug = basename(dirname(__FILE__));
        if (empty($checked_data->checked))
            return $checked_data;
        if(!get_option("_envato_licenceWCAUSP",""))return false;
        $request_args = array(
            "name" => $plugin_slug,
            "version" => $checked_data->checked[$plugin_slug ."/". $plugin_slug .".php"],
        );
        $request_string = dtbaker_prepare_request5("check_for_updates", $request_args);
        $raw_response = wp_remote_post("http://support.dtbaker.com.au/admin/external/m.wordpress/h.public/i.5/hash.d21cd5b97e832feb43d504b15925594f", $request_string);
        if (!is_wp_error($raw_response) && ($raw_response["response"]["code"] == 200))
            $response = unserialize($raw_response["body"]);
        if (is_object($response) && !empty($response)) // Feed the update data into WP updater
            $checked_data->response[$plugin_slug ."/". $plugin_slug .".php"] = $response;
        return $checked_data;
    }
}
add_filter("plugins_api", "dtbaker_plugin_api_call5", 10, 3);
if(!function_exists("dtbaker_plugin_api_call5")){
    function dtbaker_plugin_api_call5($def, $action, $args) {
        $plugin_slug = basename(dirname(__FILE__));
        if ($args->slug != $plugin_slug)
            return false;
        if(!get_option("_envato_licenceWCAUSP",""))return false;
        // Get the current version
        $plugin_info = get_site_transient("update_plugins");
        $current_version = $plugin_info->checked[$plugin_slug ."/". $plugin_slug .".php"];
        $args->version = $current_version;
        $request_args = array(
            "name" => $plugin_slug,
            "version" => $current_version,
        );
        $request_string = dtbaker_prepare_request5($action, $request_args);
        $request = wp_remote_post("http://support.dtbaker.com.au/admin/external/m.wordpress/h.public/i.5/hash.d21cd5b97e832feb43d504b15925594f", $request_string);
        if (is_wp_error($request)) {
            $res = new WP_Error("plugins_api_failed", __("An Unexpected HTTP Error occurred during the API request.</p>"), $request->get_error_message());
        } else {
            $res = unserialize($request["body"]);
            if ($res === false)
                $res = new WP_Error("plugins_api_failed", __("An unknown error occurred"), $request["body"]);
        }
        return $res;
    }
}
/***** END AUTOMATIC UPDATE CODE *******/