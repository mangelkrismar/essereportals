<?php
session_start();
if (isset($_SESSION['expire'])) {
$now = time();
  
if($now > $_SESSION['expire']) {
    session_destroy();
    echo "expire";
}else{
	echo $now.":".$_SESSION['expire'];
}
}
?>