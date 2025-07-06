<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

interface DeleteInterface
{
    public function delete(int $id) : array;
}
