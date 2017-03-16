$(document).ready(function() {
	var isOwnFeed, feed;
	if ($("#persfeed").length) {
		isOwnFeed = true;
        feed = $("#persfeed");
	} else {
		isOwnFeed = false;
        feed = $("#"); // add id of general html timeline element
	}
	loadFeed(isOwnFeed);

	function loadFeed(pub) {
		$.post( "feed.php", {public: pub}, function(res) {
            res = JSON.parse(res);
			display(res);
		});
	}

    function display(data) {
        for (var i = 0; i < data.length; i++) {
            var pub = data[i].public;
            var subject = data[i].subject;
            var time = data[i].time;
            var comment = data[i].comment;
            var amount = data[i].amount;
            var line = $("<div class='line'>")
                .append(("<div class='circle'></div>")
                .append("<div class='circle'></div>")
                .append("<div class='circle'></div>"));
            $("#feed").append(line);
            //line.appendTo(feed)// append to parent div
        }
    }
});
