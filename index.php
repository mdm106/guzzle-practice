<?php

require 'vendor/autoload.php'; //requirement of Guzzle

use GuzzleHttp\Client;

$client = new Client(); 

$response = $client->request('GET', 'https://swapi.dev/api/people/1');

echo $response->getStatusCode()."\n"; //HTTP response code
echo $response->getHeaderLine('content-type')."\n"; // 'application/json; charset=utf8'

$body = $response->getBody();
echo $body."\n";

$person = json_decode($body);
$name = $person->name;
$homeURL = $person->homeworld;

$homePlanet = json_decode($client->request('GET', $homeURL)->getBody())->name;

$firstFilm = json_decode($client->request('GET', $person->films[0])->getBody())->title;

echo $name."'s home planet is ".$homePlanet.". He first appeared in ".$firstFilm;

