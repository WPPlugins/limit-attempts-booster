<?php
/**
 * Template for manage ip address settings.
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
        $limit_attempts_manage_ip_address = wp_create_nonce("limit_attempts_manage_ip_address");
        $limit_attempts_manage_ip_address_delete = wp_create_nonce("limit_attempts_manage_ip_address_delete");
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
                        <?php echo $lab_manage_ip_addresses_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-globe"></i>
                            <?php echo $lab_manage_ip_addresses_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_manage_ip_addresses_form">
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
                                                <?php echo $lab_ip_address; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_addresses_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_ip_address" id="ux_txt_ip_address" placeholder="<?php echo $lab_valid_ip_address; ?>" onblur="check_valid_ip_address_limit_attempts_booster();" value="<?php echo isset($_REQUEST["ip_address"]) ? long2ip($_REQUEST["ip_address"]) : ""; ?>" onfocus="prevent_paste_limit_attempts_booster(this.id);" onkeypress="limit_attempts_booster_valid_ip_address(event);">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_blocked_for; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_blocked_for_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">*</span>
                                            </label>
                                            <select name="ux_ddl_ip_blocked_for" id="ux_ddl_ip_blocked_for" class="form-control">
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
                                <div class="form-group">
                                    <label class="control-label">
                                        <?php echo $lab_comments; ?> :
                                        <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_addresses_comments_tooltip; ?>" data-placement="right"></i>
                                    </label>
                                    <textarea class="form-control" name="ux_txtarea_ip_comments" id="ux_txtarea_ip_comments" rows="4" placeholder="<?php echo $lab_comments_placeholder; ?>"></textarea>
                                </div>
                                <div class="line-separator"></div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="button" class="btn vivid-green" name="ux_btn_clear" id="ux_btn_clear" value="<?php echo $lab_clear; ?>" onclick="value_blank_ip_addresses_limit_attempts_booster();">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_block_ip_address" id="ux_btn_block_ip_address" value="<?php echo $lab_block_ip_address; ?>">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-globe"></i>
                            <?php echo $lab_manage_ip_addresses_view_blocked; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_view_blocked_ip_addresses">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_start_date_heading; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_addresses_start_date_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_start_date" value="<?php echo date("m/d/Y", esc_html($start_date)); ?>" id="ux_txt_start_date" onkeypress="prevent_data_limit_attempts_booster(event)" placeholder="<?php echo $lab_start_date_placeholder; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                <?php echo $lab_end_date_heading; ?> :
                                                <i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_manage_ip_addresses_end_date_tooltip; ?>" data-placement="right"></i>
                                                <span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span>
                                            </label>
                                            <input type="text" class="form-control" name="ux_txt_end_date" value="<?php echo date("m/d/Y"); ?>" id="ux_txt_end_date" onkeypress="prevent_data_limit_attempts_booster(event)" value="" placeholder="<?php echo $lab_end_date_placeholder; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="pull-right">
                                        <input type="submit" class="btn vivid-green" name="ux_btn_ip_adresses" id="ux_btn_ip_adresses" value="<?php echo $lab_submit; ?>">
                                    </div>
                                </div>
                                <div class="line-separator"></div>
                                <div class="table-top-margin">
                                    <select name="ux_ddl_manage_ip_addesses" id="ux_ddl_manage_ip_addesses" class="custom-bulk-width">
                                        <option value=""><?php echo $lab_bulk_action; ?></option>
                                        <option value="delete" style="color:red;"><?php echo $lab_delete; ?><span> <?php echo " ( " . $lab_premium_editions_label . " ) " ?></span></option>
                                    </select>
                                    <input type="button" class="btn vivid-green" name="ux_btn_apply" id="ux_btn_apply" value=<?php echo $lab_apply; ?> onclick="premium_edition_notification_limit_attempts_booster();">
                                </div>
                                <table class="table table-striped table-bordered table-hover table-margin-top" id="ux_tbl_manage_ip_addresses">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;width: 5%;" class="chk-action">
                                                <input type="checkbox" name="ux_chk_all_manage_ip_address" id="ux_chk_all_manage_ip_address">
                                            </th>
                                            <th>
                                                <label class="control-label">
                                                    <?php echo $lab_ip_address; ?>
                                                </label>
                                            </th>
                                            <th>
                                                <label class="control-label">
                                                    <?php echo $lab_location; ?>
                                                </label>
                                            </th>
                                            <th style="width:20%;">
                                                <label class="control-label">
                                                    <?php echo $lab_blocked_date_time; ?>
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
                                            <th style="text-align:center;width: 7%;" class="chk-action">
                                                <label class="control-label">
                                                    <?php echo $lab_action; ?>
                                                </label>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_table_filter">
                                        <?php
                                        foreach ($manage_ip_address as $row) {
                                            ?>
                                            <tr>
                                                <td style="text-align: center;width: 5%;">
                                                    <input type="checkbox" onclick="check_all_limit_attempts_booster('#ux_chk_all_manage_ip_address');" name="ux_chk_manage_ip_address_<?php echo intval($row["meta_id"]); ?>" id="ux_chk_manage_ip_address_<?php echo intval($row["meta_id"]); ?>" value="<?php echo intval($row["meta_id"]); ?>">
                                                </td>
                                                <td>
                                                    <label>
                                                        <?php echo long2ip($row["ip_address"]); ?>
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
                                                <td class="custom-alternative"  style="width: 10%;">
                                                    <a href="javascript:void(0);">
                                                        <i class="icon-custom-trash tooltips" data-original-title="<?php echo $lab_delete; ?>"  onclick="delete_ip_address_limit_attempts_booster(<?php echo intval($row["meta_id"]); ?>)" data-placement="right"></i>
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
                        <?php echo $lab_manage_ip_addresses_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-globe"></i>
                            <?php echo $lab_manage_ip_addresses_menu; ?>
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