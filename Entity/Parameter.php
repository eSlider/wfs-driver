<?php

namespace WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Parameter
 *
 * @package WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Parameter extends BaseEntity
{
    protected $name;
    protected $allowedValues;
}