<?php

unset($_COOKIE['dapcookie_email']);
unset($_COOKIE['dapcookie_password']);
unset($_COOKIE['PHPSESSID']);
unset($_COOKIE['inspiredsoft_11_init']);
unset($_COOKIE['inspiredsoft_11']);

setcookie('dapcookie_email', null, -1, '/');
setcookie('dapcookie_password', null, -1, '/');
setcookie('PHPSESSID', null, -1, '/');
setcookie('inspiredsoft_11_init', null, -1, '/');
setcookie('inspiredsoft_11', null, -1, '/');


?>