<?php
/**
 * List all scheduled announcements
 */

site_announcements_editor_gatekeeper();

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('site_annoucements:scheduled'));

// add button
elgg_register_title_button();

// build page elements
$title = elgg_echo('site_annoucements:scheduled:title');

$options = array(
	'type' => 'object',
	'subtype' => SITE_ANNOUNCEMENT_SUBTYPE,
	'order_by_metadata' => array(
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'ASC'
	),
	'metadata_name_value_pairs' => array(
		array(
			'name' => 'startdate',
			'value' => time(),
			'operand' => '>'
		)
	),
	'no_results' => elgg_echo('site_annoucements:scheduled:none')
);

$content = elgg_list_entities_from_metadata($options);

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content
));

// draw page
echo elgg_view_page($title, $page_data);
