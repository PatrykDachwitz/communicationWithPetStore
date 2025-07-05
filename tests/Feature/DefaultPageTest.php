<?php
declare(strict_types=1);

use function Pest\Laravel\get;

it('Expected redirect index page to pet index page', function () {
    get(url("/"))
        ->assertStatus(301)
        ->assertRedirectToRoute("pet.index");
});
