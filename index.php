<?php
/**
 * Plugin Name:       WP Gutendex
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Gutenburg > Gutendex API > WordPress |  Creates the custom table 'books'. The booklist admin page.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Praveen Dias 
 * Author URI:        https://praveen.dias/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wp-gutendex
 * Domain Path:       /languages
 */

/**
 * Useful Definitions.
 */
define('WP_GUTENDEX_DIR', __DIR__);
define('WP_GUTENDEX_URI', plugin_dir_url(__FILE__));

/**
 * Die if not defined ABSPATH.
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Let's instantiate WP Gutenburg.
 */
require_once( WP_GUTENDEX_DIR . '/inc/class-wp-gutendex.php' );
$wp_gutendex = new WP_Gutendex();


register_activation_hook( __FILE__, array($wp_gutendex, 'activate') );
register_deactivation_hook( __FILE__, array($wp_gutendex, 'deactivate') );
