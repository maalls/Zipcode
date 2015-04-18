<?php
namespace Maalls\Zipcode\Tests;

include __dir__ . "/../vendor/autoload.php";

use Maalls\Zipcode\Zipcode;

class ZipcodeTest extends \PHPUnit_Framework_TestCase
{
    
    public function testZipcode()
    {

        $zipcode = new Zipcode();

        $this->assertEquals(null, $zipcode->zipcode("RTRR", "rt"));
        $this->assertEquals(null, $zipcode->zipcode("RTRR", "ca"));

        $address = $zipcode->zipcode("X0A0A0", "CA");

        $this->assertEquals($address->zipcode, "X0A0A0");
        $this->assertEquals($address->lat, "73.005278");
        $this->assertEquals($address->lng, "-85.033056");
        $this->assertEquals($address->province, "Nunavut");
        $this->assertEquals($address->city, "Arctic Bay");
        //$this->assertEquals(-1, -1);
    }

}