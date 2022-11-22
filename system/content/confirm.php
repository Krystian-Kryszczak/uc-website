<?php
if (file_exists(IMPATH . '/config/store.php')) {
    require(IMPATH . '/config/store.php');
}
$result;
try {
    $client = new BlueMedia\Client($serviceId, $hash);
    $data = [
        'ServiceID' => $_GET['ServiceID'],
        'OrderID' => $_GET['OrderID'],
        'Hash' => $_GET['Hash']
    ];
    $result = $client->doConfirmationCheck($data); // true | false
} catch (Exception $e) {
    echo $e->getMessage();
}
if ($result) {
    header('Location: /successful', true, 302); die();
} else {
    header('Location: /failed', true, 302); die();
}