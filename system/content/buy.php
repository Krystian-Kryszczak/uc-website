<?php
if (!(isset($_POST['service'])&&isset($_POST['accept-rules'])&&isset($_POST['nickname'])&&isset($_POST['email'])&&filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {header('Location: /store'); die();}
// --------------------------------------------------------------------------- //
$ip = (function(){switch(true){case (!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];case (!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];default : return $_SERVER['REMOTE_ADDR'];}})();
// -------------------------------- [MongoDB] -------------------------------- //
try {
    $db = $mongo_db->store;
    $service = $db->services->findOne(array('name' => $_POST['service']));
    if ($service===null) {header('Location: /sklep'); die();}
    @date_default_timezone_set("Europe/Warsaw");
    $price = number_format((isset($service['promotion']) ? $service['promotion'] : $service['price']), 2, '.');
    if (!preg_match('/[0-9]{1,14}[.][0-9]{2}$/', $price)) { // [Price Validate] //
        header('Location: /store'); die();
    }
    $document = array( 
        'dateTime' => date('Y-m-d H:i:s'), 
        'service' => $service['name'],
        'price' => $price,
        'paid' => 'no',
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'customerIP' => $ip
    );
    $id = strval($db->orders->insertOne($document)->getInsertedId());
} catch(MongoConnectionException $e) {}
$description = (isset($service['description']) ? $service['description'] : 'ultimatecraft.net');
$email = $_POST['email']; // number_format($service['price'], 2, '.'))
// -------------------------------- [Config] -------------------------------- //
if (file_exists(IMPATH . '/config/store.php')) {
    require(IMPATH . '/config/store.php');
} else {
    echo 'Brak pilku store.php'; die();
}
$client = new BlueMedia\Client($serviceId, $hash);
// ------------------------------------------------------------------ //
if (!preg_match('/^[A-Za-z0-9\/\s\._,:-]+$/', $description)) {
    $description = 'UltimateCraft';
}
// -------------------------------- [Execute] -------------------------------- //
try {
    $result = $client -> doTransactionInit([
        'gatewayUrl' => $gatewayUrl,
        'transaction' => [
            'orderID' => $id,
            'amount' => $price,
            'description' => $description,
            'gatewayID' => '0',
            'currency' => 'PLN',
            'customerIP' => $ip,
            'customerEmail' => $email,
            'customerIP' => $ip,
            'title' => 'UltimateCraft'
        ]
    ]);
} catch (Throwable $t) {
    echo 'Wystąpił błąd, proszę powiadom o tym administrację!<br>';
    echo $t->getTraceAsString();
}
$continue = $result->getData();
try {
    $url = $continue->getRedirectUrl();
    if ($url!==null) {
        header('Location: '.$url, true, 302); die();
    } else {
        echo 'Wystąpił błąd, proszę powiadom o tym administrację!<br>';
    }
} catch(Throwable $t) {
    echo 'Wystąpił błąd, proszę powiadom o tym administrację!<br>';
    echo $t->getTraceAsString();
}

