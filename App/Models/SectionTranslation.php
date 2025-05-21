<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class SectionTranslation extends Model
{
    use HasFactory, HasSlug;

    protected $casts = [
        'locale_additional' => 'collection',
    ];

    protected $fillable = [
        'section_id',
        'locale',
        'title',
        'keywords',
        'slug',
        'desc',
        'icon',
        'locale_additional',
        'active',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('title')
        ->saveSlugsTo('slug')
        ->usingLanguage($this->locale)
        ->usingSeparator('-');

    }
}
