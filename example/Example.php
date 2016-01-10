<?php

require '../vendor/autoload.php';

use Paul\Client;

// get weather for Bucharest, Romania
$client = new Client();
$weather = $client->get('Bucharest, Romania');

$json = json_decode($weather);

print_r($json[0]->current);