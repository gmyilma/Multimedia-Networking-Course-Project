$().ready(function() {
	$("form").validate({
		rules : {
			fullName: "required",
			email : {
				required : true,
				email : true
			},
			password: {
				required: true,
				minlength: 6
			},
			cPassword : {
				required: true,
				minlength: 6,
				equalTo: "#password"
			}
		},
		messages : {
			fullName: "Full Name field can't be empty. Please provide your full name!",
			email : {
				required : "Email field can't be empty. Please provide your email address!",
				email : "Please provide a valid email address!"
			},
			
			password: {
				required: "Password field can't be empty. Please provide your password!",
				minlength: "Password length can't be less than 6 characters!"
			},
			cPassword: {
				required: "Password field can't be empty. Please provide your password!",
				minlength: "Password length can't be less than 6 characters!",
				equalTo: "Please enter the same password"
			}
		},
		submitHandler : function(form) {
			form.submit();
		}
	});
}); 