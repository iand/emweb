<html>
  <head>
    <title><?php echo(htmlspecialchars($page['title'] . ' - ' . $config['market_name'])); ?></title>
    <link href="<?php echo($config['base_path']); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
      /*

        Put custom CSS here 

      */

      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
        background: url("http://hollowworld.co.uk/images/bg.jpg") repeat-y scroll center -100px rgb(21, 21, 21) !important
      }
      .content {
        background: none repeat scroll 0% 0% rgba(255, 255, 255, 0.5) !important;
        padding: 6px;
      }
    </style>
    <link href="<?php echo($config['base_path']); ?>bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">

        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo($config['base_path']); ?>"><?php echo($config['market_name']); ?></a>
          <div class="nav-collapse collapse">

            <ul class="nav">
              <li><a href="<?php echo($config['base_path']); ?>">Orders</a></li>
              <li><a href="<?php echo($config['base_path']); ?>item/">Items</a></li>
              <li><a href="<?php echo($config['base_path']); ?>player/">Players</a></li>
              <li><a href="<?php echo($config['base_path']); ?>help/">Help</a></li>
              <?php
                if (getSession()->get(Constants::LOGGED_IN) == true) {
                
/*                  <li><a href="<?php echo($config['base_path']); ?>/logout">Logout</a></li> */
                } else {
/*                  <li><a href="<?php echo($config['base_path']); ?>/login">Login</a></li> */
                }
              ?>

            </ul>
          </div><!--/.nav-collapse -->
        </div>

      </div>
    </div>

<div class="container content">