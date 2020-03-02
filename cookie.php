<?php

$cookie_name = "TestCookie";
$cookie_value = "Rohit";

//echo "Server is working"; exit;

if(!isset($_COOKIE[$cookie_name])) 
{
	setcookie($cookie_name, $cookie_value, time() + (2 * 30), "/");
	echo "Cookie Set";
}
else
{
	echo "Cookie Already Found";
}
?>
<html>
<head> 
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '654212584724991']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="20" width="20" alt="" style="display:none" src="https://www.facebook.com/tr?id=654212584724991&amp;ev=PixelInitialized" /></noscript>
</head>
<body>

<h1>I am tracking You...!</h1>

<p id="demo">Thanks for opening the link....</p>

</body>
</html>