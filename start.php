<?php
/**
 * main file for this plugin
 */

define('SITE_ANNOUNCEMENT_SUBTYPE', 'site_announcement');
define('SITE_ANNOUNCEMENT_RELATIONSHIP', 'site_announcement_read');

require_once(dirname(__FILE__) . '/lib/functions.php');

// register default Elgg events
elgg_register_event_handler('init', 'system', 'site_announcements_init');

/**
 * Gets called when the system initializes
 *
 * @return void
 */
function site_announcements_init() {
	
	// extend css / js
	elgg_extend_view('elgg.css', 'css/site_announcements/site.css');
	elgg_extend_view('elgg.js', 'js/site_announcements/user_hover.js');
	
	// pagehandler
	elgg_register_page_handler('announcements', '\ColdTrick\SiteAnnouncements\PageHandler::announcements');
	
	// extends views
	elgg_extend_view('page/default', 'site_announcements/page_shell', 400);
	
	// register plugin hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', '\ColdTrick\SiteAnnouncements\EntityMenu::register');
	elgg_register_plugin_hook_handler('register', 'menu:filter', '\ColdTrick\SiteAnnouncements\FilterMenu::register');
	elgg_register_plugin_hook_handler('register', 'menu:footer', '\ColdTrick\SiteAnnouncements\FooterMenu::register');
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', '\ColdTrick\SiteAnnouncements\UserHoverMenu::register');
	elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\SiteAnnouncements\PageMenu::register');
	elgg_register_plugin_hook_handler('access:collections:write', 'user', '\ColdTrick\SiteAnnouncements\Access::userWriteCollections');
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', '\ColdTrick\SiteAnnouncements\Access::containerPermissionsCheck');
	elgg_register_plugin_hook_handler('permissions_check', 'object', '\ColdTrick\SiteAnnouncements\Access::permissionsCheck');
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', '\ColdTrick\SiteAnnouncements\Access::commentPermissionsCheck');
	elgg_register_plugin_hook_handler('cron', 'daily', '\ColdTrick\SiteAnnouncements\Cron::cleanupExpiredAnnouncements');
	
	// register actions
	elgg_register_action('site_announcements/edit', dirname(__FILE__) . '/actions/edit.php');
	elgg_register_action('announcements/delete', dirname(__FILE__) . '/actions/delete.php');
	elgg_register_action('site_announcements/mark', dirname(__FILE__) . '/actions/mark.php', 'public');
	elgg_register_action('site_announcements/toggle_editor', dirname(__FILE__) . '/actions/toggle_editor.php', 'admin');
}
