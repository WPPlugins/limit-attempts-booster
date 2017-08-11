<?php
/**
 * Template for visitor logs settings.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/dashboard
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
    } else if (dashboard_limit_attempts_booster == "1") {
        $lab_visitor_logs_delete = wp_create_nonce("limit_visitor_logs_delete");
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
                    <a href="admin.php?page=lab_limit_attempts_booster">
                        <?php echo $lab_dashboard; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $lab_visitor_logs_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-users"></i>
                            <?php echo $lab_visitor_logs_on_world_map; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_live_traffic">
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
                                <div id="map_canvas" class="custom-map"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-users"></i>
                            <?php echo $lab_visitor_logs_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_live_traffic">
                            <div class="form-body">
                                <?php
                                if ($visitor_logs_data["visitor_logs_monitoring"] == "enable") {
                                    ?>
                                    <div class="form-actions">
                                        <div class="table-top-margin">
                                            <select name="ux_ddl_visitor_logs_dashboard" id="ux_ddl_visitor_logs_dashboard" class="custom-bulk-width" onchange="lab_bulk_block_div_show_hide('#ux_ddl_visitor_logs_dashboard', '#ux_ddl_visitor_log_ip_blocked_for')">
                                                <option value=""><?php echo $lab_bulk_action; ?></option>
                                                <option value="delete" style="color:red"><?php echo $lab_delete . " ( " . $lab_premium_editions_label . " )"; ?></option>
                                                <option value="block" style="color:red"><?php echo $lab_bulk_block . " ( " . $lab_premium_editions_label . " )"; ?></option>
                                            </select>
                                            <select name="ux_ddl_visitor_log_ip_blocked_for" id="ux_ddl_visitor_log_ip_blocked_for" class="custom-bulk-width" style="display:none !important;">
                                                <option value="1Hour"><?php echo $lab_one_hour; ?></option>
                                                <option value="12Hour"><?php echo $lab_twelve_hours; ?></option>
                                                <option value="24hours"><?php echo $lab_twenty_four_hours; ?></option>
                                                <option value="48hours"><?php echo $lab_forty_eight_hours; ?></option>
                                                <option value="week"><?php echo $lab_one_week; ?></option>
                                                <option value="month"><?php echo $lab_one_month; ?></option>
                                                <option value="permanently"><?php echo $lab_permanently; ?></option>
                                            </select>
                                            <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" onclick="premium_edition_notification_limit_attempts_booster();" value="<?php echo $lab_apply; ?>">
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_visitor_logs">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center;width: 5% !important;" class="chk-action">
                                                        <input type="checkbox" class="custom-chkbox-operation" name="ux_chk_all_user" id="ux_chk_all_user">
                                                    </th>
                                                    <th style="width: 15%;">
                                                        <label class="control-label">
                                                            <?php echo $lab_user_name; ?>
                                                        </label>
                                                    </th>
                                                    <th style="width: 15%;">
                                                        <label class="control-label">
                                                            <?php echo $lab_ip_address; ?>
                                                        </label>
                                                    </th>
                                                    <th style="width: 15%;">
                                                        <label class="control-label">
                                                            <?php echo $lab_location; ?>
                                                        </label>
                                                    </th>
                                                    <th style="width: 25%;">
                                                        <label class="control-label">
                                                            <?php echo $lab_details; ?>
                                                        </label>
                                                    </th>
                                                    <th style="width: 15%;">
                                                        <label class="control-label">
                                                            <?php echo $lab_date_time; ?>
                                                        </label>
                                                    </th>
                                                    <th style="text-align:center;width: 10%;" class="chk-action">
                                                        <label class="control-label">
                                                            <?php echo $lab_action; ?>
                                                        </label>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="dynamic_table_filter">
                                                <?php
                                                foreach ($lab_map_data as $row) {
                                                    ?>
                                                    <tr>
                                                        <td style="text-align:center;">
                                                            <label>
                                                                <input  type="checkbox" onclick="check_all_limit_attempts_booster('#ux_chk_all_user');" name="ux_chk_visitor_logs_<?php echo intval($row["meta_id"]) ?>" id="ux_chk_visitor_logs_<?php echo intval($row["meta_id"]) ?>" value="<?php echo intval($row["meta_id"]); ?>">
                                                            </label>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <label>
                                                                <?php echo $row["username"] != "" ? esc_html($row["username"]) : $lab_na; ?>
                                                            </label>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <label>
                                                                <?php echo long2ip($row["user_ip_address"]); ?>
                                                            </label>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <label>
                                                                <?php echo $row["location"] != "" ? esc_html($row["location"]) : $lab_na; ?>
                                                            </label>
                                                        </td>
                                                        <td style="width: 25%;">
                                                            <label>
                                                                <?php echo $lab_resources; ?>: <?php echo esc_html($row["resources"]); ?><br/>
                                                                <?php echo $lab_http_user_agent; ?>: <?php echo esc_html($row["http_user_agent"]); ?>
                                                            </label>
                                                        </td>
                                                        <td style="width: 15%;">
                                                            <label>
                                                                <?php echo date_i18n("d M Y h:i A", esc_attr($row["date_time"])); ?>
                                                            </label>
                                                        </td>
                                                        <td class="custom-alternative"  style="width: 10%;">
                                                            <a href="javascript:void(0);" class="icon-custom-trash tooltips" data-original-title="<?php echo $lab_delete; ?>" onclick="selected_delete_visitor_logs_dashboard(<?php echo intval($row["meta_id"]); ?>);" data-placement="top"></a>
                                                            <a Onclick="premium_edition_notification_limit_attempts_booster();" class="icon-custom-ban tooltips" data-original-title="<?php echo $lab_block_ip_address; ?>" data-placement="right"></a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <strong>
                                        <?php echo $lab_visitor_logs_visitor_logs_monitoring; ?>
                                    </strong>
                                    <?php
                                }
                                ?>
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
                    <a href="admin.php?page=lab_limit_attempts_booster">
                        <?php echo $lab_dashboard; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $lab_visitor_logs_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-users"></i>
                            <?php echo $lab_visitor_logs_menu; ?>
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