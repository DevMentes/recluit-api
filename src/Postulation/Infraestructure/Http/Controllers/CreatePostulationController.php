<?php

namespace Recluit\Postulation\Infraestructure\Http\Controllers;

use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Common\Uuid\UUID;
use Recluit\Postulation\Application\Requests\CreatePostulationRequest;
use Recluit\Postulation\Application\Services\CreatePostulationService;
use Recluit\Postulation\Infraestructure\Persistence\Repositories\EloquentPostulationRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class CreatePostulationController extends Controller
{
    public function create(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body['title']) || $body['title'] === "") {
            return $response->withJson([
                "error" => "title field is required."
            ]);
        }

        $postulationId = UUID::generate();
        $title = $body['title'];
        $ownerId = $this->getAuthUserFromRequest($request)->id;

        $service = new CreatePostulationService(new EloquentPostulationRepository());
        try {
            $service->execute(new CreatePostulationRequest($postulationId, $title, $ownerId));
            return $response->withJson([
                "message" => "Postulation created successfully."
            ]);
        } catch (\DomainException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ]);
        }
    }
}