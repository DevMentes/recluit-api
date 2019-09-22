<?php

namespace Recluit\Common\Infraestructure\Http\Controller\Base;

use Slim\Http\Request;

class Controller
{

    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {

            return $this->container->{$property};
        }
    }

    public function getAuthUserFromRequest(Request $request)
    {
        return $request->getAttribute("user");
    }
}