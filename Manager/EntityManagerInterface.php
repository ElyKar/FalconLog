<?php

/**
 * The entity manager for the two Meteo Concept project
 * used to manage the connection to the databases
 */

namespace FalconLog\Manager;

interface EntityManagerInterface
{

    /**
     * Constructor
     *
     * @param db_host Host of the database
     * @param db_port Port of the database
     * @param db_user User of the database
     * @param db_password Password for the user
     */
    public function __construct($db_host, $db_port, $db_user, $db_password);

    /**
     * Fetch data using a simple SQL string statement
     *
     * @param stmt the SQL string statement
     * @param classname the name of the class to retrieve
     *
     * @return an array of result objects, null if batch mode
     */
    public function fetchSimpleClass($stmt, $classname);

    /**
     * Fetch data using a simple SQL string statement
     *
     * @param stmt the SQL string statement
     *
     * @return an array of result arrays
     */
    public function fetchSimpleAssoc($stmt);
}
