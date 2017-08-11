<?php
/**
 * Template for display core cron jobs.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/cron-jobs
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
    } else if (cron_jobs_limit_attempts_booster == "1") {
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
                    <a href="admin.php?page=lab_custom_cron_jobs">
                        <?php echo $lab_cron_jobs; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $lab_core_cron_jobs_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-folder"></i>
                            <?php echo $lab_core_cron_jobs_menu; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_core_cron_jobs">
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
                                <table class="table table-striped table-bordered table-hover" id="ux_tbl_data_table_core_cron">
                                    <thead>
                                    <th scope="col" style="width:20%;">
                                        <?php echo $lab_cron_jobs_name_of_hook; ?>
                                    </th>
                                    <th scope="col" style="width:20%;">
                                        <?php echo $lab_cron_jobs_Interval_hook; ?>
                                    </th>
                                    <th scope="col" style="width:20%;">
                                        <?php echo $lab_cron_jobs_args; ?>
                                    </th>
                                    <th scope="col" style="width:20%;">
                                        <?php echo $lab_cron_jobs_next_execution; ?>
                                    </th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($get_schedulers as $time => $time_cron_array) {
                                            foreach ($time_cron_array as $hook => $data) {
                                                if (in_array($hook, $core_cron_hooks)) {
                                                    $times_class = LIMIT_ATTEMPTS_BOOSTER_LOCAL_TIME > $time;
                                                    ?>
                                                    <tr>

                                                        <td>
                                                            <?php echo wp_strip_all_tags($hook) ?>
                                                        </td>
                                                        <?php
                                                        foreach ($data as $hash => $info) {
                                                            ?>
                                                            <td>
                                                                <?php
                                                                if ($info["schedule"] == "") {
                                                                    echo "Single Event";
                                                                } else {
                                                                    if (array_key_exists($info["schedule"], $schedule_details)) {
                                                                        echo $schedule_details[$info["schedule"]]["display"];
                                                                    } else {
                                                                        echo $info["schedule"];
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                if (is_array($info["args"]) && !empty($info["args"])) {
                                                                    foreach ($info["args"] as $key => $value) {
                                                                        display_cron_arguments_limit_attempts_booster($key, $value);
                                                                    }
                                                                } else if (is_string($info["args"]) && $info["args"] !== "") {
                                                                    echo esc_html($info["args"]);
                                                                } else {
                                                                    echo "No Args";
                                                                }
                                                                ?>
                                                            </td>
                                                            <td <?php echo $times_class ?>>
                                                                <label style="display:none;"><?php echo $time; ?></label>
                                                                <?php
                                                                $current_offset = get_option('gmt_offset') * 60 * 60;
                                                                echo date_i18n("d M, Y g:i A e", $time + $current_offset) . "<br />" . "<b>In About " . human_time_diff($time) . "</b>"
                                                                ?>
                                                            </td>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
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
                    <a href="admin.php?page=lab_custom_cron_jobs">
                        <?php echo $lab_cron_jobs; ?>
                    </a>
                    <span>></span>
                </li>
                <li>
                    <span>
                        <?php echo $lab_core_cron_jobs_menu; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-folder"></i>
                            <?php echo $lab_core_cron_jobs_menu; ?>
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