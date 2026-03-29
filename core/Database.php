<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

final class Database
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                DB_HOST,
                DB_NAME,
                DB_CHARSET
            );

            self::$instance = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // true evita errores raros con prepares nativos en hosting compartido (MySQL/MariaDB).
                PDO::ATTR_EMULATE_PREPARES => true,
            ]);
        }

        return self::$instance;
    }
}

