<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public const IMG_TYPE = 'image';

    public const LETTER_TYPE = 'letter';

    public const TYPES = [
        self::IMG_TYPE,
        self::LETTER_TYPE
    ];

    protected $fillable = [
        'name',
        'original',
        'mime',
        'type'
    ];


    protected $table = 'files';


    public function aboutImage()
    {
        return $this->belongsTo(About::class, 'id', 'image_id', 'image');
    }

    public function aboutLetter()
    {
        return $this->belongsTo(About::class, 'id', 'letter_id', 'letter');
    }


    public function used()
    {
        return $this->aboutLetter || $this->aboutImage;
    }
}
