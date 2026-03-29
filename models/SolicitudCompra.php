<?php
declare(strict_types=1);

require_once __DIR__ . '/../core/Database.php';

final class SolicitudCompra
{
    private function __construct()
    {
    }

    public static function create(array $data): int
    {
        $pdo = Database::getInstance();

        $sql = '
            INSERT INTO solicitudes_compra
                (supplier_code, request_date, delivery_date, description, quantity, unit_price, total_cost, notes)
            VALUES
                (:supplier_code, :request_date, :delivery_date, :description, :quantity, :unit_price, :total_cost, :notes)
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':supplier_code' => $data['supplier_code'],
            ':request_date' => $data['request_date'],
            ':delivery_date' => $data['delivery_date'],
            ':description' => $data['description'],
            ':quantity' => $data['quantity'],
            ':unit_price' => $data['unit_price'],
            ':total_cost' => $data['total_cost'],
            ':notes' => $data['notes'],
        ]);

        return (int)$pdo->lastInsertId();
    }

    public static function all(int $limit = 50): array
    {
        $pdo = Database::getInstance();

        // Entero embebido: en varios servidores MySQL/PDO falla LIMIT con parámetro enlazado y prepares nativos.
        $lim = max(1, min(200, $limit));

        $sql = "
            SELECT
                s.id,
                s.supplier_code,
                COALESCE(sup.name, s.supplier_code) AS supplier_name,
                s.request_date,
                s.delivery_date,
                s.description,
                s.quantity,
                s.unit_price,
                s.total_cost,
                s.notes,
                s.created_at
            FROM solicitudes_compra s
            LEFT JOIN suppliers sup ON sup.code = s.supplier_code
            ORDER BY s.id DESC
            LIMIT {$lim}
        ";

        $stmt = $pdo->query($sql);

        return $stmt->fetchAll();
    }

    public static function deleteById(int $id): bool
    {
        if ($id < 1) {
            return false;
        }

        $pdo = Database::getInstance();
        $stmt = $pdo->prepare('DELETE FROM solicitudes_compra WHERE id = :id LIMIT 1');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
