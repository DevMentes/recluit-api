<?php

use \Recluit\Common\Infraestructure\Http\Controller\IndexApiController;
use Recluit\Postulation\Infraestructure\Http\Controllers\CreatePostulationController;

$container['IndexApiController'] = function ($container){
    return new IndexApiController($container);
};

$container['CreatePostulationController'] = function ($container) {
    return new CreatePostulationController($container);
};