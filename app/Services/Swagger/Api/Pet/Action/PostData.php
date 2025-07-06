<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet\Action;

use App\Services\Swagger\Api\BasicAction\CreateInterface;
use App\Services\Swagger\Api\BasicAction\UpdateInterface;
use App\Services\Swagger\Api\BasicAction\UploadImageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class PostData implements CreateInterface, UpdateInterface, UploadImageInterface
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

    private function getApiResponseWithFile(string $url, array $data, UploadedFile $file) : array {

        $responseApi = Http::attach(
            "file",
            $file->getContent(),
            $file->getClientOriginalName(),
        )
            ->post($url, $data);

        return [
            "data" => $responseApi->json(),
            "statusCode" => $responseApi->getStatusCode(),
        ];
    }

    public function uploadImage(int $id, array $data, UploadedFile $file): array
    {
        $url = str_replace("petId", "{$id}", config('swagger.pet.uploadImage.url'));

        return $this->getApiResponseWithFile($url, $data, $file);
    }
}
