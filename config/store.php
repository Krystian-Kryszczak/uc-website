<?php
$testing = false;
if ($testing) {
    $gatewayUrl = 'https://pay-accept.bm.pl';
    $serviceId = '904114';
    $hash = '5aef6f0927d7fc4ecf4c5eec78e7c70ac440e951';
} else {
    $gatewayUrl = 'https://pay.bm.pl';
    $serviceId = '56467';
    $hash = 'ea14d0f70befc9c6a9da9c23170fc062fe0e08a0adcab171a55a820f3b703084';
}
