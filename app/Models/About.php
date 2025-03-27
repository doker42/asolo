<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends BaseInfo
{
    protected $fillable = [
        'about',
        'email',
        'git',
        'linkdin',
        'telegram',
        'letter_id',
        'image_id',
    ];

    protected $table = 'abouts';

    public function image()
    {
        return $this->hasOne(File::class, 'id','image_id');
    }

    public function letter()
    {
        return $this->hasOne(File::class, 'id', 'letter_id');
    }
}
