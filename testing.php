<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client([
    'base_uri' => 'http://localhost:8000',
    'defaults' => [
        'exceptions' => false
    ]
]);

$nickname = "ObjectOrienter" . rand(0, 999);
$data = [
    'nickname' => $nickname,
    'avatarNumber' => 5,
    'tagLine' => 'a test dev!'
];

$response = $client->post('/api/programmers', [
    'body' => json_encode($data)
]);

echo (string) $response->getBody();
echo "\n\n";