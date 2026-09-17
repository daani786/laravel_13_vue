<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;

#[Fillable(['name', 'description'])]
class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    //

    public function registrerMediaCollections():void{
        $this->addMediaCollection('image')->singleFile;
    }

    public function registerMediaConversions(?Media $media = null): void{
        $this->addMediaConversion('thumb')->fit(Fit::Crop, 100, 100);
    }
}
