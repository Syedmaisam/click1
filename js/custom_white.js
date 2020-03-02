function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
function signupuser()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	
	var name=$("#name").val();
	var mailaddress=$("#mailaddress").val();
	var pword=$("#pword").val();
	var repword=$("#repword").val();


	if(name!='' && mailaddress!='' && pword!='' && repword!='' && isValidEmailAddress( mailaddress ) && pword==repword)
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/user/adduser.php',
			data: {
				name: name,
				mailaddress: mailaddress,
				pword: pword,
				submit:"save"
			},			
			success: function(response) {
				//alert(response);
				//$("#message").html(response);
				campurl = SITE_ROOT_URL+'login.php';
if(response=="reg")
	{
	$(".alrtsuccess p").html("User Created successfully...");
	$(".alrtsuccess").removeClass("alert-danger");
	$(".alrtsuccess").addClass("alert-success");
	$(".alrtsuccess").show();
	
	}
	if(response=="notreg")
	{
		$(".alrtsuccess p").html("User Already Registered...");
		$(".alrtsuccess").removeClass("alert-success");
		$(".alrtsuccess").addClass("alert-danger");
		$(".alrtsuccess").show();
	}
				window.location.assign(campurl);
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{
		$(".blackscreen").hide();
		$(".loader_popup").hide();

		(name!='')?$("#name_req").hide():$("#name_req").show();
		(mailaddress!='')?$("#mailaddress_req").hide():$("#mailaddress_req").show();
		if(!isValidEmailAddress( mailaddress )){$("#mailaddress_confirm").show()} else { $("#mailaddress_confirm").hide()};
		(pword!='')?$("#pword_req").hide():$("#pword_req").show();
		(repword!='')?$("#repword_req").hide():$("#repword_req").show();
		(pword!=repword)?$("#repword_req_confirm").show():$("#repword_req_confirm").hide();
		

	}
}

function signuptrialuser()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	
	var name=$("#name").val();
	var mailaddress=$("#mailaddress").val();
	var pword=$("#pword").val();
	var repword=$("#repword").val();
	var reqtoken=$("#reqtoken").val();


	if(name!='' && mailaddress!='' && pword!='' && repword!='' && isValidEmailAddress( mailaddress ) && pword==repword)
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/user/adduser.php',
			data: {
				name: name,
				mailaddress: mailaddress,
				pword: pword,
				reqtoken:reqtoken,
				submit:"savetrial"
			},			
			success: function(response) {
				//alert(response);
				//$("#message").html(response);
				campurl = SITE_ROOT_URL+'login.php';
if(response=="reg")
	{
	$(".alrtsuccess p").html("User Created successfully...");
	$(".alrtsuccess").removeClass("alert-danger");
	$(".alrtsuccess").addClass("alert-success");
	$(".alrtsuccess").show();
	
	}
	if(response=="notreg")
	{
		$(".alrtsuccess p").html("User Already Registered...");
		$(".alrtsuccess").removeClass("alert-success");
		$(".alrtsuccess").addClass("alert-danger");
		$(".alrtsuccess").show();
	}
				window.location.assign(campurl);
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{
		$(".blackscreen").hide();
		$(".loader_popup").hide();

		(name!='')?$("#name_req").hide():$("#name_req").show();
		(mailaddress!='')?$("#mailaddress_req").hide():$("#mailaddress_req").show();
		if(!isValidEmailAddress( mailaddress )){$("#mailaddress_confirm").show()} else { $("#mailaddress_confirm").hide()};
		(pword!='')?$("#pword_req").hide():$("#pword_req").show();
		(repword!='')?$("#repword_req").hide():$("#repword_req").show();
		(pword!=repword)?$("#repword_req_confirm").show():$("#repword_req_confirm").hide();
		

	}
}

function verifylogin()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	
	var usermail=$("#mailid").val();
	var upassword=$("#pword").val();
	
	if(usermail!='' && upassword!='')
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/user/adduser.php',
			data: {
				usermail: usermail,
				upassword:upassword,
				submit:"login"
			},			
			success: function(response) {
				
				
				var obj=$.parseJSON(response);
				if(obj.msg=="trialuser")
					{
					var loc=SITE_ROOT_URL+'index.php';
					window.location.assign(loc);
					//window.location.assign(obj.url);
					}
				else if (obj.msg=="success") {
		
					var loc=SITE_ROOT_URL;
					window.location.assign(loc);
					}
				else
					{
					$(".alrtsuccess p").html("Invalid Credentials...");
					$(".alrtsuccess").addClass("alert-danger");
					$(".alrtsuccess").show();
					}
				//alert(response);
				//$("#message").html(response);
				//campurl = location.protocol + '//' + location.host+'/click/views/campaign/campaignNext.php/'+response+"/0/"+campaignProfile;

				//window.location.assign(campurl);
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{
		$(".blackscreen").hide();
		$(".loader_popup").hide();
		(usermail!='')?$("#usermail_req").hide():$("#usermail_req").show();
		(upassword!='')?$("#upassword_req").hide():$("#upassword_req").show();
	}
}
function sidehovertxt()
{
	var bkgcolor=$(".sidebartxthovercolor").css("background-color");
	$(".sidebar-menu .active a").css("background-color",bkgcolor);
}
function tpbgcolor()
{
	
var bkgcolor=$(".tpbgcolor").css("background-color");
					
$(".skin-blue .navbar").css("background-color",bkgcolor);

}
function logobgcolor()
{
	
var bkgcolor=$(".logobgcolor").css("background-color");
					
$(".skin-blue .logo").css("background-color",bkgcolor);
$(".navbar-right").css("background-color",bkgcolor);


}
function sidebarbgcolor()
{
	
var bkgcolor=$(".sidebarbgcolor").css("background-color");
					
$(".skin-blue .left-side").css("background-color",bkgcolor);

}
function sidebartxtcolor()
{
	
var bkgcolor=$(".sidebartxtcolor").css("background-color");
					
$(".skin-blue .sidebar a").css("color",bkgcolor);

}
function treeviewcl()
{
	
var bkgcolor=$(".treeviewcl").css("background-color");
			
$(".treeview-menu").css("background-color",bkgcolor);

}
function savesettings()
{
	var logoType=$("#logoType").val();
	var logoTxt=$("#logoTxt").val();
	var logoTxtColor=$("#logoTxtColor").css("background-color");
	var tpbgcolor=$(".tpbgcolor").css("background-color");
	var tpbartxtcolor=$(".tpbartxtcolor").css("background-color");
	var tpbarhovertxt=$(".treeviewcl").css("background-color");
	var sidebarbgcolor=$(".sidebarbgcolor").css("background-color");
	var sidebartxtcolor=$(".sidebartxtcolor").css("background-color");
	var sidebartxthovercolor=$(".sidebartxthovercolor").css("background-color");
	var copytxtcolor=$(".copytxtcolor").css("background-color");
	var logobgcolor=$(".logobgcolor").css("background-color");
	var loginpagbg=$(".loginpagbg").css("background-color");
	var appname=$(".appname").val();
	var adminmail=$(".adminmail").val();
	var signupstatus=$(".signupstatus").parent().attr('aria-checked');
	var signuptoken=$(".signuptoken").val();
	var supportlink=$(".supportlink").val();
	var trialstatus=$(".activetrial").val();
	var trialdays=$(".setnumdays").val();
	var endurl=$(".endtrialurl").val();
	var trialcode=$(".trialtoken").val();

	var setdata = $(".activetrial").parent().attr('aria-checked');
	if(signupstatus=='true')
{
signupstatus="Signup Enabled";
}
else
{
signupstatus="Signup Disabled";
}

	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			logoType: logoType,
			logoTxt:logoTxt,
			logoTxtColor:logoTxtColor,
			tpbgcolor:tpbgcolor,
			tpbartxtcolor:tpbartxtcolor,
			tpbarhovertxt:tpbarhovertxt,
			sidebarbgcolor:sidebarbgcolor,
			sidebartxtcolor:sidebartxtcolor,
			sidebartxthovercolor:sidebartxthovercolor,
			copytxtcolor:copytxtcolor,
			logobgcolor:logobgcolor,
			loginpagbg:loginpagbg,
			appname:appname,
			adminmail:adminmail,
			signupstatus:signupstatus,
			signuptoken:signuptoken,
			supportlink:supportlink,
			trialstatus:setdata,
			trialdays:trialdays,
			endurl:endurl,
			trialcode:trialcode,
			submit:"savesettings"
		},			
		success: function(response) {
			$(".altmsg").show();
			//$("#message").html(response);
			campurl = SITE_ROOT_URL+'views/settings/';

			window.location.assign(campurl);
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 

}
function genrandom()
{
	var key=$(".signuptoken").val();

		

$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			randomkey: key,
			submit:"checkrandomkey"
		},			
		success: function(response) {
var res=response;
			if(response!=key)
{
$(".thankyoupage").val(SITE_ROOT_URL+'registration.php?regcode='+key);
$(".btn-success").click();
}
			
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
	
}
function genrandomtrial()
{
	var key=$(".trialtoken").val();
		


$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			randomkey: key,
			submit:"checkrandomkeytrial"
		},			
		success: function(response) {
var res=response;
			if(response!=key)
{
$(".thankyoupagetrial").val(SITE_ROOT_URL+'trialregistration.php?regcode='+key);
$(".btn-success").click();
}
			
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
	
	
}
function randomkey()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 50; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function updateuser(id)
{
	var fullname=$("#fullname").val();
	var passw=$("#passw").val();
	
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			fullname: fullname,
			passw:passw,
			uid:id,
			submit:"upduser"
		},			
		success: function(response) {
				$(".alrtsuccess").show();
			//$("#message").html(response);
			//campurl = location.protocol + '//' + location.host+'/click/views/campaign/campaignNext.php/'+response+"/0/"+campaignProfile;

			//window.location.assign(campurl);
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}
function delrec(id)
{
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			id: id,
			submit:"delrec"
		},			
		success: function(response) {
				//$(".alrtsuccess").show();
			//$("#message").html(response);
			//campurl = location.protocol + '//' + location.host+'/click/views/campaign/campaignNext.php/'+response+"/0/"+campaignProfile;

			window.location.reload();
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 

}

function login_subuser(id)
{
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			id: id,
			submit:"loginsubuser"
		},			
		success: function(response) {
			//alert(response);
				//$(".alrtsuccess").show();
			//$("#message").html(response);
			var campurl = SITE_ROOT_URL;

			window.location.assign(campurl);
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 

}
function backtoadmin()
{
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/user/adduser.php',
		data: {
			
			submit:"backtoadmin"
		},			
		success: function(response) {
			
				//$(".alrtsuccess").show();
			//$("#message").html(response);
			var campurl = SITE_ROOT_URL;

			window.location.assign(campurl);
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}
function setupapp()
{
	$(".blackscreen").show();
	$(".loader_popup").show();

var adminemail=$("#adminemail").val();
var adminpass=$("#adminpass").val();
if(adminemail!='' && adminpass!='')
{
$.ajax({
	type: "post",
	url: SITE_ROOT_URL+'ajax/user/adduser.php',
	data: {
		
		adminemail:adminemail,
		adminpass:adminpass,
		submit:"installadmin"
	},			
	success: function(response) {
		
			//alert(response);
	
		var campurl = SITE_ROOT_URL;

		window.location.assign(campurl);
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
}); 
}
else
	{
	$(".blackscreen").hide();
	$(".loader_popup").hide();
	
	(adminemail!='')?$("#adminemail_req").hide():$("#adminemail_req").show();
	(adminpass!='')?$("#adminpass_req").hide():$("#adminpass_req").show();
	
	}

}

function sendpasword()
{
$(".blackscreen").show();
	$(".loader_popup").show();
	
	var usermail=$("#mailid").val();
	
	
	if(usermail!='')
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/user/adduser.php',
			data: {
				usermail: usermail,
				submit:"recoverpassword"
			},			
			success: function(response) {
				
				if(response=="nosent")
                                    {
				
					$(".alrtsuccess p").html("Invalid user details");
					$(".alrtsuccess").addClass("alert-danger");
					$(".alrtsuccess").show();
                                     }
else
{
var campurl = SITE_ROOT_URL+'login.php';
window.location.assign(campurl );
}
					
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{
		$(".blackscreen").hide();
		$(".loader_popup").hide();
		(usermail!='')?$("#usermail_req").hide():$("#usermail_req").show();
		
	}
}