<?php
namespace Wheregroup\WFS\Entity\Request;

/**
 * Class Feature Request
 *
 * @package Wheregroup\WFS\Entity\Request
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Feature
{
    /** @var \Wheregroup\WFS\Entity\Request\FeatureQuery[] */
    protected $queries;

    /**
     * @return array
     */
    public function toXML()
    {
        $r = array();
        foreach ($this->queries as $query) {
            $r[] = $query->toXML();
        }
        return array(
            'Query' =>
                $r);
    }
}