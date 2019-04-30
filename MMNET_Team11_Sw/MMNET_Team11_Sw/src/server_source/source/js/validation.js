$().ready(function() {
	$("form").validate({
		rules : {
			email : {
				required : true,
				email : true
			}
		},
		messages : {
			email : {
				required : "Email field can't be empty. Please provide your email address!",
				email : "Please provide a valid email address!"
			}
		},
		submitHandler : function(form) {
			form.submit();
		}
	});
}); 