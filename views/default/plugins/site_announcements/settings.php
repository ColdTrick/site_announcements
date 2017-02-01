<?php

/* @var $plugin ElggPlugin */
$plugin = elgg_extract('entity', $vars);

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('site_announcements:settings:archive_cleanup'),
	'#help' => elgg_echo('site_announcements:settings:archive_cleanup:help'),
	'name' => 'params[archive_cleanup]',
	'value' => $plugin->archive_cleanup,
	'min' => 0,
	'max' => 9999,
]);
