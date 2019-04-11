<?php
/**
 * List all announcement editors
 */

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_announcements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('site_announcements:editors'));

// add button
elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);

// build page elements
$title = elgg_echo('site_announcements:editors:title');

// get correct users
$content = elgg_list_entities([
	'type' => 'user',
	'metadata_name_value_pair' => ['admin' => 'yes'],
	'limit' => false,
	'no_results' => elgg_echo('site_announcements:editors:none'),
]);

/*
 * or guid IN
 * guids with the plugin settings
 * 	'plugin_id' => 'site_announcements',
	'plugin_user_setting_name' => 'editor',
 */

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter_id' => 'site_announcements',
	'sidebar' => false,
]);

// draw page
echo elgg_view_page($title, $page_data);
