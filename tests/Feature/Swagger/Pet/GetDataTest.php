<?php
declare(strict_types=1);


use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Action\PostData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakeResponse;



describe("Test FindByStatus function in Pet Class", function () {
    it("Test correct download data on api", function (string $status) {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeFakeStatus();

        expect($pet->findByStatus($status))
            ->toMatchArray([
                "data" => json_decode($testHttp->getResponseByStatus($status), true),
                "statusCode" => 200,
            ]);

    })->with('swagger_pet_status');

    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData());
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
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeOtherStatus("available", 400);

        expect($pet->findByStatus("available"))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 400,
            ]);
    });
});

describe("Test FindById function in Pet Class", function () {
    it("Test correct download data on api by Id", function (int $id) {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeFakeStatus();

        expect($pet->findById($id))
            ->toMatchArray([
                "data" => json_decode($testHttp->getResponseById($id), true),
                "statusCode" => 200,
            ]);

    })->with('swagger_pet_list_id_for_find_by_id');

    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeOtherFindById(1, $statusCode);

        expect($pet->findById(1))
            ->toMatchArray([
                "data" => __("swagger.otherError"),
                "statusCode" => 500,
            ]);

    })->with('swagger_pet_route_find_by_status_template_unknown_id_code');

    it("Test response for status code 400", function () {
        $responseBody = __("swagger.invalidIdInput");
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeOtherFindById(1, 400);


        expect($pet->findById(1))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 400,
            ]);

    });
    it("Test response for status code 404", function () {
        $responseBody = __("swagger.notFound");
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakeResponse();
        $testHttp->activeOtherFindById(1, 404);


        expect($pet->findById(1))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 404,
            ]);

    });
});

