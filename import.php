<?php
// UPDATE EM_Orders SET type=2 WHERE RAND() > 0.5 LIMIT 400;

header("content-type: text/plain");
include_once 'config.php';

$src_database = 'exchangemarket';  // 'iconomy';



$src_conn = mysql_connect($config['db_hostname'], $config['db_username'], $config['db_password']);
if (!$src_conn) {
    die('Could not connect: ' . mysql_error());
}
echo "Connected to iconomy database\n";

$result = mysql_select_db($src_database, $src_conn);
if (!$result) {
    die('Could not select database: ' . mysql_error());
}

$result = mysql_query('SELECT count(*) FROM WA_Auctions', $src_conn);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
$row = mysql_fetch_row($result);
mysql_free_result($result);

echo $row[0] . " auctions to import\n";


$result = mysql_query("SELECT id, playerName, itemId, qty, price, itemDamage, enchantments FROM WA_Auctions", $src_conn);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$rows = array();
while ( $row = mysql_fetch_array($result) ) {
  $rows[] = $row;
}
mysql_free_result($result);
mysql_close($src_conn);


$dest_conn = mysql_connect($config['db_hostname'], $config['db_username'], $config['db_password']);
if (!$dest_conn) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($config['db_database'], $dest_conn);
echo "Connected to destination database\n";

$result = mysql_query('SELECT count(*) FROM ' . $config['db_prefix'] . 'Orders', $dest_conn);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
  

$row = mysql_fetch_row($result);
mysql_free_result($result);

echo $row[0] . " existing orders in destination database\n";
// if ($row[0] != 0) {
//   echo "Destination database is not empty. Aborting import.\n";
//   echo "Please truncate table " . $config['db_prefix'] . "Orders before running this import script.\n";
//   mysql_close($dest_conn);
//   exit;
// } 


foreach ($rows as $row) {

  $query = "INSERT INTO " . $config['db_prefix'] . "Orders (type,infinite,player,itemID,itemDur,itemEnchants,price,amount,exchanged) ";
  $query .= "VALUES (1,0,'" . mysql_real_escape_string($row[1]) . "'," . $row[2] . ",";

  if ($row[5]) {
    $query .= $row[5];
  } else {
    $query .= "0";
  }

  $query .= ",";
  // enchants
  if ($row[5]) {
    $query .= "'" . mysql_real_escape_string($row[6]) . "'";
  } else {
    $query .= "NULL";
  }

  $query .= "," . $row[4] . "," . $row[3] . ",0)";

  $ins_result = mysql_query($query, $dest_conn);
  if (!$ins_result) {
      $message  = 'Invalid query: ' . mysql_error($dest_conn) . "\n";
      $message .= 'Whole query: ' . $query;
      die($message);
  }

  print ".";

}

print "\n";
print "IMPORT COMPLETE\n";


mysql_close($dest_conn);




