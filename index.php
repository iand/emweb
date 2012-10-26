<?php
include_once 'config.php';
include_once 'items.inc.php';
include_once './epiphany/Epi.php';
Epi::setPath('base', './epiphany');
Epi::setPath('view', 'market');
Epi::init('route','template','session', 'database');
EpiDatabase::employ('mysql',$config['db_database'],$config['db_hostname'],$config['db_username'],$config['db_password']); 



/*
 * This is a sample page whch uses EpiCode.
 * There is a .htaccess file which uses mod_rewrite to redirect all requests to index.php while preserving GET parameters.
 * The $_['routes'] array defines all uris which are handled by EpiCode.
 * EpiCode traverses back along the path until it finds a matching page.
 *  i.e. If the uri is /foo/bar and only 'foo' is defined then it will execute that route's action.
 * It is highly recommended to define a default route of '' for the home page or root of the site (yoursite.com/).
 */
getRoute()->get("" , array('OrdersController', 'display'));
getRoute()->get("/" , array('OrdersController', 'display'));
getRoute()->get('/item/(.+)', array('ItemController', 'display'));
getRoute()->get('/item/?', array('ItemListController', 'display'));
getRoute()->get('/player/(.+)', array('PlayerController', 'display'));
getRoute()->get('/player/?', array('PlayerListController', 'display'));
getRoute()->get('/help/?', array('HelpController', 'display'));

//getRoute()->get('/login', array('LoginController', 'display'));
//getRoute()->post('/login', array('LoginController', 'processLogin'));
//getRoute()->get('/logout', array('LogoutController', 'processLogout'));

getRoute()->run(); 


class Constants {
  const LOGGED_IN = 'logged_in';
}


class HelpController {
  static public function display() {
    $params = array();
    $params['page']['title'] = 'Help';
    global $config;
    $params['config'] = $config;

    getTemplate()->display('help.template.php', $params);
  }
}

class LoginController {
  static public function display()
  {
    // Check if we're already logged in, although we SHOULD never get here
    if (getSession()->get(Constants::LOGGED_IN) == true) {
        getRoute()->redirect($base_path);
    }

    $params = array();
    $params['title'] = 'Login page';
    $params['rid_email'] = 'Email';
    $params['email'] = '';
    $params['rid_pwd'] = 'Password';
    $params['rid_login'] = 'Login';

    getTemplate()->display('login.template.php', $params);
  }

  static public function processLogin()
  {
    // Confirm the password is correct

    // * Assume it's all good for the time being * //

    // Redirect to the logged in home page
    getSession()->set(Constants::LOGGED_IN, true);

	  global $config;
    getRoute()->redirect($config['base_path']);
  }
}

class LogoutController {
  static public function processLogout() {
    // Redirect to the logged in home page
  
    getSession()->set(Constants::LOGGED_IN, false);

    global $config;
    getRoute()->redirect($config['base_path']);
  }
}

class ItemController {
  static public function display($itemcode) {
  	global $items;
    global $config;

    $itemcodeparts = explode(':',$itemcode, 2);


    if (is_numeric($itemcodeparts[0])) {
      $itemid = intval($itemcodeparts[0]);
    } else {
      // TODO: error
    }

    if (count($itemcodeparts) > 1) {
      if (is_numeric($itemcodeparts[1])) {
        $itemdur = intval($itemcodeparts[1]);
      } else {
        // TODO: error
      }
    } else {
      $itemdur = 0;
    }


    if (!$itemid) {
      // TODO: error
    }

    $where = " WHERE itemID=:itemid AND itemDur=:itemdur";


    $query = 'SELECT SQL_CALC_FOUND_ROWS id,type,player,price,amount,itemID,itemDur,itemEnchants FROM ' . $config['db_prefix'] . 'Orders ';
    $query .= $where;

    $page = isset($_GET['p']) ? $_GET['p'] : 0;
    if (is_numeric($page)) {
      $page = intval($page);
    } else {
      $page = 0;
    }

    if ($page < 0) {
      $page = 0;
    }

    $query .= ' ORDER BY price ASC LIMIT ';
    if ($page > 0) {
      $query .=  $page * 30 . ", ";
    }
    $query .= ' 30';


    $params = array();

    global $config;
    $params['config'] = $config;

    $params['page']['title'] = get_item_name($itemid, $itemdur);
    $params['shortname'] = get_item_shortname($itemid, $itemdur);


    $params['buyers'] = array();
    $params['sellers'] = array();
  	$rows = getDatabase()->all($query, array(":itemid" => $itemid, ":itemdur" => $itemdur) );
    $rowcount = getDatabase()->one("SELECT FOUND_ROWS() AS rowcount");

    $params['pagination'] = array('page' => $page, 'lastpage' => intval($rowcount['rowcount'] / 30));


    foreach($rows as $key => $row) {
  		$order = array();
  		$order['id'] = $row['id'];

  		$order['player'] = $row['player'];
  		$order['price'] = $row['price'];
  		$order['amount'] = $row['amount'];
  		$itemcode = $row['itemID'];
  		if ($row['itemDur'] != 0) {
  			$itemcode .= ':' . $row['itemDur'];
  		}

      if ($row['type'] == 1) {
        $params['sellers'][] = $order;
      } else {
        $params['buyers'][] = $order;
      }
  	}

    $itemstats = getDatabase()->all("SELECT type,AVG(price) AS ap,SUM(amount) AS ta FROM " . $config['db_prefix'] . "Orders " . $where . " GROUP BY type", array(":itemid" => $itemid, ":itemdur" => $itemdur));

    foreach($itemstats as $key => $row) {
      $params['stats' . $row['type']]['average_price'] = $row['ap'];
      $params['stats' . $row['type']]['total_amount'] = $row['ta'];
    }

    getTemplate()->display('item.template.php', $params);
  }
}


class OrdersController {
  static public function display() {
    global $config;
    global $items;

    $query = 'SELECT SQL_CALC_FOUND_ROWS id,type,player,price,amount,itemID,itemDur,itemEnchants FROM ' . $config['db_prefix'] . 'Orders ';

    $page = isset($_GET['p']) ? $_GET['p'] : 0;
    if (is_numeric($page)) {
      $page = intval($page);
    } else {
      $page = 0;
    }

    if ($page < 0) {
      $page = 0;
    }

    $query .= ' ORDER BY id DESC LIMIT ';
    if ($page > 0) {
      $query .=  $page * 30 . ", ";
    }
    $query .= ' 30';




    $params = array();
    global $config;
    $params['config'] = $config;

    $params['page']['title'] = 'Current Orders';

    $params['orders'] = array();
    $rows = getDatabase()->all($query);
    $rowcount = getDatabase()->one("SELECT FOUND_ROWS() AS rowcount");

    $params['pagination'] = array('page' => $page, 'lastpage' => intval($rowcount['rowcount'] / 30), 'urlparams' => join('&', $urlparams));


    foreach($rows as $key => $row) {
      $order = array();
      $order['id'] = $row['id'];
      if ($row['type'] == 1) {
        $order['type'] = "selling";
      } else {
        $order['type'] = "buying";
      }
      
      $order['player'] = $row['player'];
      $order['price'] = $row['price'];
      $order['amount'] = $row['amount'];
      $itemcode = $row['itemID'];
      if ($row['itemDur'] != 0) {
        $itemcode .= ':' . $row['itemDur'];
      }
      $order['itemcode'] = $itemcode;
      $order['name'] = get_item_name($row['itemID'], $row['itemDur']);

      $params['orders'][] = $order;
    }


    getTemplate()->display('orders.template.php', $params);
  }
}


class PlayerController {
  static public function display($player) {
    global $items;
    global $config;

    $query = 'SELECT SQL_CALC_FOUND_ROWS id,type,player,price,amount,itemID,itemDur,itemEnchants FROM ' . $config['db_prefix'] . 'Orders ';
    $query .= " WHERE player=:player";

    $page = isset($_GET['p']) ? $_GET['p'] : 0;
    if (is_numeric($page)) {
      $page = intval($page);
    } else {
      $page = 0;
    }

    if ($page < 0) {
      $page = 0;
    }

    $query .= ' ORDER BY id DESC LIMIT ';
    if ($page > 0) {
      $query .=  $page * 30 . ", ";
    }
    $query .= ' 30';


    $params = array();

    global $config;
    $params['config'] = $config;
    $params['page']['title'] = $player;

    $params['buyers'] = array();
    $params['sellers'] = array();
    $rows = getDatabase()->all($query, array(":player" => $player) );
    $rowcount = getDatabase()->one("SELECT FOUND_ROWS() AS rowcount");

    $params['pagination'] = array('page' => $page, 'lastpage' => intval($rowcount['rowcount'] / 30), 'urlparams' => join('&', $urlparams));


    foreach($rows as $key => $row) {
      $order = array();
      $order['id'] = $row['id'];



      $order['price'] = $row['price'];
      $order['amount'] = $row['amount'];
      $itemcode = $row['itemID'];
      if ($row['itemDur'] != 0) {
        $itemcode .= ':' . $row['itemDur'];
      }
      $order['itemcode'] = $itemcode;
      $order['name'] = get_item_name($row['itemID'], $row['itemDur']);


      if ($row['type'] == 1) {
        $params['sellers'][] = $order;
      } else {
        $params['buyers'][] = $order;
      }
    }

    getTemplate()->display('player.template.php', $params);
  }
}


class PlayerListController {
  static public function display($player) {
    global $config;


    $query = 'SELECT player,count(*) as num FROM ' . $config['db_prefix'] . 'Orders GROUP BY player';

    $params = array();

    global $config;
    $params['config'] = $config;
    $params['page']['title'] = "Player List";

    $params['players'] = array();

    $rows = getDatabase()->all($query);
    foreach($rows as $key => $row) {
      $player = array();
      $player['player'] = $row['player'];
      $player['num'] = $row['num'];
      $params['players'][] = $player;
    }

    getTemplate()->display('playerlist.template.php', $params);
  }
}

class ItemListController {
  static public function display($item) {
    global $config;


    $query = 'SELECT itemID,itemDur,count(*) as num, MIN(price) AS minp FROM ' . $config['db_prefix'] . 'Orders GROUP BY player';

    $params = array();

    global $config;
    $params['config'] = $config;
    $params['page']['title'] = "Item List";

    $params['items'] = array();

    $rows = getDatabase()->all($query);
    foreach($rows as $key => $row) {
      $player = array();
      $name = get_item_name($row['itemID'], $row['itemDur']);
      $itemcode = $row['itemID'];
      if ($row['itemDur'] != 0) {
        $itemcode .= ':' . $row['itemDur'];
      }
      $params['items'][$name]['itemcode'] = $itemcode;
      $params['items'][$name]['num'] += $row['num'];
      if (!isset($params['items'][$name]['minprice']) || $row['minp'] < $params['items'][$name]['minprice']) {
        $params['items'][$name]['minprice'] = $row['minp'];
      }
  
     
    }

    ksort($params['items']);

    getTemplate()->display('itemlist.template.php', $params);
  }
}