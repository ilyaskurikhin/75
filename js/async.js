$(document).ready(function() {
	// load circle on pageload
	circle(parseInt($("#karmadisplay p").html()));


	//db connection tick
	setInterval(function(){
		$.get("update.php", function(res) {
			res = JSON.parse(res);
			update(res);
		});
	}, 500);

	// on form submit
	$('#karma').submit(function(e){
		e.preventDefault();

		//Spinner animation
		$("#ktransferbtn span").text("Transferring...  ");
		$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa-spinner fa-spin");
		var data = $(this).serialize();

		// async request
		$.post("ktransfer.php", data, function(res) {
			res = JSON.parse(res);
			transaction(res);
		}).done(function() {
			// reset submit button style
			setTimeout(function() {
				$("#ktransferbtn").removeClass();
				$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa-paper-plane");
				$("#ktransferbtn span").text("Send Karma  ");
			}, 2500 );
  		});
		// clearing form & resetting focus
		$(this).children("input").val("");
		$(this).children("input").focus().first().focus();
	});

	// on update
	function update(asyncdata){
		if (asyncdata.update == 'true') {
			// TODO transaction alert (ex. :"/user/ sent you karma!")
			display(asyncdata.points, asyncdata.oldpoints);
		}
	};

	// form animation
	function transaction(asyncdata) {
		var message = asyncdata.message;

		// spinner / checkmark animation and delay
		setTimeout(function() {
			$("#ktransferbtn span").text(message + "  ");
			if (asyncdata.success == 'true') {
				// change spinner to success
				$("#ktransferbtn").removeClass().addClass("success");
				$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa fa-check");
				display(asyncdata.points, asyncdata.oldpoints);
			} else {
				// change spinner to fail
				$("#ktransferbtn").removeClass().addClass("fail");
				$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa fa-times");
			}
		}, 1000 );
	}

	// karma animations
	function display (newpoints, oldpoints) {
		var kdp = $("#karmadisplay p");
		var iterator = Math.abs(newpoints - oldpoints);
		var timing = 1500 / iterator;
		if (timing < 10) {
			timing = 10;
		}
		var id = setInterval(count, timing);
  		function count() {
			if (oldpoints < newpoints) {
				oldpoints++;
			} else {
				oldpoints--;
			}
			kdp.html(oldpoints);
			circle(oldpoints);
			if (oldpoints == newpoints){
				clearInterval(id);
			}
		}
	};

	// circle draw animation
	function circle (karma) {
		var max = 100;
		if (karma > max) {
			$("#karmadisplay").css({
				"box-shadow": "inset 0 0 0 5px rgb(210, 245, 255)"
			});
			var clr = "#76db99";
		} else if (karma < max) {
			$("#karmadisplay").css({
				"box-shadow": "inset 0 0 0 5px rgba(210, 245, 255, 0.2)"
			});
			karma += max;
			var clr = "rgb(210, 245, 255)";
		} else {
			$("#karmadisplay").css({
				"box-shadow": "inset 0 0 0 5px rgb(210, 245, 255)"
			});
			$('#display .pointer1').css({"opacity": "0", "transform": "rotate(90deg) skew(0deg)"});
			$('#display .pointer2').css({"opacity": "0", "transform": "rotate(180deg) skew(0deg)"});
			$('#display .pointer3').css({"opacity": "0", "transform": "rotate(270deg) skew(0deg)"});
			$('#display .pointer4').css({"opacity": "0", "transform": "skew(0deg)"});
		}
		if (karma > max && karma <= (max * 5 / 4)) {
			var skew = 90 - Math.floor(3.6 * (karma - max));
			$('#display .pointer1').css({
				"transform": "rotate(90deg) skew(" + skew + "deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer2').css({"opacity": "0", "transform": "rotate(180deg) skew(0deg)"});
			$('#display .pointer3').css({"opacity": "0", "transform": "rotate(270deg) skew(0deg)"});
			$('#display .pointer4').css({"opacity": "0", "transform": "skew(0deg)"});
		} else if (karma > (max * 5 / 4) && karma <= (max * 3 / 2)) {
			var skew = 180 - (3.6 * (karma - max));
			$('#display .pointer1').css({
				"transform": "rotate(90deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer2').css({
				"transform": "rotate(180deg) skew(" + skew + "deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer3').css({"opacity": "0", "transform": "rotate(270deg) skew(0deg)"});
			$('#display .pointer4').css({"opacity": "0", "transform": "skew(0deg)"});
		} else if (karma > (max * 3 / 2) && karma <= (max * 7 / 4)) {
			var skew = 270 - (3.6 * (karma - max));
			$('#display .pointer1').css({
				"transform": "rotate(90deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer2').css({
				"transform": "rotate(180deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer3').css({
				"transform": "rotate(270deg) skew(" + skew + "deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer4').css({"opacity": "0", "transform": "skew(0deg)"});
		} else if (karma > (max * 7 / 4) && karma <= (max * 2)) {
			var skew = 360 - Math.round(3.6 * (karma - max));
			$('#display .pointer1').css({
				"transform": "rotate(90deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer2').css({
				"transform": "rotate(180deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer3').css({
				"transform": "rotate(270deg)",
				"background-color": clr,
				"opacity": "1"
			});
			$('#display .pointer4').css({
				"transform": "skew(" + skew + "deg)",
				"background-color": clr,
				"opacity": "1"
			});
		}
	}
});
