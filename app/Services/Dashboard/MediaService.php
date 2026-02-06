<?php

namespace App\Services\Dashboard;

use Illuminate\Database\Eloquent\Model;

class MediaService
{
    public function uploadSingle(Model $model, $file, string $collection): void
    {
        if ($file) {
            $model->addMedia($file)->toMediaCollection($collection);
        }
    }

    public function uploadMultiple(Model $model, array $files, string $collection, bool $clearFirst = true): void
    {
        if (empty($files)) {
            return;
        }

        if ($clearFirst) {
            $model->clearMediaCollection($collection);
        }

        foreach ($files as $file) {
            $model->addMedia($file)->toMediaCollection($collection);
        }
    }

}
