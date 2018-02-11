<?php

include_once ("set.php");

function first_big_record() {
 $query_big = "select big_id from big_clase limit 1";
 $result_big = mysql_query($query_big) or die ('Query failed'.mysql_error());
 $line_big = mysql_fetch_array($result_big, MYSQL_ASSOC);
 return $line_big['big_id'];
}


function netcidr_match($cidr, $ip)
  {
    list ($net, $mask) = explode ('/', $cidr);
    return ( ip2long ($ip) & ~((1 << (32 - $mask)) - 1) ) == ip2long ($net);
  }

function cauta_clasa($big_id) {
	$query_clasa="select clasa_b from big_clase where big_id='".$big_id."'";
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

 $very_big_array=array();

  $query = "select clasa_s from small_clase where parent='".$big_id."'";
  $result = mysql_query($query) or die ('Query failed'.mysql_error());

    $rows = mysql_num_rows($result);
    if ($rows == 0) {
  	return (long2ip($addr_long).'/30');
    }

  $future_net = $addr_long;


  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
  	list ($line_addr, $line_mask) = split ('/',$line['clasa_s']);
  	$line_addr_long = ip2long($line_addr);
  	$my_very_big_array["$line_addr_long"] =$line_mask;
  }

ksort($my_very_big_array);
foreach ($my_very_big_array as $key => $value) {
   //$valoare = long2ip($key).'/'.$value;
   //echo "value este $value key este ".long2ip($key)." future net este ".long2ip($future_net)."<br>";
   if ($future_net == $key) { // and ($value == 30 )) {
   $future_net = $future_net + 4;
   //echo "future_net a fost egal cu key, acum future_net este ".long2ip($future_net)."<br>";
   } else if ($key > $future_net) {
        $future_net = $future_net + 4;
     }
}

  if ( netcidr_match($line_clasa['clasa_b'],long2ip($future_net)) ) {
   return (long2ip($future_net).'/30');
  } else {
   die ("Nu mai sunt ip-uri libere in aceasta clasa");
  }
}


function add_small_class($small_class,$parent,$descr) {
$query = "insert into small_clase (clasa_s,descr,parent) values ('".$small_class."','".$descr."','".$parent."')";
//echo "query egal ".$query;
$result = mysql_query($query) or die ('Query failed'.mysql_error());
}

function del_small_class($small_class) {
$query = "delete from small_clase where small_id='".$small_class."'";
$result = mysql_query($query) or die ('Query failed'.mysql_error());
return true;
}

function del_big_class($big_class) {
$query = "delete from small_clase where parent='".$big_class."'";
$result = mysql_query($query) or die ('Query failed'.mysql_error());
$query = "delete from big_clase where big_id='".$big_class."'";
$result = mysql_query($query) or die ('Query failed'.mysql_error());
return true;
}


function valid_ip($ip) {
 if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
  return (false);
 } else {
  return (true);
 }
}

function valid_net($net) {
 $net = explode("/",$net);
 $ip = $net[0];
 $mask = $net[1];
 if (!valid_ip($ip)) {
  die ("Subnet Invalid");
 }
 if ( ($mask < 0) || ($mask > 32) ) die ("Subnet Invalid");
 $ip = ip2long($ip);
 $maskbin = '';
 for($i=1;$i<=32;$i++) {
  $maskbin .= $mask >= $i ? '1' : '0';
 }
 $mask = bindec($maskbin);
 $nw = ($ip & $mask);
 if ($ip != $nw) die ("Subnet Invalid, probabil este".long2ip($nw)."/$net[1]");
 $brd = $nw | (~$mask);
 $net = implode("/",$net);
 return($net);
}


function add_big_class($big_class, $descr) {
 $query = "insert into big_clase (clasa_b, descr) values ('".$big_class."','".$descr."')";
 $result = mysql_query($query) or die ('Query failed'.mysql_error());
 return true;
}

function update_small_class($id,$clasa,$descr) {
 $query = "update small_clase set clasa_s='".$clasa."', descr='".$descr."' where small_id='".$id."'";
 $result = mysql_query($query) or die ('Query failed'.mysql_error());
 return true;
}

function update_big_class($id,$clasa,$descr) {
 $query = "update big_clase set clasa_b='".$clasa."', descr='".$descr."' where big_id='".$id."'";
 $result = mysql_query($query) or die ('Query failed'.mysql_error());
 return true;
}

function update_loopback($id,$clasa,$descr) {
 $query = "update small_clase set clasa_s='".$clasa."', descr='".$descr."' where small_id='".$id."'";
 $result = mysql_query($query) or die ('Query failed'.mysql_error());
 return true;
}

function add_loopback($clasa_s,$parent,$descr) {
$query = "insert into small_clase (clasa_s,descr,parent) values ('".$clasa_s."','".$descr."','".$parent."')";
//echo "query egal ".$query;
$result = mysql_query($query) or die ('Query failed'.mysql_error());
}

/**************************/


function cauta_loopback($big_id) {
	$query_clasa="select clasa_b from big_clase where big_id='".$big_id."'";
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

  $query = "select clasa_s from small_clase where parent='".$big_id."'";
  $result = mysql_query($query) or die ('Query failed'.mysql_error());

    $rows = mysql_num_rows($result);
    if ($rows == 0) {
    	return (long2ip($addr_long+1).'/32');
    }

  $future_net = $addr_long;

  while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
  	list ($line_addr, $line_mask) = split ('/',$line['clasa_s']);
  	$line_addr_long = ip2long($line_addr);
  	$my_very_big_array[ "$line_addr_long"] =$line_mask;
  }


ksort($my_very_big_array);
foreach ($my_very_big_array as $key => $value) {
$valoare = long2ip($key).'/'.$value;
//echo "valoare = $valoare future_net = $future_net value = $value<br>";

#echo "future net este $future_net ".long2ip($future_net)."<br>";
   if ( (netcidr_match($valoare,long2ip($future_net))) and ($value == 30) ) {
   $future_net = $future_net + 4;
//   echo "value = $value<br>";
   } else if ( (netcidr_match($valoare,long2ip($future_net))) and ($value == 32)  ) {
   $future_net = $future_net +1;
//   echo "value = $value<br>";
   }
}

//  	$prim_net = $line_addr_long - 4;
//  	if ( $prim_net == $addr_long) {
//  	 return (long2ip($addr_long).'/'.$line_mask);
//  	}



//echo 'line clasa este'.$line_clasa['clasa_b'].'future net este'.$future_net.'<br>';

  if ( netcidr_match($line_clasa['clasa_b'],long2ip($future_net)) ) {
   //print "da ba<br>";
   return (long2ip($future_net).'/32');
  } else {
   die ("Nu mai sunt ip-uri libera in aceasta clasa");
  }
}

/*******************/
