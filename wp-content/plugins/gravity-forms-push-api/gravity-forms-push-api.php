<?php

/**
 * Plugin Name: BIS Forms
 * Plugin URI: https://eugenefvdm.com
 * Description: An API that posts Gravity Forms to a Business Information System (BIS)
 * Version: ALPHA 3
 * Author: Eugene van der Merwe
 * Author URI: https://eugenefvdm.com
 * License: MIT
 */

 /**
  * Registers the settings and adds an admin init action
  */
function bis_forms_register_settings()
{
    add_option('bis_forms_option_api_token', '');
    register_setting('bis_forms_options_group', 'bis_forms_option_api_token', 'bis_forms_callback');

    add_option('bis_forms_option_api_url', 'https://production-url/api/v1');
    register_setting('bis_forms_options_group', 'bis_forms_option_api_url', 'bis_forms_callback');
    
    add_option('bis_forms_option_enable_debugger', 1);
    register_setting('bis_forms_options_group', 'bis_forms_option_enable_debugger', 'bis_forms_callback');    
}
add_action('admin_init', 'bis_forms_register_settings');

/**
* Adds a new admin menu to administer the settings
*/
function bis_forms_register_options_page()
{
    add_options_page('BIS Forms Settings', 'BIS Forms', 'manage_options', 'bis-settings', 'bis_forms_options_page');
}
add_action('admin_menu', 'bis_forms_register_options_page');

/**
 * Output the options for the settings page
 */
function bis_forms_options_page()
{
    $enable_debugger = get_option( 'bis_forms_option_enable_debugger' );    
?>
    <div>
        <h2>BIS Forms Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('bis_forms_options_group'); ?>
            <table>

                <tr>
                    <td>API Token</td>
                    <td>
                        <input 
                            type="text"
                            name="bis_forms_option_api_token"
                            size="70"
                            value="<?php echo get_option('bis_forms_option_api_token'); ?>" 
                        />
                    </td>
                </tr>

                <tr>                    
                    <td>API URL</td>
                    <td>
                        <input 
                            type="text"
                            name="bis_forms_option_api_url"
                            size="40"
                            value="<?php echo get_option('bis_forms_option_api_url'); ?>" 
                        />
                    </td>
                </tr>
                
                <tr>
                    <td><label for="enable_debugger_checkbox">Enable debugger<label></td>
                    <td>
                        <input 
                            type="checkbox"
                            id="enable_debugger_checkbox"
                            name="bis_forms_option_enable_debugger"
                            value="1" <?php echo ($enable_debugger == true) ? 'checked' : '' ?> />
                    </td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
} ?>
<?php
/**
 * Register a debugger
 */
if (!function_exists('debugger')) {

    function debugger($message, $variable = '')
    {
        $serverAddr     = $_SERVER['SERVER_ADDR'];
        $dateTimeFormat = date('Y-m-d H:i:s');
        $prefix         = "[$dateTimeFormat] $serverAddr.BIS: ";
        if (is_array($variable) or is_object($variable)) {
            $variable = print_r($variable, 1);
        } else if (gettype($variable) == 'boolean') {
            $variable = "(Boolean: $variable)";
        }
        $logPath = ABSPATH . "wp-content/plugins/bis-forms/";
        file_put_contents($logPath . 'log_' . date("dmY") . '.log', $prefix . $message . $variable . "\n", FILE_APPEND);
    }
}
