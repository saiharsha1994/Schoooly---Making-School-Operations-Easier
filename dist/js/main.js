/* Session TimeOut Handler */
function sessionHandleCust(result){
	if(result=="SystemSessionTimeOut")
		location.href = 'Login';
}
/* Ajax Page Refresh */
function pageRefresh(){
	$.ajax({url: "", context: document.body, success: function(s,x){$(this).html(s);}});
}
/* A JavaScript equivalent of PHP’s urldecode */
function urldecode(str) {
  return decodeURIComponent((str + '').replace(/%(?![\da-f]{2})/gi, function(){return '%25';}).replace(/\+/g, '%20'));
}
(function(){	
	$("#parent_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});	
	$("#student_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});
	$("#bulk_up").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});
	$("#class_det").click(function () {
		alert("Feature Coming Soon Insha Allah!");
	});	
})();
function validate_pop_form(data){
	res_arr = data.split("&");						
	for(i=0;i<res_arr.length;i++){
		final_val = res_arr[i].split("=");				
		if($.trim(final_val[1]) == "" && $.trim(final_val[0]) != "Stu_Image"){
			alert("Please Fill the Mandatory Fields");				
			return false;
		}	
	}
	return true;
}	
