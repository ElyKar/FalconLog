<?php

/**
 * The entity manager for the two Meteo Concept project
 * used to manage the connection to the databases
 */

namespace FalconLog\Manager;

use MeteoConcept\Lib\Manager\EntityManagerInterface;
use MeteoConcept\Lib\Manager\BatchManager;
use MeteoConcept\Lib\Hydrator\Hydrator;
use PDO;

class EntityManager implements EntityManagerInterface
{
    /**
     * Connection to the database
     *
     * @var PDO
     */
    private $conn;

    /**
     * Hydrator
     *
     * @var Hydrator
     */
    private $hydrator;

    /**
     * {@inheritDoc}
     */
    public function __construct($db_host, $db_port, $db_user, $db_password)
    {
        $this->conn = new PDO("mysql:host=$db_host;port=$db_port;charset=utf8",$db_user, $db_password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->hydrator = new Hydrator();
    }

    /**
     * {@inheritDoc}
     */
    public function fetchSimpleClass($stmt, $classname)
    {
        if ($this->batchActive) {
            $this->batch->addSimple($stmt);
            return null;
        } else {
            $PDOstmt = $this->conn->query($stmt);
            $result = $PDOstmt->fetchAll(PDO::FETCH_ASSOC);
            return $this->hydrator->hydrateAll($result, $classname);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function fetchSimpleAssoc($stmt)
    {
        $PDOstmt = $this->conn->query($stmt);
        return $PDOstmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

