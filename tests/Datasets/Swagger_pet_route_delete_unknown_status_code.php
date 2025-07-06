<?php

dataset('swagger_pet_route_delete_unknown_status_code', function () {
    return [
        100,
        102,
        408,
        410,
        412,
        415,
    ];
});
