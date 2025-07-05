<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet;

interface PetInterface
{
    public function findByStatus(string $status) : array;
}
