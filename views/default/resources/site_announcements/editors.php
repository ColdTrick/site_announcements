<?php
/**
 * List all announcement editors
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', \SiteAnnouncement::SUBTYPE);

// add button
elgg_register_title_button('add', 'object', \SiteAnnouncement::SUBTYPE);

// draw page
echo elgg_view_page(elgg_echo('site_announcements:editors:title'), [
	'content' => elgg_view('site_announcements/listing/editors'),
	'filter_id' => 'site_announcements',
	'filter_value' => 'editors',
	'sidebar' => false,
]);
