<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;

    protected $casts = [
        'file_additional' => 'collection',
    ];

    protected $fillable = [
        'post_id',
        'type_id',
        'title',
        'file',
        'file_additional',
    ];

    /**
     * Get the user associated with the PostFile
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}
