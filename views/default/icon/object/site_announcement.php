<?php
/**
 * Overrule the default icon view for this entity
 *
 * @uses $vars['entity'] the entity to view the icon of
 * @uses $vars['size'] the size of the icon to view
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ColdTrick\SiteAnnouncements\SiteAnnouncement) {
	return;
}

$icon_type = $entity->announcement_type ?: 'hand-point-right';
$title = '';

if (empty($icon_type)) {
	$icon_type = 'hand-point-right';
	$title = elgg_echo('site_announcements:type:general');
} elseif (elgg_language_key_exists("site_announcements:type:{$icon_type}")) {
	$title = elgg_echo("site_announcements:type:{$icon_type}");
}

echo elgg_view_icon($icon_type, [
	'class' => 'site-announcements-icon',
	'title' => $title,
]);
