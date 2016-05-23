<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class ServiceIdentification
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class ServiceIdentification extends BaseEntity
{
    protected $abstract;
    protected $setAccessConstraints;
    protected $fees;
    protected $serviceTypeVersion;
    protected $title;
    protected $keywords;

    /**
     * @return array
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @return string
     */
    public function getSetAccessConstraints()
    {
        return $this->setAccessConstraints;
    }

    /**
     * @return string
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * @return string
     */
    public function getServiceTypeVersion()
    {
        return $this->serviceTypeVersion;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $data
     * @internal param mixed $keywords
     */
    protected function setOwS_Keywords($data)
    {
        $this->keywords = $data['ows_Keyword'];
    }
}