<?php

namespace App\Services\Dashboard;

use App\Models\Slide;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SlideService extends AbstractService
{
    public function __construct(protected MediaService $mediaService)
    {
        parent::__construct();
    }

    protected function model(): Model
    {
        return new Slide();
    }

    public function addSlide(array $data): Slide
    {
        return DB::transaction(function () use ($data) {
            $slide = $this->add($data);

            $this->mediaService->uploadSingle($slide, $data['image'] ?? null, 'image');
            return $slide;
        });
    }

    public function updateSlide(Slide $slide, array $data): Slide
    {
        return DB::transaction(function () use ($slide, $data) {
            $this->update($slide, $data);

            $this->mediaService->uploadSingle($slide, $data['image'] ?? null, 'image');
            return $slide;
        });
    }
}
