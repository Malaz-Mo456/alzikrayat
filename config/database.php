<?php

class Database
{
    // 1. Static property to store the single instance
    private static $instance = null;
    private $connection;

    // 2. Private constructor to prevent creating objects from outside
    private function __construct()
    {
        // Database connection information
        $host = '127.0.0.1';
        $db = 'alzikrayat';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->connection = new PDO($dsn, $user, $pass);

            // Configure PDO to throw exceptions for errors
            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            // Return database results as associative arrays
            $this->connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // 3. Get the single instance of the Database class
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // 4. Return the PDO connection
    public function getConnection()
    {
        return $this->connection;
    }

    // 5. Prevent cloning and unserialization
    private function __clone()
    {
    }

    public function __wakeup()
    {
    }
}
?>