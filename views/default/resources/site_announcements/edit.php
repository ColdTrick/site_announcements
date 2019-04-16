<?php
/**
 * edit a new site announcement
 */

// get entity
$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', \SiteAnnouncement::SUBTYPE);

$entity = get_entity($guid);

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);
elgg_push_breadcrumb(elgg_echo('edit'));

// build page elements
$title = elgg_echo('site_announcements:edit:title');

$content = elgg_view_form('site_announcements/edit', [], ['entity' => $entity]);

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'filter_id' => 'site_announcements/edit',
	'sidebar' => false,
]);

// draw page
echo elgg_view_page($title, $page_data);
