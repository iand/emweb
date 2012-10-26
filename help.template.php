<?php
  include_once "header.template.php";
?>
  <h1><?php echo(htmlspecialchars($page['title'])) ?></h1>

  <p><?php echo(htmlspecialchars($config['market_name'])) ?> uses a server plugin called <a href="http://dev.bukkit.org/server-mods/exchangemarket/">Exchange Market</a>
    which provides commands to buy and sell resources to other players. This website lets you browse the market.

  </p>
  <!-- screenshot width: 660 -->



  <h2>Tutorial</h2>


  <h3>Checking prices</h3>

  <p>Before you sell anything you can check the prices already being offered on the market. 
    Hold the items you want to sell in your hand and type this command:<p>

  <p><code>/em price</code></p> 

  <p><img src="<?php echo($config['base_path']); ?>images/screen2.png"></p>

  <p>You'll be told the name of the item, the number of items for sale and being bought and the average price for items of that type across all the listings in the market.
    To find out the average selling price, use the following command:</p>

  <p><code>/em price stone 1 sell</code></p> 

  <p><img src="<?php echo($config['base_path']); ?>images/screen3.png"></p>

  <p>Now you'll just see how many items of that type are being sold and their average sale price.</p>


  <h3>Seeing what's on the market</h3>
  <p>To see a list of all the current listings for that item on the market use the <code>search</code> command like this:</p>

  <p><code>/em search stone</code></p> 

  <p><img src="<?php echo($config['base_path']); ?>images/screen4.png"></p>

  <p>The list of orders on the market is sorted by price per item (this is the price shown in brackets ending in 'e' for each).
  In the screenshot above you can see that there are 6 people who have placed orders for stone. The highest price they are willing
  to pay is 30 <?php echo($config['currency_name']); ?> per block for up to 128 blocks (order #270).</p>

  <h3>Selling</h3>

  <p>If you were selling 128 stone then you could immediately sell it to that player
  by using the <code>sell</code> command:</p>


  <p><code>/em sell stone 128 30e</code></p>

  <p>Don't forget to add the 'e' at the end of the price, so you sell the stone for 30 <strong>each</strong> otherwise you'll be selling
    the entire 128 for 30 <?php echo($config['currency_name']); ?> in total.</p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen5.png"></p>

  <p>The market matches your sell command to the highest matching buy order and takes 128 stone from your inventory and credits
    your account with 3840 <?php echo($config['currency_name']); ?>.</p>

  <p>That's all a bit tedious if you have a lot of stone to sell. Instead of manually matching the right price to the market you 
    can simply use the <code>sell</code> command without any amount or price and the market will automatically find the best
    prices for you:</p>

  <p><code>/em sell stone</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen6.png"></p>

  <p>As you can see in the screenshot the market finds buyers as much of the stone as it can for the highest price. Use the
    <code>confirm</code> command to complete the sale:</p>

  <p><code>/em confirm</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen7.png"></p>

  <h3>Placing sell orders</h3>

  <p>Suppose when you search you don't see anyone willing to buy at the price you want:</p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen8.png"></p>

  <p>In this example perhaps you want to sell 10 stacks of stone for 3 <?php echo($config['currency_name']); ?> each. To do
    this you need to use the <code>sellorder</code> command which simply lists your sale on the market.</p>

  <p><code>/em sellorder stone 640 3e</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen9.png"></p>

  <p>Once again don't forget to add the 'e' at the end of the price.</p>

  <p>Now when other people search the market they will see your stone for sale:</p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen10.png"></p>

  <h3>Buying</h3>

  <p>To buy something from the market you first of all use the <code>search</code> command to
    find potential sellers of the item you want:</p>

  <p><code>/em search grass</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen11.png"></p>

  <p>You can then use the <code>buy</code> command to buy some of the item you need. Just like the <code>sell</code> command
    you can specify a price and the market will match what you are willing to pay with the <strong>lowest</strong> sell
    prices. Suppose you needed to buy 1500 grass, you would type:</p>

  <p><code>/em buy grass 1500</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen12.png"></p>

  <p>Use the <code>confirm</code> command to complete the purchase:</p>

  <p><code>/em confirm</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen13.png"></p>

  <p>The items you bought are put in your inventory and the money is taken from your account. <strong>Note that you can only 
    buy what fits in your inventory.</strong>. Suppose you wanted to buy another 1500 grass, you get a confirmation request only
    for the amount that will fit in your inventory (another 664 blocks):</p>


  <p><code>/em buy grass 1500</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen14.png"></p>


  <h3>Placing buy orders</h3>

  <p>Suppose you want to buy some resources but no-one is selling at the price you are willing to pay. In this case you
    can use the <code>buyorder</code> command to list the price you are willing to pay on the market. For example if you
    wanted to buy up to 64 grass at 5 <?php echo($config['currency_name']); ?> per block then you would type:</p>

  <p><code>/em buyorder grass 64 5e</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen15.png"></p>

  <p>As usual don't forget to add the 'e' at the end of the price. The money is taken from your account immediately to 
    ensure that you can pay anyone who sells to you at that price. You can use the <code>search</code> command to 
    check your listing:</p>

  <p><code>/em search grass</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen16.png"></p>

  <p>Now when people come to the market to sell grass they will be able to see what you are willing to pay and sell directly
    to you. This is great if you are planning a build because you can place buy orders for all your resources and
    enterprising players will check for things you need and go gather them for you, confident that they have a buyer
    already.

  <h3>Listing your orders</h3>
  <p>You can list your current orders in the market by using the <code>orders</code> command:</p>

  <p><code>/em orders</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen17.png"></p>


  <h3>Cancelling orders</h3>

  <p>You can cancel any order by using the <code>cancel</code> command. If you cancel a buy order you will get the 
    money credited back to your account:</p>

  <p><code>/em cancel 669</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen18.png"></p>

  <p>When you cancel a sell order only the portion that fits into your inventory gets cancelled. The remainder stays listed
    on the market. In the following example cancelling order 668 only returns 256 stone and the remainder stays listed at the 
    original price.</p>

  <p><code>/em cancel 668</code></p>

  <p><img src="<?php echo($config['base_path']); ?>images/screen19.png"></p>

  <h3>Collecting buy orders</h3>

  <p>When you have a buy order on the market other players can sell to you at that price while you are offline. To collect
    the items you have bought use the <code>collect</code> command:</p>

  <p><code>/em collect</code></p>

  <p>Just like cancelling a sell order, only the amount of resource that fits into your inventory is sent to you. The rest
    remains in the market ready for you to collect when you have space.</p>



  <h2>Command Reference</h2>

  <p>Here are the most important commands that you'll use:</p>

  <dl>


    <dt>/em search &lt;itemName&gt;</dt>
    <dd>Display all orders for that item, sorted by price. </dd>

    <dt>/em list ["buy"/"sell"]</dt>
    <dd>List all active orders. </dd>
    
    <dt>/em price [itemName] [amount] [sale/buy]</dt>
    <dd>Get the average price of an item name (or hand) from current orders. </dd>


    <dt>/em sell &lt;itemName&gt; [amount] [price]</dt>
    <dd>Sell items to existing buy orders. </dd>
    
    <dt>/em buy &lt;itemName&gt; [amount] [price]</dt>
    <dd>Buy items from existing sell orders. </dd>
    
    <dt>/em sellorder &lt;itemName&gt; [amount] [price]</dt>
    <dd>Create a sell order (add e to price for "each" item) </dd>
    
    <dt>/em buyorder &lt;itemName&gt; [amount] [price]</dt>
    <dd>Create a buy order (add e to price for "each" item) </dd>

    <dt>/em orders</dt>
    <dd>List your active orders. </dd>
    
    <dt>/em collect</dt>
    <dd>Collect items from your buy orders. </dd>
    
    <dt>/em cancel &lt;ID/"Buy"/"Sell"&gt; [itemName] [amount]</dt>
    <dd>Cancel one of your orders. </dd>
  </dl>

  <p>A full list of commands is available on the <a href="http://dev.bukkit.org/server-mods/exchangemarket/#w-commands">plugin page</a></p>




<?php
  include_once "footer.template.php";
?>
