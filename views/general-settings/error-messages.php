<?php
/**
 * Template for Error message settings.
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
                        <?php echo $lab_error_messages_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-shield"></i>
        <?php echo $lab_error_messages_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_error_messages">
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
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $lab_error_messages_for_login_attempts_failure; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_error_messages_for_login_attempts_failure_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* <?php echo "( " . $lab_premium_editions_label . " )" ?> </span>
                                    </label>
                                    <textarea class="form-control" name="ux_txt_login_attempts" id="ux_txt_login_attempts"  placeholder="<?php echo $lab_error_messages_for_login_attempts_failure_placeholder; ?>"><?php echo isset($meta_data_array["for_maximum_login_attempts"]) ? trim(htmlspecialchars(htmlspecialchars_decode($meta_data_array["for_maximum_login_attempts"]))) : ""; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $lab_error_messages_for_blocked_country; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_error_messages_for_blocked_country_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* <?php echo "( " . $lab_premium_editions_label . " )" ?> </span>
                                    </label>
                                    <textarea class="form-control" name="ux_txt_blocked_country" id="ux_txt_blocked_country"  placeholder="<?php echo $lab_error_messages_for_blocked_country_placeholder; ?>"><?php echo isset($meta_data_array["for_blocked_country_error"]) ? trim(htmlspecialchars(htmlspecialchars_decode($meta_data_array["for_blocked_country_error"]))) : ""; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $lab_error_messages_for_ip_address; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_error_messages_for_ip_address_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* <?php echo "( " . $lab_premium_editions_label . " )" ?> </span>
                                    </label>
                                    <textarea class="form-control" name="ux_txt_ip_address" id="ux_txt_ip_address"  placeholder="<?php echo $lab_error_messages_for_ip_address_placeholder; ?>"><?php echo isset($meta_data_array["for_blocked_ip_address_error"]) ? trim(htmlspecialchars(htmlspecialchars_decode($meta_data_array["for_blocked_ip_address_error"]))) : ""; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
        <?php echo $lab_error_messages_for_ip_range; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_error_messages_for_ip_range_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">* <?php echo "( " . $lab_premium_editions_label . " )" ?> </span>
                                    </label>
                                    <textarea class="form-control" name="ux_txt_ip_range" id="ux_txt_ip_range"  placeholder="<?php echo $lab_error_messages_for_ip_range_placeholder; ?>"><?php echo isset($meta_data_array["for_blocked_ip_range_error"]) ? trim(htmlspecialchars(htmlspecialchars_decode($meta_data_array["for_blocked_ip_range_error"]))) : ""; ?></textarea>
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
        <?php echo $lab_error_messages_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-shield"></i>
        <?php echo $lab_error_messages_menu; ?>
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