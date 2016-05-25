<?php

namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Member
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Member extends BaseEntity
{
    protected $gmlId;
    protected $data;
    protected $type;

    /**
     * @param array $data
     */
    public function __construct($type, array $data)
    {
        $this->type  = $type;
        $this->gmlId = $data["@attributes"]["gml_id"];
        $this->data  = $data;

        unset($data["@attributes"]);

        parent::__construct();
    }

    /**
     * @return string GML ID {TEXT.ID}
     */
    public function getGmlId()
    {
        return $this->gmlId;
    }

    /**
     * Get member type name
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->type;
    }

    /**
     * Get member ID
     *
     * @return string
     */
    public function getId()
    {
        return end(explode('.', $this->gmlId));
    }
}