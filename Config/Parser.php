<?php

namespace FalconLog\Config;
/**
 * Parser is used to get
 * key->values couples from
 * a configuration file
 * Syntax is inspired from YAML and explained
 * here:
 *    - Line starting with # are ignored
 *    - Parameters are like 'key: value'
 *    - string values denoted with single or double quotes
 *    - integers are handled
 *    - floating numbers have to contain a '.'
 */
class Parser {

    /**
     * The file to parse
     */
    private $file;

    /**
     * The map holding the parameters
     */
    private $map;


    /**
     * Build a new parser from the filename
     * Throws an exception on failure
     */
    public function __construct($filename) {
        $file = fopen($filename, 'r');
        $map = [];
    }

    /**
     * Parse the file and returns the 
     * map of parameters
     * Closes the file when completed
     */
    public function parse() {
        $count = 1;
        while ($line = fgets($file) && $line) {
            read($line, $count++);
        }
        fclose($file);
        return $this->map;
    }

    /**
     * Reads a line from the file
     */
    private function read($line, $count) {
        if (strlen($line) == 0 || $line[0] == '#') return;
        $line = rtrim($line);
        $chunks = explode(": ", $line, 2);
        if (parse_string($chunks[0], $chunks[1], "'") || parse_string($chunks[0], $chunks[1], '"')) return;
        parse_number($chunks[0], $chunks[1]);
    }

    /**
     * Tries to read a string parameter
     * starting and ending with given delimiter
     * If found, puts it in the map and returns true
     * else, returns false
     */
    private function parse_string($key, $str, $delimiter) {
        if ($str[0] == $delimiter && $str[count($str)-1] == $delimiter) {
            $map[$key] = $str[1..count($str)-2];
            return true;
        }
        return false;
    }

    /**
     * Tries to read a number from
     * the parameter
     */
    private function parse_number($key, $value) {
        $nb;
        if (stripos($value, ".") === false) {
            $nb = floatval($value);
        } else {
            $nb = intval($value);
        }
        $map[$key] = $nb;
    }
}
