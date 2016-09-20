<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    private $err = array(
        403 => array("message" => "You don't have permission"),
        404 => array("message" => "404 - Page Not Found"),
        405 => array("message" => "405 - Method not allowed"),
        500 => array("message" => "500 - Internal Server Error"),
        503 => array("message" => "Be right back")
    );

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        //if($this->isHttpException($e) && view()->exists('errors.'.$e->getStatusCode())){
        if($this->isHttpException($e) && in_array($e->getStatusCode(), array_keys($this->err))){
            return $this->renderHttpException($e);
        }
        else{
            return parent::render($request, $e);
        }
    }

    protected function renderHttpException(HttpException $e)
    {
        //return response()->view('errors.'.$e->getStatusCode(), [], $e->getStatusCode());
        return response()->view('errors.default', ['err' => $this->err[$e->getStatusCode()]], $e->getStatusCode());
    }
}
