<?php

namespace App\Rules\Swagger\Pet;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StatusRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!in_array($value, config("swagger.pet.findByStatus.status"))) {
            $fail(__("swagger.unknownStatus"));
        }
    }
}
