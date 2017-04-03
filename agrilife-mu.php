<?php
/**
 * Plugin Name: AgriLife Must Use
 * Plugin URI: https://github.com/AgriLife/AgriLife-MU
 * Description: Functionality useful for all AgriLife sites.
 * Version: 1.0
 * Author: Zach Watkins
 * Author URI: https://github.com/ZachWatkins
 * Author Email: zachary.watkins@ag.tamu.edu
 * License: GPL2+
**/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'access denied' );

define( 'AMU_DIRNAME', 'agrilife-genesis-links' );
define( 'AMU_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'AMU_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'AMU_DIR_FILE', __FILE__ );

// Load the plugin assets
require_once AMU_DIR_PATH . 'includes/PostFilter.php';
$amu_filter = new PostFilter;

require_once AMU_DIR_PATH . 'includes/PostRemoveImageProtocols.php';
$amu_removeprotocols = new PostRemoveImageProtocols;

?>
