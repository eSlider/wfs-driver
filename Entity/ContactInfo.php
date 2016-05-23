<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class ContactInfo
 *
 * @package WFS
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class ContactInfo extends BaseEntity
{
    /** @var \Wheregroup\WFS\Entity\Address */
    protected $address;

    /** @var \Wheregroup\WFS\Entity\Phone */
    protected $phone;
}