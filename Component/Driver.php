<?php
namespace WFS\Component;

use WFS\Entity\Capabilities;
use WFS\Entity\Constrain;
use WFS\Entity\FeatureType;
use WFS\Entity\OperationsMetadata;
use WFS\Entity\ServiceIdentification;
use WFS\Entity\ServiceProvider;
use Wheregroup\XML\Util\Parser;

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
        $response     = $this->queryAsArray('GetCapabilities');
        $capabilities = new Capabilities($response);
        return $capabilities->getFeatureTypeList();
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
     * @param $xml
     * @return array
     */
    public function convertXmlToSimpleArray($xml)
    {
        return Parser::convertXmlToSimpleArray($xml);
    }
}