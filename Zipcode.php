<?php
namespace Maalls\Zipcode;

use Maalls\Zipcode\Address;


class Zipcode {
    

    public function __construct($googleGeocode = null) {

        $this->googleGeocode = $googleGeocode;

    }

    public function zipcode($zipcode, $country) 
    {

        $reader = $this->getCountry($country);
        $address = null;

        $zipcode = strtoupper(str_replace(" ", "", $zipcode));

        if($reader) {

            $address = $reader->find($zipcode);

        }

        if(false && !$address && $this->googleGeocode) {
            throw new \Exception("Unable to locate the address.");
            try {
                list($lat, $lng) = $this->googleGeocode->latLng($zipcode . ", " . $country);

                $address = new Address();
                $address->lat = $lat;
                $address->lng = $lng;
                $address->zipcode = $zipcode;

            }
            catch(\Exception $e) {

                throw $e;

            }

        }

        return $address;

    }

    public function getCountry($country) {

        $basename = \ucfirst(\strtolower($country));

        $filename = __dir__ . "/Country/" . $basename . ".php";
        $country = null;

        if(file_exists($filename)) {

            include_once $filename;
            $class = "\Maalls\Zipcode\Country\\" . $basename;
            $country = new $class;

        }

        return $country;

    }



}