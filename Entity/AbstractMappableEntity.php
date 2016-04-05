<?php

/**
 * Implementation of the __set method for
 * enabling mapping
 */

namespace FalconLog\Entity;

abstract class AbstractMappableEntity
{
    public static function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }
}

