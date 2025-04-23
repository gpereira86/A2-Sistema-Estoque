<?php

namespace System\Core;

use PDO;
use PDOException;

/**
 * Database Connection Class
 *
 * This class handles the connection to the MySQL database using the PDO (PHP Data Objects) extension.
 * It provides a singleton instance of the PDO connection to ensure that only one connection is made
 * throughout the application lifecycle.
 */
class DbConnection
{

    private static $instancia;

    /**
     * Returns a PDO instance (singleton).
     *
     * This method creates a new PDO connection to the MySQL database using the configuration constants
     * from the system's configuration file. If an instance already exists, it returns the existing
     * instance to ensure only one connection is used throughout the application.
     *
     * @return PDO The PDO instance representing the connection to the database.
     * @throws PDOException If the connection cannot be established, an exception is thrown.
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$instancia)) {

            try {
                self::$instancia = new PDO(
                    'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
                    DB_USERNAME,
                    DB_PASSCODE,
                    [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "set NAMES utf8",
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                        PDO::ATTR_CASE => PDO::CASE_NATURAL
                    ]
                );
            } catch (PDOException $ex) {
                die("Connection error >>> " . $ex->getMessage());
            }
        }
        return self::$instancia;
    }

    /**
     * Constructor (protected).
     *
     * The constructor is protected to prevent creating instances directly via the constructor.
     * The class follows the Singleton design pattern, so the only way to obtain an instance is
     * through the `getInstance()` method.
     */
    protected function __construct()
    {
    }

    /**
     * Clone (private).
     *
     * The clone method is private to prevent cloning of the instance.
     * As this class follows the Singleton pattern, cloning would violate the pattern.
     */
    private function __clone()
    {
    }
}
