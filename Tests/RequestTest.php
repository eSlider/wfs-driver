<?php
namespace Wheregroup\WFS\Tests;

use Wheregroup\WFS\Component\Driver;
use Wheregroup\WFS\Component\FeatureRequest;
use Wheregroup\WFS\Entity\Capabilities;
use Wheregroup\WFS\Entity\FeatureTypeDescription;
use Wheregroup\WFS\Entity\Request\Feature;

/**
 * WFS Request tests
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /** Test XML path */
    const XML_PATH = "vendor/opengis/wfs/2.0.2/examples/";

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
        $data = $this->driver->convertXmlToSimpleArray(
            file_get_contents(
                self::XML_PATH . "DescribeFeatureType/DescribeFeatureType_Example01_Instance.xml"
            )
        );

        $ftd = new FeatureTypeDescription($data);
        $ftd->getSchemaLocations();
        $this->assertTrue(is_array($data));
        $this->assertTrue(array_key_exists('wfs_member', $data));
    }

    /**
     * @skip test
     */
    public function getFeature()
    {
        $this->driver->getFeature(new Feature(array(
            'typename'       => "osm:water_areas",
            'outputFormat'   => "text/javascript",
            'format_options' => "callback:loadFeatures",
            'srsname'        => 'EPSG:3857',
            'bbox'           => '-8922952.933898335,5361598.912035402,-8913168.994277833,5371382.851655904,EPSG:3857',
            '_'              => '1463585466550',
        )));
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
                $this->loadXML("GetCapabilities/GetCapabilities_Res_02.xml")
            );
        }
        return $xml;
    }

    /**
     * Load test xml
     *
     * @param string $file Relatives XML file path
     * @return string XML
     */
    protected function loadXML($file)
    {
        return file_get_contents(
            self::XML_PATH . $file
        );
    }

}
