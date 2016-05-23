<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class OperationsMetadata
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class OperationsMetadata extends BaseEntity
{
    /** @var  \Wheregroup\WFS\Entity\Constrain[] */
    protected $constraints;

    /** @var  \Wheregroup\WFS\Entity\Operation[] */
    protected $operations;
}