<?php
declare(strict_types=1);
namespace App\Services\Swagger\Test\Pet;

use \Illuminate\Support\Facades\Http;

class PetFakePostResponse
{
    public function activeFakeCreateRouteResponse(int $statusCode, string $body = ""): void
    {
        $url = config("swagger.pet.create.url");


        Http::fake([
            $url => Http::response($body, $statusCode)
        ]);
    }
    public function activeFakeUpdateRouteResponse(int $id, int $statusCode, string $body = ""): void
    {
        $url = config("swagger.pet.updatePost.url") . $id;


        Http::fake([
            $url => Http::response($body, $statusCode)
        ]);
    }

    public function getResponseCreateById(int $id): string
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

    public function getResponseUpdate(string $name): string
    {

        return "{
            \"name\": \"{$name}\",
            \"status\": \"test\"
            }";
    }
}
