<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use App\Services\Swagger\Api\BasicAction\CreateInterface;
use App\Services\Swagger\Api\BasicAction\UpdateInterface;
use Illuminate\Support\Facades\Http;

class PostData implements CreateInterface, UpdateInterface
{

    public function create(array $data): array
    {
        return $this->getApiResponse(config("swagger.pet.create.url"), $data);
    }

    private function getApiResponse(string $url, array $data) : array {

        $responseApi = Http::withHeaders([
                "Content-Type" => "application/json"
            ])
            ->withBody(json_encode($data))
            ->post($url);

        return [
            "data" => $responseApi->json(),
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }

    public function update(int $id, array $data): array
    {
        return $this->getApiResponse(config("swagger.pet.updatePost.url") . $id, $data);
    }
}
