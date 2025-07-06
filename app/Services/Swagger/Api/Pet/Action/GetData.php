<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use App\Services\Swagger\Api\BasicAction\FindByIdInterface;
use App\Services\Swagger\Api\BasicAction\FindByStatusInterface;
use Illuminate\Support\Facades\Http;

class GetData implements FindByStatusInterface, FindByIdInterface
{

    public function findByStatus(string $status): array
    {
        return $this->getApiResponse(config("swagger.pet.findByStatus.url"), [
            "status" => $status
        ]);
    }

    private function getApiResponse(string $url, array|null $param = null) : array {
        if (!is_null($param)) {
            $url .= "?" . http_build_query($param);
        }

        $responseApi = Http::get($url);

        return [
            "data" => $responseApi->json(),
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }

    public function findById(int $id): array
    {
        $url = config("swagger.pet.findById.url") . $id;

        return $this->getApiResponse($url);

    }
}
