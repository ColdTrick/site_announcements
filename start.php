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
	elgg_extend_view('css/elgg', 'css/site_announcements/site');
	elgg_extend_view('js/elgg', 'js/site_announcements/site');
	
	// pagehandler
	elgg_register_page_handler('announcements', array('\ColdTrick\SiteAnnouncements\PageHandler', 'announcements'));
	
	// extends views
	elgg_extend_view('page/elements/body', 'site_announcements/site', 400);
	
	// register plugin hooks
	elgg_register_plugin_hook_handler('register', 'menu:entity', array('\ColdTrick\SiteAnnouncements\EntityMenu', 'register'));
	elgg_register_plugin_hook_handler('register', 'menu:filter', array('\ColdTrick\SiteAnnouncements\FilterMenu', 'register'));
	elgg_register_plugin_hook_handler('register', 'menu:footer', array('\ColdTrick\SiteAnnouncements\FooterMenu', 'register'));
	elgg_register_plugin_hook_handler('register', 'menu:user_hover', array('\ColdTrick\SiteAnnouncements\UserHoverMenu', 'register'));
	elgg_register_plugin_hook_handler('register', 'menu:page', array('\ColdTrick\SiteAnnouncements\PageMenu', 'register'));
	elgg_register_plugin_hook_handler('access:collections:write', 'user', array('\ColdTrick\SiteAnnouncements\Access', 'userWriteCollections'));
	elgg_register_plugin_hook_handler('container_permissions_check', 'object', array('\ColdTrick\SiteAnnouncements\Access', 'containerPermissionsCheck'));
	elgg_register_plugin_hook_handler('permissions_check', 'object', array('\ColdTrick\SiteAnnouncements\Access', 'permissionsCheck'));
	elgg_register_plugin_hook_handler('permissions_check:comment', 'object', array('\ColdTrick\SiteAnnouncements\Access', 'commentPermissionsCheck'));
	
	// register actions
	elgg_register_action('site_announcements/edit', dirname(__FILE__) . '/actions/edit.php');
	elgg_register_action('announcements/delete', dirname(__FILE__) . '/actions/delete.php');
	elgg_register_action('site_announcements/mark', dirname(__FILE__) . '/actions/mark.php', 'public');
	elgg_register_action('site_announcements/toggle_editor', dirname(__FILE__) . '/actions/toggle_editor.php', 'admin');
}