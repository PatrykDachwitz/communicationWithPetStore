<?php
declare(strict_types=1);
namespace App\Services\Swagger\Test\Pet;

use \Illuminate\Support\Facades\Http;

class PetFakePutResponse
{
    public function activeFakeUpdateRouteResponse(int $statusCode, string $body = ""): void
    {
        $url = config("swagger.pet.updatePut.url");


        Http::fake([
            $url => Http::response($body, $statusCode)
        ]);
    }
    public function getResponseUpdateById(int $id): string
    {

        return "{
        \"id\": {$id},
        \"category\": {
        \"id\": 0,
        \"name\": \"string\"
        },
        \"name\": \"doggie\",
        \"photoUrls\": [
        \"string\"
        ],
        \"tags\": [
        {
        \"id\": 0,
        \"name\": \"string\"
        }
        ],
        \"status\": \"status\"
        }";

    }

}
