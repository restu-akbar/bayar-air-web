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
            $send = function (string $message, int $status, array $headers = []) {
                if (function_exists('errorResponse')) {
                    return errorResponse($message, $status, false);
                }
                return response()->json(['status' => 'error', 'message' => $message], $status, $headers);
            };

            $debug   = (bool) config('app.debug');
            $generic = 'Terjadi kesalahan pada server.';

            // === VALIDATION (422)
            if ($e instanceof ValidationException) {
                $all = collect($e->errors())->flatten()->filter();
                if ($all->isEmpty()) {
                    return $send('Validasi gagal.', 422);
                }
                $first = (string) $all->first();
                $rest  = $all->count() - 1;
                $msg   = $rest > 0 ? "{$first} dan {$rest} error lain." : $first;
                return $send($msg, 422);
            }

            // === RATE LIMIT (429) ===
            if (
                class_exists(ThrottleRequestsException::class)
                && $e instanceof ThrottleRequestsException
            ) {
                $retryAfter = method_exists($e, 'getHeaders') ? ($e->getHeaders()['Retry-After'] ?? null) : null;
                $headers    = $retryAfter ? ['Retry-After' => $retryAfter] : [];
                return $send('Terlalu banyak permintaan. Coba lagi nanti.', 429, $headers);
            }

            // === HTTP CLIENT
            if ($e instanceof HttpClientRequestException) {
                $status  = optional($e->response)->status() ?? 502;
                $message = $debug
                    ? ($e->getMessage() ?: 'Gagal memproses permintaan ke layanan eksternal.')
                    : 'Gagal memproses permintaan ke layanan eksternal.';
                return $send($message, $status);
            }

            // === AUTH / HTTP ===
            if ($e instanceof AuthenticationException)            return $send('Anda belum terautentikasi. Silakan login terlebih dahulu.', 401);
            if ($e instanceof AuthorizationException)             return $send('Tidak memiliki izin untuk aksi ini.', 403);
            if (
                $e instanceof NotFoundHttpException
                || $e instanceof ModelNotFoundException
            )             return $send('Sumber daya tidak ditemukan.', 404);
            if ($e instanceof MethodNotAllowedHttpException)      return $send('Metode HTTP tidak diizinkan.', 405);
            if ($e instanceof TokenMismatchException)             return $send('Sesi kedaluwarsa. Silakan muat ulang halaman.', 419);

            if ($e instanceof ServiceUnavailableHttpException) {
                return $send('Layanan sedang dalam pemeliharaan. Coba lagi nanti.', 503);
            }

            // === DATABASE & STORAGE ===
            if ($e instanceof QueryException) {
                $sqlState = $e->getCode();
                if (in_array($sqlState, ['23000', '40001'], true)) {
                    $msg = $sqlState === '23000'
                        ? 'Data bertentangan dengan data yang sudah ada.'
                        : 'Terjadi konflik transaksi. Silakan coba lagi.';
                    return $send($debug ? ($e->getMessage() ?: $msg) : $msg, 409);
                }
                return $send($debug ? $e->getMessage() : $generic, 500);
            }

            if ($e instanceof \PDOException)         return $send($debug ? $e->getMessage() : 'Kesalahan basis data.', 500);
            if ($e instanceof FilesystemException)   return $send($debug ? $e->getMessage() : 'Kesalahan penyimpanan berkas.', 500);

            // === HTTP EXCEPTIONS ===
            if ($e instanceof HttpExceptionInterface) {
                $status  = $e->getStatusCode();
                $message = $debug ? ($e->getMessage() ?: $generic) : $generic;
                return $send($message, $status);
            }

            // === BAD REQUEST / TYPE ERROR (400) ===
            if ($e instanceof \InvalidArgumentException || $e instanceof \TypeError || $e instanceof \JsonException) {
                $message = $debug ? ($e->getMessage() ?: 'Permintaan tidak valid.') : 'Permintaan tidak valid.';
                return $send($message, 400);
            }

            // === RUNTIME ===
            if ($e instanceof \RuntimeException && (int) $e->getCode() === 422) {
                return $send($debug ? $e->getMessage() : 'Permintaan tidak dapat diproses.', 422);
            }

            Log::error($e);
            return $send($debug ? ($e->getMessage() ?: $generic) : $generic, 500);
        });
    })->create();
