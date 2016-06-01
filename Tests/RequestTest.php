<?php
namespace Wheregroup\WFS\Tests;

use Wheregroup\WFS\Component\Driver;
use Wheregroup\WFS\Entity\Capabilities;
use Wheregroup\WFS\Entity\FeatureCollection;
use Wheregroup\WFS\Entity\Schema;

/**
 * WFS Request tests
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /** Test XML path */
    const XML_PATH = "vendor/opengis/wfs/2.0.2/examples/";

    /** WFS test server url */
    const WFS_URL = "http://localhost/cgi-bin/mapserv?map=/data/umn/germany/germany_wfs_server.map";

    /** @var Driver */
    protected $driver;

    /**
     * Generates a metadata document describing a WFS service provided by server
     * as well as valid WFS operations and parameters
     *
     * @test
     */
    public function getCapabilities()
    {
        $list         = $this->fetchTestXmlFiles("GetCapabilities/*_Res_*.xml", function ($data, $filePath) {
            return new Capabilities($data, true);
        });
        $capabilities = $this->driver->getCapabilities();
        $featureTypes = $capabilities->getFeatureTypes();
    }

    /**
     * Returns a description of feature types supported by a WFS service
     *
     * @test
     */
    public function describeFeatureType()
    {
        $list = $this->fetchTestXmlFiles("DescribeFeatureType/*_Response*", function ($data, $filePath) {
            return new Schema($data, true);
        });
    }

    /**
     * Retrieves the value of a feature property
     * or part of the value of a complex feature property
     * from the data store for a set of features identified
     * using a query expression
     *
     * @test
     */
    public function getPropertyValue()
    {
    }

    /**
     * Returns a selection of features from a data source including geometry and attribute values
     *
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
     * @param string   $globPathRule Glob path rule
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
        $this->driver = new Driver(self::WFS_URL, true);
    }


}
