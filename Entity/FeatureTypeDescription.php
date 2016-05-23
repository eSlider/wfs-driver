<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureTypeDescription
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureTypeDescription extends BaseEntity
{
    protected $numberMatched;
    protected $numberReturned;
    protected $timeStamp;
    protected $schemaLocation;

    /** @var array */
    protected $members;

    /**
     * @return mixed
     */
    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    /**
     * @param string $time
     */
    protected function setTimeStamp($time)
    {
        $this->timeStamp = strtotime($time);
    }

    /**
     * @return mixed
     */
    public function getSchemaLocations()
    {
        return preg_split('/\s+/', $this->schemaLocation);
    }

    /**
     * Set member
     *
     * @param $collections
     * @internal param $collection
     */
    protected function setMember($collections)
    {
        $r = array();
        foreach ($collections as $collection) {
            foreach ($collection as $type => $memberData) {
                $r[] = new Member($type, $memberData);
            }
        }
        $this->members = $r;
    }
}