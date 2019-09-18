<?php

$app->get('/', function (){

    print_r(
        json_encode(
            [
                "status" => true
            ]
        )
    );
});