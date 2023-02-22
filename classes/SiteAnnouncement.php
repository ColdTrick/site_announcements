<?php

/**
 * SiteAnnouncement class
 *
 * @property int    startdate         UNIX timestamp of the start of the message
 * @property int    enddate           UNIX timestamp of the end of the message
 * @property string announcement_type type of the message
 */
class SiteAnnouncement extends \ElggObject {

	const SUBTYPE = 'site_announcement';
	const READ_RELATIONSHIP = 'site_announcement_read';
	
	/**
	 * {@inheritDoc}
	 */
	protected function initializeAttributes() {
		parent::initializeAttributes();

		$this->attributes['subtype'] = self::SUBTYPE;
		$this->attributes['owner_guid'] = elgg_get_site_entity()->guid;
		$this->attributes['container_guid'] = elgg_get_site_entity()->guid;
	}
	
	/**
	 * Marks this announcement as read for the logged in user
	 *
	 * @return bool
	 */
	public function markAsRead(): bool {
		$user = elgg_get_logged_in_user_entity();
		if (!$user instanceof \ElggUser) {
			return false;
		}
		
		return $user->addRelationship($this->guid, self::READ_RELATIONSHIP);
	}
	
	/**
	 * Returns the icon name for this announcement
	 *
	 * @return string
	 */
	public function getMessageTypeIconName() {
		
		switch ($this->announcement_type) {
			case 'attention':
				return 'exclamation-triangle';
			case 'info':
				return 'info';
			case 'error':
				return 'exclamation-circle';
		}
		
		return 'bullhorn';
	}
	
	/**
	 * Returns the type label for this announcement
	 *
	 * @return string
	 */
	public function getMessageTypeLabel(): string {
		$type = $this->announcement_type ?: 'general';
		return elgg_echo("site_announcements:type:{$type}");
	}
}
