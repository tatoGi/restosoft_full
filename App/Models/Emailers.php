<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emailers extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'thumb',
        'button_slug',
        'official_web_page',
        'place_for_venue',
        'dates',
        'conference_organize',
        'conference_manager',
        'conference_administrator',
        'contact_phone',
        'contact_email',
    ];
}
