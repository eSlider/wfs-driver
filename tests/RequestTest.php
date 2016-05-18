<?php

include "../src/Driver.php";
/**
 *
 */
class RequestTest
{
    /**
     * RequestTest constructor.
     */
    public function __construct()
    {
        // ?service=WFS&version=1.1.0&request=GetCapabilities"
        $driver = new \WFS\Driver("http://demo.boundlessgeo.com/geoserver/wfs");
        $result = $driver->query('GetCapabilities');
        $version          = "2.0.0";
        //$testXmlPath      = "wfs/{$version}/GetCapabilities.xml";
        //$simpleXMLElement = simplexml_load_file($testXmlPath);
        //$nameSpaceUrls    = $simpleXMLElement->getDocNamespaces(true);
        //$r                = array($simpleXMLElement->getName() => $this->xml2array($simpleXMLElement));
    }

    public function testGetFeature(){
        //http://demo.boundlessgeo.com/geoserver/wfs
        //?service=WFS
        //&version=1.1.0
        //&request=GetFeature
        //&typename=osm:water_areas
        //&outputFormat=text/javascript
        //&format_options=callback:loadFeatures&srsname=EPSG:3857&bbox=-8922952.933898335,5361598.912035402,-8913168.994277833,5371382.851655904,EPSG:3857&_=1463585466550
    }

}

new RequestTest();
