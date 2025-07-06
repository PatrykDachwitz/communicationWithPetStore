<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet;

use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Action\PutData;
use App\Services\Swagger\Api\Pet\Action\PostData;
use Exception;
use Illuminate\Http\UploadedFile;

class Pet implements PetInterface
{
    const AVAILABLE_STATUS_FIND_BY_STATUS = [
        "200",
        "400",
    ];
    const AVAILABLE_STATUS_FIND_BY_ID = [
        "200",
        "400",
        "404",
    ];

    const AVAILABLE_STATUS_CREATE = [
        405,
        200,
    ];

    const AVAILABLE_STATUS_UPDATE_POST = [
        200,
        405,
        404
    ];
    const AVAILABLE_STATUS_UPDATE_PET = [
        200,
        400,
        404,
        405,
    ];
    const AVAILABLE_STATUS_UPLOAD_IMAGE = [
        200,
    ];

    public function __construct(
        private GetData  $getData,
        private PostData $postData,
        private PutData  $putData,
    )
    {

    }

    public function findByStatus(string $status): array
    {
        try {
            $response = $this->getData
                ->findByStatus($status);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_FIND_BY_STATUS)) {
                throw new Exception("Other error");
            } elseif ($response['statusCode'] === 400) {
                $response['data'] = __("swagger.invalidStatusValue");
            }
            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }


    public function findById(int $id): array
    {
        try {
            $response = $this->getData
                ->findById($id);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_FIND_BY_ID)) {
                throw new Exception("Other error");
            } elseif ($response['statusCode'] === 400) {
                $response['data'] = __("swagger.invalidIdInput");
            } elseif ($response['statusCode'] === 404) {
                $response['data'] = __("swagger.notFound");
            }

            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }

    public function create(array $data): array
    {
        try {
            $response = $this->postData
                ->create($data);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_CREATE)) {
                throw new Exception("Other error");
            } elseif ($response['statusCode'] === 405) {
                $response['data'] = __("swagger.invalidValuesForm");
            }

            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }

    public function updatePost(int $id, array $data): array
    {//TODO tutaj poprawić dupliakcję kodu
        try {
            $response = $this->postData
                ->update($id, $data);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_UPDATE_POST)) {
                throw new Exception("Other error");
            } elseif ($response['statusCode'] === 405) {
                $response['data'] = __("swagger.invalidValuesForm");
            } elseif ($response['statusCode'] === 404) {
                $response['data'] = __("swagger.notFound");
            }

            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }

    public function updatePut(array $data): array
    {
        try {
            $response = $this->putData
                ->create($data);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_UPDATE_PET)) {
                throw new Exception("Other error");
            } elseif ($response['statusCode'] === 405) {
                $response['data'] = __("swagger.invalidValuesForm");
            } elseif ($response['statusCode'] === 404) {
                $response['data'] = __("swagger.notFound");
            } elseif ($response['statusCode'] === 400) {
                $response['data'] = __("swagger.invalidIdInput");
            }

            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }

    public function uploadImage(int $id, array $data, UploadedFile $file): array
    {

        try {
            $response = $this->postData
                ->uploadImage($id, $data, $file);

            if (!in_array($response['statusCode'], self::AVAILABLE_STATUS_UPLOAD_IMAGE)) {
                throw new Exception("Other error");
            }

            return $response;
        } catch (Exception) {
            return [
                "statusCode" => 500,
                "data" => __("swagger.otherError"),
            ];
        }
    }
}
