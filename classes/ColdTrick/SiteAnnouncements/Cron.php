<?php

namespace ColdTrick\SiteAnnouncements;

/**
 * Cron listener
 */
class Cron {
	
	/**
	 * Cleanup expired announcements
	 *
	 * @param \Elgg\Event $event 'cron', 'daily'
	 *
	 * @return void
	 */
	public static function cleanupExpiredAnnouncements(\Elgg\Event $event): void {
		
		$archive_cleanup = (int) elgg_get_plugin_setting('archive_cleanup', 'site_announcements');
		if ($archive_cleanup < 1) {
			return;
		}
		
		$time = (int) $event->getParam('time', time());
		
		$options = [
			'type' => 'object',
			'subtype' => \SiteAnnouncement::SUBTYPE,
			'limit' => false,
			'metadata_name_value_pairs' => [
				'name' => 'enddate',
				'value' => $time - ($archive_cleanup * 24 * 60 * 60),
				'operand' => '<',
				'type' => ELGG_VALUE_INTEGER,
			],
			'batch' => true,
			'batch_inc_offset' => false,
		];
		
		elgg_call(ELGG_IGNORE_ACCESS, function() use ($options) {
			// cleanup
			/* @var $batch \ElggBatch */
			$batch = elgg_get_entities($options);
			
			/* @var $entity \SiteAnnouncement */
			foreach ($batch as $entity) {
				if (!$entity->delete()) {
					$batch->reportFailure();
				}
			}
		});
	}
}
