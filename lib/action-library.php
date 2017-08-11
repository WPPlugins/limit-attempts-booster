<?php

/**
 * This file is used to update data.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/lib
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit();
}
if (!is_user_logged_in()) {
    return;
} else {
    $access_granted = false;
    if (isset($user_role_permission) && count($user_role_permission) > 0) {
        foreach ($user_role_permission as $permission) {
            if (current_user_can($permission)) {
                $access_granted = true;
                break;
            }
        }
    }
    if (!$access_granted) {
        return;
    } else {

        function get_limit_attempts_booster_unserialize_data($manage_data) {
            $unserialize_complete_data = array();
            if (count($manage_data) > 0) {
                foreach ($manage_data as $value) {
                    $unserialize_data = unserialize($value->meta_value);
                    $unserialize_data["meta_id"] = $value->meta_id;
                    array_push($unserialize_complete_data, $unserialize_data);
                }
            }
            return $unserialize_complete_data;
        }

        function get_limit_attempts_booster_details_date($limit_data, $date1, $date2) {
            $array_details = array();
            if (count($limit_data) > 0) {
                foreach ($limit_data as $raw_row) {
                    $unserialize_data = unserialize($raw_row->meta_value);
                    $unserialize_data["id"] = $raw_row->id;
                    $unserialize_data["meta_id"] = $raw_row->meta_id;
                    if ($unserialize_data["date_time"] >= $date1 && $unserialize_data["date_time"] <= $date2)
                        array_push($array_details, $unserialize_data);
                }
            }
            return $array_details;
        }

        if (isset($_REQUEST["param"])) {
            $obj_dbHelper_limit_attempts_booster = new dbHelper_limit_attempts_booster();
            switch (esc_attr($_REQUEST["param"])) {
                case "wizard_limit_attempts_booster":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_check_status")) {
                        $type = isset($_REQUEST["type"]) ? esc_attr($_REQUEST["type"]) : "";
                        update_option("limit-attempts-wizard-set-up", $type);
                        if ($type == "opt_in") {
                            $plugin_info_limit_attempts_booster = new plugin_info_limit_attempts_booster();
                            global $wp_version;
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
                            $plugin_stat_data["event"] = "activate";
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
                    break;

                case "limit_attempts_last_login_delete_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_last_10_login_log_delete")) {
                        $where = array();
                        $where_parent = array();
                        $log_id = isset($_REQUEST["log_id"]) ? intval($_REQUEST["log_id"]) : 0;
                        $where["meta_id"] = $log_id;
                        $where_parent["id"] = $log_id;
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_dashboard_visitor_delete_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_visitor_logs_delete")) {
                        $where = array();
                        $where_parent = array();
                        $real_id = isset($_REQUEST["real_id"]) ? intval($_REQUEST["real_id"]) : 0;
                        $where["meta_id"] = $real_id;
                        $where_parent["id"] = $real_id;
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_delete_selected_live_visitor_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_traffic_delete"))
                        ; {
                        $where_meta = array();
                        $where_parent = array();
                        $confirm_id = isset($_REQUEST["confirm_id"]) ? intval($_REQUEST["confirm_id"]) : 0;
                        $where_meta["meta_id"] = $confirm_id;
                        $where_parent["id"] = $confirm_id;
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where_meta);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_delete_selected_recent_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_recent_selected_delete")) {
                        $where = array();
                        $where_parent = array();
                        $login_id = isset($_REQUEST["login_id"]) ? intval($_REQUEST["login_id"]) : 0;
                        $where["meta_id"] = $login_id;
                        $where_parent["id"] = $login_id;
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_last_login_delete_ip_address":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_delete_ip_address")) {
                        $id = isset($_REQUEST["id_address"]) ? intval($_REQUEST["id_address"]) : 0;
                        $where = array();
                        $where_parent = array();
                        $where["meta_id"] = $id;
                        $where_parent["id"] = $id;
                        $cron_name = "ip_address_unblocker_" . $id;
                        unschedule_events_limit_attempts_booster($cron_name);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_delete_ip_ranges_last_login":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_delete_ip_ranges")) {
                        $where = array();
                        $where_parent = array();
                        $id_address = isset($_REQUEST["id_address"]) ? intval($_REQUEST["id_address"]) : 0;
                        $where["meta_id"] = $id_address;
                        $where_parent["id"] = $id_address;
                        $cron_name = "ip_range_unblocker_" . $where["meta_id"];
                        
                        unschedule_events_limit_attempts_booster($cron_name);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_blocking_options_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_block")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $blocking_options_array);
                        $update_blocking_options = array();
                        $where = array();

                        $update_blocking_options["auto_ip_block"] = isset($blocking_options_array["ux_ddl_auto_ip"]) ? esc_attr($blocking_options_array["ux_ddl_auto_ip"]) : "";
                        $update_blocking_options["maximum_login_attempt_in_a_day"] = isset($blocking_options_array["ux_txt_login"]) ? intval($blocking_options_array["ux_txt_login"]) : 0;
                        $update_blocking_options["block_for"] = isset($blocking_options_array["ux_ddl_blocked_for"]) ? esc_attr($blocking_options_array["ux_ddl_blocked_for"]) : "";

                        $update_block_data = array();
                        $where["meta_key"] = "blocking_options";
                        $update_block_data["meta_value"] = serialize($update_blocking_options);
                        $obj_dbHelper_limit_attempts_booster->updateCommand(limit_attempts_booster_meta(), $update_block_data, $where);
                    }
                    break;

                case "limit_attempts_other_settings_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_other_settings")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $update_array);
                        $update_limit_attempts_type = array();
                        $where = array();
                        if (esc_attr($update_array["ux_ddl_trackback"]) == "enable") {
                            $trackback = $wpdb->query
                                    (
                                    $wpdb->prepare
                                            (
                                            "UPDATE " . $wpdb->posts . " SET ping_status=%s", "open"
                                    )
                            );
                        } else {
                            $trackback = $wpdb->query
                                    (
                                    $wpdb->prepare
                                            (
                                            "UPDATE " . $wpdb->posts . " SET ping_status=%s", "closed"
                                    )
                            );
                        }
                        if (esc_attr($update_array["ux_ddl_Comments"]) == "enable") {
                            $comments = $wpdb->query
                                    (
                                    $wpdb->prepare
                                            (
                                            "UPDATE " . $wpdb->posts . " SET comment_status=%s", "open"
                                    )
                            );
                        } else {
                            $comments = $wpdb->query
                                    (
                                    $wpdb->prepare
                                            (
                                            "UPDATE " . $wpdb->posts . " SET comment_status=%s", "closed"
                                    )
                            );
                        }
                        $update_limit_attempts_type["live_traffic_monitoring"] = isset($update_array["ux_ddl_live_traffic_monitoring"]) ? esc_attr($update_array["ux_ddl_live_traffic_monitoring"]) : "";
                        $update_limit_attempts_type["visitor_logs_monitoring"] = isset($update_array["ux_ddl_visitor_logs_monitoring"]) ? esc_attr($update_array["ux_ddl_visitor_logs_monitoring"]) : "";
                        $update_limit_attempts_type["uninstall_plugin"] = isset($update_array["ux_ddl_plugin_uninstall"]) ? esc_attr($update_array["ux_ddl_plugin_uninstall"]) : "";
                        $update_limit_attempts_type["uninstall_plugin"] = isset($update_array["ux_ddl_plugin_uninstall"]) ? esc_attr($update_array["ux_ddl_plugin_uninstall"]) : "";
                        $update_limit_attempts_type["ip_address_fetching_method"] = isset($update_array["ux_ddl_ip_address_fetching_method"]) ? esc_attr($update_array["ux_ddl_ip_address_fetching_method"]) : "";

                        $update_data = array();
                        $where["meta_key"] = "other_settings";
                        $update_data["meta_value"] = serialize($update_limit_attempts_type);
                        $obj_dbHelper_limit_attempts_booster->updateCommand(limit_attempts_booster_meta(), $update_data, $where);
                    }
                    break;

                case "limit_attempts_manage_ip_address_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_manage_ip_address")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $advance_security_data);
                        $ip = isset($_REQUEST["lab_ip_address"]) ? ip2long(json_decode(stripslashes($_REQUEST["lab_ip_address"]))) : 0;

                        $blocked_for = esc_attr($advance_security_data["ux_ddl_ip_blocked_for"]);

                        $get_ip = lab_get_ip_location_limit_attempts_booster(long2ip($ip));
                        $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

                        $ip_address_count = $wpdb->get_results
                                (
                                $wpdb->prepare
                                        (
                                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . " WHERE meta_key = %s", "block_ip_address"
                                )
                        );
                        if (isset($ip_address_count) && count($ip_address_count) > 0) {
                            foreach ($ip_address_count as $data) {
                                $ip_address_unserialize = unserialize($data->meta_value);
                                if ($ip == $ip_address_unserialize["ip_address"]) {
                                    echo "1";
                                    die();
                                }
                            }
                        }
                        $ip_address_ranges_data = $wpdb->get_results
                                (
                                $wpdb->prepare
                                        (
                                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . " WHERE meta_key = %s", "block_ip_range"
                                )
                        );
                        $ip_exists = false;
                        if (isset($ip_address_ranges_data) && count($ip_address_ranges_data) > 0) {
                            foreach ($ip_address_ranges_data as $data) {
                                $ip_range_unserialized_data = unserialize($data->meta_value);
                                $data_range = explode(",", $ip_range_unserialized_data["ip_range"]);
                                if ($ip >= $data_range[0] && $ip <= $data_range[1]) {
                                    $ip_exists = true;
                                    break;
                                }
                            }
                        }
                        if ($ip_exists == true) {
                            echo 1;
                        } else {
                            $insert_manage_ip_address = array();
                            $insert_manage_ip_address["type"] = "block_ip_address";
                            $insert_manage_ip_address["parent_id"] = "0";
                            $last_id = $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster(), $insert_manage_ip_address);

                            $insert_manage_ip_address = array();
                            $insert_manage_ip_address["ip_address"] = $ip;
                            $insert_manage_ip_address["blocked_for"] = $blocked_for;
                            $insert_manage_ip_address["location"] = $location;
                            $insert_manage_ip_address["comments"] = isset($advance_security_data["ux_txtarea_ip_comments"]) ? esc_html($advance_security_data["ux_txtarea_ip_comments"]) : "";
                            $timestamp = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
                            $insert_manage_ip_address["date_time"] = $timestamp;

                            $insert_data = array();
                            $insert_data["meta_id"] = $last_id;
                            $insert_data["meta_key"] = "block_ip_address";
                            $insert_data["meta_value"] = serialize($insert_manage_ip_address);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $insert_data);

                            if ($blocked_for != "permanently") {
                                $cron_name = "ip_address_unblocker_" . $last_id;
                                schedule_limit_attempts_booster_ip_address_range($cron_name, $blocked_for);
                            }
                        }
                    }
                    break;

                case "limit_attempts_delete_ip_address_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_manage_ip_address_delete")) {
                        $id = isset($_REQUEST["id_address"]) ? intval($_REQUEST["id_address"]) : 0;
                        $where = array();
                        $where_parent = array();
                        $where["meta_id"] = $id;
                        $where_parent["id"] = $id;
                        $cron_name = "ip_address_unblocker_" . $id;
                        unschedule_events_limit_attempts_booster($cron_name);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_delete_ip_range_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_manage_ip_ranges_delete")) {
                        $where_meta = array();
                        $where_parent = array();
                        $id_range = isset($_REQUEST["id_range"]) ? intval($_REQUEST["id_range"]) : 0;
                        $where_meta["meta_id"] = $id_range;
                        $where_parent["id"] = $id_range;
                        $cron_name = "ip_range_unblocker_" . $where_meta["meta_id"];
                        unschedule_events_limit_attempts_booster($cron_name);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster_meta(), $where_meta);
                        $obj_dbHelper_limit_attempts_booster->deleteCommand(limit_attempts_booster(), $where_parent);
                    }
                    break;

                case "limit_attempts_manage_ip_ranges_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_manage_ip_ranges")) {
                        parse_str(isset($_REQUEST["data"]) ? base64_decode($_REQUEST["data"]) : "", $ip_range_data);
                        $start_ip_range = isset($_REQUEST["start_range"]) ? ip2long(json_decode(stripslashes($_REQUEST["start_range"]))) : 0;
                        $end_ip_range = isset($_REQUEST["end_range"]) ? ip2long(json_decode(stripslashes($_REQUEST["end_range"]))) : 0;

                        $blocked_for = esc_attr($ip_range_data["ux_ddl_range_blocked"]);
                        $ip_range = $start_ip_range . "," . $end_ip_range;
                        $get_ip = lab_get_ip_location_limit_attempts_booster(long2ip($start_ip_range));
                        $location = $get_ip->country_name == "" && $get_ip->city == "" ? "" : $get_ip->country_name == "" ? "" : $get_ip->city == "" ? $get_ip->country_name : $get_ip->city . ", " . $get_ip->country_name;

                        $ip_address_range_data = $wpdb->get_results
                                (
                                $wpdb->prepare
                                        (
                                        "SELECT meta_value FROM " . limit_attempts_booster_meta() . " WHERE meta_key = %s", "block_ip_range"
                                )
                        );
                        $ip_exists = false;
                        if (isset($ip_address_range_data) && count($ip_address_range_data) > 0) {
                            foreach ($ip_address_range_data as $data) {
                                $ip_range_unserialized_data = unserialize($data->meta_value);
                                $data_range = explode(",", $ip_range_unserialized_data["ip_range"]);
                                if (($start_ip_range >= $data_range[0] && $start_ip_range <= $data_range[1]) || ($end_ip_range >= $data_range[0] && $end_ip_range <= $data_range[1])) {
                                    echo 1;
                                    $ip_exists = true;
                                    break;
                                } elseif (($start_ip_range <= $data_range[0] && $start_ip_range <= $data_range[1]) && ($end_ip_range >= $data_range[0] && $end_ip_range >= $data_range[1])) {
                                    echo 1;
                                    $ip_exists = true;
                                    break;
                                }
                            }
                        }
                        if ($ip_exists == false) {
                            $insert_manage_ip_range = array();
                            $insert_manage_ip_range["type"] = "block_ip_range";
                            $insert_manage_ip_range["parent_id"] = "0";
                            $last_id = $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster(), $insert_manage_ip_range);

                            $insert_manage_ip_range = array();
                            $insert_manage_ip_range["ip_range"] = $ip_range;
                            $insert_manage_ip_range["blocked_for"] = $blocked_for;
                            $insert_manage_ip_range["location"] = isset($location) ? esc_html($location) : "";
                            $insert_manage_ip_range["comments"] = isset($ip_range_data["ux_txtarea_manage_ip_range"]) ? htmlspecialchars_decode($ip_range_data["ux_txtarea_manage_ip_range"]) : "";
                            $timestamp = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
                            $insert_manage_ip_range["date_time"] = $timestamp;

                            $insert_data = array();
                            $insert_data["meta_id"] = $last_id;
                            $insert_data["meta_key"] = "block_ip_range";
                            $insert_data["meta_value"] = serialize($insert_manage_ip_range);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $insert_data);

                            if ($blocked_for != "permanently") {
                                $cron_name = "ip_range_unblocker_" . $last_id;
                                schedule_limit_attempts_booster_ip_address_range($cron_name, $blocked_for);
                            }
                        }
                    }
                    break;

                case "limit_attempts_change_email_template_module":
                    if (wp_verify_nonce(isset($_REQUEST["_wp_nonce"]) ? esc_attr($_REQUEST["_wp_nonce"]) : "", "limit_attempts_email_template_data")) {
                        $templates = isset($_REQUEST["data"]) ? esc_attr($_REQUEST["data"]) : "";
                        $templates_data = $wpdb->get_results
                                (
                                $wpdb->prepare
                                        (
                                        "SELECT * FROM " . limit_attempts_booster_meta() .
                                        " WHERE meta_key = %s", $templates
                                )
                        );

                        $email_template_data = get_limit_attempts_booster_unserialize_data($templates_data);
                        echo json_encode($email_template_data);
                    }
                    break;
            }
            die();
        }
    }
}