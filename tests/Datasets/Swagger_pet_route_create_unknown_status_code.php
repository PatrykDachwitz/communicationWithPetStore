<?php

dataset('swagger_pet_route_create_unknown_status_code', function () {
    return [
        100,
        102,
        408,
        410,
        412,
        415,
    ];
});
