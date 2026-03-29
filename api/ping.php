<?php
declare(strict_types=1);

/**
 * Prueba rápida: abre en el navegador
 *   http://tudominio/stitch/api/ping.php
 * Debe devolver JSON ok:true. Si falla, el mensaje indica el problema (conexión, nombre de BD, tabla, etc.).
 */
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../core/Database.php';

    $pdo = Database::getInstance();
    $pdo->query('SELECT 1');

    $countSolicitudes = (int)$pdo->query('SELECT COUNT(*) AS c FROM solicitudes_compra')->fetch()['c'];
    $countSuppliers = (int)$pdo->query('SELECT COUNT(*) AS c FROM suppliers')->fetch()['c'];

    echo json_encode([
        'ok' => true,
        'database' => DB_NAME,
        'host' => DB_HOST,
        'solicitudes_compra_rows' => $countSolicitudes,
        'suppliers_rows' => $countSuppliers,
    ], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'error' => $e->getMessage(),
        'hint' => 'Revisa config/database.php (DB_HOST, DB_NAME, DB_USER, DB_PASS). El nombre de la base en hosting suele ser usuario_nombrebd, no solo "stitch".',
    ], JSON_UNESCAPED_UNICODE);
}
