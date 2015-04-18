<?php

namespace Maalls\Zipcode\Tests;

include __dir__ . "/../Zipcode.php";

use Maalls\Zipcode\Zipcode;

$zipcode = new Zipcode();

$fh = fopen(__dir__ . "/data/sample.csv", "r");
$row = fgetcsv($fh);

while($row = fgetcsv($fh)) {

    list($from, $to) = @$row;

    $address = $zipcode->zipcode($from, "CA");

    if($address) {
    
        echo  "SUCCESS " . $from . " -> " . $address->lat . "," . $address->lng . PHP_EOL;

    }
    else {

        echo "ERROR " . $from . PHP_EOL; 

    }

    if(isset($to)) {
        $address = $zipcode->zipcode($to, "CA");

        if($address) {
        
            echo "SUCCESS " . $to . " -> " . $address->lat . "," . $address->lng . PHP_EOL;

        }
        else {

            echo "ERROR " . $to . PHP_EOL; 

        }
    }

}