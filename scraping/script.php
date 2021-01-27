<?php

require __DIR__.'/vendor/autoload.php';

$client = \Symfony\Component\Panther\Client::createChromeClient();

$client->request('GET', 'https://celiabellod.fr/blog');

$crawler = $client->waitFor('body');
echo $crawler->filter('main div div h1')->text();
$screenshot = $client->takeScreenshot('screen.png');