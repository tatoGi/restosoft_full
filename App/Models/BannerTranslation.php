<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerTranslation extends Model
{
    use HasFactory;

    protected $casts = [
        'locale_additional' => 'collection',
    ];

    protected $fillable = [
        'banner_id',
        'locale',
        'title',
        'slug',
        'desc',
        'locale_additional',
        'active',
        'image',
    ];

    public function getAttribute($key)
    {

        if (isset($this->attributes['locale_additional']) && array_key_exists($key, json_decode($this->attributes['locale_additional'], true))) {

            return json_decode($this->attributes['locale_additional'], true)[$key];
        }

        return parent::getAttribute($key);
    }
}
