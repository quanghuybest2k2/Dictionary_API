<?php
// $content =     file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/en/developer");

// $result  = json_decode($content);

// print_r($result);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.dictionaryapi.dev/api/v2/entries/en/hello",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
//
$response = json_decode($response, true); //because of true, it's in an array
echo $response[0]['word'];
echo "<br/>";
// echo $response[0]['phonetics'][1]['text'];
// echo "<br/>";
// echo $response[0]['meanings'][0]['partOfSpeech'];
// echo "<br/>";
// echo $response[0]['meanings'][0]['definitions'][0]['definition'];
$array = $response[0]['phonetics'];
foreach ($array as $key => $jsons) { // This will search in the 2 jsons
    foreach ($jsons as $key => $value) {
        if ($value === "") {
            echo "Giá trị null";
        } else {
            echo $value; // This will show jsut the value f each key like "var1" will print 9
            // And then goes print 16,16,8 ...
            echo "<br/>";
        }
    }
    echo "<br/>";
}

// var_dump($response);
// print_r($response);
