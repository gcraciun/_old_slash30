<?php

include_once("include/set.php");
include_once("include/header.php");

$query = "select big_id, clasa_b, descr from big_clase";
$result = mysql_query($query) or die ('Query failed'.mysql_error());

echo'
<table>
  <tbody>
    <tr align="center" valign="top">
      <td>


<table border="0" cellspacing="5" cellpadding="5">
 <tr align="center" valign="center">
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
   <td><a href="viewbig.php?id='.$line['big_id'].'">'.$line['clasa_b'].'</a></td
   <td><a href="viewbig.php?id='.$line['big_id'].'">'.$line['descr'].'</a></td
   <td><input type="button" name="Sterge" value="Sterge" onClick="location.href = \'delbig.php?clasa='.$line['big_id'].'\'"> </td>
  </tr>';
 $i++;
}

echo '</table>

      </td>
      <td>
      <table border="0" cellspacing="5" cellpadding="5">
      <tbody>
      <tr valign="center" align="center">
       <td>Clasa</td>
       <td>Descriere</td>
       <td></td>
      <tr valign="center" align="center">
      <form action="newbig.php" method="post">
       <td><input type="text" name="clasa"></td>
       <td><input type="text" name="descr"></td>
       <td><input type="submit" value="Adauga"></td>
       </form>
      </tr>
      </tbody>
      </table>
      ';
echo'
      </td>
    </tr>
  </tbody>
</table>
';

