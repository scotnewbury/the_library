<?php

$isbn = "9781603020220";

$url = "http://openlibrary.org/api/volumes/brief/isbn/". $isbn . ".json";

echo $url . PHP_EOL;

$jsonData = file_get_contents($url);


echo $jsonData;

