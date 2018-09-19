<?php
use ColdTrick\SiteAnnouncements\Gatekeeper;

/**
 * List all currently active announcements
 */

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_announcements'));

// add button
if (Gatekeeper::isEditor()) {
	elgg_register_title_button();
}

// build page elements
$title = elgg_echo('site_announcements:all:title');

$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \ColdTrick\SiteAnnouncements\SiteAnnouncement::SUBTYPE,
	'order_by_metadata' => [
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'DESC',
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'startdate',
			'value' => time(),
			'operand' => '<=',
		],
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '>',
		]
	],
	'no_results' => elgg_echo('site_announcements:all:none'),
]);

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'filter_id' => 'site_announcements',
	'filter_value' => 'all',
	'content' => $content,
	'sidebar' => false,
]);

// draw page
echo elgg_view_page($title, $page_data);
