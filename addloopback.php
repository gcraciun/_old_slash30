<?php

include_once("include/set.php");
include_once("include/header.php");
include_once("include/functions.php");

$clasa_libera = &$_GET['clasa_libera'];
$parent = &$_GET['parent'];
$descr = &$_GET['descr'];

//echo "clasa libera este ".$clasa_libera;
//echo "parent =".$parent;
//echo "descr =".$descr;

if (!empty($descr)) {
add_loopback($clasa_libera,$parent,$descr);
echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=loopback.php?parent='."$parent".'">';
} else {

	echo '<form action="addloopback.php" method="get">
	<input type="hidden" name="parent" value="'.$parent.'">
	';
	echo'
	<table border="0" cellspacing="5" cellpadding="5">
  	 <tbody>
    	 <tr align="center" valign="center">
      	  <td>Subnet</td>
      	  <td><input type="text" name="clasa_libera" value="'.$clasa_libera.'"></td>
      	  <td rowspan="2"><input type="submit" value="Insereaza"></td>
    	</tr>
    	<tr align="center" valign="center">
      	  <td>Descriere</td>
      	  <td><input type="text" name="descr"></td>
    	</tr>
       </tbody>
       </table>
      </form>
';
}
