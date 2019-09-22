<?php

use Recluit\Common\Middlewares\TokenValidationMiddleware;

$app->get('/', 'IndexApiController:index');
$app->post('/applications', 'CreateApplicationController:create')->add(new TokenValidationMiddleware());
$app->post('/signin', 'SignInUserController:auth');
$app->post('/signup', 'SignUpUserController:register');
$app->post('/applications/{applicationId}/applicants', 'AddApplicantController:add');