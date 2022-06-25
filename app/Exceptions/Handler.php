<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // レポート
        $this->reportable(function (Throwable $e) {

        });

        // レスポンス
        $this->renderable(function (Throwable $e) {
            // 404
            if ($e instanceof NotFoundHttpException) {
                return response()->json(['message' => $this->getErrorMessages($e->getStatusCode())]);
            }

            // 405
            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->json(['message' => $this->getErrorMessages($e->getStatusCode())]);
            }

            // 500 Api error.
            if ($e instanceof ExternalApiException) {
                $errorMessage = empty($e->getMessage()) ? $this->getErrorMessages($e->getCode()) : $e->getMessage();
                return response()->json(['message' => $errorMessage], $e->getCode());
            }

        });

    }

    /**
     * エラーメッセージ取得
     *
     * @param integer $statusCode
     * @return void
     */
    private function getErrorMessages(int $statusCode): string 
    {
        $errorMessages = [
            Response::HTTP_BAD_REQUEST => 'Bad Request.',
            Response::HTTP_UNAUTHORIZED => 'UnAuthorized.',
            Response::HTTP_NOT_FOUND => 'Not Found.',
            Response::HTTP_METHOD_NOT_ALLOWED => 'Method Not Allowed.',
            Response::HTTP_INTERNAL_SERVER_ERROR => 'Internal Server Error.',
        ];

        return $errorMessages[$statusCode];
    }
}
