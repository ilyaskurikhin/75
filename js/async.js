$(document).ready(function() {
	// async karma transaction
	$('#karma').submit(function(e){
		e.preventDefault();
		$("#ktransferbtn span").text("Transferring...  ");
		$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa-spinner fa-spin");
		var data = $(this).serialize();
		$.post( "ktransfer.php", data, function(res) {
			res = JSON.parse(res);
			var message = res.message;
			setTimeout(function() {
				$("#ktransferbtn span").text(message + "  ");
				if (Object.keys(res).length == 2) {
					$("#ktransferbtn").removeClass().addClass("success");
					$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa fa-check");
					$("#karmadisplay").html(res.karma);
				} else {
					$("#ktransferbtn").removeClass().addClass("fail");
					$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa fa-times");
				}
			}, 1000 );
		}).done(function() {
			setTimeout(function() {
				$("#ktransferbtn").removeClass();
				$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa-exchange");
				$("#ktransferbtn span").text("Transfer Karma  ");
			}, 2500 );
  		});
		$(this).children("input").val("");
		$(this).children("input").focus().first().focus();
	});
});
