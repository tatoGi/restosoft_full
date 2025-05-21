<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $casts = [
        'additional' => 'collection',
    ];

    protected $fillable = [
        'post_id',
        'name',
        'email',
        'text',
        'seen',
        'additional',
    ];

    /**
     * Get the user associated with the Submission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {

        return $this->hasOne(Post::class, 'id', 'post_id')->with('translations');
    }

    /**
     * Get all of the comments for the Submission
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(SubmissionFile::class, 'submission_id', 'id');
    }

    public function getAttribute($key)
    {

        if (isset($this->attributes['additional']) && array_key_exists($key, json_decode($this->attributes['additional'], true))) {

            return json_decode($this->attributes['additional'], true)[$key];
        }

        return parent::getAttribute($key);
    }
}
