<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Address
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Address extends BaseEntity
{
    protected $administrativeArea;
    protected $city;
    protected $country;
    protected $deliveryPoint;
    protected $electronicMailAddress;
    protected $postalCode;
}