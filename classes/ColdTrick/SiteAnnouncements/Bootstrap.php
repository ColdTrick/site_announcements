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
		elgg_extend_view('page/elements/body', 'site_announcements/site', 400);
		
		// register plugin hooks
		elgg_register_plugin_hook_handler('register', 'menu:filter:site_announcements', __NAMESPACE__ . '\FilterMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:footer', __NAMESPACE__ . '\FooterMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:user_hover', __NAMESPACE__ . '\UserHoverMenu::register');
		elgg_register_plugin_hook_handler('register', 'menu:page', __NAMESPACE__ . '\PageMenu::register');
		elgg_register_plugin_hook_handler('access:collections:write', 'user', __NAMESPACE__ . '\Access::userWriteCollections');
		elgg_register_plugin_hook_handler('container_permissions_check', 'object', __NAMESPACE__ . '\Access::containerPermissionsCheck');
		elgg_register_plugin_hook_handler('permissions_check', 'object', __NAMESPACE__ . '\Access::permissionsCheck');
		elgg_register_plugin_hook_handler('permissions_check:comment', 'object', __NAMESPACE__ . '\Access::commentPermissionsCheck');
		elgg_register_plugin_hook_handler('cron', 'daily', __NAMESPACE__ . '\Cron::cleanupExpiredAnnouncements');
	}
}
