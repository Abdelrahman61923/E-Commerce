<?php

namespace App\Services\Dashboard;

use App\Models\Slide;

class SlideService
{
    public function getAll($perPage = 10)
    {
        return Slide::latest()->paginate($perPage);
    }

    public function add(array $data)
    {
        $slide = Slide::create($data);
        if (!empty($data['image'])) {
            $slide->addMedia($data['image'])->toMediaCollection('image');
        }
        return $slide;
    }

    public function update(Slide $slide, array $data)
    {
        $slide->update($data);
        if (!empty($data['image'])) {
            $slide->addMedia($data['image'])->toMediaCollection('image');
        }
        return $slide;
    }

    public function delete(Slide $slide)
    {
        return $slide->delete();
    }
}
