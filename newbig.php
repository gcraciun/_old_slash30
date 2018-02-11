<?php

include_once("include/functions.php");
include_once("include/set.php");

$clasa = &$_POST['clasa'];
$descr = &$_POST['descr'];

//echo "clasa = $clasa<br>";

if (!empty($clasa) && add_big_class($clasa, $descr)){
echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=listbig.php"';
}
