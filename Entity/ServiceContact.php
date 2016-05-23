<?php
namespace WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

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