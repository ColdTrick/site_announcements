<?php

namespace ColdTrick\SiteAnnouncements;

use Elgg\Database\Seeds\Seed;
use Elgg\Exceptions\Seeding\MaxAttemptsException;

/**
 * Database seeder
 */
class Seeder extends Seed {
	
	protected array $announcement_types = [
		'general',
		'info',
		'attention',
		'error',
	];
	
	/**
	 * {@inheritDoc}
	 */
	public function seed() {
		$this->advance($this->getCount());
		
		$site = elgg_get_site_entity();
		
		while ($this->getCount() < $this->limit) {
			$time_created = $this->getRandomCreationTimestamp();
			$startdate = $this->getTimestamp($time_created);
			$enddate = $this->getTimestamp($startdate);
			
			try {
				/* @var $entity \SiteAnnouncement */
				$entity = $this->createObject([
					'subtype' => \SiteAnnouncement::SUBTYPE,
					'owner_guid' => $site->guid,
					'container_guid' => $site->guid,
					'time_created' => $time_created,
					'startdate' => $startdate,
					'enddate' => $enddate,
					'announcement_type' => $this->getRandomAnnouncementType(),
				]);
			} catch (MaxAttemptsException $e) {
				// unable to create with the given options
				continue;
			}
			
			// undo some seeding stuff
			unset($entity->title);
			
			$this->advance();
		}
	}
	
	/**
	 * {@inheritDoc}
	 */
	public function unseed() {
		/* @var $entities \ElggBatch */
		$entities = elgg_get_entities([
			'type' => 'object',
			'subtype' => \SiteAnnouncement::SUBTYPE,
			'metadata_name' => '__faker',
			'limit' => false,
			'batch' => true,
			'batch_inc_offset' => false,
		]);
		
		/* @var $entity \SiteAnnouncement */
		foreach ($entities as $entity) {
			if ($entity->delete()) {
				$this->log("Deleted site announcement {$entity->guid}");
			} else {
				$this->log("Failed to delete site announcement {$entity->guid}");
				$entities->reportFailure();
				continue;
			}
			
			$this->advance();
		}
	}
	
	/**
	 * {@inheritDoc}
	 */
	public static function getType(): string {
		return \SiteAnnouncement::SUBTYPE;
	}
	
	/**
	 * {@inheritDoc}
	 */
	protected function getCountOptions(): array {
		return [
			'type' => 'object',
			'subtype' => \SiteAnnouncement::SUBTYPE,
		];
	}
	
	/**
	 * Get a random announcement type
	 *
	 * @return string
	 */
	protected function getRandomAnnouncementType(): string {
		$key = array_rand($this->announcement_types);
		
		return $this->announcement_types[$key];
	}
	
	/**
	 * Get a random timestamp
	 *
	 * @param int $min_date lower bound timestamp
	 *
	 * @return int
	 */
	protected function getTimestamp(int $min_date): int {
		$create_since = $this->create_since;
		$this->create_since = $min_date;
		
		$result = $this->getRandomCreationTimestamp();
		
		$this->create_since = $create_since;
		
		return $result;
	}
}
