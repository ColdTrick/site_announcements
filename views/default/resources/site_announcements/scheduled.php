<?php
/**
 * List all scheduled announcements
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);
elgg_push_breadcrumb(elgg_echo('site_announcements:scheduled'));

// add button
elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);

// build page elements
$title = elgg_echo('site_announcements:scheduled:title');

$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \SiteAnnouncement::SUBTYPE,
	'order_by_metadata' => [
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'ASC'
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'startdate',
			'value' => time(),
			'operand' => '>',
		],
	],
	'no_results' => elgg_echo('site_announcements:scheduled:none'),
]);

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter_id' => 'site_announcements',
	'sidebar' => false,
]);

// draw page
echo elgg_view_page($title, $page_data);
