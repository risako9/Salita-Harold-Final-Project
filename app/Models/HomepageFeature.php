<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['slug', 'title', 'default_image', 'image_path'])]
class HomepageFeature extends Model
{
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? Storage::disk('public')->url($this->image_path)
            : asset($this->default_image);
    }
}
