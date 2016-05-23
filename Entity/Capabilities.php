<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Capabilities
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Capabilities extends BaseEntity
{
    /** @var string */
    protected $version;

    /** @var string */
    protected $updateSequence;

    /** @var \Wheregroup\WFS\Entity\ServiceIdentification */
    protected $serviceIdentification;

    /** @var \Wheregroup\WFS\Entity\FeatureTypeList */
    protected $featureTypeList;

    /** @var \Wheregroup\WFS\Entity\ServiceProvider */
    protected $serviceProvider;

    /** @var \Wheregroup\WFS\Entity\OperationsMetadata */
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