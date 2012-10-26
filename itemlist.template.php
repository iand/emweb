<?php
  include_once "header.template.php";
?>
  <h1><?php echo(htmlspecialchars($page['title'])) ?></h1>

  <?php 
    if (count($items) > 0) {
  ?>  
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Item</th>
      <th>Number of orders</th>
      <th>Lowest price</th>
    </tr>
<?php    
  foreach($items as $key => $item) {
    echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'item/' . htmlspecialchars($item['itemcode']) . '">' . htmlspecialchars($key) . '</a></td>';
    echo "<td>" . number_format($item['num'],0) . "</td>";
    echo "<td>" . number_format($item['minprice'],2) . "</td>";
    echo "</tr>";
  }
?>
  </table>
  <?php 
      } else {
  ?>
  <p>No-one is selling or buying anything at the moment.</p>
  <?php
    }
  ?>


<?php
  include_once "footer.template.php";
?>
