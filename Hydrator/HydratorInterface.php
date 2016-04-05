<?php

/**
 * An hydrator's role is to transform a row into objects,
 * this interface provides the necessary methods
 */

namespace FalconLog\Hydrator;

interface HydratorInterface
{
    /**
     * Hydrate an array of row into an array of objects
     *
     * @param rows the array of row
     * @param classname the name of the class to return
     *
     * @return array an array of instances of classname
     */
    public function hydrateAll($rows, $classname);

    /**
     * Hydrate a single row into an object
     *
     * @param row the data
     * @param classname the name of the class to return
     *
     * @return an instance of classname
     */
    public function hydrate($row, $classname);
}
