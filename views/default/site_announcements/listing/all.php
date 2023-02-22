<?php
/**
 * Generic listing for Site Announcements
 *
 * @uses $vars['options'] additional options for the listing
 */

$defaults = [
	'type' => 'object',
	'subtype' => \SiteAnnouncement::SUBTYPE,
	'full_view' => false,
	'sort_by' => [
		'property' => 'startdate',
		'direction' => 'DESC',
		'signed' => true,
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'startdate',
			'value' => time(),
			'operand' => '<=',
			'as' => 'integer',
		],
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '>',
			'as' => 'integer',
		]
	],
	'no_results' => elgg_echo('site_announcements:all:none'),
	'distinct' => false,
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

echo elgg_list_entities($options);
