<?php
namespace UltimateCraft;

class CommandExecutor {
    use Thedudeguy\Rcon;
    private $rcon;

    public function __construct($host, $port, $password, $timeout)
    {
        $this->$rcon = new Rcon($host, $port, $password, $timeout);
    }

    public function executeCommand()
    { // TODO
        date_default_timezone_set('Europe/Warsaw');
        $order = $mongo_db->store->orders->findOne(['_id' => new MongoDB\BSON\ObjectID($_GET['OrderID'])]);
        if ($order!==NULL) {
            $service = $mongo_db->store->services->findOne(['name' => $order['service']]);
            $rcon = new Rcon('mc.ultimatecraft.net', 25585, 'kZfGDA6ulpuA6OX', 3);
            if ($rcon->connect()) {
            $result = $rcon->sendCommand(str_replace('%player%', $order['nickname'], $service['cmd']));
            $mongo_db->store->logs->insertOne(['dateTime' => date('Y-m-d H:i:s'), 'orderID' => $_GET['OrderID'], 'details' => "Transakcja powiodła się! Gracz \"".$order['nickname']."\" otrzymał usługę ".$service['name']]);
            return $result;
            }
        }
        return false;
    }
}