<?php

namespace ColdTrick\SiteAnnouncements;

class PageHandler {
	
	/**
	 * Handler /announcements pages
	 *
	 * @param array $page url elements
	 *
	 * @return bool
	 */
	public static function announcements($page) {
		
		$includefile = false;
		$pages_path = dirname(dirname(dirname(dirname(__FILE__)))) . '/pages/';
		
		switch ($page[0]) {
			case 'all':
				$includefile = "{$pages_path}all.php";
				break;
			case 'archive':
				$includefile = "{$pages_path}archive.php";
				break;
			case 'scheduled':
				$includefile = "{$pages_path}scheduled.php";
				break;
			case 'editors':
				$includefile = "{$pages_path}editors.php";
				break;
			case 'add':
				$includefile = "{$pages_path}add.php";
				break;
			case 'edit':
				if (isset($page[1])) {
					set_input('guid', (int) $page[1]);
				}
				$includefile = "{$pages_path}edit.php";
				break;
			default:
				forward('announcements/all');
				break;
		}
		
		if (!empty($includefile)) {
			include($includefile);
			return true;
		}
		
		return false;
	}
}