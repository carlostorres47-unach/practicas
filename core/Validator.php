<?php
declare(strict_types=1);

final class Validator
{
    private function __construct()
    {
    }

    private static function cleanString($value)
    {
        $s = is_string($value) ? $value : (string)$value;
        $s = trim($s);
        $s = strip_tags($s);
        return $s;
    }

    private static function addError(array &$errors, string $field, string $message)
    {
        $errors[$field] = $message;
    }

    private static function stringLength($value)
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value);
        }
        return strlen($value);
    }

    private static function parseDate($value)
    {
        if (!is_string($value) && !is_numeric($value)) {
            return null;
        }
        $s = trim((string)$value);
        if ($s === '') {
            return null;
        }

        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $s, $m)) {
            $y = (int)$m[1];
            $mo = (int)$m[2];
            $d = (int)$m[3];
            if (checkdate($mo, $d, $y)) {
                return sprintf('%04d-%02d-%02d', $y, $mo, $d);
            }
            return null;
        }

        if (preg_match('/^(\d{2})[\/\-](\d{2})[\/\-](\d{4})$/', $s, $m)) {
            $d = (int)$m[1];
            $mo = (int)$m[2];
            $y = (int)$m[3];
            if (checkdate($mo, $d, $y)) {
                return sprintf('%04d-%02d-%02d', $y, $mo, $d);
            }
            return null;
        }

        if (preg_match('/^(\d{4})[\/\-](\d{2})[\/\-](\d{2})$/', $s, $m)) {
            $y = (int)$m[1];
            $mo = (int)$m[2];
            $d = (int)$m[3];
            if (checkdate($mo, $d, $y)) {
                return sprintf('%04d-%02d-%02d', $y, $mo, $d);
            }
            return null;
        }

        return null;
    }

    private static function parseInt($value)
    {
        if ($value === null) {
            return null;
        }
        if (is_int($value)) {
            return $value;
        }
        $s = trim((string)$value);
        if ($s === '') {
            return null;
        }
        if (!preg_match('/^-?\d+$/', $s)) {
            return null;
        }
        return (int)$s;
    }

    private static function parseFloat($value)
    {
        if ($value === null) {
            return null;
        }
        if (is_float($value) || is_int($value)) {
            return (float)$value;
        }
        $s = trim((string)$value);
        if ($s === '') {
            return null;
        }
        $s = str_replace(',', '.', $s);
        if (!is_numeric($s)) {
            return null;
        }
        return (float)$s;
    }

    /**
     * Valida campos alineados con `solicitudes_compra` (mismo criterio que el formulario original).
     */
    public static function validateSolicitudCompra(array $input)
    {
        $errors = [];
        $data = [];

        $supplier = self::cleanString($input['supplier_code'] ?? null);
        if ($supplier === '') {
            self::addError($errors, 'supplier_code', 'El proveedor es requerido.');
        }
        $data['supplier_code'] = $supplier;

        $requestRaw = $input['request_date'] ?? null;
        if ($requestRaw === null || (is_string($requestRaw) && trim($requestRaw) === '')) {
            $requestDate = date('Y-m-d');
        } else {
            $requestDate = self::parseDate($requestRaw);
        }
        if ($requestDate === null) {
            self::addError($errors, 'request_date', 'La fecha de solicitud es inválida.');
        }
        $data['request_date'] = $requestDate;

        $deliveryDate = self::parseDate($input['delivery_date'] ?? null);
        if ($deliveryDate === null) {
            self::addError($errors, 'delivery_date', 'La fecha de entrega es inválida.');
        }
        $data['delivery_date'] = $deliveryDate;

        $description = self::cleanString($input['description'] ?? null);
        if ($description === '') {
            self::addError($errors, 'description', 'La descripción del producto es requerida.');
        }
        if ($description !== '' && self::stringLength($description) > 4000) {
            self::addError($errors, 'description', 'La descripción es demasiado larga.');
        }
        $data['description'] = $description;

        $quantity = self::parseInt($input['quantity'] ?? null);
        if ($quantity === null) {
            self::addError($errors, 'quantity', 'La cantidad es inválida.');
        }
        if ($quantity !== null && $quantity < 1) {
            self::addError($errors, 'quantity', 'La cantidad debe ser >= 1.');
        }
        $data['quantity'] = $quantity;

        $unitPrice = self::parseFloat($input['unit_price'] ?? null);
        if ($unitPrice === null) {
            self::addError($errors, 'unit_price', 'El precio unitario es inválido.');
        }
        if ($unitPrice !== null && $unitPrice < 0) {
            self::addError($errors, 'unit_price', 'El precio unitario debe ser >= 0.');
        }
        $data['unit_price'] = $unitPrice;

        $notes = self::cleanString($input['notes'] ?? '');
        if ($notes !== '' && self::stringLength($notes) > 4000) {
            self::addError($errors, 'notes', 'Las notas son demasiado largas.');
        }
        $data['notes'] = $notes !== '' ? $notes : null;

        if (empty($errors)) {
            $total = ($data['quantity'] ?? 0) * ($data['unit_price'] ?? 0);
            $data['total_cost'] = round((float)$total, 2);
        }

        return [
            'is_valid' => empty($errors),
            'data' => $data,
            'errors' => $errors,
        ];
    }
}
