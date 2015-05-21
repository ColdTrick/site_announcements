<?php
/**
 * List all past announcements
 */

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('site_annoucements:archive'));

// add button
if (site_announcements_is_editor()) {
	elgg_register_title_button();
}

// build page elements
$title = elgg_echo('site_annoucements:archive:title');

$options = array(
	'type' => 'object',
	'subtype' => SITE_ANNOUNCEMENT_SUBTYPE,
	'order_by_metadata' => array(
		'name' => 'enddate',
		'as' => 'integer',
		'direction' => 'DESC'
	),
	'metadata_name_value_pairs' => array(
		array(
			'name' => 'enddate',
			'value' => time(),
			'operand' => '<'
		)
	),
	'no_results' => elgg_echo('site_annoucements:archive:none')
);

$content = elgg_list_entities_from_metadata($options);

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content
));

// draw page
echo elgg_view_page($title, $page_data);
