<?php

namespace Recluit\Security\Infraestructure\Http\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Recluit\Security\Application\Services\SignInUserService;
use Recluit\Security\Application\Requests\SignInUserRequest;
use Recluit\Common\Jwt\JsonWebTokenGenerator;
use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Security\Infraestructure\Persistence\Repositories\EloquentUserRepository;

class SignInUserController extends Controller
{
    public function auth(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body["email"]) || $body["email"] === "") {
            return $response->withJson([
                "error" => "email field is required."
            ]);
        }
        if (!isset($body["password"]) || $body["password"] === "") {
            return $response->withJson([
                "error" => "password field is required."
            ]);
        }

        $email = $body["email"];
        $password = $body["password"];

        $service = new SignInUserService(new EloquentUserRepository());

        try{
            $authUser = $service->execute(new SignInUserRequest($email, $password));

            return $response->withJson([
                "token" => JsonWebTokenGenerator::generate([
                    "id" => $authUser->id(),
                    "email" => $authUser->email()
                ])
            ]);
        }catch (\Exception $exception){
            return $response->withJson([
                "error" => $exception->getMessage()
            ], 400);
        }
    }
}