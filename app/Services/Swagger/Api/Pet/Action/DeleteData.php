<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use App\Services\Swagger\Api\BasicAction\CreateInterface;
use App\Services\Swagger\Api\BasicAction\DeleteInterface;
use Illuminate\Support\Facades\Http;

class DeleteData implements DeleteInterface
{

    private function getApiResponse(string $url) : array {

        $responseApi = Http::withToken(env("API_KEY", ""))
            ->delete($url);

        return [
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }

    public function delete(int $id): array
    {
        return $this->getApiResponse(config("swagger.pet.delete.url") . $id);
    }
}
