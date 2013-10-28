
$(document).ready(function(){
  var validation =  $("#myPost").validate({
  rules: { 
           content: { required: true, content: true },
       },
   errorPlacement: function(error,element) {
              error.insertAfter(element);
       }   
	});
});
