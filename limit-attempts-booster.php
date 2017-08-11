<?php

/*
  Plugin Name: Limit Login Attempts by Limit Attempts Booster
  Plugin URI: http://beta.tech-banker.com
  Description: Limit Attempts Booster is a High Quality WordPress Plugin which manages/restricts the access to your website as per your requirements.
  Author: Tech Banker
  Author URI: http://beta.tech-banker.com
  Version: 3.0.3
  License: GPLv3
  Text Domain: limit-attempts-booster
  Domain Path: /languages
 */

if (!defined("ABSPATH")) {
    exit();
}
/* Constant Declaration */
if (!defined("LIMIT_ATTEMPTS_BOOSTER_FILE"))
    define("LIMIT_ATTEMPTS_BOOSTER_FILE", plugin_basename(__FILE__));
if (!defined("LIMIT_ATTEMPTS_BOOSTER_DIR_PATH"))
    define("LIMIT_ATTEMPTS_BOOSTER_DIR_PATH", plugin_dir_path(__FILE__));
if (!defined("LIMIT_ATTEMPTS_BOOSTER_URL_PATH"))
    define("LIMIT_ATTEMPTS_BOOSTER_URL_PATH", plugins_url(__FILE__));
if (!defined("LIMIT_ATTEMPTS_BOOSTER_PLUGIN_DIRNAME"))
    define("LIMIT_ATTEMPTS_BOOSTER_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if (!defined("LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME"))
    define("LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME", strtotime(date_i18n("Y-m-d H:i:s")));
if (is_ssl()) {
    if (!defined("tech_banker_url"))
        define("tech_banker_url", "https://tech-banker.com");
    if (!defined("tech_banker_beta_url"))
        define("tech_banker_beta_url", "https://beta.tech-banker.com");
    if (!defined("tech_banker_services_url"))
        define("tech_banker_services_url", "https://tech-banker-services.org");
}
else {
    if (!defined("tech_banker_url"))
        define("tech_banker_url", "http://tech-banker.com");
    if (!defined("tech_banker_beta_url"))
        define("tech_banker_beta_url", "http://beta.tech-banker.com");
    if (!defined("tech_banker_services_url"))
        define("tech_banker_services_url", "http://tech-banker-services.org");
}
if (!defined("tech_banker_stats_url"))
    define("tech_banker_stats_url", "http://stats.tech-banker-services.org");
if (!defined("limit_attempts_booster_version_number"))
    define("limit_attempts_booster_version_number", "3.0.3");

$memory_limit_limit_attempts_booster = intval(ini_get("memory_limit"));
if (!extension_loaded('suhosin') && $memory_limit_limit_attempts_booster < 512) {
    @ini_set("memory_limit", "512M");
}

@ini_set("max_execution_time", 6000);
@ini_set("max_input_vars", 10000);
/*
  Function Name: install_script_for_limit_attempts_booster
  Parameters: No
  Description: This function is used to create tables in database.
  Created On: 23-09-2015 11:30
  Created By: Tech Banker Team
 */

function install_script_for_limit_attempts_booster() {
    global $wpdb;
    if (is_multisite()) {
        $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            $version = get_option("limit_attempts_booster_version_number");
            if ($version < "3.0.0") {
                if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/install-script.php")) {
                    include LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/install-script.php";
                }
            }
            restore_current_blog();
        }
    } else {
        $version = get_option("limit_attempts_booster_version_number");
        if ($version < "3.0.0") {
            if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/install-script.php")) {
                include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/install-script.php";
            }
        }
    }
}

/*
  Function Name: get_others_capabilities_limit_attempts_booster
  Parameters: No
  Description: This function is used to get all the roles available in WordPress
  Created On: 01-11-2016 03:16
  Created By: Tech Banker Team
 */

function get_others_capabilities_limit_attempts_booster() {
    $user_capabilities = array();
    if (function_exists("get_editable_roles")) {
        foreach (get_editable_roles() as $role_name => $role_info) {
            foreach ($role_info["capabilities"] as $capability => $values) {
                if (!in_array($capability, $user_capabilities)) {
                    array_push($user_capabilities, $capability);
                }
            }
        }
    } else {
        $user_capabilities = array(
            "manage_options",
            "edit_plugins",
            "edit_posts",
            "publish_posts",
            "publish_pages",
            "edit_pages",
            "read"
        );
    }
    return $user_capabilities;
}

/*
  Function Name: check_user_roles_for_limit_attempts_booster
  Parameters: No
  Description: This function is used for checking roles of different users.
  Created On: 01-11-2016 03:14
  Created By: Tech Banker Team
 */

function check_user_roles_for_limit_attempts_booster() {
    global $current_user;
    $user = $current_user ? new WP_User($current_user) : wp_get_current_user();
    return $user->roles ? $user->roles[0] : false;
}

/*
  Function Name: limit_attempts_booster
  Parameters: No
  Description: This function is used for creating parent table.
  Created on: 23-09-2015 11:45
  Created By: Tech Banker Team
 */

function limit_attempts_booster() {
    global $wpdb;
    return $wpdb->prefix . "limit_attempts_booster";
}

/*
  Function Name: limit_attempts_booster_meta
  Parameters: No
  Description: This function is used for creating meta table.
  Created on: 23-09-2015 11:45
  Created By: Tech Banker Team
 */

function limit_attempts_booster_meta() {
    global $wpdb;
    return $wpdb->prefix . "limit_attempts_booster_meta";
}

/*
  Function Name: limit_attempts_booster_action_links
  Parameters: Yes
  Description: This function is used to create link for Pro Editions.
  Created On: 18-04-2016 17:56
  Created By: Tech Banker Team
 */

function limit_attempts_booster_action_links($plugin_link) {
    $plugin_link[] = "<a href=\"http://beta.tech-banker.com/products/limit-attempts-booster\" style=\"color: red; font-weight: bold;\" target=\"_blank\">Go Pro!</a>";
    return $plugin_link;
}

/*
  Function Name: limit_attempts_booster_settings_link
  Parameters: Yes($action)
  Description: This function is used to add settings link.
  Created On: 06-05-2017 11:46
  Created By: Tech Banker Team
 */

function limit_attempts_booster_settings_link($action) {
    global $wpdb;
    $user_role_permission = get_users_capabilities_for_limit_attempts_booster();
    $settings_link = '<a href = "' . admin_url('admin.php?page=lab_limit_attempts_booster') . '">' . "Settings" . '</a>';
    array_unshift($action, $settings_link);
    return $action;
}

$version = get_option("limit_attempts_booster_version_number");
if ($version >= "3.0.0") {
    /*
      Function Name: backend_js_css_limit_attempts_booster
      Parameters: No
      Description: This function is used to include backend js.
      Created On: 23-09-2015 11:30
      Created By: Tech Banker Team
     */

    if (is_admin()) {

        function backend_js_css_limit_attempts_booster() {
            $pages_limit_attempts_booster = array
                (
                "limit_attempts_wizard",
                "lab_limit_attempts_booster",
                "lab_visitor_logs_dashboard",
                "lab_last_blocked_ip_addresses",
                "lab_last_blocked_ip_ranges",
                "lab_recent_logs",
                "lab_live_traffic",
                "lab_visitor_logs",
                "lab_blocking_options",
                "lab_manage_ip_addresses",
                "lab_manage_ip_ranges",
                "lab_country_blocks",
                "lab_alert_setup",
                "lab_error_messages",
                "lab_other_settings",
                "lab_email_templates",
                "lab_roles_and_capabilities",
                "lab_custom_cron_jobs",
                "lab_core_cron_jobs",
                "lab_feature_requests",
                "lab_system_information",
                "lab_error_logs",
                "lab_upgrade"
            );
            if (in_array(isset($_REQUEST["page"]) ? esc_attr($_REQUEST["page"]) : "", $pages_limit_attempts_booster)) {
                wp_enqueue_script("jquery");
                wp_enqueue_script("jquery-ui-datepicker");
                wp_enqueue_script("limit-attempts-booster-bootstrap.js", plugins_url("assets/global/plugins/custom/js/custom.js", __FILE__));
                wp_enqueue_script("limit-attempts-booster-jquery.validate.js", plugins_url("assets/global/plugins/validation/jquery.validate.js", __FILE__));
                wp_enqueue_script("limit-attempts-booster-jquery.datatables.js", plugins_url("assets/global/plugins/datatables/media/js/jquery.datatables.js", __FILE__));
                wp_enqueue_script("limit-attempts-booster-jquery.fngetfilterednodes.js", plugins_url("assets/global/plugins/datatables/media/js/fngetfilterednodes.js", __FILE__));
                wp_enqueue_script("limit-attempts-booster-toastr.js", plugins_url("assets/global/plugins/toastr/toastr.js", __FILE__));
                if (is_ssl()) {
                    wp_enqueue_script("limit-attempts-booster-maps_script.js", "https://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyC4rVG7IsNk9pKUO_uOZuxQO4FmF6z03Ks");
                } else {
                    wp_enqueue_script("limit-attempts-booster-maps_script.js", "http://maps.googleapis.com/maps/api/js?v=3&libraries=places&key=AIzaSyC4rVG7IsNk9pKUO_uOZuxQO4FmF6z03Ks");
                }
                wp_enqueue_style("limit-attempts-booster-simple-line-icons.css", plugins_url("assets/global/plugins/icons/icons.css", __FILE__));
                wp_enqueue_style("limit-attempts-booster-components.css", plugins_url("assets/global/css/components.css", __FILE__));
                wp_enqueue_style("limit-attempts-booster-custom.css", plugins_url("assets/admin/layout/css/limit-attempts-booster-custom.css", __FILE__));
                wp_enqueue_style("limit-attempts-booster-premium-edition.css", plugins_url("assets/admin/layout/css/premium-edition.css", __FILE__));
                if (is_rtl()) {
                    wp_enqueue_style("limit-attempts-booster-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom-rtl.css", __FILE__));
                    wp_enqueue_style("limit-attempts-booster-layout.css", plugins_url("assets/admin/layout/css/layout-rtl.css", __FILE__));
                    wp_enqueue_style("limit-attempts-booster-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom-rtl.css", __FILE__));
                } else {
                    wp_enqueue_style("limit-attempts-booster-bootstrap.css", plugins_url("assets/global/plugins/custom/css/custom.css", __FILE__));
                    wp_enqueue_style("limit-attempts-booster-layout.css", plugins_url("assets/admin/layout/css/layout.css", __FILE__));
                    wp_enqueue_style("limit-attempts-booster-tech-banker-custom.css", plugins_url("assets/admin/layout/css/tech-banker-custom.css", __FILE__));
                }
                wp_enqueue_style("limit-attempts-booster-default.css", plugins_url("assets/admin/layout/css/themes/default.css", __FILE__));
                wp_enqueue_style("limit-attempts-booster-toastr.min.css", plugins_url("assets/global/plugins/toastr/toastr.css", __FILE__));
                wp_enqueue_style("limit-attempts-booster-jquery-ui.css", plugins_url("assets/global/plugins/datepicker/jquery-ui.css", __FILE__), false, "2.0", false);
                wp_enqueue_style("limit-attempts-booster-datatables.foundation.css", plugins_url("assets/global/plugins/datatables/media/css/datatables.foundation.css", __FILE__));
            }
        }

        add_action("admin_enqueue_scripts", "backend_js_css_limit_attempts_booster");
    }

    /*
      Function Name: sidebar_menu_for_limit_attempts_booster
      Parameters: No
      Description: This function is used for sidebar menu.
      Created On: 23-09-2015 11:40
      Created By: Tech Banker Team
     */

    function sidebar_menu_for_limit_attempts_booster() {
        global $wpdb, $current_user;
        $user_role_permission = get_users_capabilities_for_limit_attempts_booster();
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php")) {
            include LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php";
        }
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/sidebar-menu.php")) {
            include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/sidebar-menu.php";
        }
    }

    /*
      Function Name: topbar_menu_for_limit_attempts_booster
      Parameters: No
      Description: This function is used for topbar menu.
      Created On: 23-09-2015 11:40
      Created By: Tech Banker Team
     */

    function topbar_menu_for_limit_attempts_booster() {
        global $wpdb, $current_user, $wp_admin_bar;
        $role_capabilities_topbar_menu = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key = %s", "roles_and_capabilities"
                )
        );
        $roles_and_capabilities_data = unserialize($role_capabilities_topbar_menu);
        if (esc_attr($roles_and_capabilities_data["show_limit_attempts_booster_top_bar_menu"]) == "enable") {
            $user_role_permission = get_users_capabilities_for_limit_attempts_booster();
            if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php")) {
                include LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php";
            }
            if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/admin-bar-menu.php")) {
                include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/admin-bar-menu.php";
            }
        }
    }

    /*
      Function Name: helper_file_for_limit_attempts_booster
      Parameters: No
      Description: This function is used for helper file.
      Created On: 23-09-2015 11:40
      Created By: Tech Banker Team
     */

    function helper_file_for_limit_attempts_booster() {
        global $wpdb;
        $user_role_permission = get_users_capabilities_for_limit_attempts_booster();
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/helper.php")) {
            include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/helper.php";
        }
    }

    /*
      Function Name: ajax_register_for_limit_attempts_booster
      Parameters: No
      Description: This function is used for register ajax.
      Created On: 23-09-2015 11:40
      Created By: Tech Banker Team
     */

    function ajax_register_for_limit_attempts_booster() {
        global $wpdb;
        $user_role_permission = get_users_capabilities_for_limit_attempts_booster();
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php")) {
            include LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "includes/translations.php";
        }
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/action-library.php")) {
            include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/action-library.php";
        }
    }

    /*
      Function Name: validate_ip_limit_attempts_booster
      Parameters: No
      description: This function is used for validating ip address.
      Created on: 29-09-2015 10:56
      Created By: Tech Banker Team
     */

    function validate_ip_limit_attempts_booster($ip) {
        if (strtolower($ip) === "unknown") {
            return false;
        }
        $ip = ip2long($ip);

        if ($ip !== false && $ip !== -1) {
            $ip = sprintf("%u", $ip);

            if ($ip >= 0 && $ip <= 50331647) {
                return false;
            }
            if ($ip >= 167772160 && $ip <= 184549375) {
                return false;
            }
            if ($ip >= 2130706432 && $ip <= 2147483647) {
                return false;
            }
            if ($ip >= 2851995648 && $ip <= 2852061183) {
                return false;
            }
            if ($ip >= 2886729728 && $ip <= 2887778303) {
                return false;
            }
            if ($ip >= 3221225984 && $ip <= 3221226239) {
                return false;
            }
            if ($ip >= 3232235520 && $ip <= 3232301055) {
                return false;
            }
            if ($ip >= 4294967040) {
                return false;
            }
        }
        return true;
    }

    /*
      Function Name: get_ip_address_limit_attempts_booster
      Parameters: No
      Description: This function is used for getIpAddress.
      Created on: 29-09-2015 10:56
      Created By: Tech Banker Team
     */

    function get_ip_address_limit_attempts_booster() {
        static $ip = null;
        if (isset($ip)) {
            return $ip;
        }

        global $wpdb;
        $data = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key=%s", "other_settings"
                )
        );
        $other_settings_data = unserialize($data);

        switch (esc_attr($other_settings_data["ip_address_fetching_method"])) {
            case "REMOTE_ADDR":
                if (isset($_SERVER["REMOTE_ADDR"])) {
                    if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_limit_attempts_booster($_SERVER["REMOTE_ADDR"])) {
                        $ip = $_SERVER["REMOTE_ADDR"];
                        return $ip;
                    }
                }
                break;

            case "HTTP_X_FORWARDED_FOR":
                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                    if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                        $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                        foreach ($iplist as $ip_address) {
                            if (validate_ip_limit_attempts_booster($ip_address)) {
                                $ip = $ip_address;
                                return $ip;
                            }
                        }
                    } else {
                        if (validate_ip_limit_attempts_booster($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                            return $ip;
                        }
                    }
                }
                break;

            case "HTTP_X_REAL_IP":
                if (isset($_SERVER["HTTP_X_REAL_IP"])) {
                    if (!empty($_SERVER["HTTP_X_REAL_IP"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_X_REAL_IP"])) {
                        $ip = $_SERVER["HTTP_X_REAL_IP"];
                        return $ip;
                    }
                }
                break;

            case "HTTP_CF_CONNECTING_IP":
                if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                    if (!empty($_SERVER["HTTP_CF_CONNECTING_IP"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_CF_CONNECTING_IP"])) {
                        $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
                        return $ip;
                    }
                }
                break;

            default:
                if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                    if (!empty($_SERVER["HTTP_CLIENT_IP"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_CLIENT_IP"])) {
                        $ip = $_SERVER["HTTP_CLIENT_IP"];
                        return $ip;
                    }
                }
                if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && !empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                    if (strpos($_SERVER["HTTP_X_FORWARDED_FOR"], ",") !== false) {
                        $iplist = explode(",", $_SERVER["HTTP_X_FORWARDED_FOR"]);
                        foreach ($iplist as $ip_address) {
                            if (validate_ip_limit_attempts_booster($ip_address)) {
                                $ip = $ip_address;
                                return $ip;
                            }
                        }
                    } else {
                        if (validate_ip_limit_attempts_booster($_SERVER["HTTP_X_FORWARDED_FOR"])) {
                            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                            return $ip;
                        }
                    }
                }
                if (isset($_SERVER["HTTP_X_FORWARDED"])) {
                    if (!empty($_SERVER["HTTP_X_FORWARDED"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_X_FORWARDED"])) {
                        $ip = $_SERVER["HTTP_X_FORWARDED"];
                        return $ip;
                    }
                }
                if (isset($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
                    if (!empty($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
                        $ip = $_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
                        return $ip;
                    }
                }
                if (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
                    if (!empty($_SERVER["HTTP_FORWARDED_FOR"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_FORWARDED_FOR"])) {
                        $ip = $_SERVER["HTTP_FORWARDED_FOR"];
                        return $ip;
                    }
                }
                if (isset($_SERVER["HTTP_FORWARDED"])) {
                    if (!empty($_SERVER["HTTP_FORWARDED"]) && validate_ip_limit_attempts_booster($_SERVER["HTTP_FORWARDED"])) {
                        $ip = $_SERVER["HTTP_FORWARDED"];
                        return $ip;
                    }
                }
                if (isset($_SERVER["REMOTE_ADDR"])) {
                    if (!empty($_SERVER["REMOTE_ADDR"]) && validate_ip_limit_attempts_booster($_SERVER["REMOTE_ADDR"])) {
                        $ip = $_SERVER["REMOTE_ADDR"];
                        return $ip;
                    }
                }
                break;
        }
        return "127.0.0.1";
    }

    /*
      Function Name: get_users_capabilities_for_limit_attempts_booster
      Parameters: No
      Description: This function is used to get users capabilities.
      Created On: 01-11-2016 02:55
      Created By: Tech Banker Team
     */

    function get_users_capabilities_for_limit_attempts_booster() {
        global $wpdb;
        $capabilities = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key = %s", "roles_and_capabilities"
                )
        );
        $core_roles = array(
            "manage_options",
            "edit_plugins",
            "edit_posts",
            "publish_posts",
            "publish_pages",
            "edit_pages",
            "read"
        );
        $unserialized_capabilities = unserialize($capabilities);
        return isset($unserialized_capabilities["capabilities"]) ? $unserialized_capabilities["capabilities"] : $core_roles;
    }

    /*
      Function Name: user_login_status_limit_attempts_booster
      Parameters:yes($username,$password)
      Description: This function is used for check the user's Login status.
      Created On: 06-10-2015 11:00
      Created By: Tech Banker Team
     */

    function user_login_status_limit_attempts_booster($username, $password) {
        global $wpdb;
        $ip = get_ip_address_limit_attempts_booster();
        $ip_address = $ip == "::1" ? ip2long("127.0.0.1") : ip2long($ip);
        $location = lab_get_ip_location_limit_attempts_booster(long2ip($ip_address));
        $place = $location->country_name == "" && $location->city == "" ? "" : $location->country_name == "" ? "" : $location->city == "" ? $location->country_name : $location->city . ", " . $location->country_name;

        $userdata = get_user_by("login", $username);
        if ($userdata && wp_check_password($password, $userdata->user_pass)) {
            $insert_login_logs = array();
            $insert_login_logs["type"] = "recent_login_logs";
            $insert_login_logs["parent_id"] = "0";
            $wpdb->insert(limit_attempts_booster(), $insert_login_logs);
            $last_id = $wpdb->insert_id;

            $insert_login_logs = array();
            $insert_login_logs["username"] = esc_attr($username);
            $insert_login_logs["user_ip_address"] = doubleval($ip_address);
            $insert_login_logs["location"] = esc_attr($place);
            $insert_login_logs["latitude"] = doubleval($location->latitude);
            $insert_login_logs["longitude"] = doubleval($location->longitude);
            $insert_login_logs["resources"] = esc_attr($_SERVER["REQUEST_URI"]);
            $insert_login_logs["http_user_agent"] = esc_attr($_SERVER["HTTP_USER_AGENT"]);
            $insert_login_logs["date_time"] = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
            $insert_login_logs["status"] = "Success";
            $insert_login_logs["meta_id"] = intval($last_id);
            $recent_logs_data = array();
            $recent_logs_data["meta_id"] = $last_id;
            $recent_logs_data["meta_key"] = "recent_login_data";
            $recent_logs_data["meta_value"] = serialize($insert_login_logs);
            $wpdb->insert(limit_attempts_booster_meta(), $recent_logs_data);

        } else {
            if ($username == "" || $password == "") {
                return;
            } else {
                $insert_login_logs = array();
                $insert_login_logs["type"] = "recent_login_logs";
                $insert_login_logs["parent_id"] = "0";
                $wpdb->insert(limit_attempts_booster(), $insert_login_logs);
                $last_id = $wpdb->insert_id;

                $insert_login_logs = array();
                $insert_login_logs["username"] = esc_attr($username);
                $insert_login_logs["user_ip_address"] = doubleval($ip_address);
                $insert_login_logs["location"] = esc_attr($place);
                $insert_login_logs["latitude"] = doubleval($location->latitude);
                $insert_login_logs["longitude"] = doubleval($location->longitude);
                $insert_login_logs["resources"] = esc_attr($_SERVER["REQUEST_URI"]);
                $insert_login_logs["http_user_agent"] = esc_attr($_SERVER["HTTP_USER_AGENT"]);
                $insert_login_logs["date_time"] = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
                $insert_login_logs["status"] = "Failure";
                $insert_login_logs["meta_id"] = intval($last_id);

                $recent_logs_data = array();
                $recent_logs_data["meta_id"] = $last_id;
                $recent_logs_data["meta_key"] = "recent_login_data";
                $recent_logs_data["meta_value"] = serialize($insert_login_logs);
                $wpdb->insert(limit_attempts_booster_meta(), $recent_logs_data);

                $auto_ip_block = $wpdb->get_var
                        (
                        $wpdb->prepare
                                (
                                "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
							WHERE meta_key = %s", "blocking_options"
                        )
                );

                $blocking_options_data = unserialize($auto_ip_block);

                if (esc_attr($blocking_options_data["auto_ip_block"]) == "enable") {
                    add_filter("login_errors", "login_error_messages_limit_attempts_booster", 10, 1);
                    $get_ip = lab_get_ip_location_limit_attempts_booster(long2ip($ip_address));
                    $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;
                    $date = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;

                    $meta_data_array = $blocking_options_data;

                    $get_all_user_data = $wpdb->get_results
                            (
                            $wpdb->prepare
                                    (
                                    "SELECT * FROM " . limit_attempts_booster_meta() . "
								 WHERE meta_key = %s", "recent_login_data"
                            )
                    );

                    $blocked_for_time = esc_attr($meta_data_array["block_for"]);

                    switch ($blocked_for_time) {
                        case "1Hour":
                            $this_time = 60 * 60;
                            break;

                        case "12Hour":
                            $this_time = 12 * 60 * 60;
                            break;

                        case "24hours":
                            $this_time = 24 * 60 * 60;
                            break;

                        case "48hours":
                            $this_time = 2 * 24 * 60 * 60;
                            break;

                        case "week":
                            $this_time = 7 * 24 * 60 * 60;
                            break;

                        case "month":
                            $this_time = 30 * 24 * 60 * 60;
                            break;

                        case "permanently":
                            $this_time = "permanently";
                            break;
                    }

                    $user_data = COUNT(get_limit_attempts_booster_details_login_count_check($get_all_user_data, $date, $this_time, $ip_address));
                    if (!defined("lab_count_login_status"))
                        define("lab_count_login_status", $user_data);
                    if ($user_data >= intval($meta_data_array["maximum_login_attempt_in_a_day"])) {
                        $ip_address_block = array();
                        $ip_address_block["type"] = "block_ip_address";
                        $ip_address_block["parent_id"] = 0;
                        $wpdb->insert(limit_attempts_booster(), $ip_address_block);
                        $last_id = $wpdb->insert_id;

                        $ip_address_block_meta = array();
                        $ip_address_block_meta["ip_address"] = doubleval($ip_address);
                        $ip_address_block_meta["blocked_for"] = esc_attr($blocked_for_time);
                        $ip_address_block_meta["location"] = esc_attr($location);
                        $ip_address_block_meta["comments"] = "IP ADDRESS AUTOMATIC BLOCKED!";

                        $timestamp = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
                        $ip_address_block_meta["date_time"] = intval($timestamp);

                        $insert_data = array();

                        $insert_data["meta_id"] = $last_id;
                        $insert_data["meta_key"] = "block_ip_address";
                        $insert_data["meta_value"] = serialize($ip_address_block_meta);
                        $wpdb->insert(limit_attempts_booster_meta(), $insert_data);

                        if ($blocked_for_time != "permanently") {
                            $cron_name = "ip_address_unblocker_" . $last_id;
                            schedule_limit_attempts_booster_ip_address_range($cron_name, $blocked_for_time);
                        }

                        $error_message_data = $wpdb->get_var
                                (
                                $wpdb->prepare
                                        (
                                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
									WHERE meta_key = %s", "error_message"
                                )
                        );

                        $meta_data_array = unserialize($error_message_data);

                        $replace_ipaddress = $meta_data_array["for_blocked_ip_address_error"];
                        $replace_address = str_replace("[ip_address]", long2ip($ip_address), $replace_ipaddress);
                        wp_die($replace_address);
                    }
                }
            }
        }
    }

    /*
      Function Name: login_error_messages_limit_attempts_booster
      Parameter: Yes($default_error_message)
      Description: This Function is used for login error messages.
      Created On: 14-10-2015 11:00
      Created By: Tech Banker Team
     */

    function login_error_messages_limit_attempts_booster($default_error_message) {
        global $wpdb;
        $max_login_attempts = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key = %s", "blocking_options"
                )
        );
        $max_login_attempts_data = unserialize($max_login_attempts);
        $error_message_attempts = $wpdb->get_var
                (
                $wpdb->prepare
                        (
                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key = %s", "error_message"
                )
        );
        $error_message_attempts_data = unserialize($error_message_attempts);
        $login_attempts = intval($max_login_attempts_data["maximum_login_attempt_in_a_day"]) - lab_count_login_status;
        $replace_attempts = str_replace("[login_attempts]", $login_attempts, $error_message_attempts_data["for_maximum_login_attempts"]);
        $display_error_message = $default_error_message . " " . $replace_attempts;
        return $display_error_message;
    }

    /*
      Function Name: schedule_limit_attempts_booster_ip_address_range
      Parameter: Yes($cron_name,$time_interval)
      Description: This function is used for creating a scheduler of ip address.
      Created On: 14-10-2015 11:00
      Created By: Tech Banker Team
     */

    function schedule_limit_attempts_booster_ip_address_range($cron_name, $time_interval) {
        if (!wp_next_scheduled($cron_name)) {
            switch ($time_interval) {
                case "1Hour":
                    $this_time = 60 * 60;
                    break;

                case "12Hour":
                    $this_time = 12 * 60 * 60;
                    break;

                case "24hours":
                    $this_time = 24 * 60 * 60;
                    break;

                case "48hours":
                    $this_time = 2 * 24 * 60 * 60;
                    break;

                case "week":
                    $this_time = 7 * 24 * 60 * 60;
                    break;

                case "month":
                    $this_time = 30 * 24 * 60 * 60;
                    break;
            }
            wp_schedule_event(time() + $this_time, $time_interval, $cron_name);
        }
    }

    $scheduler = _get_cron_array();
    $current_scheduler = array();

    foreach ($scheduler as $value => $key) {
        $arr_key = array_keys($key);
        foreach ($arr_key as $value) {
            array_push($current_scheduler, $value);
        }
    }

    if (isset($current_scheduler[0])) {
        if (!defined("scheduler_name"))
            define("scheduler_name", $current_scheduler[0]);

        if (strstr($current_scheduler[0], "ip_address_unblocker_")) {
            add_action($current_scheduler[0], "unblock_script_limit_attempts_booster");
        } elseif (strstr($current_scheduler[0], "ip_range_unblocker_")) {
            add_action($current_scheduler[0], "unblock_script_limit_attempts_booster");
        }
    }

    /*
      Function Name: unblock_script_limit_attempts_booster
      Parameter: No
      Description: This function is used for including the unblock-script file.
      Created On: 24-10-2015 2:20
      Created By: Tech Banker Team
     */

    function unblock_script_limit_attempts_booster() {
        if (file_exists(LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/unblock-script.php")) {
            $nonce_unblock_script = wp_create_nonce("unblock_script");
            global $wpdb;
            include_once LIMIT_ATTEMPTS_BOOSTER_DIR_PATH . "lib/unblock-script.php";
        }
    }

    /*
      Function Name: block_ip_address_limit_attempts_booster
      Parameter: No
      Description: This function  is used for blocking ip address and ip ranges.
      Created On: 14-10-2015 11:00
      Created By: Tech Banker Team
     */

    function block_ip_address_limit_attempts_booster($meta_data_array, $meta_values_ip_blocks_lab, $ip_address, $location) {
        $flag = 0;
        $count_ip = 0;
        for ($key = 0; $key < count($meta_values_ip_blocks_lab); $key++) {
            if ($meta_values_ip_blocks_lab[$key]->meta_key == "block_ip_range") {
                $block_ip_range = unserialize($meta_values_ip_blocks_lab[$key]->meta_value);
                $ip_range_address = explode(",", $block_ip_range["ip_range"]);
                if ($ip_address >= $ip_range_address[0] && $ip_address <= $ip_range_address[1]) {
                    $flag = 1;
                    break;
                }
            } elseif ($meta_values_ip_blocks_lab[$key]->meta_key == "block_ip_address") {
                $block_ip_address = unserialize($meta_values_ip_blocks_lab[$key]->meta_value);
                if ($block_ip_address["ip_address"] == $ip_address) {
                    $count_ip = 1;
                    break;
                }
            }
        }
        if ($count_ip == 1 || $flag == 1) {
            if ($count_ip == 1) {
                $replace_ipaddress = $meta_data_array["for_blocked_ip_address_error"];
                $replace_address = str_replace("[ip_address]", long2ip($ip_address), $replace_ipaddress);
                wp_die($replace_address);
            } else {
                $replace_iprange = $meta_data_array["for_blocked_ip_range_error"];
                $replace_range = str_replace("[ip_range]", long2ip($ip_range_address[0]) . "-" . long2ip($ip_range_address[1]), $replace_iprange);
                wp_die($replace_range);
            }
        }
    }

    /*
      Function Name: visitor_logs_insertion_limit_attempts_booster
      Parameter: Yes
      Description: This Function is used for insert the live traffic data in database.
      Created On: 06-10-2015 11:00
      Created By: Tech Banker Team
     */

    function visitor_logs_insertion_limit_attempts_booster($meta_data_array, $ip_address, $location) {
        if ((!is_admin()) && (!defined("DOING_CRON"))) {
            global $wpdb, $current_user;
            $ip = get_ip_address_limit_attempts_booster();
            $ip_address = $ip == "::1" ? ip2long("127.0.0.1") : ip2long($ip);
            $location = lab_get_ip_location_limit_attempts_booster(long2ip($ip_address));
            $place = $location->country_name == "" && $location->city == "" ? "" : $location->country_name == "" ? "" : $location->city == "" ? $location->country_name : $location->city . ", " . $location->country_name;
            $username = $current_user->user_login;

            $insert_live_traffic = array();
            $insert_live_traffic["type"] = "visitor_log";
            $insert_live_traffic["parent_id"] = 0;
            $wpdb->insert(limit_attempts_booster(), $insert_live_traffic);
            $last_id = $wpdb->insert_id;

            $insert_live_traffic = array();
            $insert_live_traffic["username"] = esc_attr($username);
            $insert_live_traffic["user_ip_address"] = doubleval($ip_address);

            $insert_live_traffic["location"] = esc_attr($place);
            $insert_live_traffic["latitude"] = doubleval($location->latitude);
            $insert_live_traffic["longitude"] = doubleval($location->longitude);
            $insert_live_traffic["resources"] = esc_attr($_SERVER["REQUEST_URI"]);
            $insert_live_traffic["http_user_agent"] = esc_attr($_SERVER["HTTP_USER_AGENT"]);
            $insert_live_traffic["date_time"] = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
            $insert_live_traffic["meta_id"] = intval($last_id);
            $insert_live_traffic_data = array();
            $insert_live_traffic_data["meta_id"] = $last_id;
            $insert_live_traffic_data["meta_key"] = "visitor_log_data";
            $insert_live_traffic_data["meta_value"] = serialize($insert_live_traffic);
            $wpdb->insert(limit_attempts_booster_meta(), $insert_live_traffic_data);
        }
    }

    /*
      Function Name: lab_get_ip_location_limit_attempts_booster
      Parameters: $ip_Address
      Description: This function is used to get ip location.
      Created on: 29-09-2015 10:56
      Created By: Tech Banker Team
     */

    function lab_get_ip_location_limit_attempts_booster($ip_Address) {
        $core_data = '{"ip":"0.0.0.0","country_code":"","country_name":"","region_code":"","region_name":"","city":"","latitude":0,"longitude":0}';
        $apiCall = tech_banker_services_url . "/api/getipaddress.php?ip_address=" . $ip_Address;
        $jsonData = @file_get_contents($apiCall);
        return json_decode($jsonData);
    }

        /*
          Function Name: get_limit_attempts_booster_details_login_count_check
          Parameters: $data,$date,$time_interval,$ip_address
          Description: This function is used to get login counts.
          Created on: 29-09-2015 10:56
          Created By: Tech Banker Team
         */

        function get_limit_attempts_booster_details_login_count_check($data, $date, $time_interval, $ip_address) {
            $limit_attempts_details = array();
            foreach ($data as $raw_row) {
                $row = unserialize($raw_row->meta_value);
                if ($row["user_ip_address"] == $ip_address) {
                    if ($time_interval != "permanently") {
                        if ($row["status"] == "Failure" && $row["date_time"] + $time_interval >= $date) {
                            array_push($limit_attempts_details, $row);
                        }
                    } else {
                        if ($row["status"] == "Failure") {
                            array_push($limit_attempts_details, $row);
                        }
                    }
                }
            }
            return $limit_attempts_details;
        }

        /*
          Function Name: cron_scheduler_for_intervals_limit_attempts_booster
          Parameters: Yes($schedules)
          Description: This function is used to cron scheduler for intervals.
          Created On: 15-10-2015 12:05
          Created By: Tech Banker Team
         */

        function cron_scheduler_for_intervals_limit_attempts_booster($schedules) {
            $schedules["1Hour"] = array("interval" => 60 * 60, "display" => "Every 1 Hour");
            $schedules["2Hour"] = array("interval" => 60 * 60 * 2, "display" => "Every 2 Hours");
            $schedules["3Hour"] = array("interval" => 60 * 60 * 3, "display" => "Every 3 Hours");
            $schedules["4Hour"] = array("interval" => 60 * 60 * 4, "display" => "Every 4 Hours");
            $schedules["5Hour"] = array("interval" => 60 * 60 * 5, "display" => "Every 5 Hours");
            $schedules["6Hour"] = array("interval" => 60 * 60 * 6, "display" => "Every 6 Hours");
            $schedules["7Hour"] = array("interval" => 60 * 60 * 7, "display" => "Every 7 Hours");
            $schedules["8Hour"] = array("interval" => 60 * 60 * 8, "display" => "Every 8 Hours");
            $schedules["9Hour"] = array("interval" => 60 * 60 * 9, "display" => "Every 9 Hours");
            $schedules["10Hour"] = array("interval" => 60 * 60 * 10, "display" => "Every 10 Hours");
            $schedules["11Hour"] = array("interval" => 60 * 60 * 11, "display" => "Every 11 Hours");
            $schedules["12Hour"] = array("interval" => 60 * 60 * 12, "display" => "Every 12 Hours");
            $schedules["13Hour"] = array("interval" => 60 * 60 * 13, "display" => "Every 13 Hours");
            $schedules["14Hour"] = array("interval" => 60 * 60 * 14, "display" => "Every 14 Hours");
            $schedules["15Hour"] = array("interval" => 60 * 60 * 15, "display" => "Every 15 Hours");
            $schedules["16Hour"] = array("interval" => 60 * 60 * 16, "display" => "Every 16 Hours");
            $schedules["17Hour"] = array("interval" => 60 * 60 * 17, "display" => "Every 17 Hours");
            $schedules["18Hour"] = array("interval" => 60 * 60 * 18, "display" => "Every 18 Hours");
            $schedules["19Hour"] = array("interval" => 60 * 60 * 19, "display" => "Every 19 Hours");
            $schedules["20Hour"] = array("interval" => 60 * 60 * 20, "display" => "Every 20 Hours");
            $schedules["21Hour"] = array("interval" => 60 * 60 * 21, "display" => "Every 21 Hours");
            $schedules["22Hour"] = array("interval" => 60 * 60 * 22, "display" => "Every 22 Hours");
            $schedules["23Hour"] = array("interval" => 60 * 60 * 23, "display" => "Every 23 Hours");
            $schedules["Daily"] = array("interval" => 60 * 60 * 24, "display" => "Daily");
            $schedules["24hours"] = array("interval" => 60 * 60 * 24, "display" => "Every 24 Hours");
            $schedules["48hours"] = array("interval" => 60 * 60 * 48, "display" => "Every 48 Hours");
            $schedules["week"] = array("interval" => 60 * 60 * 24 * 7, "display" => "Every 1 Week");
            $schedules["month"] = array("interval" => 60 * 60 * 24 * 30, "display" => "Every 1 Month");
            return $schedules;
        }

        /*
          Function Name: unschedule_events_limit_attempts_booster
          Parameters: Yes($cron_name)
          Description: This function is used to unscheduling the events.
          Created On: 15-10-2015 12:11
          Created By: Tech Banker Team
         */

        function unschedule_events_limit_attempts_booster($cron_name) {
            if (wp_next_scheduled($cron_name)) {
                $db_cron = wp_next_scheduled($cron_name);
                wp_unschedule_event($db_cron, $cron_name);
            }
        }

        /*
          Function Name: plugin_load_textdomain_limit_attempts_booster
          Parameters: No
          Description: This function is used to load languages.
          Created On: 21-11-2015 12:11
          Created By: Tech Banker Team
         */

        function plugin_load_textdomain_limit_attempts_booster() {
            load_plugin_textdomain("limit-attempts-booster", false, LIMIT_ATTEMPTS_BOOSTER_PLUGIN_DIRNAME . "/languages");
        }

        /*
          Function Name: admin_functions_limit_attempts_booster
          Parameters: No
          Description: This function is used for calling add_action .
          Created On: 23-02-2016 04:30
          Created by: Tech Banker Team
         */

        function admin_functions_limit_attempts_booster() {
            install_script_for_limit_attempts_booster();
            helper_file_for_limit_attempts_booster();
        }

        /*
          Function Name: user_functions_limit_attempts_booster
          Parameters: No
          Description: This function is used for calling add_action for frontend .
          Created On: 23-02-2016 01:13
          Created by: Tech Banker Team
         */

        function user_functions_limit_attempts_booster() {
            global $wpdb;
            plugin_load_textdomain_limit_attempts_booster();
            $meta_values = $wpdb->get_results
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_key,meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key IN(%s,%s)", "error_message", "other_settings"
                    )
            );

            $meta_values_ip_blocks_lab = $wpdb->get_results
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_key,meta_value FROM " . limit_attempts_booster_meta() . "
					WHERE meta_key IN(%s,%s)", "block_ip_address", "block_ip_range"
                    )
            );
            $meta_data_array = array();
            foreach ($meta_values as $row) {
                $meta_data_array[$row->meta_key] = unserialize($row->meta_value);
            }
            $other_settings_array = $meta_data_array["other_settings"];
            $error_message_array = $meta_data_array["error_message"];
            $ip_address = get_ip_address_limit_attempts_booster() == "::1" ? ip2long("127.0.0.1") : ip2long(get_ip_address_limit_attempts_booster());
            $location = lab_get_ip_location_limit_attempts_booster(long2ip($ip_address));
            block_ip_address_limit_attempts_booster($error_message_array, $meta_values_ip_blocks_lab, $ip_address, $location);
            if (array_key_exists("visitor_logs_monitoring", $other_settings_array) && array_key_exists("live_traffic_monitoring", $other_settings_array)) {
                if (esc_attr($other_settings_array["visitor_logs_monitoring"]) == "enable" || esc_attr($other_settings_array["live_traffic_monitoring"]) == "enable") {
                    visitor_logs_insertion_limit_attempts_booster($meta_data_array, $ip_address, $location);
                }
            }
        }

        /*
          Function Name: deactivation_function_for_limit_attempts_booster
          Parameters: No
          Description: This function is used for executing the code on deactivation.
          Created On: 13-04-2017 03:53
          Created by: Tech Banker Team
         */

        function deactivation_function_for_limit_attempts_booster() {
            $type = get_option("limit-attempts-wizard-set-up");
            if ($type == "opt_in") {
                $plugin_info_limit_attempts_booster = new plugin_info_limit_attempts_booster();
                global $wp_version, $wpdb;
                $url = tech_banker_stats_url . "/wp-admin/admin-ajax.php";
                $theme_details = array();
                if ($wp_version >= 3.4) {
                    $active_theme = wp_get_theme();
                    $theme_details["theme_name"] = strip_tags($active_theme->Name);
                    $theme_details["theme_version"] = strip_tags($active_theme->Version);
                    $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
                }
                $plugin_stat_data = array();
                $plugin_stat_data["plugin_slug"] = "limit-attempts-booster";
                $plugin_stat_data["type"] = "standard_edition";
                $plugin_stat_data["version_number"] = limit_attempts_booster_version_number;
                $plugin_stat_data["status"] = $type;
                $plugin_stat_data["event"] = "de-activate";
                $plugin_stat_data["domain_url"] = site_url();
                $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();

                $plugin_stat_data["email"] = get_option("admin_email");
                $plugin_stat_data["wp_version"] = $wp_version;
                $plugin_stat_data["php_version"] = esc_html(phpversion());
                $plugin_stat_data["mysql_version"] = $wpdb->db_version();
                $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
                $plugin_stat_data["operating_system"] = PHP_OS . "  (" . PHP_INT_SIZE * 8 . ") BIT";
                $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit") ? ini_get("memory_limit") : "N/A";
                $plugin_stat_data["extensions"] = get_loaded_extensions();
                $plugin_stat_data["plugins"] = $plugin_info_limit_attempts_booster->get_plugin_info_limit_attempts_booster();
                $plugin_stat_data["themes"] = $theme_details;

                $response = wp_safe_remote_post($url, array
                    (
                    "method" => "POST",
                    "timeout" => 45,
                    "redirection" => 5,
                    "httpversion" => "1.0",
                    "blocking" => true,
                    "headers" => array(),
                    "body" => array("data" => serialize($plugin_stat_data), "site_id" => get_option("lab_tech_banker_site_id") != "" ? get_option("lab_tech_banker_site_id") : "", "action" => "plugin_analysis_data")
                ));

                if (!is_wp_error($response)) {
                    $response["body"] != "" ? update_option("lab_tech_banker_site_id", $response["body"]) : "";
                }
            }
        }

        /* Hooks */

        /* add_action for admin_functions_limit_attempts_booster
          Description: This hook is used for calling all the Backend Functions
          Created On: 19-01-2016 11:50
          Created by: Tech Banker Team
         */

        add_action("admin_init", "admin_functions_limit_attempts_booster");

        /* add_action for user_functions_limit_attempts_booster
          Description: This hook is used for calling all the Backend Functions
          Created On: 19-01-2016 11:50
          Created by: Tech Banker Team
         */

        add_action("init", "user_functions_limit_attempts_booster");

        /* add_action for ajax_register_for_limit_attempts_booster
          Description: This hook is used for calling the function to register ajax.
          Created On: 12-09-2016 02:22
          Created by: Tech Banker Team
         */

        add_action("wp_ajax_limit_attempts_booster_action", "ajax_register_for_limit_attempts_booster");

        /* add_action for sidebar_menu_for_limit_attempts_booster
          Description: This hook is uesd for calling the function of sidebar menu.
          Created On: 23-09-2015 11:50
          Created By: Tech Banker Team
         */

        add_action("admin_menu", "sidebar_menu_for_limit_attempts_booster");

        /* add_action for sidebar_menu_for_limit_attempts_booster
          Description: This hook is used for calling the function of sidebar menuin multisite case.
          Created On: 28-10-2016 12:15
          Created By: Tech Banker Team
         */

        add_action("network_admin_menu", "sidebar_menu_for_limit_attempts_booster");

        /* add_action for topbar_menu_for_limit_attempts_booster
          Description: This hook is used for calling the function of topbar menu.
          Created On: 23-09-2015 11:50
          Created By: Tech Banker Team
         */

        add_action("admin_bar_menu", "topbar_menu_for_limit_attempts_booster", 100);

        /*
          add_action for user_login_status_limit_attempts_booster
          Description: This hook is used for calling function of check user login status.
          Created On: 06-10-2015 11:00
          Created By: Tech Banker Team
         */

        add_action("wp_authenticate", "user_login_status_limit_attempts_booster", 10, 2);

        /*
          Add Filter for cron_scheduler_for_intervals_limit_attempts_booster
          Description: This hook is used for calling the function of cron schedulers jobs for wordpress data and database.
          Created On Date: 13-10-2015 12:45
          Created By: Tech Banker Team
         */

        add_filter("cron_schedules", "cron_scheduler_for_intervals_limit_attempts_booster");
    }

    /* register_activation_hook
      Description: This hook is used for calling the function of install script.
      Created On: 23-09-2015 11:50
      Created By: Tech Banker Team
     */

    register_activation_hook(__FILE__, "install_script_for_limit_attempts_booster");

    /* admin_init
      Description: This hook is used for calling the function of install script.
      Created On: 23-09-2015 11:50
      Created By: Tech Banker Team
     */

    add_action("admin_init", "install_script_for_limit_attempts_booster");

    /* add_filter create Go Pro link for Limit Attempts Booster
      Description: This hook is used for create link for premium Editions.
      Created On: 18-04-2014 17:56
      Created by: Tech Banker Team
     */
    add_filter("plugin_action_links_" . plugin_basename(__FILE__), "limit_attempts_booster_action_links");

    /*
      add_filter for limit_attempts_booster_settings_link
      Description: This hook is used for calling the function of settings link.
      Created On: 09-08-2016 02:51
      Created By: Tech Banker Team
     */

    add_filter("plugin_action_links_" . plugin_basename(__FILE__), "limit_attempts_booster_settings_link", 10, 2);

    /* deactivation_function_for_limit_attempts_booster
      Description: This hook is used to sets the deactivation hook for a plugin.
      Created On: 13-04-2017 04:08
      Created by: Tech Banker Team
     */

    register_deactivation_hook(__FILE__, "deactivation_function_for_limit_attempts_booster");

    /*
      Function Name: plugin_activate_limit_attempts
      Description: This function is used to add option.
      Parameters: No
      Created On: 28-04-2017 12:11
      Created By: Tech Banker Team
     */

    function plugin_activate_limit_attempts() {
        add_option("limit_attempts_do_activation_redirect", true);
    }

    /*
      Function Name: limit_attempts_redirect
      Description: This function is used to redirect page.
      Parameters: No
      Created On: 28-04-2017 12:13
      Created By: Tech Banker Team
     */

    function limit_attempts_redirect() {
        if (get_option("limit_attempts_do_activation_redirect", false)) {
            delete_option("limit_attempts_do_activation_redirect");
            wp_redirect(admin_url("admin.php?page=lab_limit_attempts_booster"));
            exit;
        }
    }

    /*
      register_activation_hook
      Description: This hook is used for calling the function plugin_activate_limit_attempts
      Created On: 28-04-2017 12:15
      Created By: Tech Banker Team
     */

    register_activation_hook(__FILE__, "plugin_activate_limit_attempts");

    /*
      add_action for limit_attempts_redirect
      Description: This hook is used for calling the function limit_attempts_redirect
      Created On: 28-04-2017 12:17
      Created By: Tech Banker Team
     */

    add_action("admin_init", "limit_attempts_redirect");    