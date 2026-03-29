<?php
declare(strict_types=1);

/**
 * Configuración de base de datos.
 * Ajusta estos valores a tu entorno (MySQL) o define las variables de entorno:
 * DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHARSET.
 */

function envOr(string $key, string $default): string
{
    $val = getenv($key);
    if ($val === false || $val === '') return $default;
    return (string)$val;
}

define('DB_HOST', envOr('DB_HOST', 'sql311.byethost11.com'));
define('DB_NAME', envOr('DB_NAME', 'b11_41502120_stitch'));
define('DB_USER', envOr('DB_USER', 'b11_41502120'));
define('DB_PASS', envOr('DB_PASS', '180924'));
define('DB_CHARSET', envOr('DB_CHARSET', 'utf8mb4'));

