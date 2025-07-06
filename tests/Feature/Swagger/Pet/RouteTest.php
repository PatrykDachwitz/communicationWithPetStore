<?php

declare(strict_types=1);

use App\Services\Swagger\Api\Pet\Action\GetData;
use App\Services\Swagger\Api\Pet\Pet;
use App\Services\Swagger\Test\Pet\PetFakeResponse;
use function Pest\Laravel\get;

it("Test available route index expected status 200", function () {
    get(route("pet.index"))
        ->assertOk();
});

it("Test available route show expected status 200", function () {
    get(route("pet.index", [
        "pet" => 123
    ]))
        ->assertOk();
});

it('Test available route create expected status 200', function () {
    get(route("pet.create"))
        ->assertOk();
});
