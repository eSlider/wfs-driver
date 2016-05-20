<?php
namespace WFS\Entity;

/**
 * Class Address
 *
 * @package WFS\Entity
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