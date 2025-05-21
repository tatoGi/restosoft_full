<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Section extends Model
{
    use HasFactory;
    use Translatable;

    protected $casts = [

        'additional' => 'collection',

    ];

    /**
     * The attributes that are mass assignable.

     *

     * @var array
     */
    protected $fillable = [

        'order',

        'cover',

        'additional',

        'parent_id',

        'type_id',

        'image',

    ];

    protected $hidden = [

        '_token',

    ];

    public $translatedAttributes = [

        'title',

        'keywords',

        'slug',

        'desc',

        'icon',

        'locale_additional',

        'active',

    ];

    /**
     * tgis function gets Type of the section

     * you can use it with just "->type"

     *

     * @return void
     */
    public function getTypeAttribute()
    {

        return collect(Config::get('sectionTypes'))->where('id', $this->type_id)->first();

    }

    /**
     * tgis function gets Type of the section

     * you can use it with just "->fields"

     *

     * @return void
     */
    public function getFieldsAttribute()
    {

        return collect(Config::get('sectionTypes'))->where('id', $this->type_id)->first()['fields'];

    }

    public function getFullSlug()
    {

        $slug = Slug::where('slugable_type', 'App\Models\Section')->where('slugable_id', $this->id)->where('locale', app()->getlocale())->first();

        if ($slug !== null) {

            return $slug->fullSlug;

        }

        return null;

    }

    /**
     * isMenuType can section o

     *

     * @param  mixed  $type

     * @return void
     */
    public function scopeMenuType($query, $type)
    {

        $sections_id = MenuSection::where('menu_type_id', array_search($type, menuTypes()))->pluck('section_id')->toArray();

        return $query->where('id', $sections_id);

    }

    public function post()
    {

        return Post::where('section_id', $this->id)->with('submissions')->whereHas('translations', function ($query) {
          $query->where('locale', app()->getLocale());
          $query->whereActive(true)->whereLocale(app()->getLocale());
        })->first();

    }

     /**
      * Get the user associated with the Section

      *

      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
     public function posts()
     {
         return $this->hasMany(Post::class, 'section_id', 'id')->whereHas('translations', function ($query) {
             $query->where('locale', app()->getLocale());
             $query->whereActive(true)->whereLocale(app()->getLocale());
           })->with('translations')->orderBy('date', 'desc');
     }

    public function menuTypes()
    {

        return $this->hasMany(MenuSection::class, 'section_id', 'id');

    }

    public function children()
    {

        return $this->hasMany(Section::class, 'parent_id')->with('translation')->with(['children' => function ($query) {

          $query->whereHas('menuTypes', function ($q) {

              $q->where('menu_type_id', 1);

          });

         }])->orderBy('order', 'asc');

    }

    public function parent()
    {

        return $this->belongsTo(Section::class, 'parent_id')->with('parent.translations');

    }

    public function slugs()
    {

        return $this->morphMany(Slug::class, 'slugable');

    }

    public function getAttribute($key)
    {

        if (in_array($key, locales())) {

            return $this->translations->keyBy('locale')->get($key);

        }

        if (isset($this->attributes['additional']) && array_key_exists($key, json_decode($this->attributes['additional'], true))) {

            return json_decode($this->attributes['additional'], true)[$key];

        }

        return parent::getAttribute($key);

    }

    public static function rearrange($array)
    {

        self::_rearrange($array, 0);

        \App\Models\Section::all()->each(function ($item) {

            $item->save();

        });

      }

    private static function _rearrange($array, $count, $parent = null)
    {

    foreach ($array as $a) {

        $count++;

        self::where('id', $a['id'])->update(['parent_id' => $parent, 'order' => $count]);

        if (isset($a['children'])) {

        $count = self::_rearrange($a['children'], $count, $a['id']);

        }

    }

    return $count;

    }

    public function getTranslatedFullSlugs($slugs = [], $parent = null)
    {

        if (! count($slugs)) {

          $translations = $this->translations;

          foreach ($translations as $key => $value) {

            $slugs[$value->locale] = $value->slug;

          }

          // dd($slugs);

          // $parent = $this->parent;

        } else {

          $translations = $parent->translations;

          foreach ($translations as $key => $value) {

            $slugs[$value->locale] = $value->slug.'/'.$slugs[$value->locale];

          }

          $parent = $parent->parent;

        }

        if ($parent == null) {

          foreach ($slugs as $key => $value) {

            if (count($_GET)) {

              $slugs[$key] = $key.'/'.$value.'?'.http_build_query($_GET);
            } else {

              $slugs[$key] = $key.'/'.$value;

            }

          }

          return $slugs;

        }

        return $this->getTranslatedFullSlugs($slugs, $parent);

      }
}
