<?php
/**
 * Prepend of page/elements/body to show the current site announcements
 */

$options = array(
	"type" => "object",
	"subtype" => "site_announcement",
	"limit" => false,
	"metadata_name_value_pairs" => array(
		array(
			"name" => "startdate",
			"value" => time(),
			"operand" => "<="
		),
		array(
			"name" => "enddate",
			"value" => time(),
			"operand" => ">"
		)
	),
	"order_by_metadata" => array(
		"name" => "startdate",
		"as" => "integer",
		"direction" => "ASC"
	),
	"full_view" => true,
	"pagination" => false
);

$content = elgg_list_entities_from_metadata($options);

if (!empty($content)) {
	echo "<div id='site-announcements-site'>";
	echo $content;
	echo "</div>";
}