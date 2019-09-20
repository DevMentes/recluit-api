<?php

namespace Recluit\Security\Infraestructure\Http\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use Recluit\Common\Uuid\UUID;
use Recluit\Security\Application\Requests\SignUpUserRequest;
use Recluit\Security\Application\Services\SignUpUserService;
use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Security\Infraestructure\Persistence\Repositories\EloquentUserRepository;

class SignUpUserController extends Controller
{
    public function register(Request $request, Response $response)
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

        $service = new SignUpUserService(new EloquentUserRepository());

        try{
            $service->execute(new SignUpUserRequest(UUID::generate(),$email, $password));
            return $response->withJson([
               "message" => "user was registered successfully"
            ]);
        }catch (\DomainException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ], 400);
        } catch (\Exception $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ], 400);
        }
    }
}