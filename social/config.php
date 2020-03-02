<?php
/*
------------------------------------------------------
  www.idiotminds.com
--------------------------------------------------------
*/
@session_start();
define('BASE_URL', filter_var('http://cliks.it/click/', FILTER_SANITIZE_URL));

define('APP_ID','1567714706823859');
define('APP_SECRET','8b3ba65d376ff7c2efc4b01dbbdde3e1');

define('CONSUMER_KEY', 'cBMEd3zVVvflqBpoMs6fw');
define('CONSUMER_SECRET','TYAdgYY5U1pJuS1A5nnk3RZwHHzfyzl7BrjDWsjU');
define('OAUTH_CALLBACK', "http://cliks.it/click/callback.php");

?>