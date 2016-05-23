<?php
namespace WFS\Tests;

use WFS\Component\Driver;
use WFS\Entity\Capabilities;

/**
 * WFS Request tests
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /** Assets path */
    const XML_PATH = "Tests/WFS";

    /** @var Driver */
    protected $driver;

    /**
     * Setup driver
     */
    protected function setUp()
    {
        $this->driver = new Driver("http://demo.boundlessgeo.com/geoserver/wfs");
    }

    public function testDescribeFeatureType()
    {
        $r = $this->driver->convertXmlToSimpleArray(
            file_get_contents(
                self::XML_PATH . "/2.0.0/DescribeFeatureType.xml"
            )
        );
    }

    public function testGetFeature()
    {
        //http://demo.boundlessgeo.com/geoserver/wfs
        //?service=WFS
        //&version=1.1.0
        //&request=GetFeature
        //&typename=osm:water_areas
        //&outputFormat=text/javascript
        //&format_options=callback:loadFeatures&srsname=EPSG:3857&bbox=-8922952.933898335,5361598.912035402,-8913168.994277833,5371382.851655904,EPSG:3857&_=1463585466550
    }

    /**
     * @test
     */
    public function getCapabilities()
    {
        $xml          = $this->testShrinkAndConvertXML();
        $capabilities = new Capabilities($xml);
        $capabilities->getFeatureTypeList();
    }

    /**
     * @return array
     */
    public function testShrinkAndConvertXML()
    {
        static $xml = null;
        if (!$xml) {
            $xml = $this->driver->convertXmlToSimpleArray(
                file_get_contents(
                //"vendor/opengis/wfs/2.0.0/examples/GetCapabilities/GetCapabilities_Res_02.xml"
                    self::XML_PATH . "/2.0.0/GetCapabilities.xml"
                ));
        }
        return $xml;
    }

}
