
$(document).ready(function(){

	// validate signup form on keyup and submit
	$("#myForm").validate({
		rules: {
			first_name: {
				required: true,
				minlength: 1
			},
			last_name: {
				required: true,
				minlength: 1
			},
			password: {
				required: true,
				minlength: 4
			},
			confirm_password: {
				required: true,
				minlength: 4,
				equalTo: "#password"
			},
			email: {
				required: true,
				email: true
			},
		},
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 4 characters long"
			},
			confirm_password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 4 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
		
		}
	});
});

