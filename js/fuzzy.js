$(document).ready(function() {
	var prop = "";
	$('#destination').keyup(function(e){
		input = $(this).val();
		fuzzy(input);
	});
	$('#destination').blur(function(){
		$(this).val(prop);
		$('#fuzzy').text("");
	});
	function fuzzy(query){
		$.post( "fuzzy.php", {user: query}, function(res) {
			if (res !== ""){
				prop = res;
				for (var i = 0; i < query.length; i++) {
					res = query + res.substring(query.length);
				}
			}
			if (input !== "") {
				$('#fuzzy').text(res);
			} else {
				$('#destination').val("");
			}
			$('#fuzzy').text(res);
		});
	};
});
