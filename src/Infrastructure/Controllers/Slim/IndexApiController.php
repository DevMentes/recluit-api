<?php

namespace Recluit\Infrastructure\Controllers\Slim;

use Recluit\Infrastructure\Controllers\Slim\Base\Controller;
use Slim\Http\Request;
use Slim\Http\Response;

class IndexApiController extends Controller
{
    public function index(Request $request, Response $response)
    {
        return $response->withJson([
            'message' => 'Welcome to Recluit API',
            'status' => true
        ], 200);
    }
}