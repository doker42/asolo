<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
            $article->slug = Str::slug($article->title);
        });

        static::updating(function ($article) {
            $article->slug = Str::slug($article->title);
        });
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


//    protected function description(): Attribute
//    {
//        return Attribute::make(
//            get: fn (string $value) => Str::limit(
//                trim(
//                    preg_replace('/\s+/', ' ', // заменяем множественные пробелы
//                        str_replace("\u{A0}", ' ', // удаляем \u{A0}
//                            strip_tags(
//                                html_entity_decode($this->content)
//                            )
//                        )
//                    )
//                ), 100
//            ),
//        );
//    }

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
