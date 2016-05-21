<?php
namespace WFS\Component;

use Sabre\Xml\Service;
use WFS\Entity\Constrain;
use WFS\Entity\FeatureType;
use WFS\Entity\FeatureTypeList;
use WFS\Entity\OperationsMetadata;
use WFS\Entity\ServiceIdentification;
use WFS\Entity\ServiceProvider;

/**
 * @author Andriy Oblivantsev <eslider@gmail.com>
 */
class Driver
{
    /** @var string URL */
    protected $url;

    /** @var  Constrain */
    protected $constrains;

    /** @var string Last URL request */
    protected $_lastUrl;

    /** @var  ServiceIdentification */
    protected $serviceIdentification;

    /** @var OperationsMetadata */
    protected $operationsMetadata;

    /** @var  ServiceProvider */
    protected $serviceProvider;

    /**
     * Driver constructor.
     *
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return FeatureType[]
     */
    public function getEntityTypes()
    {
        $response                    = $this->queryAsArray('GetCapabilities');
        $this->serviceIdentification = new ServiceIdentification($response['ows_ServiceIdentification']);
        $this->operationsMetadata    = new OperationsMetadata($response['ows_OperationsMetadata']);
        $this->serviceProvider       = new ServiceProvider($response["ows_ServiceProvider"]);
        $featureTypeList             = new FeatureTypeList($response['FeatureTypeList']);
        return $featureTypeList;
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
        $url            = $this->url . '?' .
            http_build_query(
                array_merge(array(
                    'service' => 'WFS',
                    'request' => $requestName,
                ), $request));
        $this->_lastUrl = $url;
        return implode(file($url));
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
            throw new \Exception("WFS:" . $details["exceptionCode"] . ':' . $details["ows_ExceptionText"]);
        }
        return $array;
    }

    /**
     * @param string $requestName
     * @param array  $request
     * @param array  $map
     * @return array
     */
    public function queryMapped($requestName, array $request = array(), array $map = null)
    {
        return $this->xml2array(
            $this->query($requestName, $request),
            $map);
    }

    /**
     * Convert XML to Array
     *
     * @param      $xml
     * @param null $map
     * @return array
     */
    public function xml2array($xml, $map = null)
    {
        $service = new Service();
        if (is_array($map)) {
            $service->elementMap = $map;
        }
        return $service->parse($xml);
    }

    /**
     * @param $xmlElement
     * @return mixed
     */
    public function object2array($xmlElement)
    {
        return json_decode(json_encode($xmlElement), true);
    }

    /**
     * @param $xml
     * @return array
     */
    public function convertXmlToSimpleArray($xml)
    {
        $xml = preg_replace('/<(.+?):(.+?)>/s', '<$1_$2>', $xml);
        return $this->object2array(simplexml_load_string($xml));
    }
}