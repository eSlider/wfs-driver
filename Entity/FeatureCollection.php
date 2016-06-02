<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureCollection
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureCollection extends BaseEntity
{
    protected $numberMatched;
    protected $numberReturned;
    protected $timeStamp;
    protected $schemaLocation;

    /** @var Envelope */
    protected $boundedBy;


    /** @var \Wheregroup\WFS\Entity\Member[] */
    protected $members;

    /**
     * Get schema location URL's
     *
     * @return array Schema location URL's
     */
    public function getSchemaLocations()
    {
        return preg_split('/\s+/', $this->schemaLocation);
    }

    /**
     * @return mixed
     */
    public function countMatched()
    {
        return $this->numberMatched;
    }

    /**
     * @return mixed
     */
    public function countReturned()
    {
        return $this->numberReturned;
    }

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return strtotime($this->timeStamp);
    }

    /**
     * @param mixed $boundedBy
     */
    public function setBoundedBy($boundedBy)
    {
        $envelopeData    = current(array_values($boundedBy));
        $this->boundedBy = new Envelope($envelopeData);
    }

    /**
     *
     */
    public function getMembers()
    {
        return $this->members;
    }
}