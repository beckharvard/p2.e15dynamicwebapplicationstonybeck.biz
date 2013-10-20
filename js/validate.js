
$(document).ready(function(){
  var validation =  $("#myForm").validate({
  rules: { 
           email: { required: true, email: true },
  		   password: { required: true }
       },
   errorPlacement: function(error,element) {
              error.insertAfter(element);
       }   
	});
});
