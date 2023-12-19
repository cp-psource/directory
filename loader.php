<?php
/*
Plugin Name: Verzeichnis
Plugin URI: https://n3rds.work/docs/verzeichnis
Description: Verzeichnis - Erstelle eine vollständige Verzeichnis-Seite.
Version: 2.2.9
Author: WMS N@W
Author URI: https://n3rds.work
Text Domain: dr_text_domain
Domain Path: /languages
License: GNU General Public License (Version 2 - GPLv2)
*/

$plugin_header_translate = array(
        __('Verzeichnis - Erstelle eine vollständige Verzeichnis-Seite.', 'dr_text_domain'),
        __('DerN3rd', 'dr_text_domain'),
        __('https://n3rds.work', 'dr_text_domain'),
        __('Verzeichnis', 'dr_text_domain'),
        );
        
        /*

Authors - DerN3rd
Copyright 2021-204 WMS N@W, (https://n3rds.work)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

require 'psource/psource-plugin-update/psource-plugin-updater.php';
use Psource\PluginUpdateChecker\v5\PucFactory;
$MyUpdateChecker = PucFactory::buildUpdateChecker(
	'https://n3rds.work//wp-update-server/?action=get_metadata&slug=directory', 
	__FILE__, 
	'directory' 
);
// Define plugin version
define( 'DR_VERSION', '2.2.9' );
// define the plugin folder url
define( 'DR_PLUGIN_URL', plugin_dir_url(__FILE__) );
// define the plugin folder dir
define( 'DR_PLUGIN_DIR', plugin_dir_path(__FILE__) );
// The text domain for strings localization
define( 'DR_TEXT_DOMAIN', 'dr_text_domain' );
// The key for the options array
define( 'DR_OPTIONS_NAME', 'dr_options' );
// The key for the captcha transient
define( 'DR_CAPTCHA', 'dr_captcha_' );

// include core files
//If another version of CustomPress not loaded, load ours.
if(!class_exists('CustomPress_Core')) include_once 'core/custompress/loader.php';

register_deactivation_hook( __FILE__, function() {
        //Remove Directory custom post types
        $ct_custom_post_types = get_site_option( 'ct_custom_post_types' );
        unset($ct_custom_post_types['directory_listing']);
        update_site_option( 'ct_custom_post_types', $ct_custom_post_types );
        
        $ct_custom_post_types = get_option( 'ct_custom_post_types' );
        unset($ct_custom_post_types['directory_listing']);
        update_option( 'ct_custom_post_types', $ct_custom_post_types );
        
        $ct_custom_taxonomies = get_site_option('ct_custom_taxonomies');
        unset($ct_custom_taxonomies['listing_tag']);
        update_site_option( 'ct_custom_taxonomies', $ct_custom_taxonomies );
        
        $ct_custom_taxonomies = get_option('ct_custom_taxonomies');
        unset($ct_custom_taxonomies['listing_tag']);
        update_option( 'ct_custom_taxonomies', $ct_custom_taxonomies );
        
        $ct_custom_taxonomies = get_site_option('ct_custom_taxonomies');
        unset($ct_custom_taxonomies['listing_category']);
        update_site_option( 'ct_custom_taxonomies', $ct_custom_taxonomies );
        
        $ct_custom_taxonomies = get_option('ct_custom_taxonomies');
        unset($ct_custom_taxonomies['listing_category']);
        update_option( 'ct_custom_taxonomies', $ct_custom_taxonomies );
        
        flush_rewrite_rules();

} );

include_once 'core/core.php';
include_once 'core/functions.php';
include_once 'core/template-tags.php';
include_once 'core/payments.php';
include_once 'core/ratings.php';
