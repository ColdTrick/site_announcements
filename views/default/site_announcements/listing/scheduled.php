<?php
/**
 * Show the scheduled Site Announcements
 */

$vars['options'] = [
	'sort_by' => [
		'property' => 'startdate',
		'direction' => 'ASC',
		'signed' => true,
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'startdate',
			'value' => time(),
			'operand' => '>',
			'as' => 'integer',
		],
	],
];

echo elgg_view('site_announcements/listing/all', $vars);
