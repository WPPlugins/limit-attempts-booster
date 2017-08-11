<?php

/**
 * This file is used to create tables insert defalut data.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/lib
 * @version 2.0.0
 */
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
} else {
    if (!current_user_can("manage_options")) {
        return;
    } else {
        $limit_attempts_booster_version_number = get_option("limit_attempts_booster_version_number");
        if ($limit_attempts_booster_version_number != "") {
            global $wp_version, $wpdb;
            $other_settings_data = $wpdb->get_var
                    (
                    $wpdb->prepare
                            (
                            "SELECT meta_value FROM " . $wpdb->prefix ."limit_attempts_booster_meta
                             WHERE meta_key = %s ", "other_settings"
                    )
            );
            $other_settings_unserialized_data = unserialize($other_settings_data);

            if (esc_attr($other_settings_unserialized_data["uninstall_plugin"]) == "enable") {

                $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix ."limit_attempts_booster");
                $wpdb->query("DROP TABLE IF EXISTS " . $wpdb->prefix ."limit_attempts_booster_meta");

                delete_option("limit_attempts_booster_version_number");
                delete_option("limit-attempts-wizard-set-up");
                delete_option("lab_tech_banker_site_id");
            }
        }
    }
}
