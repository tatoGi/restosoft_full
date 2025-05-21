<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerFile extends Model
{
    use HasFactory;

    protected $casts = [
        'file_additional' => 'collection',
    ];

    protected $fillable = [
        'banner_id',
        'type_id',
        'title',
        'file',
        'file_additional',
    ];

    public function getAttribute($key)
    {

        if (isset($this->attributes['file_additional']) && array_key_exists($key, json_decode($this->attributes['file_additional'], true))) {

            return json_decode($this->attributes['file_additional'], true)[$key];
        }

        return parent::getAttribute($key);
    }
}
