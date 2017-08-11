<?php

/**
 * This file is contain variables.
 *
 * @author  tech-banker
 * @package limit-attempts-booster/includes
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
    } else {
        $wp_langs = array();
        $wp_langs["af"] = "Afrikaans";
        $wp_langs["ak"] = "Akan";
        $wp_langs["sq"] = "Shqip";
        $wp_langs["arq"] = "الدارجة الجزايرية";
        $wp_langs["am"] = "አማርኛ";
        $wp_langs["ar"] = "العربية";
        $wp_langs["hy"] = "Հայերեն";
        $wp_langs["rup_mk"] = "Armãneashce";
        $wp_langs["frp"] = "Arpitan";
        $wp_langs["as"] = "অসমীয়া";
        $wp_langs["ast"] = "Asturianu";
        $wp_langs["az"] = "Azərbaycan dili";
        $wp_langs["az_tr"] = "Azərbaycan Türkcəsi";
        $wp_langs["bcc"] = "بلوچی مکرانی";
        $wp_langs["ba"] = "башҡорт теле";
        $wp_langs["eu"] = "Euskara";
        $wp_langs["bel"] = "Беларуская мова";
        $wp_langs["bn_bd"] = "বাংলা";
        $wp_langs["bs_ba"] = "Bosanski";
        $wp_langs["bre"] = "Brezhoneg";
        $wp_langs["bg_bg"] = "Български";
        $wp_langs["ca"] = "Català";
        $wp_langs["bal"] = "Català (Balear)";
        $wp_langs["ceb"] = "Cebuano";
        $wp_langs["zh_cn"] = "简体中文";
        $wp_langs["zh_hk"] = "香港中文版 ";
        $wp_langs["zh_tw"] = "繁體中文";
        $wp_langs["co"] = "Corsu";
        $wp_langs["hr"] = "Hrvatski";
        $wp_langs["cs_cz"] = "Čeština‎";
        $wp_langs["da_dk"] = "Dansk";
        $wp_langs["dv"] = "ދިވެހި";
        $wp_langs["nl_nl"] = "Nederlands";
        $wp_langs["nl_be"] = "Nederlands (België)";
        $wp_langs["dzo"] = "རྫོང་ཁ";
        $wp_langs["en_au"] = "English (Australia)";
        $wp_langs["en_ca"] = "English (Canada)";
        $wp_langs["en_nz"] = "English (New Zealand)";
        $wp_langs["en_za"] = "English (South Africa)";
        $wp_langs["eo"] = "Esperanto";
        $wp_langs["et"] = "Eesti";
        $wp_langs["fo"] = "Føroyskt";
        $wp_langs["fi"] = "Suomi";
        $wp_langs["fr_be"] = "Français de Belgique";
        $wp_langs["fr_ca"] = "Français du Canada";
        $wp_langs["fr_fr"] = "Français";
        $wp_langs["fy"] = "Frysk";
        $wp_langs["fur"] = "Friulian";
        $wp_langs["fuc"] = "Pulaar";
        $wp_langs["gl_es"] = "Galego";
        $wp_langs["ka_ge"] = "ქართული";
        $wp_langs["de_de"] = "Deutsch";
        $wp_langs["de_ch"] = "Deutsch (Schweiz)";
        $wp_langs["el"] = "Ελληνικά";
        $wp_langs["kal"] = "Kalaallisut";
        $wp_langs["gn"] = "Avañe'ẽ";
        $wp_langs["gu"] = "ગુજરાતી";
        $wp_langs["hat"] = "Kreyol ayisyen";
        $wp_langs["haw_us"] = "Ōlelo Hawaiʻi";
        $wp_langs["haz"] = "هزاره گی";
        $wp_langs["he_il"] = "עִבְרִית";
        $wp_langs["hi_in"] = "हिन्दी";
        $wp_langs["hu_hu"] = "Magyar";
        $wp_langs["is_is"] = "Íslenska";
        $wp_langs["ido"] = "Ido";
        $wp_langs["id_id"] = "Bahasa Indonesia";
        $wp_langs["ga"] = "Gaelige";
        $wp_langs["it_it"] = "Italiano";
        $wp_langs["ja"] = "日本語";
        $wp_langs["jv_id"] = "Basa Jawa";
        $wp_langs["kab"] = "Taqbaylit";
        $wp_langs["kn"] = "ಕನ್ನಡ";
        $wp_langs["kk"] = "Қазақ тілі";
        $wp_langs["km"] = "ភាសាខ្មែរ";
        $wp_langs["kin"] = "Ikinyarwanda";
        $wp_langs["ky_ky"] = "кыргыз тили";
        $wp_langs["ko_kr"] = "한국어";
        $wp_langs["ckb"] = "كوردی‎";
        $wp_langs["lo"] = "ພາສາລາວ";
        $wp_langs["lv"] = "Latviešu valoda";
        $wp_langs["li"] = "Limburgs";
        $wp_langs["lin"] = "Ngala";
        $wp_langs["lt_lt"] = "Lietuvių kalba";
        $wp_langs["lb_lu"] = "Lëtzebuergesch";
        $wp_langs["mk_mk"] = "Македонски јазик";
        $wp_langs["mg_mg"] = "Malagasy";
        $wp_langs["ms_my"] = "Bahasa Melayu";
        $wp_langs["ml_in"] = "മലയാളം";
        $wp_langs["mri"] = "Te Reo Māori";
        $wp_langs["mr"] = "मराठी";
        $wp_langs["xmf"] = "მარგალური ნინა";
        $wp_langs["mn"] = "Монгол";
        $wp_langs["me_me"] = "Crnogorski jezik";
        $wp_langs["ary"] = "العربية المغربية";
        $wp_langs["my_mm"] = "ဗမာစာ";
        $wp_langs["ne_np"] = "नेपाली";
        $wp_langs["nb_no"] = "Norsk bokmål";
        $wp_langs["nn_no"] = "Norsk nynorsk";
        $wp_langs["oci"] = "Occitan";
        $wp_langs["ory"] = "ଓଡ଼ିଆ";
        $wp_langs["os"] = "Ирон";
        $wp_langs["ps"] = "پښتو";
        $wp_langs["fa_ir"] = "فارسی";
        $wp_langs["fa_af"] = "(فارسی (افغانستان";
        $wp_langs["pl_pl"] = "Polski";
        $wp_langs["pt_br"] = "Português do Brasil";
        $wp_langs["pt_pt"] = "Português";
        $wp_langs["pa_in"] = "ਪੰਜਾਬੀ";
        $wp_langs["rhg"] = "Ruáinga";
        $wp_langs["ro_ro"] = "Română";
        $wp_langs["roh"] = "Rumantsch Vallader";
        $wp_langs["ru_ru"] = "Русский";
        $wp_langs["rue"] = "Русиньскый";
        $wp_langs["sah"] = "Сахалыы";
        $wp_langs["sa_in"] = "भारतम्";
        $wp_langs["srd"] = "Sardu";
        $wp_langs["gd"] = "Gàidhlig";
        $wp_langs["sr_rs"] = "Српски језик";
        $wp_langs["szl"] = "Ślōnskŏ gŏdka";
        $wp_langs["snd"] = "سنڌي";
        $wp_langs["si_lk"] = "සිංහල";
        $wp_langs["sk_sk"] = "Slovenčina";
        $wp_langs["sl_si"] = "Slovenščina";
        $wp_langs["so_so"] = "Afsoomaali";
        $wp_langs["azb"] = "گؤنئی آذربایجان";
        $wp_langs["es_ar"] = "Español de Argentina";
        $wp_langs["es_cl"] = "Español de Chile";
        $wp_langs["es_co"] = "Español de Colombia";
        $wp_langs["es_gt"] = "Español de Guatemala";
        $wp_langs["es_mx"] = "Español de México";
        $wp_langs["es_pe"] = "Español de Perú";
        $wp_langs["es_pr"] = "Español de Puerto Rico";
        $wp_langs["es_es"] = "Español";
        $wp_langs["es_ve"] = "Español de Venezuela";
        $wp_langs["su_id"] = "Basa Sunda";
        $wp_langs["sw"] = "Kiswahili";
        $wp_langs["sv_se"] = "Svenska";
        $wp_langs["gsw"] = "Schwyzerdütsch";
        $wp_langs["tl"] = "Tagalog";
        $wp_langs["tah"] = "Reo Tahiti";
        $wp_langs["tg"] = "Тоҷикӣ";
        $wp_langs["tzm"] = "ⵜⴰⵎⴰⵣⵉⵖⵜ";
        $wp_langs["ta_in"] = "தமிழ்";
        $wp_langs["ta_lk"] = "தமிழ்";
        $wp_langs["tt_ru"] = "Татар теле";
        $wp_langs["te"] = "తెలుగు";
        $wp_langs["th"] = "ไทย";
        $wp_langs["bo"] = "བོད་སྐད";
        $wp_langs["tir"] = "ትግርኛ";
        $wp_langs["tr_tr"] = "Türkçe";
        $wp_langs["tuk"] = "Türkmençe";
        $wp_langs["twd"] = "Twents";
        $wp_langs["ug_cn"] = "Uyƣurqə";
        $wp_langs["uk"] = "Українська";
        $wp_langs["ur"] = "اردو";
        $wp_langs["uz_uz"] = "O‘zbekcha";
        $wp_langs["vi"] = "Tiếng Việt";
        $wp_langs["wa"] = "Walon";
        $wp_langs["cy"] = "Cymraeg";
        $wp_langs["yor"] = "Yorùbá";
        $locale = strtolower(get_locale());
        if (array_key_exists("$locale", $wp_langs)) {
            $language = $wp_langs["$locale"];
            $lab_message_translate_help = __("If you would like to translate in $language & help us, we will reward you with a free Personal Edition License of Limit Attempts Booster.", "limit-attempts-booster");
            $lab_kindly_click = __("If Interested, Kindly click ", "limit-attempts-booster");
            $lab_message_translate_here = __("here.", "limit-attempts-booster");
        } else {
            $lab_message_translate_help = "";
            $lab_kindly_click = "";
            $lab_message_translate_here = "";
        }
        //Footer
        $lab_language_interested_to_translate = __("Language Interested to Translate", "limit-attempts-booster");
        $lab_language_interested_to_translate_tooltip = __("Please enter the language you want to translate.", "limit-attempts-booster");
        $lab_language_interested_to_translate_placeholder = __("Please enter the language", "limit-attempts-booster");
        $lab_popup_query = __("Query", "limit-attempts-booster");
        $lab_popup_query_tooltip = __("Please enter your query.", "limit-attempts-booster");
        $lab_popup_query_placeholder = __("Please enter the query.", "limit-attempts-booster");
        $lab_popup_your_name_tooltip = __("In this field, you would need to provide your name which will be sent along with your request", "limit-attempts-booster");
        $lab_popup_your_email_tooltip = __("In this field, you would need to provide your valid email which will be sent along with your request", "limit-attempts-booster");
        $lab_language_interested_to_translate = __("Language Interested to Translate", "limit-attempts-booster");
        $lab_language_interested_to_translate_tooltip = __("Please enter the language you want to translate.", "limit-attempts-booster");
        $lab_language_interested_to_translate_placeholder = __("Please enter the language", "limit-attempts-booster");
        $lab_close = __("Close", "limit-attempts-booster");
        $lab_important_disclaimer = __("Important Disclaimer!", "limit-attempts-booster");
        $lab_confirm_close = __("Are you sure you want to close without sending Translation Request?", "limit-attempts-booster");
        $lab_translation_request = __("Translation Request", "limit-attempts-booster");
        $lab_success = __("Success!", "limit-attempts-booster");
        $lab_update_blocking_options = __("Blocking Options have been saved Successfully", "limit-attempts-booster");
        $lab_advance_security_manage_ip_address = __("IP Address has been blocked Successfully", "limit-attempts-booster");
        $lab_advance_security_manage_ip_ranges = __("IP Range has been blocked Successfully", "limit-attempts-booster");
        $lab_delete_blocked_ip_address = __("IP Address has been deleted Successfully", "limit-attempts-booster");
        $lab_delete_blocked_ip_range = __("IP Range has been deleted Successfully", "limit-attempts-booster");
        $lab_update_other_settings = __("Other Settings have been saved Successfully", "limit-attempts-booster");
        $lab_feature_request = __("Your request email has been sent Successfully", "limit-attempts-booster");
        $lab_ip_address = __("IP Address", "limit-attempts-booster");
        $lab_location = __("Location", "limit-attempts-booster");
        $lab_latitude = __("Latitude", "limit-attempts-booster");
        $lab_longitude = __("Longitude", "limit-attempts-booster");
        $lab_http_user_agent = __("HTTP User Agent", "limit-attempts-booster");
        $lab_na = __("N/A", "limit-attempts-booster");
        $lab_confirm_delete = __("Are you sure you want to delete?", "limit-attempts-booster");
        $lab_valid_ip_address = __("Please provide valid IP Address", "limit-attempts-booster");
        $lab_valid_ip_range = __("Please provide valid IP Range", "limit-attempts-booster");
        $lab_error_message_notification = __("Error Message", "limit-attempts-booster");
        $lab_ip_address_already_blocked = __("This IP Address has been already blocked!", "limit-attempts-booster");
        $lab_ip_range_already_blocked = __("This IP Range has been already blocked!", "limit-attempts-booster");
        $lab_notification = __("Notification!", "limit-attempts-booster");
        $lab_bulk_block = __("Block", "limit-attempts-booster");
        $message_premium_edition = __("This feature is available only in Premium Editions! <br> Kindly Purchase to unlock it!", "limit-attempts-booster");
        $lab_delete_login_logs = __("A Login Log has been deleted Successfully", "limit-attempts-booster");
        $lab_delete_visitor_logs = __("A Visitor Log has been deleted Successfully", "limit-attempts-booster");
        $lab_delete_traffic_logs = __("A Traffic Log has been deleted Successfully", "limit-attempts-booster");

        //Common Variables
        $lab_premium_editions_label = __("Premium Edition", "limit-attempts-booster");
        $limit_attempts_booster = __("Limit Attempts Booster", "limit-attempts-booster");
        $lab_limit_attempts = __("Limit Attempts", "limit-attempts-booster");
        $lab_bulk_action = __("Bulk Action", "limit-attempts-booster");
        $lab_delete = __("Delete", "limit-attempts-booster");
        $lab_apply = __("Apply", "limit-attempts-booster");
        $lab_user_name = __("User Name", "limit-attempts-booster");
        $lab_date_time = __("Date & Time", "limit-attempts-booster");
        $lab_status = __("Status", "limit-attempts-booster");
        $lab_details = __("Details", "limit-attempts-booster");
        $lab_resources = __("Resources", "limit-attempts-booster");
        $lab_block_ip_address = __("Block IP Address", "limit-attempts-booster");
        $lab_blocked_date_time = __("Blocked Date & Time", "limit-attempts-booster");
        $lab_release_date_time = __("Release Date & Time", "limit-attempts-booster");
        $lab_action = __("Action", "limit-attempts-booster");
        $lab_ip_ranges = __("IP Ranges", "limit-attempts-booster");
        $lab_live_traffic_on_world_map = __("Live Traffic On World Map", "limit-attempts-booster");
        $lab_visitor_logs_on_world_map = __("Visitor Logs On World Map", "limit-attempts-booster");
        $lab_start_date_heading = __("Start Date", "limit-attempts-booster");
        $lab_start_date_placeholder = __("Please choose Start Date", "limit-attempts-booster");
        $lab_end_date_heading = __("End Date", "limit-attempts-booster");
        $lab_end_date_placeholder = __("Please choose End Date", "limit-attempts-booster");
        $lab_submit = __("Submit", "limit-attempts-booster");
        $lab_save_changes = __("Save Changes", "limit-attempts-booster");
        $lab_enable = __("Enable", "limit-attempts-booster");
        $lab_disable = __("Disable", "limit-attempts-booster");
        $lab_comments = __("Comments", "limit-attempts-booster");
        $lab_user_access_message = __("You don't have Sufficient Access to this Page. Kindly contact the Administrator for more Privileges", "limit-attempts-booster");
        $lab_comments_placeholder = __("Please provide Comments", "limit-attempts-booster");
        $lab_clear = __("Clear", "limit-attempts-booster");
        $lab_blocked_for = __("Blocked For", "limit-attempts-booster");
        $lab_blocked_for_tooltip = __("In this field, you would need to choose a time duration for which you would like to block an IP Address so that particular IP Address will be blocked for a fixed time interval", "limit-attempts-booster");
        $lab_one_hour = __("1 Hour", "limit-attempts-booster");
        $lab_twelve_hours = __("12 Hours", "limit-attempts-booster");
        $lab_twenty_four_hours = __("24 Hours", "limit-attempts-booster");
        $lab_forty_eight_hours = __("48 Hours", "limit-attempts-booster");
        $lab_one_week = __("1 Week", "limit-attempts-booster");
        $lab_one_month = __("1 Month", "limit-attempts-booster");
        $lab_permanently = __("Permanently", "limit-attempts-booster");
        $lab_subject = __("Subject", "limit-attempts-booster");
        $lab_never = __("Never", "limit-attempts-booster");
        $lab_upgrade = __("Upgrade", "limit-attempts-booster");

        //Admin Bar Menu
        $lab_dashboard = __("Dashboard", "limit-attempts-booster");
        $lab_logs = __("Logs", "limit-attempts-booster");
        $lab_advance_security = __("Advance Security", "limit-attempts-booster");
        $lab_general_settings = __("General Settings", "limit-attempts-booster");
        $lab_email_templates_menu = __("Email Templates", "limit-attempts-booster");
        $lab_roles_and_capability = __("Roles & Capabilities", "limit-attempts-booster");
        $lab_cron_jobs = __("Cron Jobs", "limit-attempts-booster");
        $lab_feature_requests = __("Feature Requests", "limit-attempts-booster");
        $lab_system_information = __("System Information", "limit-attempts-booster");
        $lab_error_logs = __("Error Logs", "limit-attempts-booster");

        //Sidebar Menu
        $lab_live_traffic_menu = __("Live Traffic", "limit-attempts-booster");
        $lab_visitor_logs_menu = __("Visitor Logs", "limit-attempts-booster");
        $lab_blocked_ip_addresses_menu = __("Blocked IP Addresses", "limit-attempts-booster");
        $lab_blocked_ip_ranges_menu = __("Blocked IP Ranges", "limit-attempts-booster");
        $lab_recent_login_logs_menu = __("Login Logs", "limit-attempts-booster");
        $lab_blocking_options_menu = __("Blocking Options", "limit-attempts-booster");
        $lab_manage_ip_addresses_menu = __("Manage IP Addresses", "limit-attempts-booster");
        $lab_manage_ip_ranges_menu = __("Manage IP Ranges", "limit-attempts-booster");
        $lab_country_blocks_menu = __("Country Blocks", "limit-attempts-booster");
        $lab_alert_setup_menu = __("Alert Setup", "limit-attempts-booster");
        $lab_error_messages_menu = __("Error Messages", "limit-attempts-booster");
        $lab_other_settings_menu = __("Other Settings", "limit-attempts-booster");
        $lab_custom_cron_jobs_menu = __("Custom Cron Jobs", "limit-attempts-booster");
        $lab_core_cron_jobs_menu = __("Core Cron Jobs", "limit-attempts-booster");

        //Sidebar
        $lab_dashboard_last10_logs = __("Dashboard (Last 10 Logs)", "limit-attempts-booster");
        $lab_login_logs = __("Login Logs", "limit-attempts-booster");
        //Error Messages

        $lab_error_messages_for_login_attempts_failure = __("For Maximum Login Attempts Error Message", "limit-attempts-booster");
        $lab_error_messages_for_login_attempts_failure_tooltip = __("In this field, you would need to provide an error message to be displayed when a user exceeds maximum number of login attempts", "limit-attempts-booster");
        $lab_error_messages_for_login_attempts_failure_placeholder = __("Please provide your Login Attempts Error Message", "limit-attempts-booster");
        $lab_error_messages_for_blocked_country = __("For Blocked Country Error Message", "limit-attempts-booster");
        $lab_error_messages_for_blocked_country_tooltip = __("In this field, you would need to provide an error message to be displayed when a user country is being blocked by the Administrator", "limit-attempts-booster");
        $lab_error_messages_for_blocked_country_placeholder = __("Please provide your Blocked Country Error Message", "limit-attempts-booster");
        $lab_error_messages_for_ip_address = __("For Blocked IP Address Error Message", "limit-attempts-booster");
        $lab_error_messages_for_ip_address_tooltip = __("In this field, you would need to provide an error message to be displayed when user IP Address is being blocked by the Administrator", "limit-attempts-booster");
        $lab_error_messages_for_ip_address_placeholder = __("Please provide your Blocked IP Address Error Message", "limit-attempts-booster");
        $lab_error_messages_for_ip_range = __("For Blocked IP Range Error Message", "limit-attempts-booster");
        $lab_error_messages_for_ip_range_tooltip = __("In this field, you would need to provide an error message to be displayed when user IP Range is being blocked by the Administrator", "limit-attempts-booster");
        $lab_error_messages_for_ip_range_placeholder = __("Please provide your Blocked IP Range Error Message", "limit-attempts-booster");

        //Other Settings
        $lab_other_settings_trackbacks = __("Trackbacks", "limit-attempts-booster");
        $lab_other_settings_trackbacks_tooltip = __("Trackbacks are a way to notify legacy blog systems that you have linked to them. If you would like to enable trackbacks to your site then you would need to choose enable or vice-versa from drop-down", "limit-attempts-booster");
        $lab_other_settings_comments_tooltip = __("If you would like to allow people to comment on your posts or pages then you would need to choose enable or vise-versa from drop-down", "limit-attempts-booster");
        $lab_other_settings_live_traffic_monitoring_title = __("Live Traffic Monitoring", "limit-attempts-booster");
        $lab_other_settings_live_traffic_monitoring_tooltip = __("If you would like to monitor details of users who are currently visiting your website and pages visited by them then you would need to choose enable or vise-versa from dropdown", "limit-attempts-booster");
        $lab_other_settings_visitor_logs_monitoring_title = __("Visitor Logs Monitoring", "limit-attempts-booster");
        $lab_other_settings_visitor_logs_monitoring_tooltip = __("If you would like to monitor details of users who are visiting your website and pages visited by them then you would need to choose enable or vise-versa from dropdown", "limit-attempts-booster");
        $lab_other_settings_uninstall_plugin = __("Remove Tables At Uninstall", "limit-attempts-booster");
        $lab_other_settings_remove_tables_at_uninstall_tooltip = __("If you would like to remove tables at uninstall then you would need to choose enable or vice-versa from dropdown", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_method = __("How does Limit Attempts Booster get IPs", "limit-attempts-booster");
        $lab_other_settings_ip_address_tooltips = __("In this field, you would need to choose a specific option  for how does Limit Attempts Booster get IPs", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_option1 = __("Let Limit Attempts Booster use the most secure method to get visitor IP address. Prevents spoofing and works with most sites.", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_option2 = __("Use PHP's built in REMOTE_ADDR and don't use anything else. Very secure if this is compatible with your site.", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_option3 = __("Use the X-Forwarded-For HTTP header. Only use if you have a front-end proxy or spoofing may result.", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_option4 = __("Use the X-Real-IP HTTP header. Only use if you have a front-end proxy or spoofing may result.", "limit-attempts-booster");
        $lab_other_settings_ip_address_fetching_option5 = __("Use the Cloudflare 'CF-Connecting-IP' HTTP header to get a visitor IP. Only use if you're using Cloudflare.", "limit-attempts-booster");

        // Alert Setup
        $lab_alert_setup_email_when_a_user_fails = __("Email when a User Fails Login", "limit-attempts-booster");
        $lab_alert_setup_email_when_a_user_fails_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when a user fails to login", "limit-attempts-booster");
        $lab_alert_setup_email_when_a_user_success = __("Email when a User Success Login", "limit-attempts-booster");
        $lab_alert_setup_email_when_a_user_success_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when a user succeeds in login", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_address_blocked = __("Email when an IP Address is Blocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_address_blocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Address is being blocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_address_unblocked = __("Email when an IP Address is Unblocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_address_unblocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Address is being unblocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_range_blocked = __("Email when an IP Range is Blocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_range_blocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Range is being blocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_range_unblocked = __("Email when an IP Range is Unblocked", "limit-attempts-booster");
        $lab_alert_setup_email_when_ip_range_unblocked_tooltip = __("In this field, you would need to choose Enable to automatically send an email to the Administrator when an IP Range is being unblocked", "limit-attempts-booster");

        //Dashboard
        $lab_login_logs_on_world_map = __("Login Logs On World Map", "limit-attempts-booster");

        //Logs
        $lab_recent_login_logs_on_world_map = __("Login Logs On World Map", "limit-attempts-booster");
        $lab_recent_logs_start_date_tooltip = __("In this field, you would need to specify start date to view information about users who logged within a specified period", "limit-attempts-booster");
        $lab_recent_logs_end_date_tooltip = __("In this field, you would need to specify end date to view information about users who logged within a specified period", "limit-attempts-booster");
        $lab_visitor_logs_start_date_tooltip = __("In this field, you would need to specify start date to view information about users who visit to your website within a specified period", "limit-attempts-booster");
        $lab_visitor_logs_end_date_tooltip = __("In this field, you would need to specify end date to view information about users who visit to your website within a specified period", "limit-attempts-booster");
        $lab_visitor_logs_live_traffic_monitoring = __("Live Traffic Monitoring is Turned Off. Please go to General Settings > Other Settings Menu to enable it", "limit-attempts-booster");
        $lab_visitor_logs_visitor_logs_monitoring = __("Visitor Logs Monitoring is Turned Off. Please go to General Settings > Other Settings Menu to enable it", "limit-attempts-booster");
        $lab_visitor_logs_next_refresh_in = __("Next Refresh in", "limit-attempts-booster");
        $lab_visitor_logs_seconds = __("Seconds", "limit-attempts-booster");

        //Blocking Options
        $lab_blocking_options_auto_ip_block = __("Auto IP Block", "limit-attempts-booster");
        $lab_blocking_options_auto_ip_block_tooltip = __("In this field, you would need to choose Enable to automatically block an IP Address when a user exceeds their maximum login attempts", "limit-attempts-booster");
        $lab_blocking_options_login_attempts = __("Maximum Login Attempts in a Day", "limit-attempts-booster");
        $lab_blocking_options_login_attempts_tooltip = __("In this field, you would need to provide maximum number of login attempts in a day. If a user exceeds its login attempts then their IP Address will be automatically blocked", "limit-attempts-booster");
        $lab_blocking_options_login_attempts_placeholder = __("Please provide Maximum Login Attempts in a Day", "limit-attempts-booster");

        //Manage IP Address
        $lab_manage_ip_addresses_tooltip = __("In this field, you would need to provide a valid IP Address which you would like to block", "limit-attempts-booster");
        $lab_manage_ip_addresses_comments_tooltip = __("In this field, you would need to provide comments to give an overview about reason for blocking these IP Addresses", "limit-attempts-booster");
        $lab_manage_ip_addresses_view_blocked = __("View Blocked IP Addresses", "limit-attempts-booster");
        $lab_manage_ip_addresses_start_date_tooltip = __("In this field, you would need to choose start date to view information about IP Addresses which were blocked within a specified period", "limit-attempts-booster");
        $lab_manage_ip_addresses_end_date_tooltip = __("In this field, you would need to choose end date to view information about IP Addresses which were blocked within a specified period", "limit-attempts-booster");

        //Manage IP Range
        $lab_manage_ip_ranges_start = __("Start IP Range", "limit-attempts-booster");
        $lab_manage_ip_ranges_start_tooltip = __("In this field, you would need to provide a valid Start IP Ranges which you would like to block", "limit-attempts-booster");
        $lab_manage_ip_ranges_start_placeholder = __("Please provide valid Start IP Range", "limit-attempts-booster");
        $lab_manage_ip_ranges_end = __("End IP Range", "limit-attempts-booster");
        $lab_manage_ip_ranges_end_tooltip = __("In this field, you would need to provide a valid End IP Ranges which you would like to block", "limit-attempts-booster");
        $lab_manage_ip_ranges_end_placeholder = __("Please provide valid End IP Range", "limit-attempts-booster");
        $lab_manage_ip_ranges_blocked_for_tootltip = __("In this field, you would need to choose duration of time for which you would like to block these IP Ranges", "limit-attempts-booster");
        $lab_manage_ip_ranges_comments_tooltip = __("In this field, you would need to provide comments to give an overview about reason for blocking these IP Ranges", "limit-attempts-booster");
        $lab_manage_ip_ranges_block = __("Block IP Range", "limit-attempts-booster");
        $lab_manage_ip_ranges_view_blocked = __("View Blocked IP Ranges", "limit-attempts-booster");
        $lab_manage_ip_ranges_start_date_tooltip = __("In this field, you would need to choose start date to view information about IP Ranges which were blocked within a specified period", "limit-attempts-booster");
        $lab_manage_ip_ranges_end_date_tooltip = __("In this field, you would need to choose end date to view information about IP Ranges which were blocked within a specified period", "limit-attempts-booster");

        //Country Blocks
        $lab_country_blocks_available_countries = __("Available Countries", "limit-attempts-booster");
        $lab_country_blocks_available_countries_tooltip = __("List of all Countries", "limit-attempts-booster");
        $lab_country_blocks_add = __("Add >>", "limit-attempts-booster");
        $lab_country_blocks_remove = __("<< Remove", "limit-attempts-booster");
        $lab_blocked_countries = __("Blocked Countries", "limit-attempts-booster");
        $lab_blocked_countries_tooltip = __("List of all Countries being Blocked", "limit-attempts-booster");

        //Email Templates
        $lab_choose_email_template = __("Choose Email Template", "limit-attempts-booster");
        $lab_choose_email_template_tooltip = __("In this field, you would need to choose Email Template from dropdown", "limit-attempts-booster");
        $lab_email_template_for_user_success = __("Template For User Successful Login", "limit-attempts-booster");
        $lab_email_template_for_user_failure = __("Template For User Failure Login", "limit-attempts-booster");
        $lab_email_template_for_ip_address_blocked = __("Template For IP Address Blocked", "limit-attempts-booster");
        $lab_email_template_for_ip_address_unblocked = __("Template For IP Address Unblocked", "limit-attempts-booster");
        $lab_email_template_for_ip_range_blocked = __("Template For IP Range Blocked", "limit-attempts-booster");
        $lab_email_template_for_ip_range_unblocked = __("Template For IP Range Unblocked", "limit-attempts-booster");
        $lab_email_template_send_to = __("Send To", "limit-attempts-booster");
        $lab_email_template_send_to_tooltip = __("In this field, you would need to provide a valid email address where you would like to send an email notification", "limit-attempts-booster");
        $lab_email_template_send_to_placeholder = __("Please provide valid Email Address", "limit-attempts-booster");
        $lab_email_template_cc = __("CC", "limit-attempts-booster");
        $lab_email_template_cc_tooltip = __("In this field, you would need to provide valid Cc Email Address", "limit-attempts-booster");
        $lab_email_template_cc_placeholder = __("Please provide CC Email", "limit-attempts-booster");
        $lab_email_template_bcc = __("BCC", "limit-attempts-booster");
        $lab_email_template_bcc_tooltip = __("In this field, you would need to provide valid Bcc Email Address", "limit-attempts-booster");
        $lab_email_template_bcc_placeholder = __("Please provide BCC Email", "limit-attempts-booster");
        $lab_email_template_subject_tooltip = __("In this field, you would need to provide subject for email notification", "limit-attempts-booster");
        $lab_email_template_subject_placeholder = __("Please provide Subject", "limit-attempts-booster");
        $lab_email_template_message = __("Message", "limit-attempts-booster");
        $lab_email_template_message_tooltip = __("In this field, you would need to provide content which has to be sent to the Administrator", "limit-attempts-booster");

        //Roles and Capabilities
        $lab_roles_capabilities_show_menu = __("Show Limit Attempts Booster Menu", "limit-attempts-booster");
        $lab_roles_capabilities_show_menu_tooltip = __("In this field, you would need to choose a specific role who can see Sidebar Menu", "limit-attempts-booster");
        $lab_roles_capabilities_administrator = __("Administrator", "limit-attempts-booster");
        $lab_roles_capabilities_author = __("Author", "limit-attempts-booster");
        $lab_roles_capabilities_editor = __("Editor", "limit-attempts-booster");
        $lab_roles_capabilities_contributor = __("Contributor", "limit-attempts-booster");
        $lab_roles_capabilities_subscriber = __("Subscriber", "limit-attempts-booster");
        $lab_roles_capabilities_topbar_menu = __("Show Limit Attempts Booster Top Bar Menu", "limit-attempts-booster");
        $lab_roles_capabilities_topbar_menu_tooltip = __("If you would like to show Limit Attempts Booster Top Bar Menu then you would need to choose enable or vice-versa from dropdown", "limit-attempts-booster");
        $lab_roles_capabilities_administrator_role = __("An Administrator Role can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_administrator_role_tooltip = __("Administrators will have by default full control to manage different options in Limit Attempts Booster, so all checkboxes will already be selected for the Administrator Role as mentioned below", "limit-attempts-booster");
        $lab_roles_capabilities_full_control = __("Full Control", "limit-attempts-booster");
        $lab_roles_capabilities_author_role = __("An Author Role can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_author_role_tooltip = __("You can choose what pages could be accessed by users having an Author Role and you can also choose additional capabilities that could be accessed by users on your Limit Attempts Booster for security purpose which is mentioned below in Author Role checkboxes", "limit-attempts-booster");
        $lab_roles_capabilities_editor_role = __("An Editor Role can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_editor_role_tooltip = __("You can choose what pages could be accessed by the users having an Editor Role and you can also choose additional capabilities that could be accessed by users on your Limit Attempts Booster for security purpose which is mentioned below in Editor Role checkboxes", "limit-attempts-booster");
        $lab_roles_capabilities_contributor_role = __("A Contributor Role can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_contributor_role_tooltip = __("You can choose what pages could be accessed by the users having a Contributor Role and you can also choose additional capabilities that could be accessed by users on your Limit Attempts Booster for security purpose which is mentioned below in Contributor Role checkboxes", "limit-attempts-booster");
        $lab_roles_capabilities_subscriber_role = __("A Subscriber Role can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_subscriber_role_tooltip = __("You can choose what pages could be accessed by the users having a Subscriber Role and you can also choose additional capabilities that could be accessed by users on your Limit Attempts Booster for security purpose which is mentioned below in Subscriber Role checkboxes", "limit-attempts-booster");
        $lab_roles_capabilities_others = __("Others", "limit-attempts-booster");
        $lab_roles_capabilities_other_role = __("Other Roles can do the following ", "limit-attempts-booster");
        $lab_roles_capabilities_other_role_tooltip = __("You can choose what pages could be accessed by the users having an Others Role and you can also choose additional capabilities that could be accessed by users on your Limit Attempts Booster for security purpose which is mentioned below in Others Role checkboxes", "limit-attempts-booster");
        $lab_roles_capabilities_other_roles_capabilities = __("In this field, you would need to choose appropriate capabilities for security purposes", "limit-attempts-booster");
        $lab_roles_capabilities_other_roles_capabilities_tooltip = __("In this field, only users can access to these capabilities of Limit Attempts Booster", "limit-attempts-booster");

        //Core Cron Jobs
        $lab_cron_jobs_name_of_hook = __("Name of the Hook", "limit-attempts-booster");
        $lab_cron_jobs_Interval_hook = __("Interval Hook", "limit-attempts-booster");
        $lab_cron_jobs_args = __("Args", "limit-attempts-booster");
        $lab_cron_jobs_next_execution = __("Next Execution", "limit-attempts-booster");

        //Feature Request
        $lab_feature_requests_thank_you = __("Thank You!", "limit-attempts-booster");
        $lab_feature_requests_suggest_some_features = __("Kindly fill in the below form, if you would like to suggest some features which are not in the Plugin", "limit-attempts-booster");
        $lab_feature_requests_suggestion_complaint = __("If you also have any suggestion/complaint, you can use the same form below", "limit-attempts-booster");
        $lab_feature_requests_write_us_on = __("You can also write us on", "limit-attempts-booster");
        $lab_feature_requests_your_name = __("Your Name", "limit-attempts-booster");
        $lab_feature_requests_your_name_tooltip = __("In this field, you would need to provide your Name which will be sent along with your Feedback", "limit-attempts-booster");
        $lab_feature_requests_your_name_placeholder = __("Please provide your Name", "limit-attempts-booster");
        $lab_feature_requests_your_email = __("Your Email", "limit-attempts-booster");
        $lab_feature_requests_your_email_tooltip = __("In this field, you would need to provide your valid Email Address which will be sent along with your Feedback", "limit-attempts-booster");
        $lab_feature_requests_your_email_placeholder = __("Please provide your Email", "limit-attempts-booster");
        $lab_feature_requests_tooltip = __("In this field, you would need to provide a feature which you would like to request to be added to this Plugin", "limit-attempts-booster");
        $lab_feature_requests_placeholder = __("Please provide Feature Request", "limit-attempts-booster");
        $lab_feature_requests_send_request = __("Send Request", "limit-attempts-booster");

        // Error logs
        $lab_error_log_output = __("Output", "limit-attempts-booster");
        $lab_error_log_download = __("Download Error Log", "limit-attempts-booster");
        $lab_error_log_clear = __("Clear Error Log", "limit-attempts-booster");
        $lab_error_log_output_tooltip = __("In this field,you would be able to see all PHP Errors", "limit-attempts-booster");
    }
}