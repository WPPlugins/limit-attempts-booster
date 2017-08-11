<?php
/**
 * Template for alert setup settings.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/views/general-settings
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
                        <?php echo $lab_alert_setup_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-bell"></i>
        <?php echo $lab_alert_setup_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_alert_setup">
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
                                <?php echo $lab_alert_setup_email_when_a_user_fails; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_a_user_fails_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_fail" id="ux_ddl_fail" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_alert_setup_email_when_a_user_success; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_a_user_success_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_success" id="ux_ddl_success" class="form-control">
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
        <?php echo $lab_alert_setup_email_when_ip_address_blocked; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_ip_address_blocked_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_IP_address_blocked" id="ux_ddl_IP_address_blocked" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_alert_setup_email_when_ip_address_unblocked; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_ip_address_unblocked_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_IP_address_unblocked" id="ux_ddl_IP_address_unblocked" class="form-control">
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
        <?php echo $lab_alert_setup_email_when_ip_range_blocked; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_ip_range_blocked_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_IP_range_blocked" id="ux_ddl_IP_range_blocked" class="form-control">
                                                <option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
        <?php echo $lab_alert_setup_email_when_ip_range_unblocked; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_alert_setup_email_when_ip_range_unblocked_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* ( <?php echo $lab_premium_editions_label; ?> )</span>
                                            </label>
                                            <select name="ux_ddl_IP_range_unblocked" id="ux_ddl_IP_range_unblocked" class="form-control">
                                                <<option value="enable"><?php echo $lab_enable; ?></option>
                                                <option value="disable"><?php echo $lab_disable; ?></option>
                                            </select>
                                        </div>
                                    </div>
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
        <?php echo $lab_alert_setup_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-bell"></i>
        <?php echo $lab_alert_setup_menu; ?>
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