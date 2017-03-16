$(document).ready(function() {
	var pubFeed, feed;
	if ($("#persFeed").length) {
		pubFeed = false;
        feed = $("#persFeed");
	} else {
		pubFeed = true;
        feed = $("#"); // add id of general html timeline element
	}
	loadFeed(pubFeed);

	function loadFeed(pub) {
		$.post( "feed.php", {public: pub}, function(res) {
            res = JSON.parse(res);
			display(res);
		});
	}

    function display(data) {
        for (var i = 0; i < data.length; i++) {
            var subject = "<div class='name'>" + data[i].subject + "</div>";
            var time = data[i].time;
            var comment = "<div class='comment'>" + data[i].comment + "</div>";
            if (data[i].amount > 0) {
                var amount = "<div class='points pos'>" + data[i].amount + "</div>";
            } else {
                var amount = "<div class='points neg'>" + data[i].amount + "</div>";
            }
            var line = $("<div class='line'>")
                .append("<div class='circle'>")
                .append(subject)
                .append(comment)
                .append(amount);
            feed.append(line);
        }
    }
});
