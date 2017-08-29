<?php

namespace ColdTrick\SiteAnnouncements;

class Cron {
	
	/**
	 * Cleanup expired announcements
	 *
	 * @param string $hook         the name of the hook
	 * @param string $type         the type of the hook
	 * @param mixed  $return_value current return value
	 * @param arary  $params       supplied params
	 *
	 * @return void
	 */
	public static function cleanupExpiredAnnouncements($hook, $type, $return_value, $params) {
		
		$archive_cleanup = (int) elgg_get_plugin_setting('archive_cleanup', 'site_announcements');
		if ($archive_cleanup < 1) {
			return;
		}
		
		echo 'Stating SiteAnnouncements cleanup' . PHP_EOL;
		elgg_log('Stating SiteAnnouncements cleanup', 'NOTICE');
		
		$time = (int) elgg_extract('time', $params, time());
		
		$options = [
			'type' => 'object',
			'subtype' => SITE_ANNOUNCEMENT_SUBTYPE,
			'limit' => false,
			'metadata_name_value_pairs' => [
				'name' => 'enddate',
				'value' => $time - ($archive_cleanup * 24 * 60 * 60),
				'operand' => '<',
				
			],
		];
		
		// ignore access
		$ia = elgg_set_ignore_access(true);
		
		// cleanup
		$batch = new \ElggBatch('elgg_get_entities_from_metadata', $options, 'elgg_batch_delete_callback', 25, false);
		
		// restore access
		elgg_set_ignore_access($ia);
		
		echo 'Done with SiteAnnouncements cleanup' . PHP_EOL;
		elgg_log('Done with SiteAnnouncements cleanup', 'NOTICE');
	}
}
