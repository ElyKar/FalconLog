<?php

namespace FalconLog\Config;
/**
 * The Config class parses and create a config
 * accessible globally in the application
 * from a file
 */
class Config {

    /**
     * The map of parameters
     */
    private $map;

    /**
     * Builds a new config from the given
     * file name
     */
    public function __construct($filename) {
        $parser = new Parser($filename);
        $map = $parser->parse();
    }

    /**
     * Get the parameter with given name
     * Throws an exception if non-existant
     */
    public function get($name) {
        if (array_key_exists($map, $name)) {
            return $map[$name];
        }
        throw new Exception("Non-existant parameter '$name'");
    }
}

