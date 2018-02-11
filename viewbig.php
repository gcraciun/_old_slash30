<?php

include_once ("include/header.php");
include_once ("include/set.php");
include_once ("include/functions.php");

$id = &$_GET['id'];

if ( empty($id) && !empty($_POST['id']) ) {
$id = &$_POST['id'];
$clasa = &$_POST['clasa'];
$descr = &$_POST['descr'];
update_big_class($id,$clasa,$descr);
}

$query = "select clasa_b, descr from big_clase where big_id='".$id."'";
$result = mysql_query($query) or die ('Query failed'.mysql_error());
$line = mysql_fetch_array($result, MYSQL_ASSOC);


echo '
<table class="one" border="0" cellspacing="5" cellpadding="5">
  <tbody>
    <tr align="center" valign="center">
      <td>Clasa</td>
      <td>Descriere</td>
      <td></td>
    </tr>
    <tr >
      <form action="viewbig.php" method="post">
      <input type="hidden" name="id" value="'.$id.'">
      <td><input type="text" name="clasa" value="'.$line['clasa_b'].'"></td>
      <td><input type="text" name="descr" value="'.$line['descr'].'"></td>
      <td><input type="submit" value="Update"></td>
      </form>
    </tr>
  </tbody>
</table>
';
