<?php
namespace WFS;

/**
 * @author Andriy Oblivantsev <eslider@gmail.com>
 */
class Driver
{
    protected $version;
    protected $url;

    /**
     * Driver constructor.
     *
     * @param string $url
     * @param string $version
     */
    public function __construct($url, $version = null)
    {
        $this->url     = $url;
        $this->version = null;
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
        return $this->xml2array(
            simplexml_load_string(
                implode(
                    file($this->url . '?' .
                        http_build_query(
                            array_merge(array(
                                'service' => 'WFS',
                                'request' => $requestName,
                            ), $request))))));
    }

    /**
     * Convert XML to Array
     *
     * @param $xml
     * @return array
     */
    protected function xml2array($xml)
    {
        return json_decode(json_encode($xml), true);
    }
}