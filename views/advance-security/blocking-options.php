<?php
/**
 * Template for blocking options.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/advance-security
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
    } else if (advance_security_limit_attempts_booster == "1") {
        $limit_attempts_block = wp_create_nonce("limit_attempts_block");
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
                    <a href="admin.php?page=lab_blocking_options">
                        <?php echo $lab_advance_security; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $lab_blocking_options_menu; ?>
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
        <?php echo $lab_blocking_options_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_blocking_options">
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
        <?php echo $lab_blocking_options_auto_ip_block; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_blocking_options_auto_ip_block_tooltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <select name="ux_ddl_auto_ip" id="ux_ddl_auto_ip" class="form-control" onchange="change_mailer_type_limit_attempts_booster();">
                                        <option value="enable"><?php echo $lab_enable; ?></option>
                                        <option value="disable"><?php echo $lab_disable; ?></option>
                                    </select>
                                </div>
                                <div id="ux_div_auto_ip">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
        <?php echo $lab_blocking_options_login_attempts; ?> :
                                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_blocking_options_login_attempts_tooltip; ?>" data-placement="right"></i>
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <input type="text" class="form-control" name="ux_txt_login" id="ux_txt_login" value="<?php echo isset($blocking_option_array["maximum_login_attempt_in_a_day"]) ? intval($blocking_option_array["maximum_login_attempt_in_a_day"]) : "" ?>" onfocus="prevent_paste_limit_attempts_booster(this.id);" placeholder="<?php echo $lab_blocking_options_login_attempts_placeholder; ?>" onkeypress="enter_only_numbers(this.id)" maxlength="4">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">
        <?php echo $lab_blocked_for; ?> :
                                                    <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_blocked_for_tooltip; ?>" data-placement="right"></i>
                                                    <span class="required" aria-required="true">*</span>
                                                </label>
                                                <div class="input-icon-custom right">
                                                    <select name="ux_ddl_blocked_for" id="ux_ddl_blocked_for" class="form-control">
                                                        <option value="1Hour"><?php echo $lab_one_hour; ?></option>
                                                        <option value="12Hour"><?php echo $lab_twelve_hours; ?></option>
                                                        <option value="24hours"><?php echo $lab_twenty_four_hours; ?></option>
                                                        <option value="48hours"><?php echo $lab_forty_eight_hours; ?></option>
                                                        <option value="week"><?php echo $lab_one_week; ?></option>
                                                        <option value="month"><?php echo $lab_one_month; ?></option>
                                                        <option value="permanently"><?php echo $lab_permanently; ?></option>
                                                    </select>
                                                </div>
                                            </div>
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
                    <a href="admin.php?page=lab_blocking_options">
        <?php echo $lab_advance_security; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
        <?php echo $lab_blocking_options_menu; ?>
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
        <?php echo $lab_blocking_options_menu; ?>
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