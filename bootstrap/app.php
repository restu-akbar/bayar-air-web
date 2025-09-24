<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Client\RequestException as HttpClientRequestException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Support\Facades\Log;
use League\Flysystem\FilesystemException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => CheckAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, $request) {
            $isApi = $request->expectsJson() || $request->is('api/*');

            if (! $isApi) {
                return null;
            };

            if (! function_exists('normalizeMessage')) {
                function normalizeMessage(?string $message, ?string $default = null): string
                {
                    $msg = trim((string) $message);
                    $fallback = $default !== null ? trim($default) : 'Terjadi kesalahan pada server';
                    return $msg !== '' ? $msg : $fallback;
                }
            }

            $generic = 'Terjadi kesalahan pada server';

            $send = function (string $message, int $status, array $headers = [], ?string $defaultMessage = null) use ($generic) {
                $normalized = normalizeMessage($message, $defaultMessage ?? $generic);

                if (function_exists('errorResponse')) {
                    return errorResponse($normalized, $status, false);
                }

                return response()->json([
                    'status'  => 'error',
                    'message' => $normalized,
                ], $status, $headers);
            };

            // === VALIDATION (422)
            if ($e instanceof ValidationException) {
                $all = collect($e->errors())->flatten()->filter();
                if ($all->isEmpty()) {
                    return $send('', 422, [], 'Validasi gagal.');
                }

                $first = (string) $all->first();
                $rest  = $all->count() - 1;
                $msg   = $rest > 0 ? "{$first} dan {$rest} error lain." : $first;

                return $send($msg, 422, [], 'Validasi gagal.');
            }

            // === RATE LIMIT (429) ===
            if (class_exists(ThrottleRequestsException::class) && $e instanceof ThrottleRequestsException) {
                $retryAfter = method_exists($e, 'getHeaders') ? ($e->getHeaders()['Retry-After'] ?? null) : null;
                $headers    = $retryAfter ? ['Retry-After' => $retryAfter] : [];
                return $send('', 429, $headers, 'Terlalu banyak permintaan. Coba lagi nanti.');
            }

            // === HTTP CLIENT (ke service eksternal)
            if ($e instanceof HttpClientRequestException) {
                $status  = optional($e->response)->status() ?? 502;
                $default = 'Gagal memproses permintaan ke layanan eksternal.';
                return $send($e->getMessage() ?: '', $status, [], $default);
            }

            // === AUTH / HTTP ===
            if ($e instanceof AuthenticationException)
                return $send('', 401, [], 'Anda belum terautentikasi. Silakan login terlebih dahulu.');

            if ($e instanceof AuthorizationException)
                return $send('', 403, [], 'Anda tidak memiliki izin untuk aksi ini.');

            if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException)
                return $send('', 404, [], 'Sumber daya tidak ditemukan.');

            if ($e instanceof MethodNotAllowedHttpException)
                return $send('', 405, [], 'Metode HTTP tidak diizinkan.');

            if ($e instanceof TokenMismatchException)
                return $send('', 419, [], 'Sesi kedaluwarsa. Silakan muat ulang halaman.');

            if ($e instanceof ServiceUnavailableHttpException)
                return $send('', 503, [], 'Layanan sedang dalam pemeliharaan. Coba lagi nanti.');

            // === DATABASE & STORAGE ===
            if ($e instanceof QueryException) {
                $sqlState = $e->getCode();

                if (in_array($sqlState, ['23000', '40001'], true)) {
                    $default = $sqlState === '23000'
                        ? 'Data bertentangan dengan data yang sudah ada.'
                        : 'Terjadi konflik transaksi. Silakan coba lagi.';
                    return $send($e->getMessage() ?: '', 409, [], $default);
                }

                return $send($e->getMessage() ?: '', 500, [], $generic);
            }

            if ($e instanceof \PDOException)
                return $send($e->getMessage() ?: '', 500, [], 'Terdapat kesalahan database.');

            if ($e instanceof FilesystemException)
                return $send($e->getMessage() ?: '', 500, [], 'Kesalahan penyimpanan berkas.');

            // === HTTP EXCEPTIONS (umum) ===
            if ($e instanceof HttpExceptionInterface) {
                $status  = $e->getStatusCode();
                return $send($e->getMessage() ?: '', $status, [], $generic);
            }

            // === BAD REQUEST / TYPE ERROR (400) ===
            if ($e instanceof \InvalidArgumentException || $e instanceof \TypeError || $e instanceof \JsonException) {
                return $send($e->getMessage() ?: '', 400, [], 'Permintaan tidak valid.');
            }

            // === RUNTIME (422 business rule) ===
            if ($e instanceof \RuntimeException && (int) $e->getCode() === 422) {
                return $send($e->getMessage() ?: '', 422, [], 'Permintaan tidak dapat diproses.');
            }

            // === FALLBACK ===
            Log::error($e);
            return $send($e->getMessage() ?: '', 500, [], $generic);
        });
    })->create();
