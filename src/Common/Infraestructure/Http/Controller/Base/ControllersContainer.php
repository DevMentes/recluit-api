<?php

use Recluit\Applications\Infraestructure\Http\Controllers\AddApplicantController;
use Recluit\Applications\Infraestructure\Http\Controllers\CreateApplicationController;
use Recluit\Common\Infraestructure\Http\Controller\IndexApiController;
use Recluit\Security\Infraestructure\Http\Controllers\SignInUserController;
use Recluit\Security\Infraestructure\Http\Controllers\SignUpUserController;

$container['IndexApiController'] = function ($container) {
    return new IndexApiController($container);
};

$container['CreateApplicationController'] = function ($container) {
    return new CreateApplicationController($container);
};

$container['SignInUserController'] = function ($container) {
    return new SignInUserController($container);
};

$container['SignUpUserController'] = function ($container) {
    return new SignUpUserController($container);
};

$container['AddApplicantController'] = function ($container) {
    return new AddApplicantController($container);
};