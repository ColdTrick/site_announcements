<?php

use ColdTrick\SiteAnnouncements\Gatekeeper;

return [
	'plugin' => [
		'version' => '8.0',
	],
	'entities' => [
		[
			'type' => 'object',
			'subtype' => 'site_announcement',
			'class' => \SiteAnnouncement::class,
			'capabilities' => [
				'commentable' => false,
			],
		],
	],
	'routes' => [
		'action:site_announcements/edit' => [
			'path' => '/action/site_announcements/edit',
			'file' => __DIR__ . '/actions/site_announcements/edit.php',
			'middleware' => [
				Gatekeeper::class,
			]
		],
		'add:object:site_announcement' => [
			'path' => '/announcements/add/{guid?}',
			'resource' => 'site_announcements/add',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'edit:object:site_announcement' => [
			'path' => '/announcements/edit/{guid}',
			'resource' => 'site_announcements/edit',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:archive' => [
			'path' => '/announcements/archive',
			'resource' => 'site_announcements/archive',
		],
		'collection:object:site_announcement:scheduled' => [
			'path' => '/announcements/scheduled',
			'resource' => 'site_announcements/scheduled',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:editors' => [
			'path' => '/announcements/editors',
			'resource' => 'site_announcements/editors',
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'collection:object:site_announcement:all' => [
			'path' => '/announcements/all',
			'resource' => 'site_announcements/all',
		],
		'default:object:site_announcement' => [
			'path' => '/announcements',
			'resource' => 'site_announcements/all',
		],
	],
	'actions' => [
		'site_announcements/mark' => ['access' => 'public'],
		'site_announcements/toggle_editor' => ['access' => 'admin'],
	],
	
	'hooks' => [
		'access:collections:write' => [
			'user' => [
				'\ColdTrick\SiteAnnouncements\Access::userWriteCollections' => [],
			],
		],
		'container_permissions_check' => [
			'object' => [
				'\ColdTrick\SiteAnnouncements\Access::containerPermissionsCheck' => [],
			],
		],
		'cron' => [
			'daily' => [
				'\ColdTrick\SiteAnnouncements\Cron::cleanupExpiredAnnouncements' => [],
			],
		],
		'register' => [
			'menu:filter:site_announcements' => [
				'\ColdTrick\SiteAnnouncements\FilterMenu::register' => [],
			],
			'menu:footer' => [
				'\ColdTrick\SiteAnnouncements\FooterMenu::register' => [],
			],
			'menu:page' => [
				'\ColdTrick\SiteAnnouncements\PageMenu::register' => [],
			],
			'menu:user_hover' => [
				'\ColdTrick\SiteAnnouncements\UserHoverMenu::register' => [],
			],
		],
		'permissions_check' => [
			'object' => [
				'\ColdTrick\SiteAnnouncements\Access::permissionsCheck' => [],
			],
		],
		'permissions_check:comment' => [
			'object' => [
				'\ColdTrick\SiteAnnouncements\Access::commentPermissionsCheck' => [],
			],
		],
	],
	'view_extensions' => [
		'elgg.css' => [
			'site_announcements/site.css' => [],
		],
		'page/elements/body' => [
			'site_announcements/site' => ['priority' => 400],
		],
	],
];
