<?php
namespace WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class OperationsMetadata
 *
 * @package WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class OperationsMetadata extends BaseEntity
{
    /** @var  \WFS\Entity\Constrain[] */
    protected $constraints;

    /** @var  \WFS\Entity\Operation[] */
    protected $operations;
}