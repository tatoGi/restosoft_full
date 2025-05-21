<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;
    use Translatable;

    protected $fillable = [
        'type_id',
        'parent_id',
        'order_by',
    ];

    public $translatedAttributes = [
        'title',
    ];

    public function children()
    {
        return $this->hasMany('App\Models\Directory', 'parent_id')->with(['translations' => function ($query) {
          $query->where('locale', app()->getLocale());
        }])->with('parent')->with('children')->orderBy('order_by', 'asc');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Directory', 'parent_id')->with('parent.translations');
    }

    public static function rearrange($array)
    {
        self::_rearrange($array, 0);

        \App\Models\Directory::all()->each(function ($item) {
            $item->save();
        });
      }

    private static function _rearrange($array, $count, $parent = null)
    {
    foreach ($array as $a) {
        $count++;
        self::where('id', $a['id'])->update(['parent_id' => $parent, 'order_by' => $count]);

        if (isset($a['children'])) {
        $count = self::_rearrange($a['children'], $count, $a['id']);
        }
    }

    return $count;
    }
}
