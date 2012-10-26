<?php
  include_once "header.template.php";
  include_once $body;

  echo "<h2>Orders</h2><table>";
  echo "<tr><th>id</th><th>type</th><th>name</th><th>player</th><th>price</th><th>amount</th></tr>\n";
  foreach($orders as $key => $order) {
  	echo "<tr>";
  	echo "<td>" . htmlspecialchars($order['id']) . "</td>";
  	echo "<td>" . htmlspecialchars($order['type']) . "</td>";
  	echo "<td>" . htmlspecialchars($order['name']) . "</td>";
  	echo "<td>" . htmlspecialchars($order['player']) . "</td>";
  	echo "<td>" . htmlspecialchars($order['price']) . "</td>";
  	echo "<td>" . htmlspecialchars($order['amount']) . "</td>";
  	echo "</tr>";
  }
  echo "</ol>";

  include_once "footer.template.php";
?>
