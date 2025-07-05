<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

interface FindByStatusInterface
{
    public function findByStatus(string $status) : array;
}
