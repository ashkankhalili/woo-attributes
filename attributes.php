<?php
/**
 * Plugin Name
 *
 * @package   Attributes
 * @author    Erfan Loghmani
 * @copyright 2019 Rooberah
 * @license   GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Attributes
 * Description:       This plugin make changing attributes easier
 * Version:           0.1.0
 */

namespace Attributes;

if (!defined('ATTRIBUTES_PLUGIN_PATH')) {
    define('ATTRIBUTES_PLUGIN_PATH', dirname(__FILE__).'/');
    define('ATTRIBUTES_PLUGIN_VERSION', '0.1.0');
    define('ATTRIBUTES_PREFIX', 'attr');
}


require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = \Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/Rooberah/attributes-plugin',
    __FILE__,
    'attributes-plugin'
);

require_once ATTRIBUTES_PLUGIN_PATH.'core/admin-page.php';

$admin_page = new AdminPage();

