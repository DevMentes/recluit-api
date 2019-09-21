<?php

use Recluit\Common\Infraestructure\Http\Controller\IndexApiController;
use Recluit\Postulation\Infraestructure\Http\Controllers\CreatePostulationController;
use Recluit\Security\Infraestructure\Http\Controllers\SignInUserController;
use Recluit\Security\Infraestructure\Http\Controllers\SignUpUserController;

$container['IndexApiController'] = function ($container) {
    return new IndexApiController($container);
};

$container['CreatePostulationController'] = function ($container) {
    return new CreatePostulationController($container);
};

$container['SignInUserController'] = function ($container) {
    return new SignInUserController($container);
};

$container['SignUpUserController'] = function ($container) {
    return new SignUpUserController($container);
};