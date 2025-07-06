<?php
declare(strict_types=1);


use App\Services\Swagger\Api\Pet\Action\DeleteData;
use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Action\PostData;
use App\Services\Swagger\Api\Pet\Action\PutData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakeDeleteResponse;



describe("Test delete function in Pet Class", function () {
    it("Test correct download data on api", function () {
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakeDeleteResponse();
        $testHttp->activeFakeDeleteRouteResponse(1, 200);

        expect($pet->delete(1))
            ->toMatchArray([
                "statusCode" => 200,
            ]);

    });


    it("Test unknown status code", function (int $statusCode) {
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakeDeleteResponse();
        $testHttp->activeFakeDeleteRouteResponse(1, $statusCode);

        expect($pet->delete(1))
            ->toMatchArray([
                "data" => __("swagger.otherError"),
                "statusCode" => 500,
            ]);

    })->with('swagger_pet_route_delete_unknown_status_code');


    it("Test invalid id status value", function () {
        $responseBody = __("swagger.invalidIdInput");
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakeDeleteResponse();
        $testHttp->activeFakeDeleteRouteResponse(1, 400);

        expect($pet->delete(1))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 400,
            ]);
    });
    it("Test not found id status value", function () {
        $responseBody = __("swagger.notFound");
        $pet = new Pet(new GetData(), new PostData(), new PutData(), new DeleteData());
        $testHttp = new PetFakeDeleteResponse();
        $testHttp->activeFakeDeleteRouteResponse(1, 404);

        expect($pet->delete(1))
            ->toMatchArray([
                "data" => $responseBody,
                "statusCode" => 404,
            ]);
    });
});
