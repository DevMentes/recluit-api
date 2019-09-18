<?php

namespace Recluit\Common\Infraestructure\Http\Controller;

use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
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