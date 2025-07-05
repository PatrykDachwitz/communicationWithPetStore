<?php
declare(strict_types=1);


use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakeResponse;

it("Test correct download data on api", function (string $status) {
    $pet = new Pet(new GetData());
    $testHttp = new PetFakeResponse();
    $testHttp->activeFakeStatus();

    expect($pet->findByStatus($status))
        ->toMatchArray([
            "data" => json_decode($testHttp->getResponseByStatus($status), true),
            "statusCode" => 200,
        ]);

})->with('swagger_pet_status');

it("Test unknown status code", function (int $statusCode) {
    $pet = new Pet(new GetData());
    $testHttp = new PetFakeResponse();
    $testHttp->activeOtherStatus("available", $statusCode);

    expect($pet->findByStatus("available"))
        ->toMatchArray([
            "data" => __("swagger.otherError"),
            "statusCode" => 500,
        ]);

})->with('swagger_pet_route_find_by_status_template_unknown_status_code');

it("Test invalid status value", function () {
    $responseBody = __("swagger.invalidStatusValue");
    $pet = new Pet(new GetData());
    $testHttp = new PetFakeResponse();
    $testHttp->activeOtherStatus("available", 400);


    expect($pet->findByStatus("available"))
        ->toMatchArray([
            "data" => $responseBody,
            "statusCode" => 400,
        ]);

});

