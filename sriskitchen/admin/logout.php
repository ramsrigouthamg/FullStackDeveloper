<?php


$_SESSION = array() ;
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}
session_unset(); 
session_destroy();
echo '<meta http-equiv="refresh" content="0; url=login.php">';
exit();
#header('Location:login.php');
?>