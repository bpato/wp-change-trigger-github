<?php
/**
 * Plugin Name: WP Change Trigger GitHub
 * Plugin URI: https://github.com/bpato/wp-change-trigger-github
 * Description: A WordPress plugin to trigger GitHub actions on content changes.
 * Version: 1.0.0
 * Author: Brais Pato
 * Author URI: https://www.bpato.com
 * Text Domain: changuetriggergithub
 * Requires at least: 6.7
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
	define( 'WC_PLUGIN_FILE', __FILE__ );
}

require __DIR__ . '/vendor/autoload.php';

if ( class_exists( \Bpato\WpChangeTriggerGithub\WpChangeTriggerGithub::class ) ) {
    \Bpato\WpChangeTriggerGithub\WpChangeTriggerGithub::init();
}