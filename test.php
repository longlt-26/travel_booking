<?php
$apiKey = 'AIzaSyA6aHowwKRALYZEgIIc9yA7fDRyqlWG4rM';
$url = 'https://generativelanguage.googleapis.com/v1beta/models?key=' . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$data = json_decode($response, true);
foreach ($data['models'] as $model) {
    if (in_array('generateContent', $model['supportedGenerationMethods'])) {
        echo $model['name'] . "\n";
    }
}
