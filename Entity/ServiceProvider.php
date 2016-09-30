<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class ServiceProvider
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class ServiceProvider extends BaseEntity
{
    /** @var string Service name */
    protected $name;

    /** @var \Wheregroup\WFS\Entity\ServiceContact */
    protected $serviceContact;

    /**
     * @return ServiceContact
     */
    public function getContact()
    {
        return $this->serviceContact;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    protected function setOws_ProviderName($name)
    {
        $this->name = $name;
    }
}