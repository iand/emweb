<?php
  include_once "header.template.php";
?>
  <p>Use this website to browse the buy and sell orders in the <?php echo(htmlspecialchars($config['market_name'])); ?>.</p>

  <p>Use the commands in game to buy and sell. See the <a href="<?php echo($config['base_path']); ?>help">help pages</a> for more information.</p>
  <h2>Orders</h2>
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Player</th>
      <th>Order type</th>
      <th>Item</th>
      <th>Price</th>
      <th>Amount</th>
    </tr>
<?php    
  foreach($orders as $key => $order) {
  	echo "<tr>";
    echo '<td><a href="player/' . htmlspecialchars($order['player']) . '">' . htmlspecialchars($order['player']) . '</a></td>';
  	echo "<td>" . htmlspecialchars($order['type']) . "</td>";
  	echo '<td><a href="item/'. htmlspecialchars($order['itemcode']) . '">' . htmlspecialchars($order['name']) . '</a></td>';
  	echo "<td>" . number_format($order['price'],2) . "</td>";
  	echo "<td>" . number_format($order['amount']) . "</td>";
  	echo "</tr>";
  }
?>
  </table>


<?php
  include_once "pagination.template.php";
?>

<?php
  include_once "footer.template.php";
?>
