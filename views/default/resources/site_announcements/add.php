<?php
/**
 * create a new site announcement
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);
elgg_push_breadcrumb(elgg_echo('add'));

// build page elements
$title = elgg_echo('site_announcements:add:title');

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => elgg_view_form('site_announcements/edit'),
	'filter_id' => 'site_announcements/add',
	'sidebar' => false,
]);

// draw page
echo elgg_view_page($title, $page_data);
