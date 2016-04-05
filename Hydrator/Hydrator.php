<?php

/**
 * The implementation of HydratorInterface
 */

namespace FalconLog\Hydrator;

use FalconLog\HydratorInterface;
use FalconLog\Entity;

class Hydrator implements HydratorInterface
{
    private static $namespace = "FalconLog\Entity";

    /**
     * Constructor
     */
    public function __construct() 
    {
    }

    /**
     * {@inheritDoc}
     */
    public function hydrateAll($rows, $classname)
    {
        $entities = array();
        foreach ($rows as $row) {
            array_push($entities, $this->hydrate($row, $classname));
        }
        return $entities;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($row, $classname)
    {
        $namespaceEntity = self::$namespace."\\".$classname;
        $entity = new $namespaceEntity();
        foreach ($row as $property => $value) {
            $entity->$property = $value;
        }
        return $entity;
    }
}
