<?php
declare(strict_types=1);


use App\Services\Swagger\Api\Pet\Action\DeleteData;
use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Action\PostData;
use App\Services\Swagger\Api\Pet\Action\PutData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakePutResponse;



describe("Test Update function in Pet Class -> put method", function () {
    it("Test correct download data on api", function () {
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakePutResponse();
        $expectedResponse = json_decode($testHttp->getResponseUpdateById(1), true);
        $testHttp->activeFakeUpdateRouteResponse(200, $testHttp->getResponseUpdateById(1));

        expect($pet->updatePut($expectedResponse))
            ->toMatchArray([
                "data" => $expectedResponse,
                "statusCode" => 200,
            ]);

    });


    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakePutResponse();
        $testHttp->activeFakeUpdateRouteResponse($statusCode);

        expect($pet->updatePut([]))
            ->toMatchArray([
                "data" => __("swagger.otherError"),
                "statusCode" => 500,
            ]);

    })->with('swagger_pet_route_update_put_unknown_status_code');


    it("Test invalid inputs status value", function () {
        $responseBody = __("swagger.invalidValuesForm");
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakePutResponse();
        $testHttp->activeFakeUpdateRouteResponse(405);

        expect($pet->updatePut([]))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 405,
            ]);
    });

    it("Test not found status value", function () {
        $responseBody = __("swagger.notFound");
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakePutResponse();
        $testHttp->activeFakeUpdateRouteResponse(404);

        expect($pet->updatePut([]))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 404,
            ]);
    });

    it("Test invalid ID value status value", function () {
        $responseBody = __("swagger.invalidIdInput");
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakePutResponse();
        $testHttp->activeFakeUpdateRouteResponse(400);

        expect($pet->updatePut([]))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 400,
            ]);
    });
});
