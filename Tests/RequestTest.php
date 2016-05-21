<?php
namespace WFS\Tests;

use WFS\Component\Driver;
use WFS\Entity\FeatureTypeList;
use WFS\Entity\OperationsMetadata;
use WFS\Entity\ServiceProvider;

/**
 *
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * RequestTest constructor.
     */
    public function __construct()
    {
        $capabilitiesXML = "Tests/WFS/2.0.0/GetCapabilities.xml";
        $wfsURL          = "http://demo.boundlessgeo.com/geoserver/wfs";
        $driver          = new Driver($wfsURL);
        $caps            = $driver->convertXmlToSimpleArray(file_get_contents($capabilitiesXML));
        $operations      = new OperationsMetadata($caps['ows_OperationsMetadata']);
        $serviceProvider = new ServiceProvider($caps["ows_ServiceProvider"]);
        $featureTypeList = new FeatureTypeList($caps['FeatureTypeList']);

        //$caps = $driver->conve
        //rtXmlToSimpleArray(file_get_contents("../Tests/WFS/2.0.0/GetCapabilities.xml"));


        //$featureType = $driver->t($caps);

        //$desc = $driver->xml2array(file_get_contents("../tests/wfs/2.0.0/DescribeFeatureType.xml"));
        //$result = $driver->query('GetCapabilities');
    }

    public function testGetFeature()
    {
        //http://demo.boundlessgeo.com/geoserver/wfs
        //?service=WFS
        //&version=1.1.0
        //&request=GetFeature
        //&typename=osm:water_areas
        //&outputFormat=text/javascript
        //&format_options=callback:loadFeatures
        //&srsname=EPSG:3857
        //&bbox=-8922952.933898335,5361598.912035402,-8913168.994277833,5371382.851655904,EPSG:3857
        //&_=1463585466550
    }
}

