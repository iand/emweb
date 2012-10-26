<?php
  include_once "header.template.php";
?>
  <h1><?php echo(htmlspecialchars($page['title'])) ?></h1>


  <h2>Currently selling</h2>
  <?php 
    if (count($sellers) > 0) {
  ?>  
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Item</th>
      <th>Price (each)</th>
      <th>Quantity available</th>
      <th>Total cost</th>
    </tr>
<?php    
  foreach($sellers as $key => $order) {
    echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'item/' . htmlspecialchars($order['itemcode']) . '">' . htmlspecialchars($order['name']) . '</a></td>';
    echo "<td>" . number_format($order['price'],2) . "</td>";
    echo "<td>" . htmlspecialchars($order['amount']) . "</td>";
    echo "<td>" . number_format($order['price'] * $order['amount'],2) . "</td>";
    echo "</tr>";
  }
?>
  </table>
  <?php 
      } else {
  ?>
  <p><?php echo(htmlspecialchars($page['title'])) ?> is not selling anything at the moment.</p>
  <?php
    }
  ?>

  <h2>Currently buying</h2>
  <?php 
    if (count($buyers) > 0) {
  ?>
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Item</th>
      <th>Price (each)</th>
      <th>Quantity required</th>
      <th>Total cost</th>
    </tr>
<?php    
  foreach($buyers as $key => $order) {
  	echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'item/' . htmlspecialchars($order['itemcode']) . '">' . htmlspecialchars($order['name']) . '</a></td>';
  	echo "<td>" . number_format($order['price'], 2) . "</td>";
  	echo "<td>" . htmlspecialchars($order['amount']) . "</td>";
    echo '<td>' . number_format($order['price'] * $order['amount'], 2) . "</td>";
  	echo "</tr>";
  }
?>
  </table>
  <?php 
      } else {
  ?>
  <p><?php echo(htmlspecialchars($page['title'])) ?> is not buying anything at the moment.</p>
  <?php
    }
  ?>

<?php
  include_once "footer.template.php";
?>
