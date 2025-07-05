<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet;

use App\Services\Swagger\Api\Pet\Action\GetData;
use Exception;
use phpDocumentor\Reflection\Types\Self_;

class Pet implements PetInterface
{
    const AVAILABLE_STATUS_FIND_BY_STATUS = [
        "200",
        "400",
    ];

    public function __construct(
        private GetData $getData
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
}
