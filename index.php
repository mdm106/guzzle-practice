<?php

require 'vendor/autoload.php'; //requirement of Guzzle

use GuzzleHttp\Client;

$client = new Client(); 

$response = $client->request('GET', 'https://swapi.dev/api/people/1');

echo $response->getStatusCode()."\n"; //HTTP response code
echo $response->getHeaderLine('content-type')."\n"; // 'application/json; charset=utf8'

$body = $response->getBody();
echo $body."\n";

$person = json_decode($body); //decode response into PHP object
$name = $person->name; 
$homeURL = $person->homeworld;

$homePlanet = json_decode($client->request('GET', $homeURL)->getBody())->name; //GET request with URL from the homeworld key of person

$firstFilm = json_decode($client->request('GET', $person->films[0])->getBody())->title; //GET request with URL from the first value of the films key of person

echo $name."'s home planet is ".$homePlanet.". He first appeared in ".$firstFilm; //results echoed in sentence

