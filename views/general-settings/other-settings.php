<?php
/**
 * Template for Other message settings.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/views/other-settings
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit();
}
if (!is_user_logged_in()) {
    return;
} else {
    $access_granted = false;
    foreach ($user_role_permission as $permission) {
        if (current_user_can($permission)) {
            $access_granted = true;
            break;
        }
    }
    if (!$access_granted) {
        return;
    } else if (general_settings_limit_attempts_booster == "1") {
        $limit_attempts_other_settings = wp_create_nonce("limit_attempts_other_settings");
        ?>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-custom-home"></i>
                    <a href="admin.php?page=lab_limit_attempts_booster">
        <?php echo $limit_attempts_booster; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <a href="admin.php?page=lab_alert_setup">
        <?php echo $lab_general_settings; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
        <?php echo $lab_other_settings_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
        <?php echo $lab_other_settings_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_other_settings">
                            <div class="form-body">
                                <?php
                                if ($lab_message_translate_help != "") {
                                    ?>
                                    <div class="note note-danger">
                                        <h4 class="block">
            <?php echo $lab_important_disclaimer; ?>
                                        </h4>
                                        <strong><?php echo $lab_message_translate_help; ?><br/><?php echo $lab_kindly_click; ?><a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links" onclick="show_pop_up_limit_attempts_booster();"><?php echo $lab_message_translate_here; ?></a></strong>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_other_settings_trackbacks ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_trackbacks_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_trackback" id="ux_ddl_trackback" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_comments; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_comments_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_Comments" id="ux_ddl_Comments" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_other_settings_live_traffic_monitoring_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_live_traffic_monitoring_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_live_traffic_monitoring" id="ux_ddl_live_traffic_monitoring" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_other_settings_visitor_logs_monitoring_title; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_visitor_logs_monitoring_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_visitor_logs_monitoring" id="ux_ddl_visitor_logs_monitoring" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $lab_other_settings_uninstall_plugin; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_remove_tables_at_uninstall_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <select name="ux_ddl_plugin_uninstall" id="ux_ddl_plugin_uninstall" class="form-control">
                                        <option value="enable"><?php echo $lab_enable; ?></option>
                                        <option value="disable"><?php echo $lab_disable; ?></option>
                                    </select>
                                </div>
                                <div style="margin-top:15px;" class="form-group">
                                    <label class="control-label">
        <?php echo $lab_other_settings_ip_address_fetching_method; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_other_settings_ip_address_tooltips; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <select name="ux_ddl_ip_address_fetching_method" id="ux_ddl_ip_address_fetching_method" class="form-control">
                                        <option value=""><?php echo $lab_other_settings_ip_address_fetching_option1; ?></option>
                                        <option value="REMOTE_ADDR"><?php echo $lab_other_settings_ip_address_fetching_option2; ?></option>
                                        <option value="HTTP_X_FORWARDED_FOR"><?php echo $lab_other_settings_ip_address_fetching_option3; ?></option>
                                        <option value="HTTP_X_REAL_IP"><?php echo $lab_other_settings_ip_address_fetching_option4; ?></option>
                                        <option value="HTTP_CF_CONNECTING_IP"><?php echo $lab_other_settings_ip_address_fetching_option5; ?></option>
                                    </select>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_save_changes" id="ux_btn_save_changes" value="<?php echo $lab_save_changes; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-custom-home"></i>
                    <a href="admin.php?page=lab_limit_attempts_booster">
        <?php echo $limit_attempts_booster; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <a href="admin.php?page=lab_alert_setup">
        <?php echo $lab_general_settings; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
        <?php echo $lab_other_settings_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
        <?php echo $lab_other_settings_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <strong><?php echo $lab_user_access_message; ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}