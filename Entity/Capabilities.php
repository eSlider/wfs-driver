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

    /** @var \Wheregroup\WFS\Entity\FeatureType[] */
    protected $featureTypes;

    /** @var \Wheregroup\WFS\Entity\ServiceProvider */
    protected $serviceProvider;

    /** @var \Wheregroup\WFS\Entity\OperationsMetadata */
    protected $operationsMetadata;

    /** @var  array */
    protected $filter_Capabilities;

    /** @var string URL */
    protected $schemaLocations;

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
     * @return FeatureType[]
     */
    public function getFeatureTypes()
    {
        return $this->featureTypes;
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

    /**
     * @param string $schemaLocations
     */
    public function setSchemaLocation($schemaLocations)
    {
        $this->schemaLocations = preg_split('/\s+/', $schemaLocations);
    }

    /**
     * Set feature types
     *
     * @param $list
     */
    public function setFeatureTypeList($list)
    {
        $this->fill($list);
    }

}