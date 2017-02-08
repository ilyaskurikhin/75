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
			prop = res;
			if ($('#destination').val() !== "") {
				$('#fuzzy').text(res);
			} else {
				$('#fuzzy').text("");
			}
		});
	};
});
