<?php
/**
 * create a new site announcement
 */

// only for editors
site_announcements_editor_gatekeeper();

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('add'));

// build page elements
$title = elgg_echo('site_annoucements:add:title');

$content = elgg_view_form('site_announcements/edit');

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content,
	'filter' => ''
));

// draw page
echo elgg_view_page($title, $page_data);
