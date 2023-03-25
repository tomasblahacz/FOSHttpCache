<?php

/*
 * This file is part of the FOSHttpCache package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\HttpCache\Exception;

use Http\Client\Exception\HttpException;

/**
 * Wrapping an error response from the caching proxy.
 */
class ProxyResponseException extends \RuntimeException implements HttpCacheException
{
    /**
     * @return ProxyResponseException
     */
    public static function proxyResponse(HttpException $exception)
    {
        $request = $exception->getRequest();
        $message = sprintf(
            '%s error response "%s" from caching proxy. Request path: %s, query: %s, method %s, contents: %s.',
            $exception->getResponse()->getStatusCode(),
            $exception->getResponse()->getReasonPhrase(),
            $request->getUri()->getPath(),
            $request->getUri()->getQuery(),
            $request->getMethod(),
            $request->getBody()->getContents()
        );

        return new self($message, 0, $exception);
    }
}
