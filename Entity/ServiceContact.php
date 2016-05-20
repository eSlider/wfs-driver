<?php
namespace WFS\Entity;

/**
 * ServiceContact
 */
class ServiceContact extends BaseEntity
{
    /** @var string */
    protected $individualName;

    /** @var string */
    protected $positionName;

    /** @var \WFS\Entity\ContactInfo */
    protected $contactInfo;
}