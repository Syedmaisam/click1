function createImgCamp() {


	var isStatusValid = true; 

	var title = $.trim(document.getElementById("inp_title").value);
	if (title == null || title == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_title').html("* Required");
		isStatusValid =false;
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_title').html("*");
	}

	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_contentUrl').html("* Required");
		//return false;
		isStatusValid =false;
	}
	else
	{
		$('#Err_contentUrl').html("*");
	}

	var profile = document.getElementById("inp_Profile").value;
	if (profile == null || profile == "addprofile") {
		//$('#Err_Profile').css('display', 'block');
		$('#Err_Profile').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Profile').html("*");
	}

	var ImgError = $('#Err_ImgLocation').text();//document.getElementById("Err_ImgLocation").value;

	if(ImgError == "* Invalid")
	{
		isStatusValid = false;
	}


	//start imageurl & Browse location
	var imageurl = document.getElementById("inp_ImgUrl").value;
	var browseloc = $('#imagePreview').css("background-image");

	if(imageurl == null || imageurl == "") 
	{
		if(browseloc == "none")
		{
			isStatusValid = false;
		}
		
	}

var contentUrl = document.getElementById("inp_contentUrl").value;
	if(contentUrl != "")
	{
		var isvalidCont =ValidUrl_ForContentUrl(contentUrl); 
		if(isvalidCont == false)
		{
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_contentUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_contentUrl').html("*");
		}
	}


//	if (imageurl == null || imageurl == "") 
//	{
//	$('#Err_ImgUrl').html("*");
//	isStatusValid = false;
//	}else
//	{
//	$('#Err_ImgUrl').html("*");
//	}
//	if(imageurl != "")
//	{
//	var isvalid =ValidURL(imageurl); 
//	if(isvalid == false)
//	{
//	$('#Err_ImgUrl').html("* Invalid Url");
//	isStatusValid = false;
//	}else
//	{
//	$('#Err_ImgUrl').html("*");
//	}
//	}
	//end image url

	//start yourUrl
	
	var yoururl = document.getElementById("inp_YourUrl").value;

	if (yoururl == null || yoururl == "") {
		//$('#Err_YourUrl').css('display', 'block');
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
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_YourUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_YourUrl').html("*");
		}
	}
	//start yourUrl


	// start height
	var height = document.getElementById("inp_Height").value;

	if (height == null || height == "") {
		//$('#Err_height').css('display', 'block');
		$('#Err_height').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_height').html("*");
	}
	if(height != "")
	{
		var isvalid = ValidateNumber(height); 
		if(isvalid == false)
		{
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_height').html("* Invalid");
			isStatusValid = false;
		}
		else
		{
			//$('#Err_YourUrl').css('display', 'none');
			$('#Err_height').html("*");
		}
	}
	//end height

	//start width
	var width = document.getElementById("inp_Width").value;

	if (width == null || width == "") {
		//$('#Err_width').css('display', 'block');
		$('#Err_width').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_width').html("*");
	}
	if(width != "")
	{
		var isvalid =ValidateNumber(width); 
		if(isvalid == false)
		{
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_width').html("* Invalid");
			isStatusValid = false;
		}
		else
		{
			//$('#Err_YourUrl').css('display', 'none');
			$('#Err_width').html("*");
		}
	}
	//end width

	var timing = document.getElementById("inp_Timing").value;
	if (timing == null || timing == "") {
		//$('#Err_timimg').css('display', 'block');
		$('#Err_timimg').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_timimg').html("*");
	}

	if(isStatusValid==true)
	{
		return true;
	}
	else
	{
		return  false;
	}

}

function imageValidURL(str) 
{
	var isvalid = false;
	var ext = '';
	var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
	
	if (!myRegExp.test(str))
	{
		isvalid = false;
	}
	else
	{
		isvalid = true;
		
	}
	return isvalid;
}
function ValidUrl_ForContentUrl(str)
{
	var isvalid = false;
	var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
	
	if (!myRegExp.test(str))
	{
		isvalid = false;
	}
	else
	{
        var domain = str.replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
		var neWext = domain.split('.');
        if(neWext[1]=='' || neWext[1]==undefined) 
        {
            isvalid = false;
        } 
        else 
        {
        	isvalid = true;
       }
	}
	return isvalid;
}
function ValidURL(str) 
{
	var isvalid = false;
	var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;
	
	if (!myRegExp.test(str))
	{
		isvalid = false;
	}
	else
	{
var domain = str.replace('http://','').replace('https://','').replace('www.','').split(/[/?#]/)[0];
		var neWext = domain.split('.');
if(neWext[1]=='' || neWext[1]==undefined){
isvalid = false;
} else {
		var ext = str.substring(str.lastIndexOf('.') + 1);
		if(ext ==="gif" || ext ==="GIF" || ext === "jpg" || ext === "JPG" ||  ext === "JPEG" || ext === "jpeg" ||  ext === "png"|| ext === "BMP"){
			isvalid = false;
		} else {  
			isvalid = true;
		}
}
	}
	return isvalid;
}
function ValidateNumber(num)
{
	var isvalid = false;
	var myRegExp = /^\d{1}|[1-9]\d{1}$/;
	if (!myRegExp.test(num))
	{
		isvalid = false;
	}
	else
	{
		isvalid = true;
	}
	return isvalid;
}
function inputTitle()
{
	var title = document.getElementById("inp_title").value;
	if (title == null || title == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_title').html("* Required");
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_title').html("*");
	}
}
function inputContentUrl() {
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_contentUrl').html("* Required");
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_contentUrl').html("*");
	}
	if(contentUrl!="")
	{
		var isvalid =ValidUrl_ForContentUrl(contentUrl); 
		if(isvalid == false)
		{
			//$('#Err_ImgUrl').css('display', 'block');
			$('#Err_contentUrl').html("* Invalid Url");
			return false;
		}
		else
		{
			//$('#Err_ImgUrl').css('display', 'none');
			$('#Err_contentUrl').html("*");
		}
	}
	
}
function selectProfile() {

	var profile = document.getElementById("inp_Profile").value;
	//alert(profile);
	if (profile == null || profile == "addprofile") {
		//$('#Err_Profile').css('display', 'block');
		$('#Err_Profile').html("* Required");
	} else {
		//$('#Err_Profile').css('display', 'none');
		$('#Err_Profile').html("*");
	}
}

function imageurlOnchange() {
	var imageurl = document.getElementById("inp_ImgUrl").value;	
	//$('inp_ImgLocation').removeAttr("disabled");


	if (imageurl == null || imageurl == "") {
		$('#inp_ImgLocation').attr("disabled",true);
		$('#Err_ImgUrl').html("*");
		$('#inp_ImgLocation').removeAttr("disabled");
	} else {		
		$('#Err_ImgUrl').html("*");
	}
	if(imageurl !="")
	{
		$('#inp_ImgLocation').attr("disabled","disabled");
		var isvalid =imageValidURL(imageurl); 
		if(isvalid == false)
		{
			//$('#Err_ImgUrl').css('display', 'block');
			$('#Err_ImgUrl').html("* Invalid Url");
			return false;
		}
		else
		{			
			//$('#Err_ImgUrl').css('display', 'none');
			//$('#inp_ImgLocation').removeAttr("disabled");
			$('#Err_ImgUrl').html("*");
		}
	}

}
function yoururlOnchange() {
	var yoururl = document.getElementById("inp_YourUrl").value;
	if (yoururl == null || yoururl == "") {
		//$('#Err_YourUrl').css('display', 'block');
		$('#Err_YourUrl').html("* Required");
	} else {
		//$('#Err_YourUrl').css('display', 'none');
		$('#Err_YourUrl').html("*");
	}
	if(yoururl !="")
	{
		var isvalid =ValidURL(yoururl); 
		if(isvalid == false)
		{
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_YourUrl').html("* Invalid Url");
			return false;
		}
		else
		{
			//$('#Err_YourUrl').css('display', 'none');
			$('#')
			$('#Err_YourUrl').html("*");
		}
	}
	
}
function heightOnchange() {
	var height = document.getElementById("inp_Height").value;
	if (height == null || height == "") {
		//$('#Err_height').css('display', 'block');
		$('#Err_height').html("* Required");
	} else {
		//$('#Err_height').css('display', 'none');
		$('#Err_height').html("*");
	}
	
	var isvalid =ValidateNumber(height); 
	if(isvalid == false)
	{
		//$('#Err_YourUrl').css('display', 'block');
		$('#Err_height').html("* Invalid");
		return false;
	}
	else
	{
		//$('#Err_YourUrl').css('display', 'none');
		$('#Err_height').html("*");
	}
}
function widthOnchange() {
	var width = document.getElementById("inp_Width").value;
	if (width == null || width == "") {
		//$('#Err_width').css('display', 'block');
		$('#Err_width').html("* Required");
	} else {
		//$('#Err_width').css('display', 'none');
		$('#Err_width').html("*");
	}
	
	var isvalid =ValidateNumber(width); 
	if(isvalid == false)
	{
		//$('#Err_YourUrl').css('display', 'block');
		$('#Err_width').html("* Invalid");
		return false;
	}
	else
	{
		//$('#Err_YourUrl').css('display', 'none');
		$('#Err_width').html("*");
	}
}
function timingOnchange() {
	var timing = document.getElementById("inp_Timing").value;
	if (timing == null || timing == "") {
		//$('#Err_timimg').css('display', 'block');
		$('#Err_timimg').html("* Required");
	} else {
		//$('#Err_timimg').css('display', 'none');
		$('#Err_timimg').html("*");
	}
}
function selectImage(fileName)
{
	$('#Err_ImgLocation').attr('value',"");
	var allowed_extensions = new Array("jpg","png","gif","jpeg");
	var file_extension = fileName.split('.').pop(); // split function will split the filename by dot(.), and pop function will pop the last element from the array which will give you the extension as well. If there will be no extension then it will return the filename.

	for(var i = 0; i <= allowed_extensions.length; i++)
	{
		if(allowed_extensions[i]==file_extension)
		{
			$('#Err_ImgLocation').html("");
			$('#Err_ImgLocation').attr('value',"isvalid");
			$('#inp_ImgUrl').attr('disabled',true);
			$('#imagePreview span').show();
			return true; // valid file extension
		}
	}
	$('#Err_ImgLocation').html("* Invalid");
	return false;
}

function delete_image(id)
{
	$.ajax({
		type: "post",
		url: window.location.href,
		data: {
		id: id,
		q:"delete",
		beforeSend: function() {
		$("#image_"+id).css({'background-color':'#fb6c6c'},300);
	},
	},			
	success: function(response) {
		$("#image_"+id).slideUp(1000,function() {
			$("#image_"+id).remove();
		});
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	}); 
}

//javascript code for basic tab --------------------------------------------------------------------

function inputMessage()
{
	var title = document.getElementById("messsage").value;
	if (title == null || title == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_message').html("* Required");
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_message').html("*");
	}
}
function callActionOnChange()
{
	var title = document.getElementById("ctoa").value;
	if (title == null || title == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_callAction').html("* Required");
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_callAction').html("*");
	}
}
function selectBasicProfile() {

	//var profile = document.getElementById("inp_Profile").value;
	var profilename = $('#inp_Profile option:selected').text();
	var profileid = $('#inp_Profile option:selected').val();
	//alert(profile);
	if (profilename == null || profilename == "Add new profile") {
		//$('#Err_Profile').css('display', 'block');
		$('#Err_Profile').html("* Required");
		 $('#inp_Campaign').html("<option value='0'>Select Campaign</option>");
		 
		
	} else {
		//$('#Err_Profile').css('display', 'none');
		$('#Err_Profile').html("*");
		$.ajax({
			url:SITE_ROOT_URL+'ajax/campaign/getCampaignDropDown.php',
			type:"post",
			 data: {
				    submit: "submit",
				    id: profileid,
				    basic:"Basic"
			   		          
			 },
			 success: function(response) { 
				
				 var arr = response.split('##');
				 var profileImage = arr[1];
				 var dropDownHtml = arr[0];
				 if(profileImage != '')
				 {
					 $(".picture a img").attr('src',SITE_ROOT_URL+'images/profile/'+profileImage);
				 }
				 else
				 {
					 $(".picture a img").attr('src',SITE_ROOT_URL+'images/profile/default.png');
				 }

				 $('#inp_Campaign').html(dropDownHtml);
			 }
		
		});
	}
	$('#txtlink').html(profilename);
	//selectMessage()
	
}

function selectMessage()
{
	var profileId = $('#inp_Profile option:selected').val();
	var camp = $('#inp_Campaign option:selected').text();
	var campid = $('#inp_Campaign option:selected').val();
	var imageUrl = $('#inp_Profile option:selected').attr('image');	
	var profileId = $('#inp_Profile').val();

	if (camp == "Please Select Campaign") {	

		$('#normalpanel').show();
		$('#campaignpanel').hide();
		$('#inp_SelMessage').html("");

		var oldpopup = $('#pophtml').val();
		$('#popbasic').html(oldpopup);

		var oldmsg = $('#mktmsg').html();
		$('#messsage').val(oldmsg);		

		var oldbtnhref = $('#linkbgcl').attr('href');
		$('#inp_YourUrl').attr('href',oldbtnhref);

		var linktext = $('#linkbgcl').html();
		$('#ctoa').val(linktext);

		// add value to hidden fields 
		$('#campId_hidden').attr('value',0);

		// Set Default Image
		$('.picture a img').attr('src',SITE_ROOT_URL+'images/profile/default.png');

	}else
	{
		// add value to hidden fields 
		$('#campId_hidden').attr('value',campid);
		
		
		$('#normalpanel').hide();
		$('#campaignpanel').show();
		
		$.ajax({
			url:SITE_ROOT_URL+'ajax/campaign/getMessages.php',
			type:"post",
			 data: {
				    submit: "submit",
				    id: campid,
				    pid: profileId
			   		          
				   },
				   success: function(response) { 
					  // alert(response);
					   $('#inp_SelMessage').html(response);
					   //$('#popbasic').html()
					   }
		
		});
		
		$.ajax({
			url:SITE_ROOT_URL+'ajax/campaign/getPopupHtml.php',
			type:"post",
			 data: {
				    submit: "submit",
				    task: "getPopupHtml",
				    id: campid,
				    pid:profileId
			   		          
				   },
				   success: function(response) { 
					   //alert(response);
					   //$('#inp_SelMessage').html(response);
					   $('#popbasic').html(response);
					     var msg = $('#mktmsg').html();
						// alert(msg);
						 $('#messsage').val(msg);
						
						 var linkhref = $('#linkbgcl').attr('href');
						 $('#inp_YourUrl').val(linkhref);
						 //alert(linkhref);
						 var linktext = $('#linkbgcl').html();
						 $('#ctoa').val(linktext);
						 //alert(linktext);
						 
						 // Add Image back to Image		
						 if(imageUrl != '')
						 {
							 $('.picture a img').attr('src',SITE_ROOT_URL+'images/profile/'+imageUrl);
						 }

					   }
		
		});
		 
	}
	
}
function getCampId()
{
	var campid= $('#inp_Campaign option:selected').val();
	$('#campId_hidden').val(campid);
}
function ChangeMessageText()
{
	var msgId = $('#inp_SelMessage option:selected').val();
	var imageUrl = $('#inp_Profile option:selected').attr('image');	
	// add value to hidden fields 
	$('#messageId_hidden').attr('value',msgId);
	$.ajax({
		url:SITE_ROOT_URL+'ajax/campaign/getPopupHtml.php',
		type:"post",
		 data: {
			    submit: "submit",
			    task: "getPopupMsg",
			    id: msgId
			   
		   		          
			   },
			   success: function(response) { 
				   //alert(response);
				   //$('#inp_SelMessage').html(response);
				   $('#popbasic').html(response);
				     var msg = $('#mktmsg').html();
					 //alert(msg);
					 $('#messsage').val(msg);
					
					 var linkhref = $('#linkbgcl').attr('href');
					 $('#inp_YourUrl').val(linkhref);
					 //alert(linkhref);
					 var linktext = $('#linkbgcl').html();
					 $('#ctoa').val(linktext);
					 //alert(linktext);
					 $('.picture a img').attr('src',SITE_ROOT_URL+'images/profile/'+imageUrl);
				   }
	
	});
	
}	
function createbasicCamp()
{
	var isStatusValid = true;
	
	var title = $.trim(document.getElementById("inp_title").value);
	if (title == null || title == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_title').html("* Required");
		isStatusValid =false;
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_title').html("*");
	}
	
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (contentUrl == null || contentUrl == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_contentUrl').html("* Required");
		//return false;
		isStatusValid =false;
	}
	else
	{
		$('#Err_contentUrl').html("*");
	}

	var profile = document.getElementById("inp_Profile").value;
	if (profile == null || profile == "addprofile") {
		//$('#Err_Profile').css('display', 'block');
		$('#Err_Profile').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Profile').html("*");
	}
	
	/*var camp = document.getElementById("inp_Campaign").value;
	if (camp == null || camp == "SelectCampaign") {
		//$('#Err_Profile').css('display', 'block');
		$('#Err_Campaign').html("* Required");
		isStatusValid =false;
	}else
	{
		$('#Err_Campaign').html("*");
	}*/
	
	var msg = document.getElementById("messsage").value;
	if (msg.trim() == null || msg.trim() == "") {
		//$('#Err_contentUrl').css('display', 'block');
		$('#Err_message').html("* Required");
		isStatusValid =false;
	} else {
		//$('#Err_contentUrl').css('display', 'none');
		$('#Err_message').html("*");
	}
	
	 
	//start yourUrl
	var yoururl = document.getElementById("inp_YourUrl").value;
	var contentUrl = document.getElementById("inp_contentUrl").value;
	if (yoururl == null || yoururl == "") {
		//$('#Err_YourUrl').css('display', 'block');
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
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_YourUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_YourUrl').html("*");
		}
	}
	if(contentUrl != "")
	{
		var isvalidCont =ValidURL(contentUrl); 
		if(isvalidCont == false)
		{
			//$('#Err_YourUrl').css('display', 'block');
			$('#Err_contentUrl').html("* Invalid Url");
			isStatusValid = false;
		}else
		{
			$('#Err_contentUrl').html("*");
		}
	}
	//start yourUrl
	
	
	// start ctoa
	var height = document.getElementById("ctoa").value;
	
	if (height.trim() == null || height.trim() == "") {
		//$('#Err_height').css('display', 'block');
		$('#Err_callAction').html("* Required");
		isStatusValid = false;
	}else
	{
		$('#Err_callAction').html("*");
	}
	
	
	//end ctoa
	
	if(isStatusValid == true)
	{
		var pophtmls = $('#popbasic').html();
		$('#pophtml').attr("value",pophtmls);
		return true;
	}
	else
	{
	    return  false;
	}
}
function delete_basicdetail(id)
{
	$.ajax({
		url:SITE_ROOT_URL+'ajax/basic/ajax_deleteBasicHistory.php',
		type:"post",
		 data: {
			    submit: "submit",
			    id: id
		   		          
			   },
			   success: function(response) { 
				   //alert(response);
				   window.location.reload();
				   }
	
	});
}
function delete_FormsPolldetail(id)
{
	
	$.ajax({
		url:SITE_ROOT_URL+'ajax/basic/ajax_deleteFormsPollHistory.php',
		type:"post",
		 data: {
			    submit: "submit",
			    id: id
		   		          
			   },
			   success: function(response) { 
				 //  alert(response);
				   window.location.reload();
				   }
	
	});
	
}
function onclick_CrossButton()
{

	var myhtml =  "<input type='file' onchange='selectImage(this.value)' placeholder='e.g. We offer Awesome Product' accept='image/*' aria-required='true' name='inp_ImgLocation' id='inp_ImgLocation' class='' value=''>";
	$('#inp_ImgUrl').removeAttr('disabled');
	$("#imagePreview span").hide();
	$("#imagePreview").css('background-image','');
	$("#inp_ImgLocation").val('');	
}

