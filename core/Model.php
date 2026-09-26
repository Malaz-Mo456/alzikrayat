<?php

require_once __DIR__ . '/../config/database.php';

/**
 * Base model used by all database models.
 */
abstract class Model{
    protected $db;

    /**
     * Gets the shared PDO database connection.
     */
    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
}