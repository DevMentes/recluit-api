<?php

$app->get('/', 'IndexApiController:index');
$app->post('/postulations', 'CreatePostulationController:create');
$app->post('/signin', 'SignInUserController:auth');
$app->post('/signup', 'SignUpUserController:register');