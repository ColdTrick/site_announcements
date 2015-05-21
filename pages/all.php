<?php
/**
 * List all currently active announcements
 */

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'));

// add button
if (site_announcements_is_editor()) {
	elgg_register_title_button();
}

// build page elements
$title = elgg_echo('site_annoucements:all:title');

$options = array(
	'type' => 'object',
	'subtype' => SITE_ANNOUNCEMENT_SUBTYPE,
	'order_by_metadata' => array(
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'DESC'
	),
	'metadata_name_value_pairs' => array(
		array(
			'name' => 'startdate',
			'value' => time(),
			'operand' => '<='
		),
		array(
			'name' => 'enddate',
			'value' => time(),
			'operand' => '>'
		)
	),
	'no_results' => elgg_echo('site_annoucements:all:none')
);

$content = elgg_list_entities_from_metadata($options);

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content
));

// draw page
echo elgg_view_page($title, $page_data);
