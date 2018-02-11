<?php

function netcidr_match($cidr, $ip) {                                              
    list ($net, $mask) = explode ('/', $cidr);
    return ( ip2long ($ip) & ~((1 << (32 - $mask)) - 1) ) == ip2long ($net);
}

/*
include_once ("set.php");


        $query_clasa="select clasa_b from big_clase where big_id='5'";
        $result_clasa=mysql_query($query_clasa) or die ('Query failed'.mysql_error());
        $line_clasa = mysql_fetch_array($result_clasa, MYSQL_ASSOC); 
        list($addr,$mask) = split('/',$line_clasa['clasa_b']);
        $addr_long = ip2long($addr);
        $mask_long = $mask;         
        $maskbin = '';
        for($i=1;$i<=32;$i++) {
        $maskbin .= $mask_long >= $i ? '1' : '0';
        }
        $mask_long = bindec($maskbin);
        $nw = ($addr_long & $mask_long);
        $brd = $nw | (~$mask_long);

$query = "select clasa_s from small_clase where parent='5'";
$result = mysql_query($query) or die ('Query failed'.mysql_error());

$rows = mysql_num_rows($result);
if ($rows == 0) {
	echo "nu suntem aici"; $valoare = long2ip($addr_long+1); return (long2ip($addr_long+1).'/32');
}

$future_net = $addr_long;

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
	list ($line_addr, $line_mask) = split ('/',$line['clasa_s']);
	$line_addr_long = ip2long($line_addr);
	$my_very_big_array[$line_addr_long] = $line_mask;
}

foreach ($my_very_big_array as $key => $value) {
	echo long2ip($key)." _ $value <br>";
}
echo "------<br>";
ksort($my_very_big_array);
foreach ($my_very_big_array as $key => $value) {
	echo long2ip($key)."  _ $value <br>";
}
*/

$valoare = "127.156.101.0/30";
$future_net = "127.156.101.0";
$value = "30";

if ( (netcidr_match($valoare,$future_net)) and ($value == 30) ) {
echo "valoare = $valoare -- future_net = $future_net -- value = $value";
}
