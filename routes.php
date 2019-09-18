<?php

$app->get('/', 'IndexApiController:index');
$app->post('/postulations', 'CreatePostulationController:create');