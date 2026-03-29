<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../models/Supplier.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if ($method === 'GET') {
        Response::ok(Supplier::all(), 200);
    }

    Response::error('Método no permitido', 405);
} catch (Throwable $e) {
    Response::error('Error interno del servidor', 500, [
        'exception' => $e->getMessage(),
    ]);
}
