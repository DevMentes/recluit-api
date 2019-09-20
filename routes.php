<?php

use Recluit\Common\Middlewares\TokenValidationMiddleware;

$app->get('/', 'IndexApiController:index');
$app->post('/postulations', 'CreatePostulationController:create')->add(new TokenValidationMiddleware());
$app->post('/signin', 'SignInUserController:auth');
$app->post('/signup', 'SignUpUserController:register');