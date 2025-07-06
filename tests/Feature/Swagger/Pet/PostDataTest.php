<?php
declare(strict_types=1);


use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Action\PostData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakePostResponse;
use App\Services\Swagger\Test\Pet\PetFakeResponse;



describe("Test create function in Pet Class", function () {
    it("Test correct download data on api", function () {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $expectedResponse = json_decode($testHttp->getResponseCreateById(1), true);
        $testHttp->activeFakeCreateRouteResponse(200, $testHttp->getResponseCreateById(1));

        expect($pet->create($expectedResponse))
            ->toMatchArray([
                "data" => $expectedResponse,
                "statusCode" => 200,
            ]);

    });


    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $testHttp->activeFakeCreateRouteResponse($statusCode);

        expect($pet->create([]))
            ->toMatchArray([
                "data" => __("swagger.otherError"),
                "statusCode" => 500,
            ]);

    })->with('swagger_pet_route_create_unknown_status_code');


    it("Test invalid status value", function () {
        $responseBody = __("swagger.invalidValuesForm");
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $testHttp->activeFakeCreateRouteResponse(405);

        expect($pet->create([]))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 405,
            ]);
    });
});



describe("Test update post function in Pet Class", function () {
    it("Test correct download data on api", function () {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $expectedResponse = json_decode($testHttp->getResponseUpdate("test"), true);
        $testHttp->activeFakeUpdateRouteResponse(1, 200, $testHttp->getResponseUpdate("test"));

        expect($pet->updatePost(1, []))
            ->toMatchArray([
                "data" => $expectedResponse,
                "statusCode" => 200,
            ]);

    });


    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $testHttp->activeFakeUpdateRouteResponse(1, $statusCode);

        expect($pet->updatePost(1, []))
            ->toMatchArray([
                "data" => __("swagger.otherError"),
                "statusCode" => 500,
            ]);

    })->with('swagger_pet_route_update_post_unknown_status_code');


    it("Test invalid status value", function () {
        $responseBody = __("swagger.invalidValuesForm");
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $testHttp->activeFakeUpdateRouteResponse(1, 405);

        expect($pet->updatePost(1, []))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 405,
            ]);
    });
    it("Test not found status value", function () {
        $responseBody = __("swagger.notFound");
        $pet = new Pet(new GetData(), new PostData());
        $testHttp = new PetFakePostResponse();
        $testHttp->activeFakeUpdateRouteResponse(1, 404);

        expect($pet->updatePost(1, []))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 404,
            ]);
    });
});

