$().ready(function() {
	$("form").validate({
		rules : {
			password : {
				required : true,
				minlength : 6
			}
		},
		messages : {
			password : {
				required : "Password field can't be empty. Please provide your password!",
				minlength : "Password length can't be less than 6 characters"
			}
		},
		submitHandler : function(form) {
			form.submit();
		}
	});
}); 