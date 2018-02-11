<?php

include_once("include/header.php");
include_once("include/set.php");
include_once("include/functions.php");

$big_id = &$_POST['big_id'];
if ( $big_id == '') {
 $big_id = first_big_record() ;
}

$query = "select big_id, clasa_b from big_clase";
$result = mysql_query($query) or die ('Query failed'.mysql_error());

echo '
<form action="newloopback.php" method="post">

<table border="0" cellspacing="5" cellpadding="5">
  <tbody>
    <tr align="center" valign="center">
      <td>Clasa Parinte</td>
      <td><select name="big_id" size="1" onChange=this.form.submit()>';


while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	if ($line['big_id'] == $big_id) {
		echo'
		 <option value="'.$line['big_id'].'" selected>'.$line['clasa_b'].'</option>';
	} else {
	echo'
	 <option value="'.$line['big_id'].'">'.$line['clasa_b'].'</option>';
	}
}

echo'
      </select></td>
    </tr>
    <tr align="center" valign="center">
      <td>';
	//cauta_clasa($big_id);
	$clasa_libera = cauta_loopback($big_id);
	echo "$clasa_libera";
	//print cauta_clasa($big_id);
echo '
      </td>
      <td><input type="button" name="Adauga" value="Adauga" onClick="location.href = \'addloopback.php?clasa_libera='.$clasa_libera.'&parent='.$big_id.'\'"></td>
    </tr>
  </tbody>
</table>
</form>
';
