<?php

namespace ColdTrick\SiteAnnouncements\Forms;

use Elgg\Values;

/**
 * Prepare form vars for the site_announcements/edit form
 */
class PrepareFields {
	
	/**
	 * Prepare fields
	 *
	 * @param \Elgg\Event $event 'form:prepare:fields', 'site_announcements/edit'
	 *
	 * @return array
	 */
	public function __invoke(\Elgg\Event $event): array {
		$vars = $event->getValue();
		
		// input names => defaults
		$startdate = Values::normalizeTime('now');
		$enddate = Values::normalizeTime('+7 days');
		
		$values = [
			'description' => null,
			'startdate' => $startdate->getTimestamp(),
			'enddate' => $enddate->getTimestamp(),
			'announcement_type' => null,
			'access_id' => ACCESS_DEFAULT,
			'container_guid' => null,
			'guid' => null,
		];
		
		$entity = elgg_extract('entity', $vars);
		if ($entity instanceof \SiteAnnouncement) {
			// load current announcement values
			foreach (array_keys($values) as $field) {
				if (!isset($entity->$field)) {
					continue;
				}
				
				$values[$field] = $entity->$field;
				
				switch ($field) {
					case 'startdate':
						$startdate = Values::normalizeTime($entity->$field);
						break;
					case 'enddate':
						$enddate = Values::normalizeTime($entity->$field);
						break;
				}
			}
		}
		
		$values['starthour'] = $startdate->format('G');
		$values['startmins'] = $startdate->format('i');
		$values['endhour'] = $enddate->format('G');
		$values['endmins'] = $enddate->format('i');
		
		return array_merge($values, $vars);
	}
}
