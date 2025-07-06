<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\Pet;

interface PetInterface
{
    public function findByStatus(string $status) : array;

    public function findById(int $id) : array;

    public function create(array $data) : array;
    public function updatePost(int $id, array $data) : array;
    public function updatePut(array $data) : array;
}
