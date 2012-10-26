<?php
  include_once "header.template.php";
?>
  <h1><?php echo(htmlspecialchars($page['title'])) ?></h1>


  <h2>Current sellers</h2>
  <?php 
    if (count($sellers) > 0) {
  ?>  
  <p>Average selling price: <?php echo(number_format($stats1['average_price'],2) . ' ' . $config['currency_name']); ?></p>
  
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Player</th>
      <th>Quantity available</th>
      <th>Price (each)</th>
      <th>Total cost</th>
    </tr>
<?php    
  foreach($sellers as $key => $order) {
    echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'player/' . htmlspecialchars($order['player']) . '">' . htmlspecialchars($order['player']) . '</a></td>';
    echo "<td>" . htmlspecialchars($order['amount']) . "</td>";
    echo "<td>" . number_format($order['price'],2) . "</td>";
    echo "<td>" . number_format($order['price'] * $order['amount'],2) . "</td>";
    echo "</tr>";
  }
?>
  </table>
  <?php 
      } else {
  ?>
  <p>No-one is selling <?php echo(htmlspecialchars($page['title'])) ?> at the moment.</p>
  <?php
    }
  ?>

  <h2>Current buyers</h2>
  <?php 
    if (count($buyers) > 0) {
  ?>
  <p>Average buying price: <?php echo(number_format($stats2['average_price'],2) . ' ' . $config['currency_name']); ?></p>
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Player</th>
      <th>Quantity required</th>
      <th>Price (each)</th>
      <th>Total cost</th>
    </tr>
<?php    
  foreach($buyers as $key => $order) {
  	echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'player/' . htmlspecialchars($order['player']) . '">' . htmlspecialchars($order['player']) . '</a></td>';
    echo "<td>" . htmlspecialchars($order['amount']) . "</td>";
  	echo "<td>" . number_format($order['price'], 2) . "</td>";
    echo '<td>' . number_format($order['price'] * $order['amount'], 2) . "</td>";
  	echo "</tr>";
  }
?>
  </table>
  <?php 
      } else {
  ?>
  <p>No-one wants to buy <?php echo(htmlspecialchars($page['title'])) ?> at the moment.</p>
  <?php
    }
  ?>

<?php
  include_once "footer.template.php";
?>
