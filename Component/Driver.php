<?php
namespace Wheregroup\WFS\Component;

use Wheregroup\WFS\Entity\Capabilities;
use Wheregroup\WFS\Entity\Constrain;
use Wheregroup\WFS\Entity\FeatureType;
use Wheregroup\WFS\Entity\OperationsMetadata;
use Wheregroup\WFS\Entity\Request\Feature;
use Wheregroup\WFS\Entity\ServiceIdentification;
use Wheregroup\WFS\Entity\ServiceProvider;
use Wheregroup\XML\Util\Parser;

/**
 * @author Andriy Oblivantsev <eslider@gmail.com>
 */
class Driver
{
    /** @var string URL */
    protected $debugging = true;

    /** @var string URL */
    protected $url;

    /** @var  Constrain */
    protected $constrains;

    /** @var  ServiceIdentification */
    protected $serviceIdentification;

    /** @var OperationsMetadata */
    protected $operationsMetadata;

    /** @var  ServiceProvider */
    protected $serviceProvider;

    protected $cacheQueries;

    /**
     * Driver constructor.
     *
     * @param string $url
     * @param bool   $cache
     */
    public function __construct($url, $cache = false)
    {
        $this->url = $url;
        $this->setCacheQueries($cache);
        $this->debugging = $cache;
    }

    /**
     * @return FeatureType[]
     */
    public function getEntityTypes()
    {
        return $this->getCapabilities()->getFeatureTypes();
    }

    /**
     * @param Feature $featureRequest
     * @return array
     * @throws \Exception
     */
    public function getFeature(Feature $featureRequest)
    {
        return $this->queryAsArray('getFeature', $featureRequest->toXML());
    }

    /**
     * @param FeatureType $featureType
     * @return array
     * @throws \Exception
     */
    public function describeFeatureType(FeatureType $featureType)
    {
        return $this->queryAsArray('DescribeFeatureType',
            array('TypeName' => $featureType->getName()));
    }

    /**
     * Query server
     *
     * @param string     $requestName
     * @param array|null $request
     * @return array
     */
    public function query($requestName, array $request = array())
    {
        $url      = $this->url . '?' .
            http_build_query(
                array_merge(array(
                    'service' => 'WFS',
                    'request' => $requestName,
                ), $request));
        if($this->cacheQueries){
            $filePath = "Cache/" . md5($url) . ".xml";
            if ( !file_exists($filePath)) {
                $xmlContent = implode(file($url));
                file_put_contents($filePath, $xmlContent);
            } else {
                $xmlContent = implode(file($filePath));

            }
        }else{
            $xmlContent = implode(file($url));
        }

        return $xmlContent;
    }

    /**
     * @param string $requestName
     * @param array  $request
     * @param array  $map
     * @return array
     * @throws \Exception
     */
    public function queryAsArray($requestName, array $request = array(), array $map = null)
    {
        $xml   = $this->query($requestName, $request);
        $array = $this->convertXmlToSimpleArray($xml);

        if (isset($array["ows_Exception"])) {
            $details = $array["ows_Exception"];
            throw new \Exception(
                "WFS:"
                . $details['@attributes']['exceptionCode']
                . ':'
                . $details['ows_ExceptionText']
            );
        }
        return $array;
    }

    /**
     * @param $xml
     * @return array
     */
    public function convertXmlToSimpleArray($xml)
    {
        return Parser::convertXmlToSimpleArray($xml);
    }

    /**
     * @return Capabilities
     * @throws \Exception
     */
    public function getCapabilities()
    {
        $response     = $this->queryAsArray('GetCapabilities');
        $capabilities = new Capabilities($response, $this->debugging);
        return $capabilities;
    }

    /**
     * Cache queries
     *
     * @param boolean $cacheQueries
     */
    public function setCacheQueries($cacheQueries)
    {
        $this->cacheQueries = $cacheQueries;
    }
}