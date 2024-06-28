<?php

use ColdTrick\SiteAnnouncements\Gatekeeper;
use Elgg\Blog\Forms\PrepareFields;

return [
	'plugin' => [
		'version' => '12.0',
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
	'actions' => [
		'site_announcements/edit' => [
			'middleware' => [
				Gatekeeper::class,
			],
		],
		'site_announcements/mark' => ['access' => 'public'],
		'site_announcements/toggle_editor' => ['access' => 'admin'],
	],
	'routes' => [
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
	'events' => [
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
		'form:prepare:fields' => [
			'site_announcements/edit' => [
				\ColdTrick\SiteAnnouncements\Forms\PrepareFields::class => [],
			],
		],
		'permissions_check' => [
			'object' => [
				'\ColdTrick\SiteAnnouncements\Access::permissionsCheck' => [],
			],
		],
		'register' => [
			'menu:admin_header' => [
				'\ColdTrick\SiteAnnouncements\Menus\AdminHeader::register' => [],
			],
			'menu:filter:site_announcements' => [
				'\ColdTrick\SiteAnnouncements\Menus\Filter::register' => [],
			],
			'menu:footer' => [
				'\ColdTrick\SiteAnnouncements\Menus\Footer::register' => [],
			],
			'menu:user_hover' => [
				'\ColdTrick\SiteAnnouncements\Menus\UserHover::register' => [],
			],
		],
		'seeds' => [
			'database' => [
				'\ColdTrick\SiteAnnouncements\Seeder::register' => [],
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
