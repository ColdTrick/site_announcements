<?php
/**
 * List all scheduled announcements
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// add button
elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);

// build page elements
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

// draw page
echo elgg_view_page(elgg_echo('site_announcements:scheduled:title'), [
	'content' => $content,
	'filter_id' => 'site_announcements',
	'filter_value' => 'scheduled',
	'sidebar' => false,
]);
