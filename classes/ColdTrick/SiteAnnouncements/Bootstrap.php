<?php

namespace ColdTrick\SiteAnnouncements;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {

	/**
	 * {@inheritdoc}
	 */
	public function init() {
		
		elgg_extend_view('elgg.js', 'js/site_announcements/user_hover.js');
			
		// extends views
		elgg_extend_view('page/default', 'site_announcements/page_shell', 400);
		
		// register plugin hooks
		elgg_register_plugin_hook_handler('register', 'menu:filter:site_announcements', '\ColdTrick\SiteAnnouncements\FilterMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:footer', '\ColdTrick\SiteAnnouncements\FooterMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:user_hover', '\ColdTrick\SiteAnnouncements\UserHoverMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:page', '\ColdTrick\SiteAnnouncements\PageMenu::register');
		elgg_register_plugin_hook_handler('access:collections:write', 'user', '\ColdTrick\SiteAnnouncements\Access::userWriteCollections');
		elgg_register_plugin_hook_handler('container_permissions_check', 'object', '\ColdTrick\SiteAnnouncements\Access::containerPermissionsCheck');
		elgg_register_plugin_hook_handler('permissions_check', 'object', '\ColdTrick\SiteAnnouncements\Access::permissionsCheck');
		elgg_register_plugin_hook_handler('permissions_check:comment', 'object', '\ColdTrick\SiteAnnouncements\Access::commentPermissionsCheck');
		elgg_register_plugin_hook_handler('cron', 'daily', '\ColdTrick\SiteAnnouncements\Cron::cleanupExpiredAnnouncements');
	}
}
