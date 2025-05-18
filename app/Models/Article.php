<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'author',
        'content',
        'published'
    ];

    /**
     * @return void
     */
    public static function booted()
    {
        static::creating(function ($article) {
            $article->slug = self::slugUnique($article);
        });

        static::updating(function ($article) {
            $article->slug = self::slugUnique($article);
        });
    }

    private static function slugUnique(self $article): string
    {
        $slug = Str::slug($article->title);
        $original = $slug;
        $i = 1;
        while (self::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }

    /**
     *  Use slug instead of ID
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function images()
    {
        return $this->hasMany(ArticleImage::class);
    }


    protected function scopePublished(Builder $query)
    {
        $query->where('published', 1);
    }


    public function getDescriptionAttribute()
    {
        return Str::limit(
            trim(
                preg_replace('/\s+/', ' ',
                    str_replace("\u{A0}", ' ',
                        strip_tags(
                            html_entity_decode($this->content)
                        )
                    )
                )
            ), 100
        );
    }
}
