<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';

final class Supplier
{
    private function __construct()
    {
    }

    /** @return array<int, array{code: string, name: string}> */
    public static function all(): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query('SELECT code, name FROM suppliers ORDER BY name ASC');

        return $stmt->fetchAll();
    }
}
