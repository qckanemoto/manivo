<?php
namespace Qck\Manivo\Interceptor;

use BEAR\Resource\Code;
use BEAR\Sunday\Inject\ResourceInject;
use Parse\ParseException;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

class ParseExceptionCatcher implements MethodInterceptor
{
    use ResourceInject;

    /**
     * @param MethodInvocation $invocation
     * @return mixed|object
     */
    public function invoke(MethodInvocation $invocation)
    {
        switch ($invocation->getMethod()->name) {
            case 'onGet':
                $code = Code::NOT_FOUND;
                break;
            case 'onPost':
                $code = Code::BAD_REQUEST;
                break;
            default:
                $code = Code::ERROR;
                break;
        }

        try {
            return $invocation->proceed();

        } catch (ParseException $e) {
            return $this->resource
                ->get
                ->uri('app://self/exception/parse')
                ->withQuery([
                    'statusCode' => $code,
                    'exceptionCode' => $e->getCode(),
                    'exceptionMessage' => $e->getMessage(),
                ])
                ->eager
                ->request()
            ;
        }
    }
}
