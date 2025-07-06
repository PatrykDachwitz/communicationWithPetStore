<?php
declare(strict_types=1);
namespace App\Services\Swagger\Test\Pet;

use \Illuminate\Support\Facades\Http;

class PetFakeResponse
{


    public function activeOtherStatus(string $status, int $statusCode) : void {
        $url = config("swagger.pet.findByStatus.url") . "?" . http_build_query([
            "status" => $status
            ]);


        Http::fake([
            $url => Http::response("", $statusCode)
        ]);
    }
    public function activeOtherFindById(int $id, int $statusCode) : void {
        $url = config("swagger.pet.findById.url") . $id;


        Http::fake([
            $url => Http::response("", $statusCode)
        ]);
    }

    public function getResponseByStatus(string $status) : string {

        $response = "";

        switch ($status) {
            case "available":
                $response = '[{
    "id": 1926,
    "category": {
      "id": 7904,
      "name": "often"
    },
    "name": "face",
    "photoUrls": [
      "https://dummyimage.com/476x742"
    ],
    "tags": [
      {
        "id": 4795,
        "name": "performance"
      }
    ],
    "status": "pending"
  },
  {
    "id": 8475,
    "category": {
      "id": 3008,
      "name": "fall"
    },
    "name": "parent",
    "photoUrls": [
      "https://placekitten.com/679/796"
    ],
    "tags": [
      {
        "id": 620,
        "name": "board"
      }
    ],
    "status": "available"
  }]';
                break;
            case "sold":
                $response = '[{
    "id": 1243,
    "category": {
      "id": 7904,
      "name": "often"
    },
    "name": "face",
    "photoUrls": [
      "https://dummyimage.com/476x742"
    ],
    "tags": [
      {
        "id": 4795,
        "name": "performance"
      }
    ],
    "status": "pending"
  },
  {
    "id": 8475,
    "category": {
      "id": 3008,
      "name": "fall"
    },
    "name": "parent",
    "photoUrls": [
      "https://placekitten.com/679/796"
    ],
    "tags": [
      {
        "id": 620,
        "name": "board"
      }
    ],
    "status": "sold"
  }]';
                break;
            case "pending":
                $response = '[{
    "id": 54353,
    "category": {
      "id": 7904,
      "name": "often"
    },
    "name": "face",
    "photoUrls": [
      "https://dummyimage.com/476x742"
    ],
    "tags": [
      {
        "id": 4795,
        "name": "performance"
      }
    ],
    "status": "pending"
  },
  {
    "id": 8475,
    "category": {
      "id": 3008,
      "name": "fall"
    },
    "name": "parent",
    "photoUrls": [
      "https://placekitten.com/679/796"
    ],
    "tags": [
      {
        "id": 620,
        "name": "board"
      }
    ],
    "status": "pending"
  }]';
                break;
        }
        return $response;
    }
    public function getResponseById(int $id) : string {

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
\"status\": \"available\"
}";
    }
    public function activeFakeStatus() : void {

        $urlBasicFindByStatus = config("swagger.pet.findByStatus.url");
        $urlBasicFindByID = config("swagger.pet.findById.url");


        Http::fake([
            $urlBasicFindByStatus . "?status=available" => Http::response($this->getResponseByStatus("available"), 200),
            $urlBasicFindByStatus . "?status=sold" => Http::response($this->getResponseByStatus("sold"), 200),
            $urlBasicFindByStatus . "?status=pending" => Http::response($this->getResponseByStatus("pending"), 200),
            $urlBasicFindByID . "12" => Http::response($this->getResponseById(12), 200),
            $urlBasicFindByID . "13" => Http::response($this->getResponseById(13), 200),
            $urlBasicFindByID . "14" => Http::response($this->getResponseById(14), 200),
        ]);
    }
}
