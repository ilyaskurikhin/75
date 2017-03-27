$(document).ready(function() {
	var pubFeed, feed, feedType;
	if ($("#persFeed").length) {
		pubFeed = false;
        feed = $("#persFeed");
        feedType = smallFeed;
	} else {
		pubFeed = true;
        feed = $("#timeline"); // add id of general html timeline element
        feedType = bigFeed;
	}
	loadFeed(pubFeed, feedType);

	function loadFeed(pub, callback) {
		$.post( "feed.php", {public: pub}, function(res) {
            res = JSON.parse(res);
			callback(res);
		});
	}

    function smallFeed(data) {
        for (var i = 0; i < data.length; i++) {
            var subject = "<div class='name'>" + data[i].subject + "</div>";
            var commenttext = data[i].comment;
            if (commenttext == "") {
                commenttext = "no comment";
            }
            var comment = "<div class='comment'><p>" + commenttext + "</p></div>";
            var sqltimestamp = data[i].time;
            var timestamp = sqltimestamp.substr(0, 10).split(/[-]/);
            var datestring = timestamp.join('-');
            var date = new Date(datestring);
            var formatteddate = date.getDate() + "/" + (date.getMonth() + 1);
            var time = "<div class='timestamp'>" + formatteddate + "</div>";
            if (data[i].amount > 0) {
                var amount = "<div class='points pos'>" + data[i].amount + "</div>";
            } else {
                var amount = "<div class='points neg'>" + data[i].amount + "</div>";
            }
            var line = $("<div class='line'>")
                .append("<div class='circle'>")
                .append(subject)
                .append(comment)
                .append(time)
                .append(amount);
            feed.append(line);
        }
    }

    function bigFeed(data) {
        for (var i = 0; i < data.length; i++) {
            var subject = "<div class='name'>" + data[i].subject + "</div>";
            var time = data[i].time;
            var commenttext = data[i].comment;
            if (commenttext == "") {
                commenttext = "no comment";
            }
            var comment = "<div class='comment'><p>" + commenttext + "</p></div>";
            if (data[i].amount > 0) {
                var amount = "<div class='points pos'>" + data[i].amount + "</div>";
            } else {
                var amount = "<div class='points neg'>" + data[i].amount + "</div>";
            }
            var line = $("<div class='line'>")
                .append("<div class='circle'>")
                .append("<div class='circle2'>")
                .append(subject)
                .append(comment)
                .append(amount);
            feed.append(line);
        }
    }
});
