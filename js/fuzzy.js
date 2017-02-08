$(document).ready(function() {
	var prop = "";
	$('#destination').keyup(function(e){
		input = $(this).val();
		fuzzy(input);
	});
	$('#destination').blur(function(){
		$(this).val(prop);
		$(this).css("background-image", "none");
	});
	function fuzzy(query){
		$.post( "fuzzy.php", {user: query}, function(res) {
			prop = res;
			var svg = "url('data:image/svg+xml;utf8,<svg width=\"300\" height=\"60\" viewBox=\"0 0 300 60\" xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\"><text x=\"20\" y=\"36\" font-size=\"20px\" font-family=\"sans-serif\" fill=\"rgba(0, 0, 0, 0.5)\">" + res + "</text></svg>')"
			if ($('#destination').val() !== "") {
				$('#destination').css({
					"background-image": svg,
					"background-position": "top left"
					});
				$(".msg").text(svg);
			} else {
				$('#destination').css("background-image", "none");
			}
		});
	};
});
