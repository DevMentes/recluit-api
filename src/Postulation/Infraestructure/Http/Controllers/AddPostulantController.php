<?php

namespace Recluit\Postulation\Infraestructure\Http\Controllers;

use Illuminate\Database\QueryException;
use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Common\Uuid\UUID;
use Recluit\Postulation\Application\Requests\AddPostulantRequest;
use Recluit\Postulation\Application\Services\AddPostulantService;
use Recluit\Postulation\Infraestructure\Persistence\Repositories\EloquentPostulationRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class AddPostulantController extends Controller
{
    public function add(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body["name"]) || $body["name"] === "") {
            return $response->withJson([
                "error" => "name field is required."
            ])
        }

        if (!isset($body["surname"]) || $body["surname"] === "") {
            return $response->withJson([
                "error" => "surname field is required."
            ])
        }

        if (!isset($body["email"]) || $body["email"] === "") {
            return $response->withJson([
                "error" => "email field is required."
            ])
        }

        if (!isset($body["postulationId"]) || $body["postulationId"] === "") {
            return $response->withJson([
                "error" => "postulationId field is required."
            ])
        }

        $postulantId = UUID::generate();
        $postulantName = $body["name"];
        $postulantSurname = $body["surname"];
        $postulantEmail = $body["email"];
        $postulantResume = "";
        $postulationId = $body["postulationId"]


        $service = new AddPostulantService(
            new EloquentPostulationRepository()
        );

        try {
            $service->execute(new AddPostulantRequest(
                $postulantId,
                $postulantName,
                $postulantSurname,
                $postulantEmail,
                $postulantResume,
                $postulationId
            ));
        } catch (\DomainException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ])
        } catch (QueryException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ])
        }
    }
}