<?php
// Store Config
if (file_exists(IMPATH . '/config/store.php')) {
	require(IMPATH . '/config/store.php');
} else {
	echo 'Brak pilku store.php';
}
// Rcon Config
if (file_exists(IMPATH . '/config/rcon.php')) {
	require(IMPATH . '/config/rcon.php');
} else {
	echo 'Brak pilku rcon.php';
}
$client = new BlueMedia\Client($serviceId, $hash);
$result = $client->doItnIn($_POST['transactions']);
$itnIn = $result->getData();
$transactionConfirmed = $client->checkHash($itnIn);
@date_default_timezone_set('Europe/Warsaw');
use Thedudeguy\Rcon;
// Jeżeli status płatności z ITN jest potwierdzony i hash jest poprawny - zakończ płatność w systemie
if ($itnIn->getPaymentStatus() === 'SUCCESS' && $transactionConfirmed) {
  $order = $mongo_db->store->orders->findOne(['_id' => new MongoDB\BSON\ObjectID($itnIn->getOrderId())]);
  if ($order===NULL) {
    $mongo_db->store->logs->insertOne(['dateTime' => date('Y-m-d H:i:s'), 'orderID' => $itnIn->getOrderId(), 'details' => 'Realizacja nie powiodła się.']);
  }
  $service = $mongo_db->store->services->findOne(['name' => $order['service']]);
  $rcon = new Rcon($adressIp, $port, $password, $timeout); // Minecraft Rcon Console
  if ($rcon->connect() && isset($order['nickname']) && isset($service['cmd']) && isset($order['nickname'])) {
      $rcon->sendCommand(str_replace('%player%', $order['nickname'], $service['cmd']));
      $mongo_db->store->logs->insertOne(['dateTime' => date('Y-m-d H:i:s'), 'orderID' => $itnIn->getOrderId(), 'details' => "Realizacja powiodła się. Gracz \"".$order['nickname']."\" otrzymał usługę ".$service['name']]);
  } else {
    $mongo_db->store->logs->insertOne(['dateTime' => date('Y-m-d H:i:s'), 'orderID' => $itnIn->getOrderId(), 'details' => "Realizacja nie powiodła się. Gracz \"".$order['nickname']."\" nie otrzymał usługi ".$service['name']]);
  }
}
$itnResponse = $client->doItnInResponse($itnIn, $transactionConfirmed);
echo $itnResponse->getData()->toXml();
