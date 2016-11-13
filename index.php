<?php
//phpinfo();
/*$ch = curl_init("http://localhost:8084/csvPuntsWifi/api/ws/lista");
$fp = fopen("example_homepage.txt", "w");

curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_exec($ch);
curl_close($ch);
fclose($fp);*/

$ch = curl_init();

// set url
curl_setopt($ch, CURLOPT_URL, "http://localhost:8084/csvPuntsWifi/api/ws/lista");

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);
//echo $output;

echo "EMPIEZA...\n";

$jsonIterator = new RecursiveIteratorIterator(
    new RecursiveArrayIterator(json_decode($output, TRUE)),
    RecursiveIteratorIterator::SELF_FIRST);

foreach ($jsonIterator as $key => $val) {
    if(is_array($val)) {
        echo "$key:\n";
    } else {
        echo "$key => $val\n";
    }
}

?>
