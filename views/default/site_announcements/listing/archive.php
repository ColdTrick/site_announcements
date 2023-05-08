<?php
/**
 * Show archived Site Announcements
 */

$vars['options'] = [
	'sort_by' => [
		'property' => 'enddate',
		'direction' => 'DESC',
		'signed' => true,
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '<',
			'type' => ELGG_VALUE_INTEGER,
		],
	],
];

echo elgg_view('site_announcements/listing/all', $vars);
