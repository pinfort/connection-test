<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request, $path = '/') {
        $raw = $request->__toString();
        $raw_request = [];
        $raw_req = explode("\r\n\r\n", $raw);
        foreach ($raw_req as $req) {
            $raw_request = array_merge($raw_request, explode("\n\n", $req));
        }
        $responseArr = [
            'client' => [
                'ip' => $request->ip(),
                'UA' => $request->userAgent(),
                'protocol' => $request->server('SERVER_PROTOCOL'),
                'unix_request_time' => LARAVEL_START,
                'request_time' => date( DATE_ATOM , LARAVEL_START),
            ],
            'request' => [
                'url' => [
                    'scheme' => $request->getScheme(),
                    'host' => $request->getHost(),
                    'port' => $request->getPort(),
                    'path' => $path,
                    'query' => $request->getQueryString(),
                    'full' => $request->fullUrl(),
                ],
                'method' => $request->method(),
                'headers' => getallheaders(),
                'query' => $request->query(),
                'cookie' => $request->cookie(),
                'raw' => $raw,
                'params' => $request->all(),
                'raw_header' => $raw_request[0],
                'raw_body' => array_key_exists(1, $raw_request) ? $raw_request[1] : null,
            ],
            'info' => 'This is webservice for test http connection. See https://github.com/pinfort/connection-test .',
            'server' => [
                'ip' => $request->server('SERVER_ADDR'),
                'processing_time' => microtime(true) - LARAVEL_START,
            ],
        ];
        return response()->json($responseArr);
    }
}
