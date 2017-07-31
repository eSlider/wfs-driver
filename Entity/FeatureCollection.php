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
     * Get feature members
     *
     * @return Member[]
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @return Envelope
     */
    public function getBoundedBy()
    {
        return $this->boundedBy;
    }

    /**
     * Convert multi dimensional[type][member] array structure
     * to typed Member[]
     *
     * @param $memberTypes
     */
    protected function setMember($memberTypes)
    {
        foreach ($memberTypes as $typeName => $members) {
            if (!is_numeric(key($members))) {
                $members = array($members);
            }
            foreach ($members as $memberData) {
                $memberData      = array_merge(current($memberData), array('type' => key($memberData)));
                $this->members[] = new Member($memberData);
            }
        }
        $this->members;
    }

    /**
     * Get SRID
     *
     * @return string
     */
    public function getSRID()
    {
        return $this->getBoundedBy()->getSRID();
    }
}