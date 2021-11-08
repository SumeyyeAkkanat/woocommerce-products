<?php
/**
 * Plugin Name: Test Plugin
 * Plugin URI: https://kabipartners.com/
 * Description: The very first plugin that I have ever created.
 * Version: 1.0
 * Author: akkanatsumeyye
 * Author URI: https://kabipartners.com.tr/
 * Licence: GPLv2 or later
 * Text Domain: plugin
 */
defined( 'ABSPATH' ) || exit;
include 'inc/Order.php';
$class=new Order;
$class->init();
