<?php
namespace WFS\Entity;

/**
 * Class ServiceProvider
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class ServiceProvider extends BaseEntity
{
    /** @var string Service name */
    protected $name;

    /** @var \WFS\Entity\ServiceContact */
    protected $serviceContact;

    /**
     * @return ContactInfo
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