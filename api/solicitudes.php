<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/Validator.php';
require_once __DIR__ . '/../models/SolicitudCompra.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if ($method === 'GET') {
        $items = SolicitudCompra::all(50);
        Response::ok($items, 200);
    }

    if ($method === 'POST') {
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true);
        if (!is_array($input)) {
            // Fallback por si llega form-urlencoded o el body JSON viene vacío.
            $input = $_POST;
        }

        // Normaliza nombres de campos por si el formulario llega con otros keys.
        if (!array_key_exists('supplier_code', $input) && array_key_exists('supplier', $input)) {
            $input['supplier_code'] = $input['supplier'];
        }
        if (!array_key_exists('request_date', $input) && array_key_exists('date', $input)) {
            $input['request_date'] = $input['date'];
        }

        $validated = Validator::validateSolicitudCompra($input);
        if (!$validated['is_valid']) {
            Response::error('Validación fallida', 422, $validated['errors']);
        }

        $id = SolicitudCompra::create($validated['data']);
        Response::ok(['id' => $id], 201);
    }

    if ($method === 'DELETE') {
        $raw = file_get_contents('php://input');
        $input = json_decode($raw, true);
        $id = 0;
        if (is_array($input) && isset($input['id'])) {
            $id = (int)$input['id'];
        }
        if ($id < 1 && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
        }
        if ($id < 1) {
            Response::error('Identificador de orden inválido', 422);
        }

        $deleted = SolicitudCompra::deleteById($id);
        if (!$deleted) {
            Response::error('No se encontró la orden de compra', 404);
        }

        Response::ok(['id' => $id, 'deleted' => true], 200);
    }

    Response::error('Método no permitido', 405);
} catch (Throwable $e) {
    // En producción, evita mostrar detalles al cliente.
    Response::error('Error interno del servidor', 500, [
        'exception' => $e->getMessage(),
    ]);
}

