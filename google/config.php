<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/


$base_url= filter_var('Your domain path', FILTER_SANITIZE_URL);

// Visit https://code.google.com/apis/console to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
define('CLIENT_ID','60657940767-u2n0et3s430tp16t14k6o44aqqm7vdkt.apps.googleusercontent.com');
define('CLIENT_SECRET','yajgL0wx0Hx6opPA4Rwbl-Qk');
define('REDIRECT_URI','http://cliks.it/click/register.php');
define('APPROVAL_PROMPT','auto');
define('ACCESS_TYPE','offline');
?>