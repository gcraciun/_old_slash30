<?php

include_once("include/set.php");
include_once("include/header.php");

$parent = &$_GET['parent'];

if (!empty($parent)) {
 $query = "select small_id, clasa_s, descr, parent from small_clase where parent='".$parent."' and clasa_s like '%/32%'";
 } else {
  $query = "select small_id, clasa_s, descr, parent from small_clase where clasa_s like '%/32%'";
  }
$result = mysql_query($query) or die ('Query failed'.mysql_error());

echo '
<table class="one" border="0" cellspacing="5" cellpadding="5">
 <tr>
  <td align="center">Nr</td>
  <td align="center">Clasa</td>
  <td align="center">Descriere</td>
  <td align="center">Actiune</td>
 </tr>';

 $i=1;

 while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
  echo '
  <tr>
   <td>'.$i.'</td>
   <td><a href="viewloop.php?id='.$line['small_id'].'">'.$line['clasa_s'].'</a></td>
   <td><a href="viewloop.php?id='.$line['small_id'].'">'.$line['descr'].'</a></td>
   <td><input type="button" name="Sterge" value="Sterge" onClick="location.href = \'delloop.php?clasa='.$line['loop_id'].'&parent='.$parent.'\'"> </td>
  </tr>';
 $i++;
}

echo '</table>';

