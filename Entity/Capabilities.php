<?php
namespace WFS\Entity;

/**
 * Class Capabilities
 *
 * @package WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Capabilities extends BaseEntity
{
    /** @var string */
    protected $version;

    /** @var string */
    protected $updateSequence;

    /** @var \WFS\Entity\ServiceIdentification */
    protected $serviceIdentification;

    /** @var \WFS\Entity\FeatureTypeList */
    protected $featureTypeList;

    /** @var \WFS\Entity\ServiceProvider */
    protected $serviceProvider;

    /** @var \WFS\Entity\OperationsMetadata */
    protected $operationsMetadata;

    /** @var  array */
    protected $filter_Capabilities;

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return ServiceIdentification
     */
    public function getServiceIdentification()
    {
        return $this->serviceIdentification;
    }

    /**
     * @return FeatureTypeList
     */
    public function getFeatureTypeList()
    {
        return $this->featureTypeList;
    }

    /**
     * @return ServiceProvider
     */
    public function getServiceProvider()
    {
        return $this->serviceProvider;
    }

    /**
     * @return OperationsMetadata
     */
    public function getOperationsMetadata()
    {
        return $this->operationsMetadata;
    }

    /**
     * @return array
     */
    public function getFilterCapabilities()
    {
        return $this->filter_Capabilities;
    }

}