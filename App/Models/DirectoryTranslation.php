<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectoryTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'directory_id',
        'locale',
        'title',
    ];
}
