function ulp_subscribe(thisData)
{
	var user_email = $("input[name='ulp-email']").val();
	var user_name = $("input[name='ulp-name']").val();
	var api_key = $("#api_key").val();
	var camp_id = $("#camp_id").val();
	var layered_id = $("#layered_id").val();
	var awaber_auth_token = $("#awaber_auth_token").val();
	var awaber_account_id = $("#awaber_account_id").val();
	var auth_token_secret = $("#auth_token_secret").val();
	var type_data = $("#type").val();
	if(user_email!='' && user_name!=''){
		$(".blackscreen").show();
		$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
		user_email: user_email,
		user_name:user_name,
		api_key:api_key,
		camp_id:camp_id,
		layered_id:layered_id,
		type_data:type_data,
		awaber_auth_token:awaber_auth_token,
		awaber_account_id:awaber_account_id,
		auth_token_secret:auth_token_secret
		
	},			
	success: function(response) {
		alert("Subscribe successfully!");
		ulp_self_close();
		//setInterval(function(){ location.reload(); }, 2000);
		$(".blackscreen").hide();
		$(".loader_popup").hide();
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	});  
	} else 
	{
		if(user_email=='')
		{
			$("input[name='ulp-email']").css('border','1px solid red');
		}
		if(user_name=='')
		{
			$("input[name='ulp-name']").css('border','1px solid red');
		}
	}
}