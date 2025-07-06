<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

interface UpdateInterface
{
    public function update(int $id, array $data) : array;
}
