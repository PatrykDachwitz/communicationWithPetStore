<?php
//Configuration swagger: endpoints, available options, default options
return [
    "pet" => [
        "findByStatus" => [
            "url" => "https://petstore.swagger.io/v2/pet/findByStatus",
            "status" => [
                "available",
                "pending",
                "sold",
            ],
            "defaultStatus" => "available",
        ]
    ]
];
