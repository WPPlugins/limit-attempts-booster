<?php
/**
 * Template for manage ip range settings.
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
        $timestamp = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME;
        $start_date = $timestamp - 2592000;
        $limit_attempts_manage_ip_ranges = wp_create_nonce("limit_attempts_manage_ip_ranges");
        $limit_attempts_manage_ip_ranges_delete = wp_create_nonce("limit_attempts_manage_ip_ranges_delete");
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
                        <?php echo $lab_manage_ip_ranges_menu; ?>
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
                            <?php echo $lab_manage_ip_ranges_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_manage_ip_ranges">
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
                                                <?php echo $lab_manage_ip_ranges_start; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_start_tooltip; ?>" data-placement="right" ></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_start_ip_range" id="ux_txt_start_ip_range"  onblur="check_valid_ip_ranges_limit_attempts_booster(this);" onfocus="prevent_paste_limit_attempts_booster(this.id);" value="" onkeyPress="limit_attempts_booster_valid_ip_address(event);" placeholder="<?php echo $lab_manage_ip_ranges_start_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_manage_ip_ranges_end; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_end_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_end_ip_range" id="ux_txt_end_ip_range"  onblur="check_valid_ip_ranges_limit_attempts_booster(this);" onfocus="prevent_paste_limit_attempts_booster(this.id);"  value="" onkeyPress="limit_attempts_booster_valid_ip_address(event);" placeholder="<?php echo $lab_manage_ip_ranges_end_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <?php echo $lab_blocked_for; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_blocked_for_tootltip; ?>" data-placement="right"></i>
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <select name="ux_ddl_range_blocked" id="ux_ddl_range_blocked" class="form-control">
                                        <option value="1Hour"><?php echo $lab_one_hour; ?></option>
                                        <option value="12Hour"><?php echo $lab_twelve_hours; ?></option>
                                        <option value="24hours"><?php echo $lab_twenty_four_hours; ?></option>
                                        <option value="48hours"><?php echo $lab_forty_eight_hours; ?></option>
                                        <option value="week"><?php echo $lab_one_week; ?></option>
                                        <option value="month"><?php echo $lab_one_month; ?></option>
                                        <option value="permanently"><?php echo $lab_permanently; ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">
                                        <?php echo $lab_comments; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_comments_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                    <textarea class="form-control" name="ux_txtarea_manage_ip_range" id="ux_txtarea_manage_ip_range" rows="4" placeholder="<?php echo $lab_comments_placeholder; ?>"></textarea>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" name="ux_btn_clear" id="ux_btn_clear" value="<?php echo $lab_clear; ?>" onclick="value_blank_limit_attempts_booster();"/>
                                        <input type="submit" class="btn vivid-green" name="ux_btn_advance_security_ip_range_submit" id="ux_btn_advance_security_ip_range_submit" value="<?php echo $lab_manage_ip_ranges_block; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-wrench"></i>
                            <?php echo $lab_manage_ip_ranges_view_blocked; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_view_manage_ip_ranges">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_start_date_heading; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_start_date_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <div class="input-icon-custom right">
                                                <input type="text" class="form-control" value="<?php echo date("m/d/Y", esc_html($start_date)); ?>" name="ux_txt_start_date" onkeypress="prevent_data_limit_attempts_booster(event)" id="ux_txt_start_date"  placeholder="<?php echo $lab_start_date_placeholder; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_end_date_heading; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_ranges_end_date_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_end_date" value="<?php echo date("m/d/Y"); ?>" id="ux_txt_end_date" onkeypress="prevent_data_limit_attempts_booster(event)" placeholder="<?php echo $lab_end_date_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_ip_range" id="ux_btn_ip_range" value="<?php echo $lab_submit; ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="table-top-margin">
                                    <select name="ux_ddl_manage_ip_range" id="ux_ddl_manage_ip_range" class="custom-bulk-width">
                                        <option value=""><?php echo $lab_bulk_action; ?></option>
                                        <option value="delete" style="color:red;"><?php echo $lab_delete; ?><span> <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span></option>
                                    </select>
                                    <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value="<?php echo $lab_apply; ?>" onclick="premium_edition_notification_limit_attempts_booster();">
                                </div>
                                <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_ip_range">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width: 5%;" class="chk-action">
                                                <input type="checkbox" name="ux_chk_all_manage_ip_range" id="ux_chk_all_manage_ip_range">
                                            </th>
                                            <th>
                                                <label class="control-label">
                                                    <?php echo $lab_ip_ranges; ?>
                                                </label>
                                            </th>
                                            <th>
                                                <label class="control-label">
                                                    <?php echo $lab_location; ?>
                                                </label>
                                            </th>
                                            <th style="width:20%;">
                                                <label class="control-label">
                                                    <?php echo $lab_blocked_date_time ?>
                                                </label>
                                            </th>
                                            <th style="width:20%;">
                                                <label class="control-label">
                                                    <?php echo $lab_release_date_time; ?>
                                                </label>
                                            </th>
                                            <th>
                                                <label class="control-label">
                                                    <?php echo $lab_comments; ?>
                                                </label>
                                            </th>
                                            <th style="text-align:center;" class="chk-action">
                                                <label class="control-label">
                                                    <?php echo $lab_action; ?>
                                                </label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_table_filter">
                                        <?php
                                        foreach ($manage_ip_range as $row) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;width: 5%;">
                                                    <input type="checkbox" onclick="check_all_limit_attempts_booster('#ux_chk_all_manage_ip_range');" name="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" id="ux_chk_manage_ip_range_<?php echo intval($row["meta_id"]); ?>" value="<?php echo intval($row["meta_id"]); ?>">
                                                </td>
                                                <td>
                                                    <label>
                                                        <?php $ip_address = explode(",", $row["ip_range"]); ?>
                                                        <?php echo long2ip($ip_address[0]); ?> - <?php echo long2ip($ip_address[1]); ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <?php echo $row["location"] != "" ? esc_html($row["location"]) : $lab_na; ?>
                                                    </label>
                                                </td>
                                                <td style="width:20%;">
                                                    <label>
                                                        <?php echo date_i18n("d M Y h:i A", esc_attr($row["date_time"])); ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <?php
                                                        $blocking_time = esc_attr($row["blocked_for"]);
                                                        switch ($blocking_time) {
                                                            case "1Hour":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "12Hour":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60 * 12);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "24hours":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60 * 24);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "48hours":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60 * 48);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "week":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60 * 24 * 7);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "month":
                                                                $release_date = esc_attr($row["date_time"]) + (60 * 60 * 30 * 24);
                                                                echo date_i18n("d M Y h:i A", $release_date);
                                                                break;

                                                            case "permanently":
                                                                echo $lab_never;
                                                                break;
                                                        }
                                                        ?>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label>
                                                        <?php echo trim(htmlspecialchars(htmlspecialchars_decode($row["comments"]))); ?>
                                                    </label>
                                                </td>
                                                <td class="custom-alternative" style="width: 10%;">
                                                    <a href="javascript:void(0);">
                                                        <i class="icon-custom-trash tooltips" data-original-title="<?php echo $lab_delete; ?>" onclick="delete_ip_range_limit_attempts_booster(<?php echo intval($row["meta_id"]); ?>)"  data-placement="right"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
                        <?php echo $lab_manage_ip_ranges_menu; ?>
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
                            <?php echo $lab_manage_ip_ranges_menu; ?>
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