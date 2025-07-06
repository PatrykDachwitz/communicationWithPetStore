<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

interface CreateInterface
{
    public function create(array $data) : array;
}
