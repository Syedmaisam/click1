<?php 
include_once "../config/config.php";
?>
<style>
#twittershare iframe {
	width: 138px !important;
	height: 36px !important;
	padding-left: 30px !important;
}

#googleshare .googleplusshare {
	border: medium none;
	margin-left: 43px;
	padding-top: 8px;
	width: 21px !important;
}
.stumble iframe
{
height:27px!important;
}
.delicious a img
{
height:18px;
}
</style>
<div class="modal-content">
	<div class="modal-header">
		<button type="button" class="close" onClick="closeshare();"
			data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title">
			Share your link &ndash; <a target="_blank" id="share_pop_link"
				href="<?php echo $_POST['sharelink'] ?>"><?php echo $_POST['sharelink'] ?> </a>
		</h4>
	</div>
	<div style="display: table;" class="modal-body">

		<div class="col-md-8">
			<b id="sharetitle"><?php echo $_POST['sharetitle'] ?> </b><br>

		</div>

		<div class="col-md-12">
			<blockquote class="mt10 col-md-12">
				<?php if(isset($_POST['sharemessage']) && $_POST['sharemessage']!=''){ ?>
				<i class="fa fa-quote-left"></i>
				<p id="sharemessage">
					<?php echo $_POST['sharemessage']; ?>
				</p>
				<?php } ?>
				<small id="shareprofile"><?php echo $_POST['shareprofile'] ?> </small>
			</blockquote>

			<p>Share your link:</p>
		</div>
		<div class="row">
		<div class="col-md-3" id="twittershare">
			<div
				style="position: relative; position: relative; z-index: 3000; opacity: 0;">
				<a data-url="<?php echo $_POST['sharelink'] ?>"
					data-count-url="<?php echo $_POST['sharelink'] ?>"
					data-text="<?php echo $_POST['sharemessage'] ?>"
					href="https://twitter.com/share"
					class="twitter-share-button btn btn-primary btn-block tweetshare"
					data-dnt="true" data-count="none" data-via="">Tweet</a>
			</div>

			<script>
window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
</script>
			</a>
			<div style="position: absolute; top: 0px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/twitter.png'>
			</div>

		</div>
		<div class="col-md-3">
			<div
				style="position: relative; position: relative; z-index: 3000; opacity: 0;">
				<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
				<script type="text/javascript">_ga.trackFacebook();</script>
				<a class="btn btn-primary btn-block fbshare" href="#"><iframe
						width="100px" height="21px;"
						src="//www.facebook.com/plugins/share_button.php?href=<?php echo $_POST['sharelink']; ?>&amp;layout=button_count&amp;appId=680222178695742"
						scrolling="no" frameborder="0"
						style="border: none; overflow: hidden;" allowTransparency="true"></iframe>

				</a>
			</div>
			<div style="position: absolute; top: 0px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/facebook.png'>
			</div>
		</div>
		<div class="col-md-3" id="googleshare"
			style="width: 138px; background: none repeat scroll 0% 0% rgb(60, 141, 188); border-radius: 3px; height: 35px;">

			<div
				style="position: relative; position: relative; z-index: 3000; opacity: 0;">
				<a
					href="https://plus.google.com/share?url=<?php echo $_POST['sharelink'] ?>"
					onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
					src="https://www.gstatic.com/images/icons/gplus-32.png"
					alt="Share on Google+"
					class="btn btn-primary btn-block googleplusshare" /> </a>
			</div>
			<div style="position: relative; left: -16px; top: -35px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/gplus.png'>
			</div>
		</div>
		<div class="col-md-3">
			<div id='frameLinkedin'
				style='margin-top: 10px; opacity: 0; position: absolute; z-index: 3000; left: 32px;'>
				<script id="linkedin" src='//platform.linkedin.com/in.js' type='text/javascript'> lang: en_US</script>
				<script id="newData" type='IN/Share' data-url="<?php echo $_POST['sharelink'] ?>" data-counter='0'></script>
			</div>
			<div style="position: relative; left: 7px; top: -1px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/lin.png'>
			</div>
		</div>
		</div>
		<div class="row" style="margin-top:20px;">
		<!-- Pinterest -->
		<div class="col-md-3">
		<div style="position: relative; left: 0px; top: -5px;">
			
				<img src='<?php echo SITE_ROOT_URL ?>img/pin.png' onclick="openPin()" style="cursor:pointer;">
			</div>
		</div>		
		
		<!-- Stumble Upon -->
		<div class="col-md-3">
		<div class="stumble" style="z-index: 100; position: absolute; padding-left: 40px; opacity: 0;">
			<su:badge layout="5" location="<?php echo $_POST['sharelink']; ?>"></su:badge>
		</div>
		<div style="position: relative; left: 0px; top: -7px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/stumble.png'>
			</div>
		</div>

		<!-- Delicious -->
		<div class="col-md-3">
		<div class="delicious" style="z-index: 100; position: relative; padding-left: 12px; opacity: 0;">
			<a href="#" title="Data"
				onclick="window.open('https://delicious.com/save?v=5&provider=techpro&noui&jump=close&url='+encodeURIComponent('<?php echo $_POST['sharelink']; ?>')+'&title='+encodeURIComponent('data'), 'delicious','toolbar=no,width=550,height=550'); return false;">
				<img src="https://delicious.com/img/logo.png" height="16" width="75"
				alt="Delicious">
			</a>
			</div>
			<div style="position: relative; top: -26px; left: -14px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/delicious.png'>
			</div>
		</div>
		
		<!-- Digg -->
		<div class="col-md-3">
		
			<div style="position: relative; top: -5px; left: -26px;">
				<img src='<?php echo SITE_ROOT_URL ?>img/digg.png' onclick="openBox()" style="cursor:pointer;">
			</div>
		</div>
</div>
<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
<div style="position: relative; top: -5px; left: -26px; text-align:center;">
<img src='<?php echo SITE_ROOT_URL ?>img/vk.png' onclick="vkShareBox()" style="cursor:pointer;">
				
			</div>
</div>
<div class="col-md-4">
</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  (function() {

    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = false; li.id = 'stumb';
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();

 function openBox()
  {
	 var myWindow = window.open("http://www.digg.com/submit?url=<?php echo $_POST['sharelink'];?>", "", "width=500, height=600");
  }
function vkShareBox()
 {
	 var myWindow = window.open("http://vk.com/share.php?url=<?php echo $_POST['sharelink']; ?>", "", "width=500, height=600");
 }
function openPin()
{
	var url = "<?php echo $_POST['sharelink'] ?>";
    var media = "<?php echo $_POST['profileimg'] ?>";
    var desc = $(this).attr('data-desc');
    window.open("//www.pinterest.com/pin/create/button/"+
    "?url="+url+
    "&media="+media+
    "&description="+desc,"_blank", "toolbar=no, scrollbars=no, resizable=no, top=0, right=0, width=750, height=320");
    return false;
}
</script>