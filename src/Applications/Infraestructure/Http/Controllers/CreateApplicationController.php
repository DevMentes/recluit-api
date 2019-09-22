<?php

namespace Recluit\Applications\Infraestructure\Http\Controllers;

use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Common\Uuid\UUID;
use Recluit\Applications\Application\Requests\CreateApplicationRequest;
use Recluit\Applications\Application\Services\CreateApplicationService;
use Recluit\Applications\Infraestructure\Persistence\Repositories\EloquentApplicationRepository;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateApplicationController extends Controller
{
    public function create(Request $request, Response $response)
    {
        $body = $request->getParsedBody();

        if (!isset($body['title']) || $body['title'] === "") {
            return $response->withJson([
                "error" => "title field is required."
            ]);
        }

        $applicationId = UUID::generate();
        $title = $body['title'];
        $ownerId = $this->getAuthUserFromRequest($request)->id;

        $service = new CreateApplicationService(new EloquentApplicationRepository());
        try {
            $service->execute(new CreateApplicationRequest($applicationId, $title, $ownerId));
            return $response->withJson([
                "message" => "Applications created successfully."
            ]);
        } catch (\DomainException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ]);
        }
    }
}