<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

interface FindByIdInterface
{
    public function findById(int $id) : array;
}
