<?php
  include_once "header.template.php";
?>
  <h1><?php echo(htmlspecialchars($page['title'])) ?></h1>

  <?php 
    if (count($players) > 0) {
  ?>  
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Player</th>
      <th>Number of orders</th>
    </tr>
<?php    
  foreach($players as $key => $player) {
    echo "<tr>";
    echo '<td><a href="' . $config['base_path'] . 'player/' . htmlspecialchars($player['player']) . '">' . htmlspecialchars($player['player']) . '</a></td>';
    echo "<td>" . number_format($player['num'],0) . "</td>";
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
