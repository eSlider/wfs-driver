<?php
namespace Wheregroup\WFS\Tests;

use Wheregroup\WFS\Component\Driver;
use Wheregroup\WFS\Entity\Capabilities;
use Wheregroup\WFS\Entity\FeatureCollection;
use Wheregroup\WFS\Entity\FeatureType;

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
     * @test
     */
    public function getCapabilities()
    {
        $list = $this->fetchTestXmlFiles("GetCapabilities/*_Res_*.xml", function ($data, $filePath) {
            return new Capabilities($data, true);
        });
    }

    /**
     * @test
     */
    public function describeFeatureType()
    {
        $list = $this->fetchTestXmlFiles("DescribeFeatureType/*_Response*", function ($data, $filePath) {
            return $data;
        });
    }

    /**
     * @test
     */
    public function getFeature()
    {
        $list = $this->fetchTestXmlFiles("GetFeature/*Res.xml", function ($data, $filePath) {
            $featureCollection = new FeatureCollection($data);
            $members           = $featureCollection->getMembers();
            return $featureCollection;
        });
        var_dump($list);
    }


    public function testDescribeFeatureType()
    {
        $data = $this->readXML("DescribeFeatureType/DescribeFeatureType_Example01_Instance.xml");
        $this->assertTrue(is_array($data));
        $this->assertTrue(array_key_exists('wfs_member', $data));
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
     * @param $uri
     * @return array
     */
    protected function readXML($uri)
    {
        return $this
            ->driver
            ->convertXmlToSimpleArray(
                file_get_contents($uri)
            );
    }

    /**
     * @param string $globPathRule Glob path rule
     * @param callable $callback
     * @return array
     */
    protected function fetchTestXmlFiles($globPathRule, callable $callback)
    {
        $list = array();
        foreach (glob(self::XML_PATH . $globPathRule) as $filePath) {
            $r = $callback($this->readXML($filePath), $filePath);
            if (!$r) {
                break;
            }
            $list[] = $r;
        }
        return $list;
    }

    /**
     * Setup driver
     */
    protected function setUp()
    {
        $this->driver = new Driver("http://demo.boundlessgeo.com/geoserver/wfs");
    }


}
