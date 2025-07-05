<?php

declare(strict_types=1);

use function Pest\Laravel\get;

it("Test available route index expected status 200", function () {
    get(route("pet.index"))
        ->assertOk();
});
