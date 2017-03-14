$(document).ready(function() {
	var isOwnFeed;
	if ($("#persfeed")) {
		isOwnFeed = false;
	} else {
		isOwnFeed = true;
	}
	loadFeed(isOwnFeed);

	function loadFeed(public) {
		$.post( "feed.php", {public: public}, function(res) {

		});
	}
});
