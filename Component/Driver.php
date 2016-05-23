<?php
namespace WFS\Component;

use Sabre\Xml\Service;
use WFS\Entity\Capabilities;
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
        return $this->object2array(self::cleanXmlFromNamespaces($xml));
    }

    /**
     * Loads XML and kills namespaces in the process.
     * It allows easy usage of namespaced XML code.
     *
     * - NameSpaced tags are renamed from <ns:tag to <ns_tag.
     * - NameSpaced tags are renamed from </ns:tag> to </ns_tag>.
     * - NameSpaced attributes are renamed from ns:tag=... to ns_tag=....
     *
     * @param string $xml XML string
     * @param string $sxclass XML class name
     * @param bool $nsattr
     * @param int $flags
     * @return SimpleXMLElement
     */
    public static function cleanXmlFromNamespaces($xml, $sxclass = 'SimpleXMLElement', $nsattr = false, $flags = null)
    {
        // Let's drop namespace definitions
        if (stripos($xml, 'xmlns=') !== false) {
            $xml = preg_replace('~[\s]+xmlns=[\'"].+?[\'"]~i', null, $xml);
        }

        // I know this looks kind of funny but it changes namespaced attributes
        if (preg_match_all('~xmlns:([a-z0-9]+)=~i', $xml, $matches)) {
            foreach (($namespaces = array_unique($matches[1])) as $namespace) {
                $escapedNS = preg_quote($namespace, '~');
                $xml       = preg_replace('~[\s]xmlns:' . $escapedNS . '=[\'].+?[\']~i', null, $xml);
                $xml       = preg_replace('~[\s]xmlns:' . $escapedNS . '=["].+?["]~i', null, $xml);
                $xml       = preg_replace('~([\'"\s])' . $escapedNS . ':~i', '$1' . $namespace . '_', $xml);
            }
        }
        // Let's change <namespace:tag to <namespace_tag ns="namespace"
        $regexfrom = sprintf('~<([a-z0-9]+):%s~is', !empty($nsattr) ? '([a-z0-9]+)' : null);
        $regexto   = strlen($nsattr) ? '<$1_$2 ' . $nsattr . '="$1"' : '<$1_';
        $xml       = preg_replace($regexfrom, $regexto, $xml);

        // Let's change </namespace:tag> to </namespace_tag>
        $xml = preg_replace('~</([a-z0-9]+):~is', '</$1_', $xml);

        // Default flags I use
        if (empty($flags)) {
            $flags = LIBXML_COMPACT | LIBXML_NOBLANKS | LIBXML_NOCDATA;
        }

        // Now load and return (namespaceless)
        return $xml = simplexml_load_string($xml, $sxclass, $flags);
    }
}