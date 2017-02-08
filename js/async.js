$(document).ready(function() {
	// async karma transaction
	$('#karma').submit(function(e){
		e.preventDefault();
		$("#ktransferbtn span").text("Transferring...  ");
		$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa-spinner fa-spin");
		var data = $(this).serialize();
		$.post( "ktransfer.php", data, function(res) {
			setTimeout(function() {
				$("#ktransferbtn span").text(res + "  ");
				if (res == "Transaction successfull!") {
					$("#ktransferbtn").removeClass().addClass("success");
					$("#ktransferbtn i").removeClass().addClass("fa fa-lg fa-fw fa fa-check");
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
	// async name suggestion
});
