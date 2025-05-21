<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    use Translatable;

    protected $casts = [
        'additional' => 'collection',
    ];

    protected $fillable = [
        'type_id',
        'additional',
        'thumb',
        'author_id',
        'date',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'desc',
        'locale_additional',
        'active',
    ];

    public function files()
    {
        return $this->hasMany(BannerFile::class, 'banner_id', 'id');
    }

    public function getAttribute($key)
    {
        if (in_array($key, locales())) {
            return $this->translations->keyBy('locale')->get($key);
        }

        if (isset($this->attributes['locale_additional']) && array_key_exists($key, json_decode($this->attributes['locale_additional'], true))) {

            return json_decode($this->attributes['locale_additional'], true)[$key];
        }

        return parent::getAttribute($key);
    }
}
