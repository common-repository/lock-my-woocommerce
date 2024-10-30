<?php
/*
 * Plugin Name: Lock My WooCommerce
 * Description: This plugin allow WooCommerce to be lock without affecting any part of theme.
 * Plugin URI: http://capripio.com/lock-my-woocommerce
 * Author Name: Muhammad Asif
 * Author URI: http://capripio.com/capripio
 * Version: 1.0.1
 * License: GPLv2 or later
 */

if ( ! defined( 'ABSPATH' ) ) {
	return;
}

define( 'CP_LOCK_WC_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'CP_LOCK_WC_DOMAIN', 'cp-lock-woocommerce' );

require_once CP_LOCK_WC_DIR . '/includes/helpers.php';
require_once CP_LOCK_WC_DIR . '/includes/class-cp-lock-wc-core.php';
require_once CP_LOCK_WC_DIR . '/includes/class-cp-lock-wc-settings.php';
require_once CP_LOCK_WC_DIR . '/includes/class-cp-lock-wc-template.php';

//That's All Folks!