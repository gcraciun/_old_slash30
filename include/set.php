<?php

$dbhost = "host";
$dbuser = "status";
$dbpass = "n0p4ssr3qu1r3d";
$dbase = "status";

$link = mysql_pconnect($dbhost, $dbuser, $dbpass) or die('Could not connect'.mysql_error());
mysql_select_db($dbase) or die('Could not select database');

?>
