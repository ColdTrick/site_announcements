import 'jquery';
import Ajax from 'elgg/Ajax';

$(document).on('click', '.site-announcements-mark', function(event) {
	event.preventDefault();
	
	var ajax = new Ajax(false);
	
	var $message = $(this).closest('.elgg-message');
	$message.slideToggle();
	
	ajax.action($(this).attr('href'), {
		success: function() {
			$message.remove();
		}
	});
});
