<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use Illuminate\Support\Facades\Http;

class PostData implements \App\Services\Swagger\Api\BasicAction\CreateInterface
{

    public function create(array $data): array
    {
        return $this->getApiResponse(config("swagger.pet.create.url"), $data);
    }

    private function getApiResponse(string $url, array $body) : array {

        $responseApi = Http::withHeaders([
                "Content-Type" => "application/json"
            ])
            ->withBody(json_encode($body))
            ->post($url);

        return [
            "data" => $responseApi->json(),
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }
}
