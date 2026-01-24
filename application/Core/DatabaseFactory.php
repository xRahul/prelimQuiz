<?php

namespace App\Core;

use PDO;
use PDOException;
use MongoDB\Client;

class DatabaseFactory {
    private static $factory;
    private $database;
    private $databaseMongo;

    public static function getFactory() {
        if (!self::$factory) {
            self::$factory = new DatabaseFactory();
        }
        return self::$factory;
    }

    public function getConnection() {
        if (!$this->database) {
            try {
                $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

                $dsn = Config::get('DB_TYPE') . ':host=' . Config::get('DB_HOST') . ';dbname=' .
                       Config::get('DB_NAME') . ';port=' . Config::get('DB_PORT') . ';charset=' . (Config::get('DB_CHARSET') ?: 'utf8');

                $this->database = new PDO(
                    $dsn,
                    Config::get('DB_USER'), Config::get('DB_PASS'), $options
                );
                $this->database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } catch (PDOException $e) {
                // In production, we shouldn't echo error codes directly to user, but for now we keep it
                echo 'Database connection can not be established. Please try again later.' . '<br>';
                // echo 'Error code: ' . $e->getCode(); // Security risk
                error_log('Database Error: ' . $e->getMessage());
                exit;
            }
        }
        return $this->database;
    }

    public function getConnectionMongo() {
        if (!$this->databaseMongo) {
            $connectionString = Config::get('MONGODB_URI') ?: "mongodb://localhost:27017";
            $dbName = Config::get('MONGODB_DB') ?: (Config::get('DB_NAME') ?: 'prelim_quiz');

            try {
                $connection = new Client($connectionString);
                $this->databaseMongo = $connection->selectDatabase($dbName);
            } catch (\Exception $e) {
                 echo 'MongoDB connection can not be established.' . '<br>';
                 error_log('MongoDB Error: ' . $e->getMessage());
                 exit;
            }
        }
        return $this->databaseMongo;
    }
}
