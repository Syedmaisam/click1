var matchUrl =0;
var matchUrls =1;
var auto_res =1;
var auto_res_timer =1;
$(document).ready(function(){
	var urllll      = window.location.href;
	var uchk=0;
	var linktxt="";
	if (urllll.indexOf("user") >= 0)
		{
		uchk=1;
		linktxt="Manage Users";
		}
	else if (urllll.indexOf("basic") >= 0)
		{
		uchk=1;
		linktxt="Basic";
		
		}
	else if (urllll.indexOf("campaign") >= 0)
	{
	uchk=1;
	linktxt="Campaigns";
	
	}
	else if (urllll.indexOf("analytic_settings") >= 0)
	{
	uchk=1;
	linktxt="Analytics";
	
	}
	
	else if (urllll.indexOf("analytic") >= 0)
	{
	uchk=1;
	linktxt="Analytics";
	
	}
	else if (urllll.indexOf("settings/index.php") >= 0)
	{
	uchk=1;
	linktxt="Settings";
	
	}
	else
		{
		uchk=1;
		linktxt="Dashboard";
		}
	$( ".sidebar-menu li a span" ).each(function( index ) {
		if(linktxt=="Dashboard")
			{
			$(".sidebar-menu li:first").addClass("active");
			
			}
		var spantxt=$(this).html();
		$(this).closest("li").removeClass("active");
	if(spantxt==linktxt)
		{
		$(this).closest("li").addClass("active")
		}

		});
	$("body").addClass('fixed');
	setTimeout(function() {
		// Do something after 5 seconds
		$(".no-print").remove();
	}, 10);
	$(".np-print").remove();
	$(".urls").on('blur',function(){
		var myVariable = $(this).val();	
		var regex = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
		if(regex.test(myVariable)){
			var ext = myVariable.substring(myVariable.lastIndexOf('.') + 1);
			var domain = myVariable.replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
			var neWext = domain.split('.');
			if(neWext[1]=='' || neWext[1]==undefined){
				matchUrl=0;
				matchUrls=0;
				var datas = $(this).parents('div').children('small:nth-child(3)').show(); 
			} else 
			{
				if(ext ==="gif" || ext ==="GIF" || ext === "jpg" || ext === "JPG" ||  ext === "JPEG" || ext === "jpeg" ||  ext === "png"|| ext === "BMP"){
					matchUrl=0;
					matchUrls=0;
					var datas = $(this).parents('div').children('small:nth-child(3)').show(); 
				} else {
					matchUrl = 1;
					matchUrls = 1;
					$(this).parents('div').children('small:nth-child(3)').hide();
				}
			}
		}else{
			matchUrl=0;
			matchUrls=0;
			var datas = $(this).parents('div').children('small:nth-child(3)').show(); 
		}
	});
});

function deleteProfile(profileId)
{
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			i: profileId,
			q:"delete",
			beforeSend: function() {
				$("#profile_"+profileId).css({'background-color':'#fb6c6c'},300);
			},
		},			
		success: function(response) {
			$("#profile_"+profileId).slideUp(1000,function() {
				$("#profile_"+profileId).remove();
			});
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}

function getjustLinkData(id)
{
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/justLink/getData.php',
		data: {
			id:id
		},			
		success: function(response) {
			$("#addLinkdata").html(response);
			
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}



function add_link_validation()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	var link_name = $.trim($("#link_name").val());
	var linkProfile = $("#linkProfile").val();
	var d_url = $("#d_url").val();
	var ururl = $("#ururl").val();
	var masking = ($("#mask").is(":checked")) ? "1" : '0';

	// Destination URL Valid
	var regexData = new RegExp(
	"^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
	var durl = 0;
	if (regexData.test(d_url)) {
		$("#d_url_req").hide();
		durl = 1;
	} else {

		if (d_url != '') {
			$("#d_url_req").html(' invalid url');
			$("#d_url_req").show();
		} else {
			$("#d_url_req").html(' Required');
			$("#d_url_req").show();
		}

	}

	// Your URL Valid
	var yourUrl = 0;
	if (regexData.test(ururl)) {
		$("#ururl_req").hide();
		yourUrl = 1;
	} else {

		if (ururl != '') {

			$("#ururl_req").html(' invalid url');
			$("#ururl_req").show();
		} else {

			$("#ururl_req").html(' Required');
			$("#ururl_req").show();
		}

	}

	if (link_name != '' && linkProfile != '' && d_url != '' && ururl != ''
		&& yourUrl == 1 && durl == 1) {
		$.ajax({
			type : "post",
			url : SITE_ROOT_URL+'ajax/justLink/addLink.php',
			data : {
				link_name : link_name,
				linkProfile : linkProfile,
				d_url : d_url,
				ururl : ururl,
				masking : masking,
				submit : "save"
			},
			success : function(response) {
				$("#message").html("Created successfully!");				
				$("#linksPopUpAdd").html(response);
				$("#linksPopUpAdd").show();
				getjustLinkData();
				$(".blackscreen").show();

			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
	} else {
		$(".blackscreen").hide();
		$(".loader_popup").hide();
		(link_name != '') ? $("#link_name_req").hide() : $("#link_name_req").show();
		(linkProfile != '') ? $("#linkProfile_req").hide() : $(
		"#linkProfile_req").show();
	}
}

function linkBlurJustLink()
{
	var regexData = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
	var d_url = $("#d_url").val();

	if(d_url != '')
	{
		if(regexData.test(d_url))
		{
			$("#d_url_req").hide();
		}
		else
		{

			$("#d_url_req").html(' invalid url');
			$("#d_url_req").show();
		}
	}
}
function linkBlurJustLinkYourUrl()
{
	var regexData = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
	var ururl = $("#ururl").val();

	if(ururl != '')
	{
		if(regexData.test(ururl))
		{
			$("#ururl_req").hide();
		}
		else
		{

			$("#ururl_req").html(' invalid url');
			$("#ururl_req").show();
		}
	}
}

function update_link_validation()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	var link_name = $.trim($("#link_name").val());
	var linkProfile = $("#linkProfile").val();
	var d_url = $("#d_url").val();
	var ururl = $("#ururl").val();
	var masking = ($("#mask").is(":checked"))?"1":'0';
	var id = $("#id").val();

	// Destination URL Valid
	var regexData = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
	var durl = 0;
	if(regexData.test(d_url))
	{
		$("#d_url_req").hide();
		durl = 1;
	}
	else
	{

		if(d_url != '')
		{		
			$("#d_url_req").html(' invalid url');
			$("#d_url_req").show();
		}
		else
		{			
			$("#d_url_req").html(' Required');
			$("#d_url_req").show();
		}

	}

	// Your URL Valid
	var yourUrl = 0;
	if(regexData.test(ururl))
	{
		$("#ururl_req").hide();
		yourUrl = 1;
	}
	else
	{

		if(ururl != '')
		{

			$("#ururl_req").html(' invalid url');
			$("#ururl_req").show();
		}
		else
		{

			$("#ururl_req").html(' Required');
			$("#ururl_req").show();
		}

	}


	if(link_name!='' && linkProfile!='' && d_url!='' && ururl!='' && yourUrl==1 && durl == 1)
	{
		$.ajax({
			type: "post",
			url: window.location.href,
			data: {
				link_name: link_name,
				linkProfile:linkProfile,
				d_url: d_url,
				ururl:ururl,
				id:id,
				masking:masking,
				submit:"Update"
			},			
			success: function(response) {
				getjustLinkData();
				$(".blackscreen").hide();
				$(".loader_popup").hide();

			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{
		$(".blackscreen").hide();
		$(".loader_popup").hide();
		(link_name!='')?$("#link_name_req").hide():$("#link_name_req").show();
		(linkProfile!='')?$("#linkProfile_req").hide():$("#linkProfile_req").show();

	}
}

function edit_Message_Campaign()
{
	//alert("hello");
	$(".blackscreen").show();
	$(".loader_popup").show();
	var campaignProfile = $("#linkProfile").val();
	var campaignName = $("#linkCampaign").val();
	var id=$("#id").val();
	var generatorMessageText = $.trim($("#generatorMessageText").val());
	var generatorActionText = $.trim($("#generatorActionText").val());
	var generatorActionLink = $.trim($("#generatorActionLink").val());
	var pophtml=$("#popbasic").html();
	var msgid=$("#msgid").val();

	if(campaignProfile!='' && campaignName!='' && generatorMessageText!='' && generatorActionText!=''&& generatorActionLink!='' )
	{

		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/campaign/editMessage.php',
			data: {
				campaignProfile: campaignProfile,
				campaignName:campaignName,
				generatorMessageText: generatorMessageText,
				generatorActionText: generatorActionText,
				generatorActionLink: generatorActionLink,
				pophtml: pophtml,
				id:id,
				msgid:msgid,
				submit:"save"
			},			
			success: function(response) {
				$(".blackscreen").hide();
				$(".loader_popup").hide();
				//	alert(response);
				//$("#message").html(response);
				//campurl = location.protocol + '//' + location.host+'/click/views/campaign';
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
		(campaignProfile!='')?$("#campaignSel_req").hide():$("#campaignSel_req").show();
		(campaignName!='')?$("#campaignName_req").hide():$("#campaignName_req").show();
		(campaignMessage!='')?$("#campaignMessage_req").hide():$("#campaignMessage_req").show();
		(campaignAction!='')?$("#campaignAction_req").hide():$("#campaignAction_req").show();
		(campaignActionLink!='')?$("#campaignActionLink_req").hide():$("#campaignActionLink_req").show();


	}

}

function add_campaign_validation()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	var campaignProfile = $("#campaignProfile").val();
	var campaignName = $.trim($("#campaignName").val());
	var campaignMessage = $.trim($("#campaignMessage").val());

	if(campaignProfile!='' && campaignName!='' && campaignMessage!='')
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/campaign/addCampaign.php',
			data: {
				campaignProfile: campaignProfile,
				campaignName:campaignName,
				campaignMessage: campaignMessage,
				submit:"save"
			},			
			success: function(response) {
				//alert(response);
				//$("#message").html(response);
				campurl = SITE_ROOT_URL+'views/campaign/campaignNext.php/'+response+"/0/"+campaignProfile;

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
		(campaignProfile!='')?$("#campaignSel_req").hide():$("#campaignSel_req").show();
		(campaignName!='')?$("#campaignName_req").hide():$("#campaignName_req").show();
		(campaignMessage!='')?$("#campaignDesc_req").hide():$("#campaignDesc_req").show();

	}
}
function edit_campaign_validation()
{
	$(".blackscreen").show();
	$(".loader_popup").show();
	var campaignProfile = $("#campaignProfile").val();
	var campaignName = $.trim($("#campaignName").val());
	var campaignMessage = $.trim($("#campaignMessage").val());
	var id=$("#id").val();

	if(campaignProfile!='' && campaignName!='' && campaignMessage!='')
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/campaign/editcampaign.php',
			data: {
				campaignProfile: campaignProfile,
				campaignName:campaignName,
				campaignMessage: campaignMessage,
				id:id,
				submit:"save"
			},			
			success: function(response) {
				//alert(response);
				//$("#message").html(response);
				campurl = SITE_ROOT_URL+'views/campaign';

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
		(campaignProfile!='')?$("#campaignSel_req").hide():$("#campaignSel_req").show();
		(campaignName!='')?$("#campaignName_req").hide():$("#campaignName_req").show();
		(campaignMessage!='')?$("#campaignDesc_req").hide():$("#campaignDesc_req").show();

	}
}

function updateCampaignData()
{
	$("#campaignName_req").hide();
	$("#ValidateLinkUrl").attr('style','display:none');
	$(".blackscreen").show();
	$(".loader_popup").show();
	var campaignProfile = $("#linkProfile").val();

	//alert(campaignProfile);
	var campaignName = $("#linkCampaign").val();
	var id=$("#id").val();

	var generatorMessageText = $.trim($("#generatorMessageText").val());
	var generatorActionText = $.trim($("#generatorActionText").val());
	var generatorActionLink = $.trim($("#generatorActionLink").val());
	var pophtml=$("#popbasic").html();
	var url= /(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/;
	var UrlText=url.test(generatorActionLink);

	/*if(UrlText)
		{
		 return true;
		}
	   else
		 {
		   return false;
		   $("#ValidateLinkUrl").attr('style','display:block');
		   $("#ValidateLinkUrl").attr('style','color:red');
		 }
	 */
	if(campaignProfile!='' && campaignName!='' && generatorMessageText!='' && generatorActionText!=''&& generatorActionLink!=''&& UrlText==true && campaignName != 0)
	{

		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/campaign/updateCampaign.php',
			data: {
				campaignProfile: campaignProfile,
				campaignName:campaignName,
				generatorMessageText: generatorMessageText,
				generatorActionText: generatorActionText,
				generatorActionLink: generatorActionLink,
				pophtml: pophtml,
				id:id,
				submit:"save"
			},			
			success: function(response) {
				//	alert(response);
				//$("#message").html(response);
				campurl = SITE_ROOT_URL+'views/campaign';
				//window.location.assign(campurl);
				$(".loader_popup").hide();
				$(".blackscreen").hide();
				window.location.assign(SITE_ROOT_URL+'views/campaign/index.php');


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
		(campaignProfile!='')?$("#campaignSel_req").hide():$("#campaignSel_req").show();
		(campaignName!=0)?$("#campaignName_req").hide():$("#campaignName_req").show();
		(generatorMessageText!='')?$("#campaignMessage_req").hide():$("#campaignMessage_req").show();
		(generatorActionText!='')?$("#campaignAction_req").hide():$("#campaignAction_req").show();
		(generatorActionLink!='')?$("#campaignActionLink_req").hide():$("#campaignActionLink_req").show();

		if(UrlText==false && generatorActionLink!='')
		{
			$("#ValidateLinkUrl").attr('style','display:block');
			$("#ValidateLinkUrl").attr('style','color:red');


		}
		else
		{

		}



	}
}



function deleteJustLink(links)
{
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			lnkId: links,
			submit:"delete"
		},			
		success: function(response) {
			$(".tr_"+links).remove();

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}
function delete_Dashboard(links,tableName)
{
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			lnkId: links,
			submit:"delete",
			tblName:tableName				
		},			
		success: function(response) {
			$(".tr_"+links).remove();

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}
function changestatus_Dashboard(links,tableName)
{
	var status = 0;
	if($(".just_"+links).prop( "checked" ))
	{
		status = 1;

	} else 
	{
		status = 0;

	}

	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			status: status,
			po_id:links,
			tblName:tableName,
			st:"st"
		},   
		success: function(response) {

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}
function edit_custom_popup()
{
	//alert("edit");
	var val2=$("#template_ival").val();
	if(val2 >= 100)
	{
		window.location.href = SITE_ROOT_URL+"custom_template/edit_popup.php?id="+val2;
	}
}
function layered_popup_view()
{
	var val2=$("#template_ival").val();
	if(val2!='' && val2!=0){
		var urltext='';
		var dburl = SITE_ROOT_URL+"ajax/custom_popup/show_custom_popup_preview.php";
		if(val2 >= 100)
		{
			//alert("go after 100");
			$.ajax({
				url:dburl,
				type:"post",
				data: {
					submit: "submit",
					value: val2

				},
				success: function(response) { 
					//alert(response);
					$("#popup_content_data").html(response);
					$("#blackscreen").show();
					$("#popupform_preview").show();
					$("")
				}

			});
		}
		else
		{
			var val2=$("#template_ival").val();

			var urltext='';

			if (val2==1)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/popup1_preview.php";
			}
			if(val2==2)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/terms_popup_preview.php";
			}
			if(val2==3)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/social_email1_preview.php";
			}
			if(val2==4)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/contact_form1_preview.php";
			}
			if(val2==5)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/subscribe_form2_preview.php";
			}
			if(val2==6)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/subscribe_newsletter1_preview.php";
			}
			if(val2==7)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/contact_form2_preview.php";
			}
			if(val2==8)
			{

				urltext=SITE_ROOT_URL+"views/layered/animatemaster/report1_preview.php";

			}
			if(val2==9)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/social_email2_preview.php";

			}
			if(val2==10)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/subscribe_newsletter2_preview.php";
			}
			if(val2==11)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/massive_traffic1_preview.php";
			}
			if(val2==12)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/massive_traffic2_preview.php";
			}
			if(val2==13)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/social_email3_preview.php";
			}
			if(val2==14)
			{

				urltext=SITE_ROOT_URL+"views/layered/animatemaster/massive_traffic3_preview.php";
			}
			if(val2==15)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/subscribe_form3_preview.php";
			}
			if(val2==16)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/macbook_preview.php";
			}
			if(val2==17)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/enjoyauroaborelias_preivew.php";
			}
			if(val2==18)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/Chat1_preview.php";
			}
			if(val2==19)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/Chat2_preview.php";
			}
			if(val2==20)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/Chat3_preview.php";
			}
			if(val2==21)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/Chat4_preview.php";
			}
			if(val2==22)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/Chat5_preview.php";
			}
                        if(val2==23)
			{
				urltext=SITE_ROOT_URL+"views/layered/animatemaster/social_subscribe_preview.php";
			}


			$.ajax({
				type: "post",
				url: urltext,
				data:{ text:'1'},

				success: function(response) {

					$("#popup_content_data").html(response);
					$("#blackscreen").show();
					$("#popupform_preview").show();
				},
				error:function 
				(XMLHttpRequest, textStatus, errorThrown) {
				}
			});  

		}
	}

}

$(document).on('change', '#responsemail', function() {

	var val2=$("#responsemail").val();
	if(val2==1)
	{
		$("#getMailerliteBox").hide();
		$("#getmailchimpBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#iContactBox").hide();
		$("#getResponseBox").show();
		$("#getconstantbox").hide();
	}
	if(val2==2)
	{
		$("#getMailerliteBox").hide();
		$("#getResponseBox").hide();
		$("#getmailchimpBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#iContactBox").hide();
		$("#getAweberBox").show();
		$("#getconstantbox").hide();
	}
	if(val2==5)
	{
		$("#getAweberBox").hide();	
		$("#getResponseBox").hide();
		$("#getmailchimpBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#iContactBox").hide();
		$("#getMailerliteBox").show();
		$("#getconstantbox").hide();
	}
	if(val2==3)
	{
		$("#getMailerliteBox").hide();
		$("#getResponseBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#iContactBox").hide();
		$("#getmailchimpBox").show();
		$("#getconstantbox").hide();
	}
	if(val2==4)
	{
		$("#getMailerliteBox").hide();
		$("#getResponseBox").hide();
		$("#iContactBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").show();
		$("#getmailchimpBox").hide();
		$("#getconstantbox").hide();
	}
	if(val2==6)
	{
		$("#getMailerliteBox").hide();
		$("#iContactBox").hide();
		$("#getResponseBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#getmailchimpBox").hide();
		$("#getconstantbox").show();

	}if(val2==7)
	{
		$("#getMailerliteBox").hide();
		$("#getconstantbox").hide();
		$("#getResponseBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#getmailchimpBox").hide();
		$("#iContactBox").show();
	}if(val2=="")
	{
		$("#getMailerliteBox").hide();
		$("#getconstantbox").hide();
		$("#getResponseBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#getmailchimpBox").hide();
		$("#iContactBox").hide();
	}


});
function edit_layer_popup()
{
	var val2 = $("#template_ival").val();
	//alert(val2);
	//var val2=$("#template_ival").val();
	if(val2 >= 100)
	{
		window.location.href = SITE_ROOT_URL+"custom_template/edit_popup.php?id="+val2;
	}
	else
	{
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'views/layered/animatemaster/templates.php',
			data: {
				id: val2,

			},			
			success: function(response) {
				$("#content_ajax_popup").html(response);
				$("#edit_layer_popup").show();
				jscolor.init(); 

				pop_layer_data();

			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	}
}



//Start Layered Js

function edit_layer_popup_change(id)
{
	var val2=id;
	//alert(val2);

	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'views/layered/animatemaster/templates.php',
		data: {
			id: val2,

		},   
		success: function(response) {
			$("#content_ajax_popup").html(response);
			$("#edit_layer_popup").show();
			jscolor.init(); 
			pop_layer_data();

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}
$(document).on('change', '#layered_popup_template', function() {

	var val2=$("#layered_popup_template").val();
	//alert(val2);
	$("#template_ival").val(val2);

});

function create_layered_popup()
{
	var blockapi=0;
	var SCRIPT_REGEX = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
	$("#link_name_req").hide();
	$("#linkProfile_req").hide();
	$("#layeredEmail_req").hide();
	$("#layeredcamp_req").hide();
	$("#layeredapi_req").hide();
	$("#textarea_error_ivalid").hide();
	$("#textarea_error").hide();
	$("#linkUrl_req").hide();
	var layered_name = $("#layered_popup_template").val();
	var autoresponder_html = $(".textarea_class").val().replace(SCRIPT_REGEX,'');
	var countdown_timer = $("#datepicker").val();
	var title = $.trim($("#title").val());
	var msgPosition = $("#msgPosition").val();
	var textcolor = $("#textcolor").val();
	var hieght = $("#hieght").val();
	var width = $("#width").val();
	var popupform = $("#popupform").html();
	var overlay_op = $("#overlay_op").val();
	var inp_timing = $("#inp_Timing").val();
	var account_id = '';
	var access_token='';
	var access_secret= '';
	var iContact_app_id= '';
	var iContact_user_name= '';
	var iContact_password= '';
//	var email_provider = $("#email_provider").val();
	var checkOverlay = ($("#check").is(':checked'))?1:0;
	var email_provider = $("#responsemail").val();
	if(email_provider==1){
		var api_key = $("#ulp_getresponse_api_key").val();
		var camp_id = $("#ulp_getresponse_campaign_id").val();
	} else if(email_provider==5)
	{
		var api_key = $("#ulp_getresponse_api_key_mailer").val();
		var camp_id = $("#ulp_getresponse__mailer_campaign_id").val();
	}else if(email_provider==3)
	{
		var api_key = $("#ulp_getresponse_api_key_mailchimp").val();
		var camp_id = $("#ulp_getresponse__mailchimp_campaign_id").val();
	}else if(email_provider==2)
	{
		var api_key = $("#ulp_aweber_oauth_id").val();
		account_id = $("#account_id").val();
		access_token = $("#access_token").val();
		access_secret = $("#access_secret").val();
		var camp_id = $("#ulp_getresponse__awaber_campaign_id").val();
	} else if(email_provider==4)
	{
		var api_key = $("#ulp_activeCamp_api_url").val();
		var account_key = $("#ulp_activeCamp_api_key").val();
		var camp_id = $("#ulp_activeCamp_campaign_id").val();
	}
	else if(email_provider==6)
	{
		var api_key = $("#ulp_constant_api_key").val();
		var account_key = $("#ulp_constant_access_token").val();
		var camp_id = $("#ulp_constant_campaign_id").val();
	}
	else if(email_provider==7)
	{
		var api_key= $("#ulp_iContact_appid").val();;
		iContact_user_name= $("#ulp_iContact_user_name").val();
		iContact_password= $("#ulp_iContact_user_password").val();
		var camp_id = $("#ulp_iContact_campaign_id").val();
	}
	else if(layered_name==2 ||layered_name==16 || layered_name==17 )
	{
		blockapi=1;
	}
	var linkurl = $("#linkurl").val();
	var validurl = false;
	if(linkurl != '')
	{
		var regex = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
		if(regex.test(linkurl)){
			var ext = linkurl.substring(linkurl.lastIndexOf('.') + 1);
			var domain = linkurl.replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
			var neWext = domain.split('.');
			if(neWext[1]=='' || neWext[1]==undefined){
				validurl = false;
				//var datas = $(this).parents('div').children('small:nth-child(3)').show(); 
			} else 
			{
				if(ext ==="gif" || ext ==="GIF" || ext === "jpg" || ext === "JPG" ||  ext === "JPEG" || ext === "jpeg" ||  ext === "png"|| ext === "BMP"){
					validurl = false;
				} else {  
					validurl = true;
				}			

			}

		} else{
			validurl = false;			

		}

	}    //&& autoresponder_html!='' && autoresponder_html.indexOf("<form") >= 0


	var coun = $("#countdown").html();
	var deatepic = $("#datepicker").val();

	if(layered_name >100 ){
		if(coun!='' && coun!=undefined && deatepic!='')
		{
			if(isDate(deatepic)!=false){
				auto_res_timer=1;
			} else 
			{
				auto_res_timer=4;
			}
		}
	}


	auto_res = 0;

	if(layered_name < 100 && (layered_name==2 ||layered_name==16 || layered_name==17 || layered_name==18 || layered_name==19 || layered_name==20 || layered_name==21 || layered_name==22 ))
	{
		auto_res=1;
	}
	else 
	{
		if(layered_name > 100)
		{
			if(autoresponder_html.indexOf("<form") >= 0)
			{				
				auto_res=1;
			}
			if(autoresponder_html == '')
			{			
				auto_res=1;
			}	
		}
		else
		{
			if(autoresponder_html.indexOf("<form") >= 0)
			{				
				auto_res=1;
			} 
			else 
			{
				auto_res=2;
			}
		}
	}	
	if(layered_name!='' && title!='' && popupform!='' && camp_id!='' && linkurl != '' && validurl == true && auto_res==1 && auto_res_timer==1)
	{
		$("#select_date_error").hide();
		var coun = $("#countdown").html();
		var deatepic = $("#datepicker").val();
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
		//if(coun!='' && coun!=undefined && deatepic!=''  && (deatepic > output))
		//{
		$(".blackscreen").show();
		$(".loader_popup").show(); 

		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/layered/add.php',
			data: {
				layered_name: layered_name,
				title:title,
				msgPosition: msgPosition,
				textcolor:textcolor,
				hieght:hieght,
				width:width,
				popupform:popupform,
				overlay_op:overlay_op,
				email_provider:email_provider,
				api_key:api_key,
				camp_id:camp_id,
				checkOverlay:checkOverlay,
				linkurl:linkurl,
				account_id:account_id,
				access_token:access_token,
				access_secret:access_secret,
				account_key:account_key,
				inp_timing:inp_timing, 
				iContact_app_id:iContact_app_id,
				iContact_user_name:iContact_user_name,
				iContact_password:iContact_password,
				autoresponder_html:autoresponder_html,
				countdown_timer:countdown_timer,
				submit:"add_layered"
			},   
			success: function(response) {
				$('html, body').animate({
					scrollTop : 0
				}, 'slow');						
				$("#suc_msg").html("<div style='text-align: center;width: 50%;' class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>X</button><b>Success!</b> Layered Popup Created Succussessfully!</div>");					
				$("#suc_msg").css('height', '65px');			
				$("#layeredPopUpAdd").html(response);
				$("#layeredPopUpAdd").show();
				get_layeredData();
				//$(".blackscreen").hide();
				$(".loader_popup").hide();
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
	} else 
	{

		$("#suc_msg").html('');
		if(layered_name=='')
		{
			$("#link_name_req").show();
			$('html, body').animate({
				scrollTop: 0
			}, 'slow');
		} 
		if(title=='') 
		{
			$("#linkProfile_req").show();
		}
		if((email_provider=='' && layered_name!=2) && (email_provider=='' && layered_name!=16) && (email_provider=='' && layered_name!=17)) 
		{
			//alert(layered_name);
			$("#layeredEmail_req").show();
		}
		if(api_key=='') 
		{
			$("#layeredapi_req").show();
		}
		if(camp_id=='') 
		{
			$("#layeredcamp_req").show();
		}
		if(linkurl=='' || validurl==false) 
		{
			$("#linkUrl_req").show();
		}
		if(autoresponder_html!='')
		{
			$("#textarea_error").hide();
		} else
		{
			$("#textarea_error").show();
		}
		if(auto_res_timer==4)
		{
			$("#select_date_ivalid").show();
			$("#select_date_ivalid").html('Please select valid date');
		} else 
		{
			$("#select_date_ivalid").hide();
		}
		if(auto_res==2)
		{
			//$("#textarea_error_ivalid").hide();
			$("#textarea_error").hide();
			$("#textarea_error_ivalid").show();
		} else 
		{
			$("#textarea_error").hide();
			$("#textarea_error_ivalid").show();
		}
		if(auto_res!=1)
		{
			if(auto_res!=1 && autoresponder_html.indexOf("<form") >= 0)
			{
				$("#textarea_error_ivalid").hide();
			} else 
			{
				$("#textarea_error").hide();
				$("#textarea_error_ivalid").show();
			}
		}
		if(layered_name > 100)
		{
			$("#textarea_error_ivalid").hide();
		}

	}

}
$(document).on('change', '#layered_popup_template', function() {
	$(".countD").hide();
	var val2=$("#layered_popup_template").val();
	var Pathname =  window.location.pathname;
	var dburl = SITE_ROOT_URL+"ajax/custom_popup/view_custom_popup.php";
	if(val2 >= 100)
	{
		//alert("go after 100");
		$.ajax({
			url:dburl,
			type:"post",
			data: {
				submit: "submit",
				value: val2

			},
			success: function(response) { 
				// alert(response);
				var  var_res_html="<div id='popupform'><div class='ulp-content adcls' style='width:600px;margin:auto; margin-bottom:20px;'>" +response+ "</div></div>";
				$("#content_ajax_popup").html(var_res_html);
				// $("#content_ajax_popup").html(response);
				$("#edit_layer_popup").show();
				var coun = $("#countdown").html();
				$("#datepicker").addClass('form-control');
				if(coun!='' && coun!=undefined)
				{
					$(".countD").show();
				} else 
				{
					$(".countD").hide();
				}
				jscolor.init(); 

				//pop_layer_data();
			}

		});
	}
	else if(Pathname!="/whitelabel_click/views/layered/add.php")
	{
		//alert(val2);
		edit_layer_Chat(val2);

	}
	else
	{
		edit_layer_popup_change(val2);
	}

	if(val2==2 || val2==16 || val2==17 || val2==18 || val2==19 || val2==20 || val2==21 || val2==22)
	{
		$("#apiforms").hide();
		$("#mprovider").hide();

		$("#getMailerliteBox").hide();
		$("#getmailchimpBox").hide();
		$("#getAweberBox").hide();
		$("#getActiveCampaiganBox").hide();
		$("#getResponseBox").hide();
	}
	else
	{
		$("#apiforms").show();
		$("#mprovider").show();
	}

});

function edit_layer_Chat(id) {
	var val2 = id;


	$.ajax({
		type : "post",
		url : SITE_ROOT_URL + 'views/layered/animatemaster/templates.php',
		data : {
			id : val2,

		},
		success : function(response) {
			$("#content_ajax_popup").html(response);
			$("#edit_layer_popup").show();
			jscolor.init();
			pop_layer_data();
			var audio=new Audio(SITE_ROOT_URL + "/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
			if (val2==18) {

				if ($('#ulp-layer-144 textarea').length > 0 ) {
					textareaval = $("#ulp-layer-144 textarea").attr('placeholder');
					$("#ulp-layer-144 textarea").html('');
					arrtextarea11 = textareaval.split("");
					audio.play();
					EditframeLooper11();
				}

			}
			else if(val2==19)
			{
				if ($('#ulp-layer-144a textarea').length > 0 ) {
					textareaval = $("#ulp-layer-144a textarea").attr('placeholder');
					$("#ulp-layer-144a textarea").html('');
					arrtextarea11 = textareaval.split("");
					audio.play();
					EditChat2frameLooper11();
				}

			}

			else if (val2 == 20) 
			{
				if(($('#ulp-layer-146 input[type="text"]').length > 0 )) {
					textareaval = $('#ulp-layer-146 input[type="text"]').attr('placeholder');
					$('#ulp-layer-146 input[type="text"]').attr('placeholder','');
					arrtextarea11 = textareaval.split("");	
					audio.play();
					EditChat3frameLooper12();		
				}

			}
			else if (val2==21) {
				if(($('#ulp-layer-147 input[type="text"]').length > 0 )) {
					textareaval = $('#ulp-layer-147 input[type="text"]').attr('placeholder');
					$('#ulp-layer-147 input[type="text"]').attr('placeholder','');
					arrtextarea11 = textareaval.split("");
					audio.play();
					EditChat4frameLooper13();

				}
			}

		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
		}
	});
}
var textareaval;
var arrtextarea11;
var looptimer;

function EditframeLooper11()
{
	var value;

	if(arrtextarea11.length>0)
	{
		value=arrtextarea11.shift();
		$("#ulp-layer-144 textarea").append(value);
		setTimeout('EditframeLooper11()',80);
	}

}
function EditChat2frameLooper11()
{
	var value;
	if(arrtextarea11.length>0)
	{
		value=arrtextarea11.shift();

		$("#ulp-layer-144a textarea").append(value);
		setTimeout('EditChat2frameLooper11()',80);
	}

}

function EditChat3frameLooper12()
{

	if(arrtextarea11.length>0)
	{
		value=arrtextarea11.shift();
		$("#ulp-layer-146 input").attr('placeholder',$("#ulp-layer-146 input").attr('placeholder')+value);
		setTimeout('EditChat3frameLooper12()',80);
	}



}

function EditChat4frameLooper13()
{

	if(arrtextarea11.length>0)
	{
		value=arrtextarea11.shift();
		$("#ulp-layer-147 input").attr('placeholder',$("#ulp-layer-147 input").attr('placeholder')+value);
		setTimeout('EditChat4frameLooper13()',80);
	}


}

function get_layeredData()
{
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/layered/data.php',
		data: {
			id:1
		},   
		success: function(response) {
			$("#data_layered").html(response);
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
}

function update_layered_popup(popup_id)
{
var blockapi=0;
	$("#select_date_ivalid").hide();
	var SCRIPT_REGEX = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
	$("#link_name_req").hide();
	$("#linkProfile_req").hide();
	$("#textarea_error_ivalid").hide();
	$("#textarea_error").hide();
	var layered_name = $("#layered_popup_template").val();
	var title = $.trim($("#title").val());
	var msgPosition = $("#msgPosition").val();
	var textcolor = $("#textcolor").val();
	var hieght = $("#hieght").val();
	var width = $("#width").val();
	var popupform = $("#popupform").html();
	var overlay_op = $("#overlay_op").val();
	var email_provider = $("#responsemail").val();
	var link_url = $("#linkurl").val();
	var inp_timing = $("#inp_Timing").val();
	var autoresponder_html = $(".textarea_class").val().replace(SCRIPT_REGEX,'');
	var countdown_timer = $("#datepicker").val();
	var countdown_timer = $("#datepicker").val();
	var account_id = '';
	var access_token='';
	var access_secret= '';
	var iContact_app_id= '';
	var iContact_user_name= '';
	var iContact_password= '';
	if(email_provider==1){
		var api_key = $("#ulp_getresponse_api_key").val();
		var camp_id = $("#ulp_getresponse_campaign_id").val();
	} else if(email_provider==5)
	{
		var api_key = $("#ulp_getresponse_api_key_mailer").val();
		var camp_id = $("#ulp_getresponse__mailer_campaign_id").val();
	} else if(email_provider==3)
	{
		var api_key = $("#ulp_getresponse_api_key_mailchimp").val();
		var camp_id = $("#ulp_getresponse__mailchimp_campaign_id").val();
	} else if(email_provider==2)
	{
		var api_key = $("#ulp_aweber_oauth_id").val();
		account_id = $("#account_id").val();
		access_token = $("#access_token").val();
		access_secret = $("#access_secret").val();
		var camp_id = $("#ulp_getresponse__awaber_campaign_id").val();
	} else if(email_provider==4)
	{
		var api_key = $("#ulp_activeCamp_api_url").val();
		var account_key = $("#ulp_activeCamp_api_key").val();
		var camp_id = $("#ulp_activeCamp_campaign_id").val();
	}
	else if(email_provider==6)
	{
		var api_key = $("#ulp_constant_api_key").val();
		var account_key = $("#ulp_constant_access_token").val();
		var camp_id = $("#ulp_constant_campaign_id").val();
	}
	else if(email_provider==7)
	{
		var api_key= $("#ulp_iContact_appid").val();;
		iContact_user_name= $("#ulp_iContact_user_name").val();
		iContact_password= $("#ulp_iContact_user_password").val();
		var camp_id = $("#ulp_iContact_campaign_id").val();
	}
	else if(layered_name==2 ||layered_name==16 || layered_name==17)
	{
		blockapi=1;
	}
	var linkurl = $("#linkurl").val();
	var validurl = false;
	if(linkurl != '')
	{
		var regex = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
		if(regex.test(linkurl)){
			var ext = linkurl.substring(linkurl.lastIndexOf('.') + 1);
			if(ext ==="gif" || ext ==="GIF" || ext === "jpg" || ext === "JPG" ||  ext === "JPEG" || ext === "jpeg" ||  ext === "png"|| ext === "BMP"){
				validurl = false;
			} else {  
				validurl = true;
			}			

		}else{
			validurl = false;			
		}
	}
	var checkOverlay = ($("#check").is(':checked'))?1:0;
	//&& autoresponder_html !=''   && autoresponder_html.indexOf("<form") >= 0
	auto_res = 0;

	if(layered_name < 100 && (layered_name==2 ||layered_name==16 || layered_name==17 || layered_name==18 || layered_name==19 || layered_name==20 || layered_name==21 || layered_name==22 ))
	{
		auto_res=1;
	}
	else 
	{
		if(layered_name > 100)
		{
			if(autoresponder_html.indexOf("<form") >= 0)
			{				
				auto_res=1;
			}
			if(autoresponder_html == '')
			{			
				auto_res=1;
			}	
		}
		else
		{
			if(autoresponder_html.indexOf("<form") >= 0)
			{				
				auto_res=1;
			} 
			else 
			{
				auto_res=2;
			}
		}
	}	
	if(layered_name!='' && title!=''  && popupform!='' && title.length <=50 && validurl==true && auto_res==1)
	{
		$("#select_date_error").hide();
		$("#select_date_ivalid").hide();
		var coun = $("#countdown").html();
		var deatepic = $("#datepicker").val();
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
		var coun = $("#countdown").html();
		var deatepic = $("#datepicker").val();
		//if(coun!='' && coun!=undefined && deatepic!='' && (deatepic > output))
		//{
		$(".blackscreen").show();
		$(".loader_popup").show();
		$.ajax({
			type: "post",
			url: SITE_ROOT_URL+'ajax/layered/update.php',
			data: {
				popup_id:popup_id,
				layered_name: layered_name,
				title:title,
				msgPosition: msgPosition,
				textcolor:textcolor,
				hieght:hieght,
				width:width,
				popupform:popupform,
				overlay_op:overlay_op,
				email_provider:email_provider,
				api_key:api_key,
				camp_id:camp_id,
				checkOverlay:checkOverlay,
				link_url:link_url,
				account_id:account_id,
				access_token:access_token,
				access_secret:access_secret,
				account_key:account_key,
				inp_timing:inp_timing,  
				iContact_app_id:iContact_app_id,
				iContact_user_name:iContact_user_name,
				iContact_password:iContact_password,
				autoresponder_html:autoresponder_html,
				countdown_timer:countdown_timer,
				update:"update_layered"
			},   
			success: function(response) {
				$('html, body').animate({
					scrollTop: 0
				}, 'slow');
				$("#suc_msg").html("<div style='text-align: center;width: 50%;' class='alert alert-success alert-dismissable'><i class='fa fa-check'></i><button aria-hidden='true' data-dismiss='alert' class='close' type='button'>X</button><b>Success!</b> Layered Popup Updated Succussessfully!</div>"); 
				$("#suc_msg").css('height','65px');
				$(".blackscreen").hide();
				$(".loader_popup").hide();
			},
			error:function 
			(XMLHttpRequest, textStatus, errorThrown) {
			}
		}); 
//		} else 
//		{
//		if(deatepic <= output)
		//{
		//$("#select_date_error").hide();
		//$("#select_date_ivalid").show();
		//$("#select_date_ivalid").html('Please select a valid date.');
		//}else {
		//$("#select_date_error").show();
		//}
//		}
	} else 
	{
		$("#suc_msg").html('');
		if(layered_name=='')
		{
			$("#link_name_req").show();
			$("#linkProfile_req").html("Required!");
			$('html, body').animate({
				scrollTop: 0
			}, 'slow');
		} 
		if(title=='') 
		{
			$("#linkProfile_req").show();
			$('html, body').animate({
				scrollTop: 0
			}, 'slow');
		}
		if(title.length >=50)
		{
			$("#linkProfile_req").show();
			$("#linkProfile_req").html("You Can Enter Only 50 charter!");
		}
		if(linkurl=='' || validurl==false) 
		{
			$("#linkUrl_req").show();
		}
		if(autoresponder_html!='')
		{
			$("#textarea_error").hide();
		} else
		{
			$("#textarea_error").show();
		}
		if(auto_res==2)
		{
			//$("#textarea_error_ivalid").hide();
			$("#textarea_error").hide();
			$("#textarea_error_ivalid").show();
		} else 
		{
			$("#textarea_error").hide();
			$("#textarea_error_ivalid").show();
		}
		if(auto_res!=1)
		{
			if(auto_res!=1 && autoresponder_html.indexOf("<form") >= 0)
			{
				$("#textarea_error_ivalid").hide();
			} else 
			{
				$("#textarea_error").hide();
				$("#textarea_error_ivalid").show();
			}
		}
		if(layered_name > 100 && auto_res == 1)
		{
			$("#textarea_error_ivalid").hide();
		}
	}
}



function delete_layered(layId)
{
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			i: layId,
			q:"delete",
			beforeSend: function() {
				$(".del_"+layId).css({'background-color':'#fb6c6c'},300);
			},
		},   
		success: function(response) {
			$(".del_"+layId).slideUp(1000,function() {
				$(".del_"+layId).remove();
			});
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}

function change_status(thisData)
{
	if($(".check_"+thisData).is(":checked"))
	{
		var status = 1;
	} else 
	{
		var status = 0;
	}
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			status: status,
			po_id:thisData,
			st:"st"
		},   
		success: function(response) {

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}

function change_just_link_status(thisData)
{
	if($(".just_"+thisData).is(":checked"))
	{
		var status = 1;
	} else 
	{
		var status = 0;
	}
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			status: status,
			po_id:thisData,
			st:"st"
		},   
		success: function(response) {

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}

function add_getresponse_list(campaign_id)
{
	var email_provider = $("#responsemail").val();
	if(email_provider==1){
		$("#ulp_getresponse_campaign_id").val(campaign_id);
		$("#getresponseCampaigns").fadeOut("slow");
		$(".blackscreen").fadeOut("slow");
	} else if(email_provider==5)
	{
		//ulp_activeCamp_campaign_id
		$("#ulp_getresponse__mailer_campaign_id").val(campaign_id);
	} else if(email_provider==3)
	{
		$("#ulp_getresponse__mailchimp_campaign_id").val(campaign_id);
	} else if(email_provider==2)
	{
		$("#ulp_getresponse__awaber_campaign_id").val(campaign_id);
	} else if(email_provider==4)
	{
		$("#ulp_activeCamp_campaign_id").val(campaign_id);
	}
	else if(email_provider==6)
	{
		$("#ulp_constant_campaign_id").val(campaign_id);
	}
	else if(email_provider==7)
	{
		$("#ulp_iContact_campaign_id").val(campaign_id);
	}
	$("#getresponseCampaigns").fadeOut("slow");
	$(".blackscreen").fadeOut("slow");
	//$("#ulp_getresponse_campaign_id").val(campaign_id);
}
function showshare(id)
{
	
	var sharelink=$("#sharelink_"+id).val();
	var sharetitle=$("#sharetitle_"+id).html();
	var sharemessage=$("#sharemessage_"+id).html();
	var shareprofile=$("#shareprofile_"+id).html();
    var profileimage=$("#hid_"+id).val();
   
    $.ajax({
		type: "post",
		url: SITE_ROOT_URL+'views/SharePopup.php',
		data: {
			sharelink: sharelink,
			sharetitle:sharetitle,
			sharemessage:sharemessage,
			shareprofile:shareprofile,
            profileimg:profileimage
		},   
		success: function(response) {
			
			$("#sharepopup").html(response);
			$(".blackscreen").show();
			$("#sharepopup").show();
			callStuble();
			
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
    
}

function showsharepopup(id)
{
	//$("#sharepopup").html('');
	var sharelink=$("#sharelink_"+id).val();
	var sharetitle=$("#sharetitle_"+id).html();
	var sharemessage=$("#sharemessage_"+id).html();
	var shareprofile=$("#shareprofile_"+id).html();
var profileimage=$("#hid_"+id).val();
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'views/SharePopup.php',
		data: {
			sharelink: sharelink,
			sharetitle:sharetitle,
			sharemessage:sharemessage,
			shareprofile:shareprofile,
profileimg:profileimage
		},   
		success: function(response) {
			$("#sharepopup").html(response);
			$(".blackscreen").show();
			$("#sharepopup").show();
			callStuble();
		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	}); 
	/*
	$("#share_pop_link").attr("href",sharelink);
	$("#share_pop_link").html(sharelink);
	$("#sharetitle").html(sharetitle);
	$("#sharemessage").html(sharemessage);
	$("#shareprofile").html(shareprofile);
	$(".fbshare").html("<div class='fb-share-button' data-href='"+sharelink+"' data-layout='button_count'></div>");
	$(".blackscreen").show();
	$("#sharepopup").show();*/

}
function closeshare()
{
	delete IN;
	$("#sharepopup").hide();
	$(".blackscreen").hide();
	$("#twitter-wjs").remove();
	$("#stumb").remove();
	$("#frameLinkedin").remove();
	$("#linkedin").remove();
	//$(".stumble").html('');
	$("#iframe-stmblpn-widget-1").remove();
	$("#sharepopup").html('');
	//alert($("script[src='https://platform.linkedin.com/js/secureAnonymousFramework?v=0.0.2000-RC8.44973-1427&lang=en_US']").attr('src'))
	location.reload();

}
function validateShareLink()
{
	var shareurl = $("#share_url").val();
	if(shareurl != '')
	{		
		var regex = new RegExp("^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?");
		if(regex.test(shareurl)){			
			return true;
		}else{

			$("#error_share_link").show();
			$("#error_share_link").html('Enter valid URL');			
			return false;
		}	
	}
	else
	{
		$("#error_share_link").show();
		$("#error_share_link").html('Enter URL');		
		return false;
	}

}
function change_basic_link_status(thisData)
{
	if($(".basic_"+thisData).is(":checked"))
	{
		var status = 1;
	} else 
	{
		var status = 0;
	}
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			status: status,
			po_id:thisData,
			st:"st"
		},   
		success: function(response) {

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}

function change_image_link_status(thisData)
{

	if($(".basic_"+thisData).is(":checked"))
	{
		var status = 1;
	} else 
	{
		var status = 0;
	}
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
			status: status,
			po_id:thisData,
			st:"st"
		},   
		success: function(response) {

		},
		error:function 
		(XMLHttpRequest, textStatus, errorThrown) {
		}
	});  
}
function profile_form_validate()
{
	var profile_name = $.trim($("#profilename").val());
	var profile_link = $.trim($("#profilelink").val());
	var regexData = new RegExp("^(http|https)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\._\?\,\'/\\\+&amp;%\$#\=~])*[^\.\,\)\(\s]$");
	var check = 0;
	if(regexData.test(profile_link))
	{		
		var ext = profile_link.substring(profile_link.lastIndexOf('.') + 1);
		var domain = profile_link.replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
		var neWext = domain.split('.');
		if(neWext[1]=='' || neWext[1]==undefined)
		{
			check = 0;
		} 
		else 
		{
			if(ext ==="gif" || ext ==="GIF" || ext === "jpg" || ext === "JPG" ||  ext === "JPEG" || ext === "jpeg" ||  ext === "png"|| ext === "BMP")
			{
				check = 0;
			} 
			else 
			{
				check = 1;
			}
		}
	}
	else
	{
		check = 0;
		$("#link_profile").html("invalid Url");
		$("#link_profile").show();
	}

	if(profile_name!='' && profile_link!='' && check == 1)
	{
		$("#link_name").hide();
		$("#link_profile").hide();
		return true;
	} 
	else 
	{

		if(profile_name=='')
		{
			$("#link_name").show();
		}
		if(profile_link=='')
		{
			$("#link_profile").html("Required");
			$("#link_profile").show();
		}
		return false;
	}
}

function isDate(txtDate)
{
	var currVal = txtDate;
	if(currVal == ''){
		return false;
	}
	var rxDatePattern = /(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; //Declare Regex
	var dtArray = currVal.match(rxDatePattern); // is format OK?
	if (dtArray == null) {
		return false;
	} else {
		//Checks for mm/dd/yyyy format.
		dtYear = dtArray[1];
		dtMonth= dtArray[3];
		dtDay = dtArray[5];        
		var d = new Date();
		var month = d.getMonth()+1;
		var day = d.getDate();
		var output = d.getFullYear() + '-' +((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;
		if (dtMonth < 1 || dtMonth > 12) {
			return false;
		}
		else if (dtDay < 1 || dtDay> 31){ 
			return false;
		}
		else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31){ 
			return false; 
		}  else if (dtMonth == 2) 
		{
			var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
			if (dtDay> 29 || (dtDay ==29 && !isleap)) 
				return false;
		} else if(txtDate > output){
			return true;
		} else 
		{
			return false;
		}
	}
}

function saveBasicData()
{
	
	var isStatusValid = true;

	var title = $.trim(document.getElementById("inp_title").value);
	if (title == null || title == "") {		
		$('#Err_title').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_title').html("*");
	}

	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		$('#Err_contentUrl').html("* Required");
		isStatusValid =false;
	}
	else
	{
		$('#Err_contentUrl').html("*");
	}

	var profile = document.getElementById("inp_Profile").value;
	if (profile == null || profile == "addprofile") {
		$('#Err_Profile').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Profile').html("*");
	}

	var msg = document.getElementById("messsage").value;
	if (msg.trim() == null || msg.trim() == "") {
		$('#Err_message').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_message').html("*");
	}
	
	var yoururl = document.getElementById("inp_YourUrl").value;	
	if (yoururl == null || yoururl == "") {		
		$('#Err_YourUrl').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_YourUrl').html("*");
	}
	if(yoururl != "")
	{
		var isvalid =ValidURL(yoururl); 
		if(isvalid == false)
		{			
			$('#Err_YourUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_YourUrl').html("*");
		}
	}
	
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if(contentUrl != "")
	{
		var isvalidCont =ValidURL(contentUrl); 
		if(isvalidCont == false)
		{			
			$('#Err_contentUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_contentUrl').html("*");
		}
	}

	var height = document.getElementById("ctoa").value;
	if (height.trim() == null || height.trim() == "") {
		$('#Err_callAction').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_callAction').html("*");
	}
	
	var campId = $("#campId_hidden").val();
	var msgId = $("#messageId_hidden").val();


	if(isStatusValid == true)
	{
		var pophtmls = $('#popbasic').html();
		$('#pophtml').attr("value",pophtmls);
		$(".blackscreen").show();		
		$.ajax({
			type : "post",
			url : SITE_ROOT_URL + 'ajax/basic/saveBasic.php',
			data : {
				inp_title : title,
				inp_contentUrl : contentUrl,
				inp_Profile : profile,
				messsage : msg,
				inp_YourUrl : yoururl,
				ctoa : height,
				campId_hidden : campId,
				messageId_hidden: msgId,
				pophtml: pophtmls,
				submit: "submit"
			},
			success : function(response) {
				$("#linksPopUpAdd").html(response);
				$("#linksPopUpAdd").show();

			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
	}
	else
	{

		return  false;
	}
}
function saveFormdata()
{
	var isStatusValid = true;

	var title = $.trim(document.getElementById("inp_title").value);
	if (title == null || title == "") {		
		$('#Err_title').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_title').html("*");
	}

	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		$('#Err_contentUrl').html("* Required");
		isStatusValid =false;
	}
	else
	{
		$('#Err_contentUrl').html("*");
	}

	var profile = document.getElementById("inp_Profile").value;
	if (profile == null || profile == "addprofile") {
		$('#Err_Profile').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Profile').html("*");
	}

	var msg = document.getElementById("messsage").value;
	if (msg.trim() == null || msg.trim() == "") {
		$('#Err_message').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_message').html("*");
	}
	
	var yoururl = document.getElementById("inp_YourUrl").value;	
	if (yoururl == null || yoururl == "") {		
		$('#Err_YourUrl').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_YourUrl').html("*");
	}
	if(yoururl != "")
	{
		var isvalid =ValidURL(yoururl); 
		if(isvalid == false)
		{			
			$('#Err_YourUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_YourUrl').html("*");
		}
	}
	
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if(contentUrl != "")
	{
		var isvalidCont =ValidURL(contentUrl); 
		if(isvalidCont == false)
		{			
			$('#Err_contentUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_contentUrl').html("*");
		}
	}

	var height = document.getElementById("ctoa").value;
	if (height.trim() == null || height.trim() == "") {
		$('#Err_callAction').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_callAction').html("*");
	}
	
	var campId = $("#campId_hidden").val();
	var msgId = $("#messageId_hidden").val();
	var custom_html = $("#ChangeForms").val();
	
	if(isStatusValid == true)
	{
		var pophtmls = $('#popbasic').html();
		$('#pophtml').attr("value",pophtmls);
		$(".blackscreen").show();
		$.ajax({
			type : "post",
			url : SITE_ROOT_URL + 'ajax/basic/saveform.php',
			data : {
				inp_title : title,
				inp_contentUrl : contentUrl,
				inp_Profile : profile,
				messsage : msg,
				inp_YourUrl : yoururl,
				ctoa : height,
				campId_hidden : campId,
				messageId_hidden: msgId,
				pophtml: pophtmls,
				custom_html: custom_html,
				submit: "submit"
			},
			success : function(response) {
			       $("#magic").css('z-index','0');
				$("#linksPopUpAdd").html(response);
				$("#linksPopUpAdd").show();

			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
	}
	else
	{

		return  false;
	}
}



function savePollData()
{
	var isStatusValid = true;

	var title = $.trim(document.getElementById("inp_title").value);
	if (title == null || title == "") {		
		$('#Err_title').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_title').html("*");
	}

	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		$('#Err_contentUrl').html("* Required");
		isStatusValid =false;
	}
	else
	{
		$('#Err_contentUrl').html("*");
	}

	var profile = document.getElementById("inp_Profile").value;
	if (profile == null || profile == "addprofile") {
		$('#Err_Profile').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Profile').html("*");
	}

	var msg = document.getElementById("messsage").value;
	if (msg.trim() == null || msg.trim() == "") {
		$('#Err_message').html("* Required");
		isStatusValid =false;
	} else {
		$('#Err_message').html("*");
	}
	
	var yoururl = document.getElementById("inp_YourUrl").value;	
	if (yoururl == null || yoururl == "") {		
		$('#Err_YourUrl').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_YourUrl').html("*");
	}
	if(yoururl != "")
	{
		var isvalid =ValidURL(yoururl); 
		if(isvalid == false)
		{			
			$('#Err_YourUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_YourUrl').html("*");
		}
	}
	
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if(contentUrl != "")
	{
		var isvalidCont =ValidURL(contentUrl); 
		if(isvalidCont == false)
		{			
			$('#Err_contentUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_contentUrl').html("*");
		}
	}

	var height = document.getElementById("ctoa").value;
	if (height.trim() == null || height.trim() == "") {
		$('#Err_callAction').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_callAction').html("*");
	}
	
	var campId = $("#campId_hidden").val();
	var msgId = $("#messageId_hidden").val();
	var pollans = $("#ChangePolls").val();


	if(isStatusValid == true)
	{
		var pophtmls = $('#popbasic').html();
		$('#pophtml').attr("value",pophtmls);
		$(".blackscreen").show();		
		$.ajax({
			type : "post",
			url : SITE_ROOT_URL + 'ajax/basic/savepoll.php',
			data : {
				inp_title : title,
				inp_contentUrl : contentUrl,
				inp_Profile : profile,
				messsage : msg,
				inp_YourUrl : yoururl,
				ctoa : height,
				campId_hidden : campId,
				messageId_hidden: msgId,
				pophtml: pophtmls,
				pollans: pollans,
				submit: "submit"
			},
			success : function(response) {
                               $("#magic").css('z-index','0');
				$("#linksPopUpAdd").html(response);
				$("#linksPopUpAdd").show();

			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
			}
		});
	}
	else
	{

		return  false;
	}
}