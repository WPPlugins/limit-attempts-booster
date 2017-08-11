<?php

/**
 * This file is used to create class for insert update and delete sql commands.
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
        /*
          Class Name: dbHelper_limit_attempts_booster
          Parameters: No
          Description: This Class is used for Insert Update and Delete operations.
          Created On: 23-09-2015 1:10
          Created By: Tech Banker Team
         */

        class dbHelper_limit_attempts_booster {
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

            /*
              Function Name: bulk_deleteCommand
              Parameters: Yes($table_name,$data,$where)
              Decription: This function is being used  to delete bulk Data.
              Created On: 23-09-2015 1:10
              Created By: Tech Banker Team
             */

            function bulk_deleteCommand($table_name, $where, $data) {
                global $wpdb;
                $wpdb->query
                        (
                        "DELETE FROM $table_name WHERE $where IN ($data)"
                );
            }

            /*
              Function Name: file_reader
              Parameters: No
              Decription: This function is used to file read.
              Created On: 18-01-2017 10:18
              Created By: Tech Banker Team
             */

            public static function file_reader($filePath) {
                $reader = "";
                if (file_exists($filePath)) {
                    $reader = file_get_contents($filePath);
                }
                return $reader;
            }

            /*
              Function Name: clear_error_log
              Parameters: No
              Decription: This function is used to clear Error Logs.
              Created On: 18-01-2017 10:18
              Created By: Tech Banker Team
             */

            public static function clear_error_log($filePath) {
                if (file_exists($filePath)) {
                    file_put_contents($filePath, "");
                }
            }

        }

        /*
          Class Name: plugin_info_limit_attempts_booster
          Parameters: No
          Description: This Class is used to get the the information about plugins.
          Created On: 18-04-2017 17:06
          Created By: Tech Banker Team
         */

        class plugin_info_limit_attempts_booster {
            /*
              Function Name: get_plugin_info_limit_attempts_booster
              Parameters: No
              Decription: This function is used to return the information about plugins.
              Created On: 18-04-2017 17:06
              Created By: Tech Banker Team
             */

            function get_plugin_info_limit_attempts_booster() {
                $active_plugins = (array) get_option("active_plugins", array());
                if (is_multisite())
                    $active_plugins = array_merge($active_plugins, get_site_option("active_sitewide_plugins", array()));
                $plugins = array();
                if (count($active_plugins) > 0) {
                    $get_plugins = array();
                    foreach ($active_plugins as $plugin) {
                        $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);

                        $get_plugins["plugin_name"] = strip_tags($plugin_data["Name"]);
                        $get_plugins["plugin_author"] = strip_tags($plugin_data["Author"]);
                        $get_plugins["plugin_version"] = strip_tags($plugin_data["Version"]);
                        array_push($plugins, $get_plugins);
                    }
                    return $plugins;
                }
            }

        }

    }
}