<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsFile extends Model
{
    use HasFactory;

    protected $table = 'settings_file';

    protected $fillable = [
        'locale',
        'name',
        'path',
        'url',
    ];
}
