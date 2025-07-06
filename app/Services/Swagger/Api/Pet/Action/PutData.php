<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use App\Services\Swagger\Api\BasicAction\CreateInterface;
use Illuminate\Support\Facades\Http;

class PutData implements CreateInterface
{

    private function getApiResponse(string $url, array $data) : array {

        $responseApi = Http::withHeaders([
                "Content-Type" => "application/json"
            ])
            ->withBody(json_encode($data))
            ->put($url);

        return [
            "data" => $responseApi->json(),
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }

    public function create(array $data): array
    {
        return $this->getApiResponse(config("swagger.pet.updatePut.url"), $data);
    }
}
