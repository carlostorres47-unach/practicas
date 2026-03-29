<?php
declare(strict_types=1);

final class Response
{
    private function __construct()
    {
    }

    public static function json(array $payload, int $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        $flags = JSON_UNESCAPED_UNICODE;
        if (defined('JSON_INVALID_UTF8_SUBSTITUTE')) {
            $flags |= JSON_INVALID_UTF8_SUBSTITUTE;
        }
        $json = json_encode($payload, $flags);
        if ($json === false) {
            $json = json_encode([
                'ok' => false,
                'error' => ['message' => 'Error al generar JSON', 'details' => ['json_error' => json_last_error_msg()]],
            ], JSON_UNESCAPED_UNICODE);
        }
        echo $json;
        exit;
    }

    public static function ok($data = null, int $status = 200)
    {
        self::json([
            'ok' => true,
            'data' => $data,
        ], $status);
    }

    public static function error(string $message, int $status = 400, $errors = null)
    {
        self::json([
            'ok' => false,
            'error' => [
                'message' => $message,
                'details' => $errors,
            ],
        ], $status);
    }
}

