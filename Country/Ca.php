<?php
namespace Maalls\Zipcode\Country;
use Maalls\Zipcode\Country;
use Maalls\Zipcode\Address;

class Ca implements Country {

    static $provinceMap = array(

          "NL" => "Newfoundland and Labrador",
          "ON" => "Ontario",
          "NB" => "New Brunswick",
          "MB" => "Manitoba",
          "BC" => "British Columbia",
          "NS" => "Nova Scotia",
          "PE" => "Prince Edward Island",
          "SK" => "Saskatchewan",
          "QC" => "Quebec",
          "AB" => "Alberta",
          "NT" => "Northwest Territories",
          "YT" => "Yukon",
          "NU" => "Nunavut"

    );

    public function find($zipcode) {

        $search = strtoupper(trim(str_replace(" ", "", $zipcode)));
        $fh = fopen(__dir__ . "/data/ca/Canada.csv", "r");

        $address = null;

        while($row = fgetcsv($fh, 0, ",", '"')) {

            list($zipcode, $lat, $lng, $city, $provinceCode) = $row;

            if($row[0] == $search) {

                $address = new Address();
                $address->zipcode = $row[0];
                $address->lat = $row[1];
                $address->lng = $row[2];
                $address->city = $row[3];
                $address->province = self::$provinceMap[strtoupper($row[4])];
                break;

            }

        }

        return $address;

    }

}