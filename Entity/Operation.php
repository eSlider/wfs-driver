<?php
namespace WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Operation
 *
 * @package WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Operation extends BaseEntity
{
    /** @var string */
    protected $name;

    /** @var array */
    protected $dCP;

    /** @var \WFS\Entity\Parameter */
    protected $parameter;
}