<?php
declare(strict_types=1);
namespace App\Services\Swagger\Test\Pet;

use \Illuminate\Support\Facades\Http;

class PetFakeDeleteResponse
{
    public function activeFakeDeleteRouteResponse(int $id, int $statusCode): void
    {
        $url = config("swagger.pet.delete.url") . $id;


        Http::fake([
            $url => Http::response("", $statusCode)
        ]);
    }
}
