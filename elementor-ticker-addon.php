<?php

/**
 * Plugin Name: Elementor Ticker Addon
 * Description: Elementor widget that add running line.
 * Version:     1.0.0
 * Author:      Alkar Yekshambeyeu
 * Text Domain: ticker-addon
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.20.0
 * Elementor Pro tested up to: 3.20.0
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

function elementor_ticker_init()
{

  // Load plugin file
  require_once(__DIR__ . '/includes/plugin.php');

  \Ticker\Plugin::instance();


  defined('TICKER_PATH') || define(' TICKER_PATH', plugin_dir_path(__FILE__));
  defined('TICKER_URL') || define(' TICKER_URL', plugin_dir_url(__FILE__));
}
add_action('plugins_loaded', 'elementor_ticker_init');
