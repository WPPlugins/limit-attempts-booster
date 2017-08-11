<?php

/**
 * This file is used to create tables insert defalut data.
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
    if (!current_user_can("manage_options")) {
        return;
    } else {
        /*
          Class Name: dbHelper_install_script_limit_attempts_booster
          Parameters: No
          Description: This Class is used for Insert Update and Delete operations.
          Created On: 23-09-2015 1:10
          Created By: Tech Banker Team
         */

        class dbHelper_install_script_limit_attempts_booster {
            /*
              Function Name: insertCommand
              Parameters: Yes($table_name,$data)
              Description: This Function is used for Insert data in database.
              Created On: 23-09-2015 1:10
              Created By: Tech Banker Team
             */

            function insertCommand($table_name, $data) {
                global $wpdb;
                $wpdb->insert($table_name, $data);
                return $wpdb->insert_id;
            }

            /*
              Function Name: updateCommand
              Parameters: Yes($table_name,$data,$where)
              Description: This function is used for Update data.
              Created On: 23-09-2015 1:10
              Created By: Tech Banker Team
             */

            function updateCommand($table_name, $data, $where) {
                global $wpdb;
                $wpdb->update($table_name, $data, $where);
            }

            /*
              Function Name: deleteCommand
              Parameters: Yes($table_name,$where)
              Description: This function is used for delete data.
              Created On: 23-09-2015 1:10
              Created By: Tech Banker Team
             */

            function deleteCommand($table_name, $where) {
                global $wpdb;
                $wpdb->delete($table_name, $where);
            }

        }

        require_once ABSPATH . "wp-admin/includes/upgrade.php";
        $limit_attempts_booster_version_number = get_option("limit_attempts_booster_version_number");
        $obj_dbHelper_limit_attempts_booster = new dbHelper_install_script_limit_attempts_booster();

        function limit_attempts_booster_table() {
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . limit_attempts_booster() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`type` longtext NOT NULL,
					`parent_id` int(10) DEFAULT NULL,
					 PRIMARY KEY (`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $data = "INSERT INTO " . limit_attempts_booster() . " (`type`, `parent_id`) VALUES
				('roles_and_capabilities', 0),
				('advance_security', 0),
				('email_templates', 0),
				('general_settings', 0)";

            dbDelta($data);

            $parent_table = $wpdb->get_results
                    (
                    "SELECT * FROM " . limit_attempts_booster()
            );

            $obj_dbHelper_limit_attempts_booster = new dbHelper_install_script_limit_attempts_booster();
            if (isset($parent_table) && count($parent_table) > 0) {
                foreach ($parent_table as $parent) {
                    switch (esc_attr($parent->type)) {
                        case "advance_security":
                            $insert_parent_value = array();
                            $insert_parent_value["blocking_options"] = isset($parent->id) ? intval($parent->id) : "";
                            $insert_parent_value["country_blocks"] = isset($parent->id) ? intval($parent->id) : "";
                            foreach ($insert_parent_value as $keys => $value) {
                                $insert_advance_security_data = array();
                                $insert_advance_security_data["type"] = $keys;
                                $insert_advance_security_data["parent_id"] = $value;
                                $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster(), $insert_advance_security_data);
                            }
                            break;

                        case "general_settings":
                            $insert_into_parent = array();
                            $insert_into_parent["alert_setup"] = isset($parent->id) ? intval($parent->id) : "";
                            $insert_into_parent["error_message"] = isset($parent->id) ? intval($parent->id) : "";
                            $insert_into_parent["other_settings"] = isset($parent->id) ? intval($parent->id) : "";
                            foreach ($insert_into_parent as $keys => $value) {
                                $insert_parent_value = array();
                                $insert_parent_value["type"] = $keys;
                                $insert_parent_value["parent_id"] = $value;
                                $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster(), $insert_parent_value);
                            }
                            break;
                    }
                }
            }
        }

        function limit_attempts_booster_meta_table() {
            global $wpdb;
            $sql = "CREATE TABLE IF NOT EXISTS " . limit_attempts_booster_meta() . "
				(
					`id` int(10) NOT NULL AUTO_INCREMENT,
					`meta_id` int(10) NOT NULL,
					`meta_key` varchar(200) NOT NULL,
					`meta_value` longtext,
					PRIMARY KEY(`id`)
				)
				ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
            dbDelta($sql);

            $admin_email = get_option("admin_email");
            $admin_name = get_option("blogname");

            $parent_table_data = $wpdb->get_results
                    (
                    "SELECT id,type FROM " . limit_attempts_booster()
            );

            $obj_dbHelper_limit_attempts_booster = new dbHelper_install_script_limit_attempts_booster();
            if (isset($parent_table_data) && count($parent_table_data) > 0) {
                foreach ($parent_table_data as $row) {
                    switch (esc_attr($row->type)) {
                        case "roles_and_capabilities":
                            $roles_and_capabilities_data["roles_and_capabilities"] = "1,1,1,0,0,0";
                            $roles_and_capabilities_data["show_limit_attempts_booster_top_bar_menu"] = "enable";
                            $roles_and_capabilities_data["administrator_privileges"] = "1,1,1,1,1,1,1,1,1,1,1";
                            $roles_and_capabilities_data["author_privileges"] = "0,1,1,0,0,1,0,1,0,0,0";
                            $roles_and_capabilities_data["editor_privileges"] = "0,1,1,0,0,1,0,1,1,0,0";
                            $roles_and_capabilities_data["contributor_privileges"] = "0,0,1,0,0,1,0,0,0,0,0";
                            $roles_and_capabilities_data["subscriber_privileges"] = "0,0,0,0,0,0,0,0,0,0,0";
                            $roles_and_capabilities_data["others_full_control_capability"] = "0";
                            $roles_and_capabilities_data["other_privileges"] = "0,0,0,0,0,0,0,0,0,0,0";

                            $user_capabilities = get_others_capabilities_limit_attempts_booster();
                            $other_roles_array = array();
                            $other_roles_access_array = array(
                                "manage_options",
                                "edit_plugins",
                                "edit_posts",
                                "publish_posts",
                                "publish_pages",
                                "edit_pages",
                                "read"
                            );
                            foreach ($other_roles_access_array as $role) {
                                if (in_array($role, $user_capabilities)) {
                                    array_push($other_roles_array, $role);
                                }
                            }
                            $roles_and_capabilities_data["capabilities"] = $other_roles_array;

                            $roles_and_capabilities_data_serialize = array();
                            $roles_and_capabilities_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $roles_and_capabilities_data_serialize["meta_key"] = "roles_and_capabilities";
                            $roles_and_capabilities_data_serialize["meta_value"] = serialize($roles_and_capabilities_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $roles_and_capabilities_data_serialize);

                            break;

                        case "country_blocks":
                            $country_blocks_data = array();
                            $country_blocks_data["country_blocks_data"] = "";

                            $country_blocks_data_serialize = array();
                            $country_blocks_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $country_blocks_data_serialize["meta_key"] = "country_blocks";
                            $country_blocks_data_serialize["meta_value"] = serialize($country_blocks_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $country_blocks_data_serialize);
                            break;

                        case "blocking_options":
                            $blocking_option_data["auto_ip_block"] = "enable";
                            $blocking_option_data["maximum_login_attempt_in_a_day"] = "5";
                            $blocking_option_data["block_for"] = "1Hour";

                            $blocking_option_data_serialize = array();
                            $blocking_option_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $blocking_option_data_serialize["meta_key"] = "blocking_options";
                            $blocking_option_data_serialize["meta_value"] = serialize($blocking_option_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $blocking_option_data_serialize);
                            break;

                        case "alert_setup":
                            $alert_setup_data["email_when_a_user_fails_login"] = "disable";
                            $alert_setup_data["email_when_a_user_success_login"] = "disable";
                            $alert_setup_data["email_when_an_ip_address_is_blocked"] = "disable";
                            $alert_setup_data["email_when_an_ip_address_is_unblocked"] = "disable";
                            $alert_setup_data["email_when_an_ip_range_is_blocked"] = "disable";
                            $alert_setup_data["email_when_an_ip_range_is_unblocked"] = "disable";

                            $alert_setup_data_serialize = array();
                            $alert_setup_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $alert_setup_data_serialize["meta_key"] = "alert_setup";
                            $alert_setup_data_serialize["meta_value"] = serialize($alert_setup_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $alert_setup_data_serialize);
                            break;

                        case "error_message":
                            $error_message_data["for_maximum_login_attempts"] = "<p>Your Maximum <strong>[login_attempts]</strong> Login Attempts has been Left.</p>";
                            $error_message_data["for_blocked_ip_address_error"] = "<p>Your IP Address <strong>[ip_address]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the website Administrator for more details.</p>";
                            $error_message_data["for_blocked_country_error"] = "<p>Unfortunately, your country location <strong>[country_location]</strong> has been blocked by the Administrator for security purposes.</p><p>Please contact the website Administrator for more details.</p>";
                            $error_message_data["for_blocked_ip_range_error"] = "<p>Your IP Range <strong>[ip_range]</strong> has been blocked by the Administrator for security purposes.</p>\r\n<p>Please contact the website Administrator for more details.</p>";

                            $error_message_data_serialize = array();
                            $error_message_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $error_message_data_serialize["meta_key"] = "error_message";
                            $error_message_data_serialize["meta_value"] = serialize($error_message_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $error_message_data_serialize);

                            break;

                        case "other_settings":
                            $other_settings_data["live_traffic_monitoring"] = "disable";
                            $other_settings_data["visitor_logs_monitoring"] = "disable";
                            $other_settings_data["uninstall_plugin"] = "enable";
                            $other_settings_data["ip_address_fetching_method"] = "";

                            $other_settings_data_serialize = array();
                            $other_settings_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                            $other_settings_data_serialize["meta_key"] = "other_settings";
                            $other_settings_data_serialize["meta_value"] = serialize($other_settings_data);
                            $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $other_settings_data_serialize);
                            break;

                        case "email_templates":
                            $email_templates_data = array();
                            $email_templates_data["template_for_user_success"] = "<p>Hi,</p><p>A login attempt has been successfully made to your website [site_url] by user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                            $email_templates_data["template_for_user_failure"] = "<p>Hi,</p><p>An unsuccessful attempt to login at your website [site_url] was being made by user <strong>[username]</strong> at [date_time] from IP Address <strong>[ip_address]</strong>.</p><p><u>Here is the detailed footprint at the Request</u> :-</p><p><strong>Username:</strong> [username]</p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>website:</strong> [site_url]<p><strong>IP Address:</strong> [ip_address]</p><strong>Resource:</strong>[resource]</p><p>Thanks & Regards</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                            $email_templates_data["template_for_ip_address_blocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url]. <p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                            $email_templates_data["template_for_ip_address_unblocked"] = "<p>Hi,</p><p>An IP Address <strong>[ip_address]</strong> has been Unblocked from your website [site_url].</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Address:</strong> [ip_address]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                            $email_templates_data["template_for_ip_range_blocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Blocked <strong>[blocked_for]</strong> to your website [site_url]. <p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Range:</strong> [ip_range]</p><p><strong>Resource:</strong> [resource]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";
                            $email_templates_data["template_for_ip_range_unblocked"] = "<p>Hi,</p><p>An IP Range from <strong>[start_ip_range]</strong> to <strong>[end_ip_range]</strong> has been Unblocked from your website [site_url].</p><p><u>Here is the detailed footprint at the Request :-</u></p><p><strong>Date/Time:</strong> [date_time]</p><p><strong>Website:</strong> [site_url]</p><p><strong>IP Range:</strong> [ip_range]</p><p>Thanks and Regards,</p><p><strong>Technical Support Team</strong></p><p>[site_url]</p>";

                            $email_templates_message = array("Login Success Notification - Limit Attempts Booster", "Login Failure Notification - Limit Attempts Booster", "IP Address Blocked Notification - Limit Attempts Booster", "IP Address Unblocked Notification - Limit Attempts Booster", "IP Range Blocked Notification - Limit Attempts Booster", "IP Range Unblocked Notification - Limit Attempts Booster");
                            $count = 0;

                            foreach ($email_templates_data as $keys => $value) {
                                $email_templates_data_array = array();
                                $email_templates_data_array["email_send_to"] = $admin_email;
                                $email_templates_data_array["email_cc"] = "";
                                $email_templates_data_array["email_bcc"] = "";
                                $email_templates_data_array["email_subject"] = $email_templates_message[$count];
                                $email_templates_data_array["email_message"] = $value;
                                $count++;

                                $email_templates_data_serialize = array();
                                $email_templates_data_serialize["meta_id"] = isset($row->id) ? intval($row->id) : 0;
                                $email_templates_data_serialize["meta_key"] = $keys;
                                $email_templates_data_serialize["meta_value"] = serialize($email_templates_data_array);
                                $obj_dbHelper_limit_attempts_booster->insertCommand(limit_attempts_booster_meta(), $email_templates_data_serialize);
                            }
                            break;
                    }
                }
            }
        }

        $obj_dbHelper_limit_attempts_booster = new dbHelper_install_script_limit_attempts_booster();
        switch ($limit_attempts_booster_version_number) {
            case "":
                limit_attempts_booster_table();
                limit_attempts_booster_meta_table();
                break;

            default :
                if ($limit_attempts_booster_version_number < "2.0.3") {
                    $wpdb->query("DROP TABLE IF EXISTS " . limit_attempts_booster());
                    $wpdb->query("DROP TABLE IF EXISTS " . limit_attempts_booster_meta());
                }
                if (count($wpdb->get_var("SHOW TABLES LIKE '" . limit_attempts_booster() . "'")) == 0) {
                    limit_attempts_booster_table();
                }
                if (count($wpdb->get_var("SHOW TABLES LIKE '" . limit_attempts_booster_meta() . "'")) == 0) {
                    limit_attempts_booster_meta_table();
                } else {
                    $other_settings_serialized_data = $wpdb->get_var
                            (
                            $wpdb->prepare
                                    (
                                    "SELECT meta_value FROM " . limit_attempts_booster_meta() . "
							WHERE meta_key=%s", "other_settings"
                            )
                    );
                    $other_settings_data = unserialize($other_settings_serialized_data);
                    $update_other_settings_data = array();
                    $where = array();
                    $where["meta_key"] = "other_settings";
                    $update_other_settings_data["meta_value"] = serialize($other_settings_data);
                    $obj_dbHelper_limit_attempts_booster->updateCommand(limit_attempts_booster_meta(), $update_other_settings_data, $where);
                }
                break;
        }
        update_option("limit_attempts_booster_version_number", "3.0.0");
    }
}