<?php

namespace Recluit\Applications\Infraestructure\Http\Controllers;

use Illuminate\Database\QueryException;
use Recluit\Applications\Application\Requests\AddApplicantRequest;
use Recluit\Applications\Application\Services\AddApplicantService;
use Recluit\Applications\Infraestructure\Persistence\Repositories\EloquentApplicationRepository;
use Recluit\Common\Infraestructure\Http\Controller\Base\Controller;
use Recluit\Common\Uuid\UUID;
use Slim\Http\Request;
use Slim\Http\Response;

class AddApplicantController extends Controller
{
    public function add(Request $request, Response $response, $args = [])
    {
        $body = $request->getParsedBody();

        if (!isset($body["applicantName"]) || $body["applicantName"] === "") {
            return $response->withJson([
                "error" => "applicantName field is required."
            ]);
        }

        if (!isset($body["applicantSurname"]) || $body["applicantSurname"] === "") {
            return $response->withJson([
                "error" => "applicantSurname field is required."
            ]);
        }

        if (!isset($body["applicantEmail"]) || $body["applicantEmail"] === "") {
            return $response->withJson([
                "error" => "applicantEmail field is required."
            ]);
        }

        $applicantId = UUID::generate();
        $applicantName = $body["applicantName"];
        $applicantSurname = $body["applicantSurname"];
        $applicantEmail = $body["applicantEmail"];
        $applicantResume = "";
        $applicationId = $args["applicationId"];


        $service = new AddApplicantService(
            new EloquentApplicationRepository()
        );

        try {
            $service->execute(new AddApplicantRequest(
                $applicantId,
                $applicantName,
                $applicantSurname,
                $applicantEmail,
                $applicantResume,
                $applicationId
            ));
        } catch (\DomainException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ]);
        } catch (QueryException $exception) {
            return $response->withJson([
                "error" => $exception->getMessage()
            ]);
        }
    }
}