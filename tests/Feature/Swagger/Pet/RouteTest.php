<?php

declare(strict_types=1);

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
