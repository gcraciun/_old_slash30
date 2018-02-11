<?php

include_once ("include/set.php");
include_once ("include/functions.php");

$clasa=&$_GET['clasa'];

if (!empty($clasa) && del_big_class($clasa)){
echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=listbig.php">';
}
