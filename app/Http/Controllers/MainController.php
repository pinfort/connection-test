<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request, $path = '/') {
        $responseArr = [
            'request' => [
                'path' => $path,
                'headers' => getallheaders(),
            ],
            'info' => 'This is webservice for test http conenction. See documents at example.com.'
        ];
        return response()->json($responseArr);
    }
}
