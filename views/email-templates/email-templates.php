<?php
/**
* Template for email templates settings.
*
* @author  tech-banker
* @package limit-attempts-booster/views/email-templates
* @version 2.0.0
*/
if(!defined("ABSPATH")) { exit();}
if(!is_user_logged_in())
{
	return;
}
else
{
	$access_granted = false;
	foreach($user_role_permission as $permission)
	{
		if(current_user_can($permission))
		{
			$access_granted = true;
			break;
		}
	}
	if(!$access_granted)
	{
		return;
	}
	else if(email_templates_limit_attempts_booster == "1")
	{
		$limit_attempts_email_template_data = wp_create_nonce("limit_attempts_email_template_data");
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
						<?php echo $lab_email_templates_menu; ?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-link"></i>
							<?php echo $lab_email_templates_menu; ?>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="ux_frm_email_templates">
							<div class="form-body">
								<?php
								if($lab_message_translate_help != "")
								{
									?>
									<div class="note note-danger">
										<h4 class="block">
											<?php echo $lab_important_disclaimer; ?>
										</h4>
										<strong><?php echo $lab_message_translate_help;?><br/><?php echo $lab_kindly_click;?><a href="javascript:void(0);" data-popup-open="ux_open_popup_translator" class="custom_links" onclick="show_pop_up_limit_attempts_booster();"><?php echo $lab_message_translate_here; ?></a></strong>
									</div>
									<?php
								}
								?>
								<div class="form-group">
									<label class="control-label">
										<?php echo $lab_choose_email_template;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_choose_email_template_tooltip;?>" data-placement="right"></i>
									</label>
									<span style="color:#e02222;"><?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
									<select name="ux_ddl_user_success" id="ux_ddl_user_success" class="form-control" onchange="template_change_data_limit_attempts_booster();">
										<option value="template_for_user_success"><?php echo $lab_email_template_for_user_success;?></option>
										<option value="template_for_user_failure"><?php echo $lab_email_template_for_user_failure;?></option>
										<option value="template_for_ip_address_blocked"><?php echo $lab_email_template_for_ip_address_blocked;?></option>
										<option value="template_for_ip_address_unblocked"><?php echo $lab_email_template_for_ip_address_unblocked;?></option>
										<option value="template_for_ip_range_blocked"><?php echo $lab_email_template_for_ip_range_blocked;?></option>
										<option value="template_for_ip_range_unblocked"><?php echo $lab_email_template_for_ip_range_unblocked;?></option>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $lab_email_template_send_to;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_email_template_send_to_tooltip;?>" data-placement="right"></i>
										<span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
									</label>
									<input type="text" class="form-control" name="ux_txt_send_to" id="ux_txt_send_to" placeholder="<?php echo $lab_email_template_send_to_placeholder;?>">
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $lab_email_template_cc;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_email_template_cc_tooltip;?>" data-placement="right"></i>
											</label>
											<span style="color:#e02222;"><?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
											<input type="text" class="form-control" name="ux_txt_cc" id="ux_txt_cc" placeholder="<?php echo $lab_email_template_cc_placeholder;?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">
												<?php echo $lab_email_template_bcc;?> :
												<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_email_template_bcc_tooltip;?>" data-placement="right"></i>
											</label>
											<span style="color:#e02222;"><?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
											<input type="text" class="form-control" name="ux_txt_bcc" id="ux_txt_bcc" placeholder="<?php echo $lab_email_template_bcc_placeholder;?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $lab_subject;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_email_template_subject_tooltip;?>" data-placement="right"></i>
										<span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
									</label>
									<input type="text" class="form-control" name="ux_txt_subject" id="ux_txt_subject" placeholder="<?php echo $lab_email_template_subject_placeholder;?>">
								</div>
								<div class="form-group">
									<label class="control-label">
										<?php echo $lab_email_template_message;?> :
										<i class="icon-custom-question tooltips" data-original-title="<?php echo $lab_email_template_message_tooltip;?>" data-placement="right"></i>
										<span class="required" aria-required="true">* <?php echo " ( " . $lab_premium_editions_label." ) ";?></span>
									</label>
									<?php
										$distribution = "";
										wp_editor( $distribution, $id ="ux_heading_content", array("media_buttons" => false, "textarea_rows" => 8, "tabindex" => 4 ) );
									?>
								</div>
								<div class="line-separator"></div>
								<div class="form-actions">
									<div class="pull-right">
											<input type="hidden" id="ux_email_template_meta_id"/>
										<input type="submit" class="btn vivid-green" name="ux_btn_email_change" id="ux_btn_email_change" value="<?php echo $lab_save_changes;?>">
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
	else
	{
		?>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<i class="icon-custom-home"></i>
					<a href="admin.php?page=lab_limit_attempts_booster">
						<?php echo $limit_attempts_booster;?>
					</a>
					<span>></span>
				</li>
				<li>
					<span>
						<?php echo $lab_email_templates_menu;?>
					</span>
				</li>
			</ul>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box vivid-green">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-custom-link"></i>
							<?php echo $lab_email_templates_menu;?>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<strong><?php echo $lab_user_access_message;?></strong>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}