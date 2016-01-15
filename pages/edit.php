<?php
/**
 * edit a new site announcement
 */

// only for editors
site_announcements_editor_gatekeeper();

// get entity
$guid = (int) get_input('guid');
elgg_entity_gatekeeper($guid, 'object', SITE_ANNOUNCEMENT_SUBTYPE);

$entity = get_entity($guid);

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('edit'));

// build page elements
$title = elgg_echo('site_annoucements:edit:title');

$content = elgg_view_form('site_announcements/edit', array(), array('entity' => $entity));

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter' => ''
));

// draw page
echo elgg_view_page($title, $page_data);
