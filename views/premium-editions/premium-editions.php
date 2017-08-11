<?php
/**
 * This Template is used for displaying Premium Editions.
 *
 * @author tech-banker
 * @package limit_attempts_booster/views/premium-editions
 * @version 2.0.0
 */
if (!defined("ABSPATH")) {
    exit;
} // exit if accessed directly
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
                    <span>
                        <?php echo $lab_upgrade; ?>
                    </span>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box vivid-green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-custom-briefcase"></i>
        <?php echo $lab_upgrade; ?>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form id="ux_frm_premium_editions">
                            <div class="form-body">
                                <div class="wpb_wrapper">
                                    <div id="go-pricing-table-862" style="margin-bottom:20px;">
                                        <div class="gw-go gw-go-clearfix gw-go-enlarge-current gw-go-disable-box-shadow gw-go-3cols" data-id="862" data-colnum="3" data-equalize="{&quot;column&quot;:1,&quot;body&quot;:1,&quot;footer&quot;:1}" data-views="{&quot;tp&quot;:{&quot;min&quot;:&quot;768&quot;,&quot;max&quot;:&quot;959&quot;,&quot;cols&quot;:&quot;&quot;},&quot;ml&quot;:{&quot;min&quot;:&quot;480&quot;,&quot;max&quot;:&quot;767&quot;,&quot;cols&quot;:&quot;2&quot;},&quot;mp&quot;:{&quot;min&quot;:&quot;&quot;,&quot;max&quot;:&quot;479&quot;,&quot;cols&quot;:&quot;1&quot;}}" style="opacity: 1;">
                                            <div class="gw-go-col-wrap gw-go-col-wrap-0 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="0" style="height: 1500px;">
                                                <div class="gw-go-col gw-go-clean-style14">
                                                    <div class="gw-go-col-inner">
                                                        <div class="gw-go-col-inner-layer"></div>
                                                        <div class="gw-go-col-inner-layer-over"></div>
                                                        <div class="gw-go-header"></div>
                                                        <ul class="gw-go-body">
                                                            <li data-row-index="0">
                                                                <div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>PERSONAL</span>
                                                                    <br>Ideal for Individuals
                                                                </div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="1">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li data-row-index="2">
                                                                <div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">12<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="3">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 Installation per License</strong></div>
                                                            </li>
                                                            <li data-row-index="4">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 week of Technical Support</strong></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="5">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 year of Free Updates</strong></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="6">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Automatic Plugin Updates</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="7">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="8">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="9">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Maximum Login Attempts</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="10">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Auto IP Address Block/Unblock</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="11">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="12">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="13">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="14">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="15">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Messages Settings</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="16">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Notifications</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="17">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Alert Setup Settings</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="18">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Templates</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="19">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Login Logs Information</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="20">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Live Traffic Information</div>
                                                            </li>
                                                            <li data-row-index="21">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Visitor Logs Information</div>
                                                            </li>
                                                            <li data-row-index="22">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Manage Trackbacks & Comments</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="23">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Core Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="24">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Custom Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="25">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Logs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="26">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Roles and Capabilities</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="27">
                                                                <div class="gw-go-body-cell" style="height: 16px;">System Information</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="28">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="29">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="30">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="31">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                        </ul>
                                                        <div class="gw-go-footer-wrap">
                                                            <div class="gw-go-footer-spacer"></div>
                                                            <div class="gw-go-footer">
                                                                <div class="gw-go-footer-rows">
                                                                    <div class="gw-go-footer-row" data-row-index="0">
                                                                        <div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/limit-attempts-booster-personal-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row gw-go-even" data-row-index="1">
                                                                        <div class="gw-go-footer-row-inner" style="height: 0px;"></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row" data-row-index="2">
                                                                        <div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gw-go-tooltip"></div>
                                                </div>
                                            </div>
                                            <div class="gw-go-col-wrap gw-go-col-wrap-1 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="1" style="height: 687px;">
                                                <div class="gw-go-col gw-go-clean-style14">
                                                    <div class="gw-go-col-inner">
                                                        <div class="gw-go-col-inner-layer"></div>
                                                        <div class="gw-go-col-inner-layer-over"></div>
                                                        <div class="gw-go-ribbon-right"><img src="<?php echo plugins_url("assets/global/img/ribbon_green_right_top.png", dirname(dirname(__FILE__))); ?>"></div>
                                                        <div class="gw-go-header"></div>
                                                        <ul class="gw-go-body">
                                                            <li data-row-index="0">
                                                                <div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>BUSINESS</span>
                                                                    <br>Ideal for Businesses
                                                                </div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="1">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li data-row-index="2">
                                                                <div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">19<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="3">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 Installation per License</strong></div>
                                                            </li>
                                                            <li data-row-index="4">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 month of Technical Support</strong></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="5">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>1 year of Free Updates</strong></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="6">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Automatic Plugin Updates</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="7">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="8">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="9">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Maximum Login Attempts</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="10">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Auto IP Address Block/Unblock</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="11">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="12">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Addresses</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="13">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="14">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Ranges</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="15">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Messages Settings</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="16">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Notifications</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="17">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Alert Setup Settings</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="18">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Templates</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="19">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Login Logs Information</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="20">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Live Traffic Information</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="21">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Visitor Logs Information</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="22">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Manage Trackbacks & Comments</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="23">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Core Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="24">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Custom Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="25">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Logs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="26">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Roles and Capabilities</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="27">
                                                                <div class="gw-go-body-cell" style="height: 16px;">System Information</div>
                                                            </li>
                                                            <li data-row-index="28">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="29">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Deleting Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="30">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block/Unblock Countries</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="31">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Bulk Deletion Records</div>
                                                            </li>
                                                        </ul>
                                                        <div class="gw-go-footer-wrap">
                                                            <div class="gw-go-footer-spacer"></div>
                                                            <div class="gw-go-footer">
                                                                <div class="gw-go-footer-rows">
                                                                    <div class="gw-go-footer-row" data-row-index="0">
                                                                        <div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/limit-attempts-booster-business-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row gw-go-even" data-row-index="1">
                                                                        <div class="gw-go-footer-row-inner" style="height: 0px;"></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row" data-row-index="2">
                                                                        <div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gw-go-tooltip"></div>
                                                </div>
                                            </div>
                                            <div class="gw-go-col-wrap gw-go-col-wrap-2 gw-go-hover gw-go-disable-enlarge gw-go-disable-hover" data-current="1" data-col-index="2" style="height: 687px;">
                                                <div class="gw-go-col gw-go-clean-style14">
                                                    <div class="gw-go-col-inner">
                                                        <div class="gw-go-col-inner-layer"></div>
                                                        <div class="gw-go-col-inner-layer-over"></div>
                                                        <div class="gw-go-header"></div>
                                                        <ul class="gw-go-body">
                                                            <li data-row-index="0">
                                                                <div class="gw-go-body-cell" style="height: 79px;"><span style="font-size:20px;"><br>DEVELOPER</span>
                                                                    <br>Ideal for Webmasters
                                                                </div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="1">
                                                                <div class="gw-go-body-cell" style="height: 16px;">____</div>
                                                            </li>
                                                            <li data-row-index="2">
                                                                <div class="gw-go-body-cell" style="height: 75px;"><span style="color:#A4CD39;">$</span><span style="font-size:52px;color:#A4CD39;">82<br></span><span style="color:#A4CD39;">It's a one time purchase.</span></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="3">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>5 Installations per License</strong></div>
                                                            </li>
                                                            <li data-row-index="4">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>6 months of Technical Support</strong></div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="5">
                                                                <div class="gw-go-body-cell" style="height: 16px;"><strong>Life Time Free Updates</strong></div>
                                                            </li>
                                                            <li data-row-index="6">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Automatic Plugin Updates</div>
                                                            </li>
                                                            <li data-row-index="7">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Addresses</div>
                                                            </li>
                                                            <li data-row-index="8">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Blocked IP Ranges</div>
                                                            </li>
                                                            <li data-row-index="9">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Maximum Login Attempts</div>
                                                            </li>
                                                            <li data-row-index="10">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Auto IP Address Block/Unblock</div>
                                                            </li>
                                                            <li data-row-index="11">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Addresses</div>
                                                            </li>
                                                            <li data-row-index="12">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Addresses</div>
                                                            </li>
                                                            <li data-row-index="13">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block IP Ranges</div>
                                                            </li>
                                                            <li data-row-index="14">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Unblock IP Ranges</div>
                                                            </li>
                                                            <li data-row-index="15">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Messages Settings</div>
                                                            </li>
                                                            <li data-row-index="16">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Notifications</div>
                                                            </li>
                                                            <li data-row-index="17">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Alert Setup Settings</div>
                                                            </li>
                                                            <li data-row-index="18">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Email Templates</div>
                                                            </li>
                                                            <li data-row-index="19">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Login Logs Information</div>
                                                            </li>
                                                            <li data-row-index="20">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Live Traffic Information</div>
                                                            </li>
                                                            <li data-row-index="21">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Visitor Logs Information</div>
                                                            </li>
                                                            <li data-row-index="22">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Manage Trackbacks & Comments</div>
                                                            </li>
                                                            <li data-row-index="23">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Core Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="24">
                                                                <div class="gw-go-body-cell" style="height: 16px;">View Custom Cron Jobs</div>
                                                            </li>
                                                            <li class="gw-go-even" data-row-index="25">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Error Logs</div>
                                                            </li>
                                                            <li data-row-index="26">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Roles and Capabilities</div>
                                                            </li>
                                                            <li data-row-index="27">
                                                                <div class="gw-go-body-cell" style="height: 16px;">System Information</div>
                                                            </li>
                                                            <li data-row-index="28">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Multisite Compatible</div>
                                                            </li>
                                                            <li data-row-index="29">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Deleting Cron Jobs</div>
                                                            </li>
                                                            <li data-row-index="30">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Block/Unblock Countries</div>
                                                            </li>
                                                            <li data-row-index="31">
                                                                <div class="gw-go-body-cell" style="height: 16px;">Bulk Deletion Records</div>
                                                            </li>
                                                        </ul>
                                                        <div class="gw-go-footer-wrap">
                                                            <div class="gw-go-footer-spacer"></div>
                                                            <div class="gw-go-footer">
                                                                <div class="gw-go-footer-rows">
                                                                    <div class="gw-go-footer-row" data-row-index="0">
                                                                        <div class="gw-go-footer-row-inner" style="height: 44px;"><a href="http://beta.tech-banker.com/product/limit-attempts-booster-developer-edition/" class="gw-go-btn gw-go-btn-large"><span class="gw-go-btn-inner">BUY NOW</span></a></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row gw-go-even" data-row-index="1">
                                                                        <div class="gw-go-footer-row-inner" style="height: 0px;"></div>
                                                                    </div>
                                                                    <div class="gw-go-footer-row" data-row-index="2">
                                                                        <div class="gw-go-footer-row-inner" style="height: 10px;">&nbsp;</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}