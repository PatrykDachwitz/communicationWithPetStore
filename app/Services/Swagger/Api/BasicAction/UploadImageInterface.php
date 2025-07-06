<?php
declare(strict_types=1);
namespace App\Services\Swagger\Api\BasicAction;

use Illuminate\Http\UploadedFile;

interface UploadImageInterface
{
    public function uploadImage(int $id, array $data, UploadedFile $file) : array;
}
