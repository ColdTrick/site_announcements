<?php
/**
 * List all scheduled announcements
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// add button
elgg_register_title_button('add', 'object', \SiteAnnouncement::SUBTYPE);

// draw page
echo elgg_view_page(elgg_echo('site_announcements:scheduled:title'), [
	'content' => elgg_view('site_announcements/listing/scheduled'),
	'filter_id' => 'site_announcements',
	'filter_value' => 'scheduled',
	'sidebar' => false,
]);
